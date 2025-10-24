<?php

namespace App\Http\Controllers\administrator;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AboutController extends Controller
{

    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:150',
            'description' => 'required',
            'content' => 'required',
            'iframe' => 'required',
        ], [
            'title.required' => 'Judul diperlukan.',
            'title.max' => 'Judul tidak boleh lebih dari :max karakter.',
            'description.required' => 'Deskripsi diperlukan.',
            'content.required' => 'Konten diperlukan.',
            'iframe.required' => 'Iframe diperlukan.',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "About",
                'page_name' => "Data About"
            ];
            $about = About::first();
            return view('administrator-page.pages.about.index', compact('about', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data about. ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $about = About::findOrFail($id);
            $data = [
                'header_name' => "About",
                'page_name' => "Edit About "
            ];
            return view('administrator-page.pages.about.edit', compact('data', 'about'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data about. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        try {
            $about = About::findOrFail($id);
            $validatedData = $this->validateData($request); //ambil data request dari validatedData
            $about->update($validatedData); //update validatedData ke DB
            Session::flash('success', 'Data about berhasil diubah');
            return redirect()->route('dashboard.administrator.about.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }
}
