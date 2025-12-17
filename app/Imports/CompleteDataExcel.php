<?php

namespace App\Imports;

use App\Models\CompleteData;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class CompleteDataExcel implements ToCollection, WithHeadingRow, WithChunkReading, SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsFailures, SkipsErrors;

    public int $inserted = 0;
    public int $skipped  = 0;

    private array $required = ['email']; 

    private array $keys = [
        'date','salutation','first_name','middle_name','last_name','full_name','email','domain',
        'company_name','employee_size','see_all_employee_size','job_title','industry','phone',
        'address','city','state','zip_code','country','role','department','revenue','ip','ip_link',
        'jt_link','company_link','address_link','number_link','revenue_link','naics_code',
        'saics_code','ra_comments','ra_comments_1','ra_name','so_report','so_email_status',
        'elv_report','elv_email_status','mailchimp_outlook_report','mailchimp_outlook_email_status',
        'benchmark_report','benchmark_status','briteverify_report','briteverify_status',
        'neverbounce_report','neverbounce_status','qa_remark_1','qa_remark_2','qa_data_status',
        'quality_analyst','phone_verification_executive','pv_status','post_qualification_analyst',
        'pqa_remark_1','pqa_remark_2','pqa_data_status','mis_executive','mis_remarks','delivery_status'
    ];

    /** Optional: simple alias map for messy headers */
    private array $aliases = [
        'email'     => ['email','e-mail','email address','email_id','mail'],
        'full_name' => ['full_name','full name','name'],
        'first_name'=> ['first_name','first name','firstname','fname','f_name'],
        'last_name' => ['last_name','last name','lastname','lname','l_name'],
        'phone'     => ['phone','phone number','mobile','mobile number','contact','contact number'],
        'state'     => ['state','  state','   state','state '], // catch stray spaces
    ];
    

    public function collection(Collection $rows): void
    {
        if ($rows->isEmpty()) return;

        $now   = Carbon::now();
        $batch = [];

        foreach ($rows as $row) {
            $norm = $this->normalizeRow($row->toArray());

            $doc = [];
            foreach ($this->keys as $k) {
                $doc[$k] = $this->getValue($norm, $k);
            }

            if (!empty($doc['phone'])) {
                $doc['phone'] = preg_replace('/\s+/', '', (string) $doc['phone']);
            }
            if (!empty($doc['email'])) {
                $doc['email'] = Str::lower((string) $doc['email']);
            }
            
            if (!$this->isValidRow($doc)) {
                $this->skipped++;
                continue;
            }

            // timestamps (optional)
            $doc['created_at'] = $now;
            $doc['updated_at'] = $now;

            $batch[] = $doc;
        }

        if (!$batch) return;

        $model = new \App\Models\CompleteData();
        $db = $model->getConnection()->getDatabase();
        $collection = $db->selectCollection($model->getTable());

        try {
            $r = $collection->insertMany($batch, ['ordered' => false]);
            $this->inserted += $r->getInsertedCount();
        } catch (Throwable $e) {
            $this->skipped += count($batch);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    /** ---------- helpers ---------- */

    /** normalize keys: lowercase, collapse non-alnum to underscores, trim underscores */
    private function normalizeKey(string $k): string
    {
        $k = Str::lower($k);
        $k = preg_replace('/[^a-z0-9]+/','_', $k);
        return trim($k, '_');
    }

    /** normalize an entire row’s keys + trim string values */
    private function normalizeRow(array $row): array
    {
        $out = [];
        foreach ($row as $k => $v) {
            $nk = $this->normalizeKey((string) $k);
            $out[$nk] = is_string($v) ? trim($v) : $v;
        }
        return $out;
    }

    /** get value by exact key or from aliases; returns null if missing */
    private function getValue(array $norm, string $logicalKey)
    {
        // try exact normalized key first
        $nk = $this->normalizeKey($logicalKey);
        if (array_key_exists($nk, $norm)) return $norm[$nk];

        // then try aliases
        if (isset($this->aliases[$logicalKey])) {
            foreach ($this->aliases[$logicalKey] as $alias) {
                $ak = $this->normalizeKey($alias);
                if (array_key_exists($ak, $norm)) return $norm[$ak];
            }
        }
        // missing column -> null (don’t fail the row)
        return null;
    }

    private function isValidRow(array $doc): bool
    {
        // only check the truly required fields
        foreach ($this->required as $k) {
            if (!isset($doc[$k]) || $doc[$k] === '' || $doc[$k] === null) return false;
        }
        if (!empty($doc['email']) && !filter_var($doc['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
}
