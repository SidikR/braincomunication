<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class ProgramController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:200',
            'konten' => 'required', // Mengubah 'string' menjadi 'max:255'
            'image' => 'required',
        ], [
            'title.required' => 'Nama harus diisi.',
            'title.max' => 'Nama tidak boleh lebih dari 200 karakter.',
            'konten.required' => 'Nama harus diisi.',
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
                'header_name' => "Daftar Program",
                'page_name' => "Program"
            ];
            $programs = Program::all();
            return view('administrator-page.pages.program.index', compact('data', 'programs'));
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
                'header_name' => "Program",
                'page_name' => "Tambah Program"
            ];
            return view('administrator-page.pages.program.create', compact('data'));
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
            $validatedData['thumbnail'] = $validatedData['image'];
            $validatedData['slug'] = Str::slug($validatedData['title']);
            Program::create($validatedData);

            Session::flash('success', 'Data program berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.program.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'An error occurred while processing your request' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $program = Program::getProgramById($slug);
            $data = [
                'header_name' => "Program",
                'page_name' => "Detail Program"
            ];
            return view('administrator-page.pages.program.read', compact('data', 'program'));
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
            $program = Program::getProgramById($slug);
            $data = [
                'header_name' => "Program",
                'page_name' => "Edit Data Program"
            ];
            return view('administrator-page.pages.program.edit', compact('data', 'program'));
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

            $program = Program::getProgramById($slug);

            // Handling single data entry
            $validatedData = $this->validateData($request);
            $validatedData['thumbnail'] = $validatedData['image'];
            $validatedData['slug'] = Str::slug($validatedData['title']);
            $program->update($validatedData);

            Session::flash('success', 'Data program berhasil diubah');
            return redirect()->route('dashboard.administrator.program.index');
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
            $program = Program::getProgramById($slug);
            // Soft delete data
            $program->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Program berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data program : ' . $e->getMessage()
            ]);
        }
    }
}
