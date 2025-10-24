<?php

namespace App\Http\Controllers\StafAdministrasi;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class UserControllerSiswa extends Controller
{

    private function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "Daftar Siswa",
                'page_name' => "Siswa"
            ];
            $siswa = User::where('role', 'siswa')->get();

            return view('staf-administrasi-page.pages.siswa.index', compact('data', 'siswa'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data Siswa. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $data = [
                'header_name' => "Siswa",
                'page_name' => "Form Tambah Data Siswa"
            ];
            return view('staf-administrasi-page.pages.siswa.create', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat form tambah data Siswa. ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedData = $this->validateData($request); //ambil data request dari validatedData
            $validatedData['password'] = $request->password;
            $validatedData['role'] = 'siswa';
            User::create($validatedData); //create validatedData ke DB

            Session::flash('success', 'Data Siswa berhasil ditambahkan');
            return redirect()->route('dashboard.staf_administrasi.siswa.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        try {
            $siswa = User::find($id);

            $data = [
                'header_name' => "Data Siswa",
                'page_name' => "Detail Siswa " . $siswa->name
            ];
            return view('staf-administrasi-page.pages.siswa.read', compact('siswa', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data Siswa. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $siswa = User::find($id);
            $data = [
                'header_name' => "Siswa",
                'page_name' => "Edit Data Siswa " . $siswa->name
            ];
            return view('staf-administrasi-page.pages.siswa.edit', compact('siswa', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data Siswa. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Cari user berdasarkan ulid
            $siswa = User::find($id);

            // Validasi input
            $validatedData = $this->validateData($request);
            // Perbarui data user
            $siswa->update($validatedData);

            return redirect()->route('dashboard.staf_administrasi.siswa.show', ['siswa' => $siswa->id])
                ->with('success', 'Data Siswa (' . $siswa->name . ') berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    public function updatePassword($id, Request $request)
    {
        try {
            $siswa = User::find($id);

            $data = [
                'header_name' => "Update Password",
                'page_name' => "Update Password " . $siswa->name
            ];
            return view('staf-administrasi-page.pages.siswa.update_password', compact('siswa', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data Siswa. ' . $e->getMessage());
        }
    }

    public function updatePasswordValue($id, Request $request)
    {
        try {
            $siswa = User::find($id);
            $data = [
                'header_name' => "Update Password",
                'page_name' => "Update Password " . $siswa->name
            ];
            $validatedData['password'] = $request->password;
            $siswa->update($validatedData);
            return redirect()->route('dashboard.staf_administrasi.siswa.show', ['siswa' => $siswa->id])
                ->with('success', 'Password Siswa (' . $siswa->name . ') berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data Siswa. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        try {
            $siswa = User::find($id);
            $siswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Siswa berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data Siswa : ' . $e->getMessage()
            ]);
        }
    }

    public function statusAkun($id, Request $request)
    {
        try {
            $siswa = User::where('id', $id)->first();
            if ($siswa->status_akun === 1) {
                $validatedData['status_akun'] = 0;
            } else if ($siswa->status_akun === 0) {
                $validatedData['status_akun'] = 1;
            }
            $siswa->where('id', $id)->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Status Akun Berhasil Diubah',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Status Akun Gagal Diubah : ' . $e->getMessage()
            ]);
        }
    }
}
