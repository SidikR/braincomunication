<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class FasilitasController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:200',
            'image' => 'required',
        ], [
            'title.required' => 'Nama harus diisi.',
            'title.max' => 'Nama tidak boleh lebih dari 200 karakter.',
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
                'header_name' => "Daftar Fasilitas",
                'page_name' => "Fasilitas"
            ];
            $fasilitases = Fasilitas::all();
            return view('administrator-page.pages.fasilitas.index', compact('data', 'fasilitases'));
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
                'header_name' => "Fasilitas",
                'page_name' => "Tambah Fasilitas"
            ];
            return view('administrator-page.pages.fasilitas.create', compact('data'));
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
            Fasilitas::create($validatedData);

            Session::flash('success', 'Data fasilitas berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.fasilitas.index');
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
            $fasilitas = Fasilitas::find($id);
            $data = [
                'header_name' => "Fasilitas",
                'page_name' => "Detail Fasilitas"
            ];
            return view('administrator-page.pages.fasilitas.read', compact('data', 'fasilitas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $fasilitas = Fasilitas::find($id);
            $data = [
                'header_name' => "Fasilitas",
                'page_name' => "Edit Data Fasilitas"
            ];
            return view('administrator-page.pages.fasilitas.edit', compact('data', 'fasilitas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data layanan. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $fasilitas = Fasilitas::find($id);

            // Handling single data entry
            $validatedData = $this->validateData($request);
            $fasilitas->update($validatedData);

            Session::flash('success', 'Data fasilitas berhasil diubah');
            return redirect()->route('dashboard.administrator.fasilitas.index');
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
            $fasilitas = Fasilitas::find($id);

            // Soft delete data
            $fasilitas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Fasilitas berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data fasilitas : ' . $e->getMessage()
            ]);
        }
    }
}
