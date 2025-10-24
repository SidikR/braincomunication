<?php

namespace App\Http\Controllers\Administrator;

use App\Models\ProfilKami;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilKamiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profilKami = ProfilKami::first();
        $data = [
            'header_name' => "Profil Kami",
            'page_name' => "Profil Kami"
        ];
        return view('administrator-page.pages.tentang-kami.profil-kami.index', compact('profilKami', 'data'));
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

        // Mengambil data pertama dari tabel ProfilKami
        $profilKami = ProfilKami::first();

        // Memperbarui konten dengan data yang diterima dari form
        $profilKami->update([
            'konten' => $request->input('konten'),
        ]);

        // Redirect atau kembalikan respon setelah berhasil update
        return redirect()->back()->with('success', 'Konten berhasil diperbarui');
    }

}
