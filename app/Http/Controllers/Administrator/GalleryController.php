<?php

namespace App\Http\Controllers\administrator;

use App\Models\Photo;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriGallery;
use Symfony\Component\Uid\Ulid;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class GalleryController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:150',
            'description' => 'required|max:150',
            'category_id' => 'required|integer', // Mengubah aturan validasi
            'image' => 'required',
            'alt_image' => 'nullable|max:150' // Mengubah aturan validasi
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.max' => 'Judul tidak boleh lebih dari 150 karakter.',
            'alt_image.max' => 'Alt Image tidak boleh lebih dari 150 karakter.',
            'description.max' => 'Alt Image tidak boleh lebih dari 150 karakter.',
            'description.required' => 'Deskripsi harus diisi.',
            'category_id.required' => 'Kategori harus dipilih.',
            'category_id.integer' => 'Kategori harus berupa angka.', // Menambahkan pesan untuk category_id
            'image.required' => 'Gambar harus diunggah.',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kategori_galeri = KategoriGallery::all();
            $galeri = Gallery::getGalery();
            // dd($galeri);
            $data = [
                'header_name' => "Daftar Galeri Foto",
                'page_name' => "Data Galeri Foto"
            ];
            return view('administrator-page.pages.galeri.index', compact('galeri', 'kategori_galeri', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $kategori_galeri = KategoriGallery::all();
            $data = [
                'header_name' => "Galeri Foto",
                'page_name' => "Tambah Galeri Foto"
            ];
            return view('administrator-page.pages.galeri.create', compact('data', 'kategori_galeri'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateData($request);
            $validatedData['ulid'] = Str::ulid(); //menambahkan ulid di data validasi
            Gallery::create($validatedData);

            Session::flash('success', 'Data galeri berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.galeri.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'An error occurred while processing your request.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($ulid)
    {
        try {
            $galeri = Gallery::getGalleryByUlid($ulid);
            $data = [
                'header_name' => "Galeri Foto",
                'page_name' => "Detail Galeri Foto"
            ];
            return view('administrator-page.pages.galeri.read', compact('data', 'galeri'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ulid)
    {
        try {
            $galeri = Gallery::getGalleryByUlid($ulid);
            $kategori_galeri = KategoriGallery::all();
            $data = [
                'header_name' => "Galeri Foto",
                'page_name' => "Edit Galeri Foto"
            ];
            return view('administrator-page.pages.galeri.edit', compact('data', 'galeri', 'kategori_galeri'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($ulid, Request $request,)
    {
        try {
            $galeri = Gallery::getGalleryByUlid($ulid);
            $validatedData = $this->validateData($request);
            $galeri->where('ulid', $ulid)->update($validatedData);

            Session::flash('success', 'Data galeri berhasil diubah');
            return redirect()->route('dashboard.administrator.galeri.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Gagal Update Data Galeri');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ulid)
    {
        try {
            $galeri = Gallery::where('ulid', $ulid);

            // Soft delete data
            $galeri->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Kategori berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data galeri : ' . $e->getMessage()
            ]);
        }
    }
}
