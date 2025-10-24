<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturOrganisasi = StrukturOrganisasi::first();
        $data = [
            'header_name' => "Struktur Organisasi",
            'page_name' => "Struktur Organisasi"
        ];
        return view('administrator-page.pages.tentang-kami.struktur-organisasi.index', compact('strukturOrganisasi', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'konten' => 'required|string',
        ]);

        // Mengambil data pertama dari tabel StrukturOrganisasi
        $strukturOrganisasi = StrukturOrganisasi::first();

        // Memperbarui konten dengan data yang diterima dari form
        $strukturOrganisasi->update([
            'konten' => $request->input('konten'),
        ]);

        // Redirect atau kembalikan respon setelah berhasil update
        return redirect()->back()->with('success', 'Konten berhasil diperbarui');
    }
}
