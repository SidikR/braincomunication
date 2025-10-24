<?php

namespace App\Http\Controllers\StafAdministrasi;

use App\Models\MateriPembelajaran;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class MateriPembelajaranControllerStafAdministrasi extends Controller
{
    /**
     * Validate the incoming request data.
     */
    private function validateData(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'topik' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'mata_pelajaran_id' => 'nullable|exists:mata_pelajarans,id',
            'file' => 'required|file|max:10048|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,doc,docx,xls,xlsx,ppt,pptx',
        ], [
            'judul.required' => 'Judul harus diisi.',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'topik.max' => 'Topik tidak boleh lebih dari 255 karakter.',
            'file.required' => 'File harus diunggah.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 10MB.',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "Daftar Materi Pembelajaran",
                'page_name' => "Materi Pembelajaran"
            ];
            $materi_pembelajaran = MateriPembelajaran::all();

            return view('staf-administrasi-page.pages.materi_pembelajaran.index', compact('data', 'materi_pembelajaran'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data materi pembelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $data = [
                'header_name' => "Materi Pembelajaran",
                'page_name' => "Form Tambah Data Materi Pembelajaran"
            ];
            $mata_pelajarans = MataPelajaran::all();
            return view('staf-administrasi-page.pages.materi_pembelajaran.create', compact('data', 'mata_pelajarans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat form tambah data materi pembelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedData = $this->validateData($request);

            // Simpan file dan dapatkan path
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filePath = $file->store('files', 'public');
                $validatedData['file_path'] = $filePath;
            }

            MateriPembelajaran::create($validatedData);
            Session::flash('success', 'Data materi pembelajaran berhasil ditambahkan');
            return redirect()->route('dashboard.staf_administrasi.materi_pembelajaran.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data materi pembelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $materi_pembelajaran = MateriPembelajaran::findOrFail($id);

            // Dapatkan ekstensi file
            $fileExtension = pathinfo($materi_pembelajaran->file_path, PATHINFO_EXTENSION);

            // Tentukan ikon berdasarkan ekstensi file
            $fileIcons = [
                'pdf' => 'bi bi-file-earmark-pdf',
                'doc' => 'bi bi-filetype-doc',
                'docx' => 'bi bi-filetype-docx',
                'xls' => 'bi bi-filetype-xls',
                'xlsx' => 'bi bi-filetype-xlsx',
                'jpg' => 'bi bi-card-image',
                'png' => 'bi bi-card-image',
                'default' => 'bi bi-file-earmark-post'
            ];

            $fileIcon = $fileIcons[$fileExtension] ?? $fileIcons['default'];

            $data = [
                'header_name' => "Data Materi Pembelajaran",
                'page_name' => "Detail Materi Pembelajaran " . $materi_pembelajaran->judul
            ];
            return view('staf-administrasi-page.pages.materi_pembelajaran.read', compact('materi_pembelajaran', 'data', 'fileExtension', 'fileIcon'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data materi pembelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $materi_pembelajaran = MateriPembelajaran::findOrFail($id);
            $mata_pelajarans = MataPelajaran::all();
            $data = [
                'header_name' => "Materi Pembelajaran",
                'page_name' => "Edit Data Materi Pembelajaran " . $materi_pembelajaran->judul
            ];
            $mata_pelajaran = MataPelajaran::all();
            return view('staf-administrasi-page.pages.materi_pembelajaran.edit', compact('materi_pembelajaran','mata_pelajarans', 'data', 'mata_pelajaran'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data materi pembelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $materi_pembelajaran = MateriPembelajaran::findOrFail($id);
            $validatedData = $this->validateData($request);

            // Cek apakah ada file baru yang diunggah
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filePath = $file->store('files', 'public');
                $validatedData['file_path'] = $filePath;

                // Hapus file lama jika ada
                if ($materi_pembelajaran->file_path) {
                    Storage::disk('public')->delete($materi_pembelajaran->file_path);
                }
            }

            $materi_pembelajaran->update($validatedData);

            return redirect()->route('dashboard.staf_administrasi.materi_pembelajaran.show', ['materi_pembelajaran' => $materi_pembelajaran->id])
                ->with('success', 'Data Materi Pembelajaran berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data materi pembelajaran. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $materi_pembelajaran = MateriPembelajaran::findOrFail($id);

            // Hapus file terkait jika ada
            if ($materi_pembelajaran->file_path) {
                Storage::disk('public')->delete($materi_pembelajaran->file_path);
            }

            $materi_pembelajaran->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Materi Pembelajaran berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data materi pembelajaran: ' . $e->getMessage()
            ]);
        }
    }
}
