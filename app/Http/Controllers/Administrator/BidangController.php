<?php

namespace App\Http\Controllers\administrator;

use App\Models\Photo;
use App\Models\Bidang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class BidangController extends Controller
{

    private function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'required',
            'alt_image' => 'nullable|string|max:255'
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 150 karakter.',
            'alt_image.max' => 'Alt_Image tidak boleh lebih dari 255 karakter.',
            'description.required' => 'Deskripsi harus diisi.',
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
                'header_name' => "Daftar Bidang",
                'page_name' => "Data Bidang"
            ];
            $bidang = Bidang::all();
            return view('administrator-page.pages.bidang.index', compact('bidang', 'data'));
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
            $data = [
                'header_name' => "Bidang",
                'page_name' => "Tambah Bidang"
            ];
            return view('administrator-page.pages.bidang.create', compact('data'));
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
            $validatedData = $this->validateData($request); //ambil data request dari validatedData
            $validatedData['slug'] = Str::slug($validatedData['name']); //menambahkan slug di data validasi
            Bidang::create($validatedData); //create validatedData ke DB

            Session::flash('success', 'Data bidang berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.bidang.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $bidang = Bidang::getDivisionBySlug($slug);
            $data = [
                'header_name' => "Bidang",
                'page_name' => "Detail Bidang"
            ];
            return view('administrator-page.pages.bidang.read', compact('data', 'bidang'));
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
            $bidang = Bidang::getDivisionBySlug($slug);
            $data = [
                'header_name' => "Bidang",
                'page_name' => "Edit Bidang "
            ];
            return view('administrator-page.pages.bidang.edit', compact('data', 'bidang'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($slug, Request $request)
    {
        try {
            $bidang = Bidang::getDivisionBySlug($slug);
            $validatedData = $this->validateData($request); //ambil data request dari validatedData
            $bidang->update($validatedData); //update validatedData ke DB
            Session::flash('success', 'Data bidang berhasil diubah');
            return redirect()->route('dashboard.administrator.bidang.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        try {
            $bidang = Bidang::where('slug', $slug);

            // Soft delete data
            $bidang->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Bidang berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data bidang : ' . $e->getMessage()
            ]);
        }
    }
}
