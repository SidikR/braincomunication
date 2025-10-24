<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Sejarah::first();
        $data = [
            'header_name' => "Sejarah",
            'page_name' => "Sejarah"
        ];
        return view('administrator-page.pages.tentang-kami.sejarah.index', compact('sejarah', 'data'));
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

        // Mengambil data pertama dari tabel Sejarah
        $sejarah = Sejarah::first();

        // Memperbarui konten dengan data yang diterima dari form
        $sejarah->update([
            'konten' => $request->input('konten'),
        ]);

        // Redirect atau kembalikan respon setelah berhasil update
        return redirect()->back()->with('success', 'Konten berhasil diperbarui');
    }
}
