<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    public function index()
    {
        $data = [
            'header_name' => "File Manager",
            'page_name' => "File Manager"
        ];
        return view('administrator-page.pages.file-manager.index', compact('data'));
    }
}
