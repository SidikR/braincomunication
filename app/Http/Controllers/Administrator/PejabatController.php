<?php

namespace App\Http\Controllers\administrator;

use App\Models\Photo;
use App\Models\Pejabat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PejabatContent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PejabatController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:150',
            'nip' => 'nullable|max:255', // Mengubah 'string' menjadi 'max:255'
            'position' => 'nullable|max:255', // Mengubah 'string' menjadi 'max:255'
            'detail' => 'nullable|max:255', // Mengubah 'string' menjadi 'max:255'
            'image' => 'required',
            'alt_image' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 150 karakter.',
            'nip.max' => 'NIP tidak boleh lebih dari 255 karakter.', // Mengubah pesan untuk 'nip'
            'position.max' => 'Posisi tidak boleh lebih dari 255 karakter.', // Mengubah pesan untuk 'position'
            'detail.max' => 'Detail tidak boleh lebih dari 255 karakter.', // Mengubah pesan untuk 'detail'
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
                'header_name' => "Daftar Pejabat",
                'page_name' => "Pejabat"
            ];
            $pejabat = Pejabat::all();
            $konten_pejabat = PejabatContent::all();
            return view('administrator-page.pages.pejabat.index', compact('data', 'pejabat', 'konten_pejabat'));
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
                'header_name' => "Pejabat",
                'page_name' => "Tambah Pejabat"
            ];
            return view('administrator-page.pages.pejabat.create', compact('data'));
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
            Pejabat::create($validatedData);

            Session::flash('success', 'Data pejabat berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.pejabat.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'An error occurred while processing your request' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($ulid)
    {
        try {
            $pejabat = Pejabat::getOfficerByUlid($ulid);
            $data = [
                'header_name' => "Pejabat",
                'page_name' => "Detail Pejabat"
            ];
            return view('administrator-page.pages.pejabat.read', compact('data', 'pejabat'));
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
            $pejabat = Pejabat::getOfficerByUlid($ulid);
            $data = [
                'header_name' => "Pejabat",
                'page_name' => "Edit Data Pejabat"
            ];
            return view('administrator-page.pages.pejabat.edit', compact('data', 'pejabat'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ulid)
    {
        try {

            $pejabat = Pejabat::where('ulid', $ulid)->firstOrFail();

            // Handling single data entry
            $validatedData = $this->validateData($request);
            $pejabat->where('ulid', $ulid)->update($validatedData);

            Session::flash('success', 'Data pejabat berhasil diubah');
            return redirect()->route('dashboard.administrator.pejabat.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ulid)
    {
        try {
            $pejabat = Pejabat::where('ulid', $ulid);

            // Soft delete data
            $pejabat->where('ulid', $ulid)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Pejabat berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data pejabat : ' . $e->getMessage()
            ]);
        }
    }
}
