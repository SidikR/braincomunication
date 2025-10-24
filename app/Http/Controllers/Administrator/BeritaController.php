<?php

namespace App\Http\Controllers\administrator;

use App\Models\Photo;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BeritaUpdateApi;
use App\Models\KategoriBerita;
use App\Models\Redaktur;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class BeritaController extends Controller
{

    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:255',
            'description_thumbnail' => 'nullable|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|integer',
            'writer_id' => 'required|integer',
            'editor_id' => 'required|integer',
            'reporter_id' => 'required|integer',
            'tag' => 'required',
            'image' => 'required',
            'alt_image' => 'nullable|string|max:255',
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.max' => 'Judul tidak boleh lebih dari 150 karakter.',
            'description.required' => 'Deskripsi harus diisi.',
            'content.required' => 'Konten harus diisi.',
            'category_id.required' => 'Kategori harus dipilih.',
            'writer_id.required' => 'Penulis harus dipilih.',
            'editor_id.required' => 'Editor harus dipilih.',
            'reporter_id.required' => 'Reporter harus dipilih.',
            'tag.required' => 'Tag harus diisi.',
            'image.required' => 'Gambar harus diunggah.',
            'alt_image.max' => 'Teks alternatif gambar tidak boleh lebih dari :max karakter.',
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $berita = Berita::paginate(10);
            $data = [
                'header_name' => "Data Berita",
                'page_name' => "Daftar Berita"
            ];
            return view('administrator-page.pages.berita.index', compact('berita', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengambil data berita. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $data = [
                'header_name' => "Berita",
                'page_name' => "Form Tambah Data Berita"
            ];
            $category = KategoriBerita::all();
            $redaktur = Redaktur::all();
            return view('administrator-page.pages.berita.create', compact('data', 'category', 'redaktur'));
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
            $validatedData['slug'] = Str::slug($validatedData['title']); //menambahkan slug di data validasi
            $berita = Berita::create($validatedData);

            Session::flash('success', 'Data berita berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.berita.show', ['beritum' => $berita->slug]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }

    /**=
     * Display the specified resour
     */
    public function show($slug)
    {

        try {
            $berita = Berita::getBeritaBySlug($slug);
            $data = [
                'header_name' => "Preview Berita",
                'page_name' => "Preview Berita"
            ];
            return view('administrator-page.pages.berita.read', compact('berita', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        try {
            $berita = Berita::getBeritaBySlug($slug);
            $category = KategoriBerita::all();
            $redaktur = Redaktur::all();
            $data = [
                'header_name' => "Berita",
                'page_name' => "Edit Data Berita " . $berita->title
            ];
            return view('administrator-page.pages.berita.edit', compact('berita', 'data', 'category', 'redaktur'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data berita. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        try {
            $berita = Berita::where('slug', $slug)->firstOrFail();
            $validatedData = $this->validateData($request);

            // Update slug jika diperlukan
            if ($request->has('title') && $berita->title != $validatedData['title']) {
                $validatedData['slug'] = Str::slug($validatedData['title']);
            }

            $berita->update($validatedData);

            $beritaUpdateApi = BeritaUpdateApi::where('news_id', $berita->id)->first();
            if ($beritaUpdateApi) {
                // Jika ada, maka perbarui entri yang sudah ada di tabel berita_update_api
                $beritaUpdateApi->touch(); // Update timestamp updated_at
            } else {
                // Jika tidak ada, maka buat entri baru di tabel berita_update_api
                BeritaUpdateApi::create(['news_id' => $berita->id]);
            }

            return redirect()->route('dashboard.administrator.berita.show', [$berita->slug])
                ->with('success', 'Data berita (' . $berita->title . ') berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        try {
            $berita = Berita::withTrashed()->where('slug', $slug)->first();

            // Soft delete data
            $berita->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dipindahkan ke kotak sampah',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memindahkan data berita ke kotak sampah: ' . $e->getMessage()
            ]);
        }
    }

    public function trash(Request $request)
    {
        try {
            $trashedBerita = Berita::onlyTrashed()->get();

            $data = [
                'header_name' => "Data Berita",
                'page_name' => "Kotak Sampah Data Berita"
            ];
            return view('administrator-page.pages.berita.trash', compact('trashedBerita', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendapatkan data trash berita. ' . $e->getMessage());
        }
    }

    public function restoreFromTrash($slug, Request $request)
    {
        try {
            $deletedBerita = Berita::withTrashed()->where('slug', $slug)->first();
            // $deletedBerita->forceDelete();
            $deletedBerita->restore();
            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dipulihkan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal pulihkan data berita: ' . $e->getMessage()
            ]);
        }
    }


    public function deletePermanently($slug, Request $request)
    {
        try {
            $deletedBerita = Berita::withTrashed()->where('slug', $slug)->first();
            $deletedBerita->forceDelete();
            // $deletedBerita->restore();
            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dihapus permanent',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal hapus permanent data berita: ' . $e->getMessage()
            ]);
        }
    }

    public function publish($slug)
    {
        try {
            // Cari berita berdasarkan slug
            $berita = Berita::where('slug', $slug)->firstOrFail();

            // Perbarui data berita
            $berita->update([
                'published' => true,
                'published_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dipublish',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal publish data berita: ' . $e->getMessage()
            ]);
        }
    }

    public function unpublish($slug)
    {
        try {
            // Cari berita berdasarkan slug
            $berita = Berita::where('slug', $slug)->firstOrFail();

            // Perbarui data berita
            $berita->update([
                'published' => false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil di-unpublish',
                'redirect' => route('dashboard.administrator.berita.show', [$berita->slug])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal un-publish data berita: ' . $e->getMessage()
            ]);
        }
    }
}
