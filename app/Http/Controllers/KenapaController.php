<?php

namespace App\Http\Controllers;

use App\Models\Kenapa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class KenapaController extends Controller
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
                'header_name' => "Daftar Kenapa",
                'page_name' => "Kenapa"
            ];
            $kenapas = Kenapa::all();
            return view('administrator-page.pages.kenapa.index', compact('data', 'kenapas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data kenapa. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $data = [
                'header_name' => "Kenapa",
                'page_name' => "Tambah Kenapa"
            ];
            return view('administrator-page.pages.kenapa.create', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data kenapa. ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateData($request);
            Kenapa::create($validatedData);

            Session::flash('success', 'Data kenapa berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.kenapa.index');
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
            $kenapa = Kenapa::find($id);
            $data = [
                'header_name' => "Kenapa",
                'page_name' => "Detail Kenapa"
            ];
            return view('administrator-page.pages.kenapa.read', compact('data', 'kenapa'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data kenapa. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $kenapa = Kenapa::find($id);
            $data = [
                'header_name' => "Kenapa",
                'page_name' => "Edit Data Kenapa"
            ];
            return view('administrator-page.pages.kenapa.edit', compact('data', 'kenapa'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data kenapa. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $kenapa = Kenapa::find($id);

            // Handling single data entry
            $validatedData = $this->validateData($request);
            $kenapa->update($validatedData);

            Session::flash('success', 'Data kenapa berhasil diubah');
            return redirect()->route('dashboard.administrator.kenapa.index');
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
            $kenapa = Kenapa::find($id);

            // Soft delete data
            $kenapa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Kenapa berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data kenapa : ' . $e->getMessage()
            ]);
        }
    }
}
