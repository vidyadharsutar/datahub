<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserLogsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }
}
