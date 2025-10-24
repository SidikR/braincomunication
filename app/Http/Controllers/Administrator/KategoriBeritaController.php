<?php

namespace App\Http\Controllers\administrator;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriBerita;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriBerita::all();
        $data = [
            'header_name' => "Daftar Kategori Berita",
            'page_name' => "Data Kategori Berita"
        ];
        return view('administrator-page.pages.berita.kategori-berita.index', compact('kategori', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'header_name' => "Kategori Berita",
            'page_name' => "Tambah Kategori Berita"
        ];
        return view('administrator-page.pages.berita.kategori-berita.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Handling single data entry
            $validatedData = $request->validate([
                'name' => 'required|max:150',
                'description' => 'nullable|max:255'
            ], [
                'name.required' => 'Nama harus diisi.',
                'name.max' => 'Nama tidak boleh lebih dari 150 karakter.',
                'description.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.'
            ]);

            $berita = KategoriBerita::create([
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['name']),
                'description' => $validatedData['description'],
            ]);

            Session::flash('success', 'Data kategori berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.kategori.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'An error occurred while processing your request.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $data = [
            'header_name' => "Kategori Berita",
            'page_name' => "Detail Kategori Berita"
        ];
        return view('administrator-page.pages.berita.kategori-berita.read', compact('data', 'kategori'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $data = [
            'header_name' => "Kategori Berita",
            'page_name' => "Edit Kategori Berita"
        ];
        return view('administrator-page.pages.berita.kategori-berita.edit', compact('data', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $kategori = KategoriBerita::findOrFail($id);
            // Validating request data
            $validatedData = $request->validate([
                'name' => 'required|max:150',
                'description' => 'nullable|max:255'
            ], [
                'name.required' => 'Nama harus diisi.',
                'name.max' => 'Nama tidak boleh lebih dari 150 karakter.',
                'description.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.'
            ]);


            // Updating the existing KategoriBerita instance
            $kategori->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
            ]);

            // Flashing success message and redirecting
            Session::flash('success', 'Data kategori berhasil diperbarui');
            return redirect()->route('dashboard.administrator.kategori.index');
        } catch (ValidationException $e) {
            // Redirecting back with errors if validation fails
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Terjadi kesalahan saat memproses permintaan Anda.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kategori = KategoriBerita::findOrFail($id);

            // Soft delete data
            $kategori->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Kategori berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data kategori : ' . $e->getMessage()
            ]);
        }
    }
}
