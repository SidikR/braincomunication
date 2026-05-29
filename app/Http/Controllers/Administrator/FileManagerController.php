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

    public function uploadSummernoteImage(Request $request)
    {
        $request->validate(['file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10120']);
        $path = $request->file('file')->store('summernote', 'public');
        return response()->json(['url' => asset('storage/' . $path)]);
    }
}
