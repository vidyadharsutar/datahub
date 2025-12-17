<?php

namespace App\Http\Controllers\CompleteData;

use App\Http\Controllers\Controller;
use App\Imports\CompleteDataExcel;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CompleteDataController extends Controller
{
    public function index()
    {
        return view('complete_data.index');
    }

    public function store(Request $request)
    {
        // 1) Validate input
        $request->validate([
            'complete_data_file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:20480'], // 20MB
        ]);

        $userId    = Auth::id();
        $ipAddress = $request->ip();
        $action    = 'UPLOAD_COMPLETE_DATA'; // fixed typo
        $city      = 'Pune';

        $sizeBytes = $request->file('complete_data_file')->getSize();
        $filesize = round($sizeBytes / 1048576, 2); //file size in MB
        $name   = $request->file('complete_data_file')->getClientOriginalName(); // original file name
        $file = $request->file('complete_data_file')->getPathname(); // temporary file path
        $type = 'Complete';


        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rowCount = $sheet->getHighestDataRow();

        try {
            $import = new CompleteDataExcel();
            Excel::import($import, $request->file('complete_data_file'));

            Log::create([
                'timestamp'   => now(),
                'user_id'     => $userId,
                'ipaddress'   => $ipAddress,
                'action'      => $action,
                'description' => 'Data imported successfully.' . ' Inserted: ' . $import->inserted . ', Skipped: ' . $import->skipped,
                'location'    => $city,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data imported successfully!',
            ], 200);
        } catch (\Throwable $e) {
            Log::create([
                'timestamp'   => now(),
                'user_id'     => $userId,
                'ipaddress'   => $ipAddress,
                'action'      => "UPLOAD_COMPLETE_EXCEPTION",
                'description' => $e->getMessage(),
                'location'    => $city,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to import data.',
            ], 500);
        }
    }
}
