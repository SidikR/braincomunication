<?php

namespace App\Http\Controllers\administrator;

use App\Models\GaleriVideo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class GaleriVideoController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:150',
            'description' => 'nullable',
            'category_id' => 'required',
            'script' => 'required'
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.max' => 'Judul tidak boleh lebih dari 150 karakter.',
            'category_id.required' => 'Kategori harus dipilih.',
            'script.required' => 'Script harus diisi.'
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kategori_galeri = KategoriGallery::all();
            $galeri_video = GaleriVideo::getGalery();
            $data = [
                'header_name' => "Daftar Galeri Video",
                'page_name' => "Data Galeri Video"
            ];
            return view('administrator-page.pages.galeri-video.index', compact('galeri_video', 'kategori_galeri', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data galeri video. ' . $e->getMessage());
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
                'header_name' => "Galeri Video",
                'page_name' => "Tambah Galeri Video"
            ];
            return view('administrator-page.pages.galeri-video.create', compact('data', 'kategori_galeri'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data galeri video. ' . $e->getMessage());
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
            GaleriVideo::create($validatedData);

            Session::flash('success', 'Data galeri berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.galeri-video.index');
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
            $galeri_video = GaleriVideo::getGalleryByUlid($ulid);
            $data = [
                'header_name' => "Galeri Video",
                'page_name' => "Detail Galeri Video"
            ];
            return view('administrator-page.pages.galeri-video.read', compact('data', 'galeri_video'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data galeri video. ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ulid)
    {
        try {
            $galeri_video = GaleriVideo::getGalleryByUlid($ulid);
            $kategori_galeri = KategoriGallery::all();
            $data = [
                'header_name' => "Galeri Foto",
                'page_name' => "Edit Galeri Foto"
            ];
            return view('administrator-page.pages.galeri-video.edit', compact('data', 'galeri_video', 'kategori_galeri'));
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
            $galeri_video = GaleriVideo::getGalleryByUlid($ulid);
            $validatedData = $this->validateData($request);
            $galeri_video->where('ulid', $ulid)->update($validatedData);

            Session::flash('success', 'Data galeri video berhasil diubah');
            return redirect()->route('dashboard.administrator.galeri-video.index');
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
            $galeri = GaleriVideo::where('ulid', $ulid);

            // Soft delete data
            $galeri->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Kategori berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data galeri video : ' . $e->getMessage()
            ]);
        }
    }
}
