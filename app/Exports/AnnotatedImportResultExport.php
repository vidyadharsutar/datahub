<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AnnotatedImportResultExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /** @var array<int, array<string,mixed>> */
    protected array $rows;

    /** @var array<int> 1-based sheet row numbers that had errors (data rows) */
    protected array $errorSheetRowNumbers;

    /** @var array<string> */
    protected array $headings;

    public function __construct(array $annotatedRows, array $errorSheetRowNumbers)
    {
        $this->rows = $annotatedRows;
        $this->errorSheetRowNumbers = $errorSheetRowNumbers;

        // Build headings from the first row keys (keeps order incl. 'error' at end)
        $this->headings = array_keys($annotatedRows[0] ?? []);
    }

    public function collection()
    {
        // Only values in heading order
        $ordered = array_map(function ($row) {
            $orderedRow = [];
            foreach ($this->headings as $h) {
                $orderedRow[] = $row[$h] ?? null;
            }
            return $orderedRow;
        }, $this->rows);

        return new Collection($ordered);
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $colCount = count($this->headings);
                // Convert column count to an Excel column letter (A, B, ..., AA...)
                $endColumn = $this->columnLetterFromNumber($colCount);

                // Style header
                $sheet->getStyle("A1:{$endColumn}1")->getFont()->setBold(true);

                // For each failing row number, fill background red across full width
                foreach ($this->errorSheetRowNumbers as $rowNum) {
                    // RowNum is already the actual sheet row (incl. header offset)
                    $range = "A{$rowNum}:{$endColumn}{$rowNum}";
                    $sheet->getStyle($range)->getFill()->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FFFFCCCC'); // light red
                }
            },
        ];
    }

    protected function columnLetterFromNumber(int $num): string
    {
        $letters = '';
        while ($num > 0) {
            $mod = ($num - 1) % 26;
            $letters = chr(65 + $mod) . $letters;
            $num = (int)(($num - $mod) / 26);
        }
        return $letters;
    }
}
