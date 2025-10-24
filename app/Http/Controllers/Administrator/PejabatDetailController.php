<?php

namespace App\Http\Controllers\administrator;

use Illuminate\Http\Request;
use App\Models\PejabatContent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PejabatDetailController extends Controller
{
    public function edit($id)
    {
        $content = PejabatContent::findOrFail($id);
        $data = [
            'header_name' => "Konten Pejabat",
            'page_name' => "Edit Data Konten Pejabat"
        ];
        return view('administrator-page.pages.pejabat.konten-pejabat', compact('data', 'content'));
    }


    public function update(Request $request, $id)
    {
        try {
            $konten_pejabat = PejabatContent::findOrFail($id);
            // Validating request data
            $validatedData = $request->validate([
                'content' => 'required'
            ]);

            // Updating the existing KategoriBerita instance
            $konten_pejabat->update([
                'content' => $validatedData['content'],
            ]);

            // Flashing success message and redirecting
            Session::flash('success', 'Data konten pejabat berhasil diperbarui');
            return redirect()->route('dashboard.administrator.pejabat.index');
        } catch (ValidationException $e) {
            // Redirecting back with errors if validation fails
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Terjadi kesalahan saat memproses permintaan Anda.');
        }
    }
}
