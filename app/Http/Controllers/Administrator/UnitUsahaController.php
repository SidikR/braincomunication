<?php

namespace App\Http\Controllers;

use App\Models\UnitUsaha;
use Illuminate\Http\Request;

class UnitUsahaController extends Controller
{
    public function index()
    {
        $unitUsaha = UnitUsaha::first();
        $data = [
            'header_name' => "Unit Usaha",
            'page_name' => "Unit Usaha"
        ];
        return view('administrator-page.pages.tentang-kami.unit-usaha.index', compact('unitUsaha', 'data'));
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

        // Mengambil data pertama dari tabel UnitUsaha
        $unitUsaha = UnitUsaha::first();

        // Memperbarui konten dengan data yang diterima dari form
        $unitUsaha->update([
            'konten' => $request->input('konten'),
        ]);

        // Redirect atau kembalikan respon setelah berhasil update
        return redirect()->back()->with('success', 'Konten berhasil diperbarui');
    }
}
