<?php

namespace App\Http\Controllers\administrator;

use App\Models\Info;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class InfoController extends Controller
{

    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:150',
            'email' => 'nullable|max:255',
            'hp' => 'nullable|max:255',
            'alamat' => 'required|max:255',
            'instagram' => 'nullable|max:255',
            'facebook' => 'nullable|max:255',
            'youtube' => 'nullable|max:255',
            'tiktok' => 'nullable|max:255',
            'twitter' => 'nullable|max:255',
            'maps' => 'required',
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.max' => 'Judul tidak boleh lebih dari 150 karakter.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'hp.max' => 'Nomor HP tidak boleh lebih dari 255 karakter.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'instagram.max' => 'Instagram tidak boleh lebih dari 255 karakter.',
            'facebook.max' => 'Facebook tidak boleh lebih dari 255 karakter.',
            'youtube.max' => 'Youtube tidak boleh lebih dari 255 karakter.',
            'tiktok.max' => 'TikTok tidak boleh lebih dari 255 karakter.',
            'twitter.max' => 'Twitter tidak boleh lebih dari 255 karakter.',
            'maps.required' => 'Peta lokasi harus diisi.',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "Info",
                'page_name' => "Data Info"
            ];
            $info = Info::first();
            return view('administrator-page.pages.info.index', compact('info', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data info. ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $info = Info::findOrFail($id);
            $data = [
                'header_name' => "Info",
                'page_name' => "Edit Info "
            ];
            return view('administrator-page.pages.info.edit', compact('data', 'info'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data info. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        try {
            $info = Info::findOrFail($id);
            $validatedData = $this->validateData($request); //ambil data request dari validatedData
            $info->update($validatedData); //update validatedData ke DB
            Session::flash('success', 'Data info berhasil diubah');
            return redirect()->route('dashboard.administrator.info.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }
}
