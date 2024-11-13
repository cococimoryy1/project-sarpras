<?php

namespace App\Http\Controllers;

use App\Models\ErrorLogModel;
use Illuminate\Http\Request;

class LogErrorController extends Controller
{
    public function index()
    {
        $data = ErrorLogModel::paginate(10);
        return view('error', compact('data'));
    }
}
