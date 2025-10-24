<?php

namespace App\Http\Controllers\administrator;

use Illuminate\Http\Request;
use App\Models\Redaktur;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class RedakturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redaktur = Redaktur::all();
        $data = [
            'header_name' => "Daftar Redaktur Berita",
            'page_name' => "Data Redaktur Berita"
        ];
        return view('administrator-page.pages.berita.redaktur.index', compact('redaktur', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'header_name' => "Redaktur Berita",
            'page_name' => "Tambah Redaktur Berita"
        ];
        return view('administrator-page.pages.berita.redaktur.create', compact('data'));
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
                'alias' => 'required|max:15',
                'description' => 'nullable',
            ], [
                'name.required' => 'Nama harus diisi.',
                'name.max' => 'Nama tidak boleh lebih dari 150 karakter.',
                'alias.required' => 'Alias harus diisi.',
                'alias.max' => 'Alias tidak boleh lebih dari 15 karakter.',
            ]);


            $redaktur = Redaktur::create([
                'name' => $validatedData['name'],
                'alias' => $validatedData['alias'],
                'description' => $validatedData['description'],
            ]);

            Session::flash('success', 'Data redaktur berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.redaktur.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'An error occurred while processing your request.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $redaktur = Redaktur::findOrFail($id);
        $data = [
            'header_name' => "Redaktur Berita",
            'page_name' => "Detail Redaktur Berita"
        ];
        return view('administrator-page.pages.berita.redaktur.read', compact('data', 'redaktur'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $redaktur = Redaktur::findOrFail($id);
        $data = [
            'header_name' => "Redaktur Berita",
            'page_name' => "Edit Redaktur Berita"
        ];
        return view('administrator-page.pages.berita.redaktur.edit', compact('data', 'redaktur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $redaktur = Redaktur::findOrFail($id);
            // Validating request data
            $validatedData = $request->validate([
                'name' => 'required|max:150',
                'alias' => 'required|max:15',
                'description' => 'nullable',
            ], [
                'name.required' => 'Nama harus diisi.',
                'name.max' => 'Nama tidak boleh lebih dari 150 karakter.',
                'alias.required' => 'Alias harus diisi.',
                'alias.max' => 'Alias tidak boleh lebih dari 15 karakter.',
            ]);


            // Updating the existing Redaktur instance
            $redaktur->update([
                'name' => $validatedData['name'],
                'alias' => $validatedData['alias'],
                'description' => $validatedData['description'],
            ]);

            // Flashing success message and redirecting
            Session::flash('success', 'Data redaktur berhasil diperbarui');
            return redirect()->route('dashboard.administrator.redaktur.index');
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
            $redaktur = Redaktur::findOrFail($id);

            // Soft delete data
            $redaktur->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Redaktur berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data redaktur : ' . $e->getMessage()
            ]);
        }
    }
}
