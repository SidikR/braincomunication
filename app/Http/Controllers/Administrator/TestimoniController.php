<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class TestimoniController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:200',
            'posisi' => 'required|string|max:200',
            'image' => 'required|string',
            'pesan' => 'required|string',
            'jenis' => 'required|in:stakeholder,sahabat',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 200 karakter.',
            'posisi.required' => 'Posisi harus diisi.',
            'posisi.max' => 'Posisi tidak boleh lebih dari 200 karakter.',
            'image.required' => 'Gambar harus diunggah.',
            'pesan.required' => 'Pesan harus diisi.',
            'jenis.required' => 'Jenis harus diisi.',
            'jenis.in' => 'Jenis harus salah satu dari: stakeholder atau sahabat.',
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "Daftar Testimoni",
                'page_name' => "Testimoni"
            ];
            $testimonies = Testimoni::all();
            return view('administrator-page.pages.testimoni.index', compact('data', 'testimonies'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data testimoni. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $data = [
                'header_name' => "Testimoni",
                'page_name' => "Tambah Testimoni"
            ];
            return view('administrator-page.pages.testimoni.create', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data testimoni. ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateData($request);
            Testimoni::create($validatedData);

            Session::flash('success', 'Data testimoni berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.testimoni.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'An error occurred while processing your request' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $testimoni = Testimoni::find($id);
            $data = [
                'header_name' => "Testimoni",
                'page_name' => "Detail Testimoni"
            ];
            return view('administrator-page.pages.testimoni.read', compact('data', 'testimoni'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data testimoni. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $testimoni = Testimoni::find($id);
            $data = [
                'header_name' => "Testimoni",
                'page_name' => "Edit Data Testimoni"
            ];
            return view('administrator-page.pages.testimoni.edit', compact('data', 'testimoni'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data testimoni. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $testimoni = Testimoni::find($id);
        
            $validatedData = $this->validateData($request);
            $testimoni->update($validatedData);

            Session::flash('success', 'Data testimoni berhasil diubah');
            return redirect()->route('dashboard.administrator.testimoni.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $testimoni = Testimoni::find($id);

            // Soft delete data
            $testimoni->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Testimoni berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data testimoni : ' . $e->getMessage()
            ]);
        }
    }
}
