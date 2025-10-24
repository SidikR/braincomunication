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

class UserControllerStafAdministrasi extends Controller
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
                'header_name' => "Daftar Staf Pengajar",
                'page_name' => "Staf Pengajar"
            ];
            $staf_pengajar = User::where('role', 'staf_pengajar')->get();

            return view('staf-administrasi-page.pages.staf_pengajar.index', compact('data', 'staf_pengajar'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data staf pengajar. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $data = [
                'header_name' => "Staf Pengajar",
                'page_name' => "Form Tambah Data Staf Pengajar"
            ];
            return view('staf-administrasi-page.pages.staf_pengajar.create', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat form tambah data staf pengajar. ' . $e->getMessage());
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
            $validatedData['role'] = 'staf_pengajar';
            User::create($validatedData); //create validatedData ke DB

            Session::flash('success', 'Data staf pengajar berhasil ditambahkan');
            return redirect()->route('dashboard.staf_administrasi.staf_pengajar.index');
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
            $staf_pengajar = User::find($id);

            $data = [
                'header_name' => "Data Staf Pengajar",
                'page_name' => "Detail Staf Pengajar " . $staf_pengajar->name
            ];
            return view('staf-administrasi-page.pages.staf_pengajar.read', compact('staf_pengajar', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data staf pengajar. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $staf_pengajar = User::find($id);
            $data = [
                'header_name' => "Staf Pengajar",
                'page_name' => "Edit Data Staf Pengajar " . $staf_pengajar->name
            ];
            return view('staf-administrasi-page.pages.staf_pengajar.edit', compact('staf_pengajar', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data staf pengajar. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Cari user berdasarkan ulid
            $staf_pengajar = User::find($id);

            // Validasi input
            $validatedData = $this->validateData($request);
            // Perbarui data user
            $staf_pengajar->update($validatedData);

            return redirect()->route('dashboard.staf_administrasi.staf_pengajar.show', ['staf_pengajar' => $staf_pengajar->id])
                ->with('success', 'Data Staf Pengajar (' . $staf_pengajar->name . ') berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    public function updatePassword($id, Request $request)
    {
        try {
            $staf_pengajar = User::find($id);

            $data = [
                'header_name' => "Update Password",
                'page_name' => "Update Password " . $staf_pengajar->name
            ];
            return view('staf-administrasi-page.pages.staf_pengajar.update_password', compact('staf_pengajar', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data staf pengajar. ' . $e->getMessage());
        }
    }

    public function updatePasswordValue($id, Request $request)
    {
        try {
            $staf_pengajar = User::find($id);
            $data = [
                'header_name' => "Update Password",
                'page_name' => "Update Password " . $staf_pengajar->name
            ];
            $validatedData['password'] = $request->password;
            $staf_pengajar->update($validatedData);
            return redirect()->route('dashboard.staf_administrasi.staf_pengajar.show', ['staf_pengajar' => $staf_pengajar->id])
                ->with('success', 'Password staf pengajar (' . $staf_pengajar->name . ') berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data staf pengajar. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        try {
            $staf_pengajar = User::find($id);
            $staf_pengajar->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Staf Pengajar berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data staf pengajar : ' . $e->getMessage()
            ]);
        }
    }

    public function statusAkun($id, Request $request)
    {
        try {
            $staf_pengajar = User::where('id', $id)->first();
            if ($staf_pengajar->status_akun === 1) {
                $validatedData['status_akun'] = 0;
            } else if ($staf_pengajar->status_akun === 0) {
                $validatedData['status_akun'] = 1;
            }
            $staf_pengajar->where('id', $id)->update($validatedData);

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
