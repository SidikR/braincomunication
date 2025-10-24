<?php

namespace App\Http\Controllers\StafAdministrasi;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class MataPelajaranController extends Controller
{
    /**
     * Validate the incoming request data.
     */
    private function validateData(Request $request)
    {
        return $request->validate([
            'nama_mata_pelajaran' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'nama_mata_pelajaran.required' => 'Nama mata pelajaran harus diisi.',
            'nama_mata_pelajaran.max' => 'Nama mata pelajaran tidak boleh lebih dari 255 karakter.',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "Daftar Mata Pelajaran",
                'page_name' => "Mata Pelajaran"
            ];
            $mata_pelajaran = MataPelajaran::all();

            return view('staf-administrasi-page.pages.mata_pelajaran.index', compact('data', 'mata_pelajaran'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data mata pelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $data = [
                'header_name' => "Mata Pelajaran",
                'page_name' => "Form Tambah Data Mata Pelajaran"
            ];
            return view('staf-administrasi-page.pages.mata_pelajaran.create', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat form tambah data mata pelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedData = $this->validateData($request);

            MataPelajaran::create($validatedData);
            Session::flash('success', 'Data mata pelajaran berhasil ditambahkan');
            return redirect()->route('dashboard.staf_administrasi.mata_pelajaran.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data mata pelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $mata_pelajaran = MataPelajaran::findOrFail($id);

            $data = [
                'header_name' => "Data Mata Pelajaran",
                'page_name' => "Detail Mata Pelajaran " . $mata_pelajaran->nama_mata_pelajaran
            ];
            return view('staf-administrasi-page.pages.mata_pelajaran.read', compact('mata_pelajaran', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data mata pelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $mata_pelajaran = MataPelajaran::findOrFail($id);
            $data = [
                'header_name' => "Mata Pelajaran",
                'page_name' => "Edit Data Mata Pelajaran " . $mata_pelajaran->nama_mata_pelajaran
            ];
            return view('staf-administrasi-page.pages.mata_pelajaran.edit', compact('mata_pelajaran', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data mata pelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $mata_pelajaran = MataPelajaran::findOrFail($id);

            $validatedData = $this->validateData($request);

            $mata_pelajaran->update($validatedData);

            return redirect()->route('dashboard.staf_administrasi.mata_pelajaran.show', ['mata_pelajaran' => $mata_pelajaran->id])
                ->with('success', 'Data Mata Pelajaran berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data mata pelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $mata_pelajaran = MataPelajaran::findOrFail($id);
            $mata_pelajaran->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Mata Pelajaran berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data mata pelajaran: ' . $e->getMessage()
            ]);
        }
    }
}
