<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Models\HeroCarouselPromo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class HeroCarouselPromoController extends Controller
{
    public function store(Request $request)
    {
        try {
            // dd($request);
            $validateData = $request->validate([
                'heading' => 'nullable|max:255',
                'paragraph' => 'nullable|max:255',
                'image' => 'required',
                'alt_image' => 'nullable|max:255',
                'jenis' => 'required|in:promo,testimoni',
            ], [
                'heading.max' => 'Judul tidak boleh lebih dari :max karakter.',
                'paragraph.max' => 'Paragraf tidak boleh lebih dari :max karakter.',
                'image.required' => 'Gambar diperlukan.',
                'alt_image.max' => 'Teks alternatif gambar tidak boleh lebih dari :max karakter.',
                'jenis.required' => 'Jenis harus diisi.',
                'jenis.in' => 'Jenis harus salah satu dari: promo atau testimoni.',
            ]);

            $heroCarousel = HeroCarouselPromo::create([
                'heading' => $validateData['heading'],
                'paragraph' => $validateData['paragraph'],
                'image' => $validateData['image'],
                'alt_image' => $validateData['alt_image']
            ]);

            Session::flash('success', 'Data hero berhasil ditambahkan');
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {

        try {
            $validateData = $request->validate([
                'heading' => 'nullable|max:255',
                'paragraph' => 'nullable|max:255',
                'image' => 'required',
                'alt_image' => 'nullable|max:255',
                'jenis' => 'required|in:promo,testimoni',
            ], [
                'heading.max' => 'Judul tidak boleh lebih dari :max karakter.',
                'paragraph.max' => 'Paragraf tidak boleh lebih dari :max karakter.',
                'image.required' => 'Gambar diperlukan.',
                'alt_image.max' => 'Teks alternatif gambar tidak boleh lebih dari :max karakter.',
                'jenis.required' => 'Jenis harus diisi.',
                'jenis.in' => 'Jenis harus salah satu dari: promo atau testimoni.',
            ]);

            $heroCarousel = HeroCarouselPromo::findOrFail($id);

            $heroCarousel->update([
                'heading' => $validateData['heading'],
                'paragraph' => $validateData['paragraph'],
                'image' => $validateData['image'],
                'alt_image' => $validateData['alt_image'],
                'jenis' => $validateData['jenis'],
            ]);

            Session::flash('success', 'Data hero berhasil diubah');
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $heroCarousel = HeroCarouselPromo::findOrFail($id);

            // Soft delete data
            $heroCarousel->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data Hero berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data hero : ' . $e->getMessage()
            ]);
        }
    }
}
