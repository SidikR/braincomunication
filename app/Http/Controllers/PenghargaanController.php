<?php

namespace App\Http\Controllers;

use App\Models\Penghargaan;
use Illuminate\Http\Request;

class PenghargaanController extends Controller
{
    public function index()
    {
        $penghargaan = Penghargaan::first();
        $data = [
            'header_name' => "Penghargaan",
            'page_name' => "Penghargaan"
        ];
        return view('administrator-page.pages.tentang-kami.penghargaan.index', compact('penghargaan', 'data'));
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

        // Mengambil data pertama dari tabel Penghargaan
        $penghargaan = Penghargaan::first();

        // Memperbarui konten dengan data yang diterima dari form
        $penghargaan->update([
            'konten' => $request->input('konten'),
        ]);

        // Redirect atau kembalikan respon setelah berhasil update
        return redirect()->back()->with('success', 'Konten berhasil diperbarui');
    }
}
