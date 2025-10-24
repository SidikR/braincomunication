<?php

namespace App\Http\Controllers\administrator;

use App\Models\Photo;
use App\Models\Layanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LayananController extends Controller
{

    private function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'required',
            'alt_image' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'alt_image.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'content.required' => 'Konten harus diisi.',
            'image.required' => 'Gambar harus diunggah.',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "Daftar Layanan",
                'page_name' => "Layanan"
            ];
            $layanan = Layanan::all();

            return view('administrator-page.pages.layanan.index', compact('data', 'layanan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $data = [
                'header_name' => "Layanan",
                'page_name' => "Form Tambah Data Layanan"
            ];
            return view('administrator-page.pages.layanan.create', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat form tambah data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedData = $this->validateData($request); //ambil data request dari validatedData
            $validatedData['slug'] = Str::slug($validatedData['name']); //menambahkan slug di data validasi
            Layanan::create($validatedData); //create validatedData ke DB

            Session::flash('success', 'Data layanan berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.layanan.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug, Request $request)
    {
        try {
            $layanan = Layanan::getServiceById($slug);

            $data = [
                'header_name' => "Data Layanan",
                'page_name' => "Detail Layanan " . $layanan->name
            ];
            return view('administrator-page.pages.layanan.read', compact('layanan', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        try {
            $layanan = Layanan::getServiceById($slug);
            $data = [
                'header_name' => "Layanan",
                'page_name' => "Edit Data Layanan " . $layanan->name
            ];
            return view('administrator-page.pages.layanan.edit', compact('layanan', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        try {
            // Cari layanan berdasarkan ulid
            $layanan = Layanan::getServiceById($slug);

            // Validasi input
            $validatedData = $this->validateData($request);

            // Perbarui data layanan
            $layanan->update($validatedData);

            return redirect()->route('dashboard.administrator.layanan.show', ['layanan' => $layanan->slug])
                ->with('success', 'Data layanan (' . $layanan->name . ') berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug, Request $request)
    {
        try {
            $layanan = Layanan::getServiceById($slug);
            $layanan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Layanan berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data layanan : ' . $e->getMessage()
            ]);
        }
    }
}
