<?php

namespace App\Http\Controllers\Administrator;

use App\Models\RoleUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class RoleUserController extends Controller
{

    private function validateData(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "Daftar Role User",
                'page_name' => "Role User"
            ];
            $role_user = RoleUser::where('nama', '!=', 'administrator')->get();

            return view('administrator-page.pages.role-user.index', compact('data', 'role_user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data user. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $data = [
                'header_name' => "Role User",
                'page_name' => "Form Tambah Data Role User"
            ];
            return view('administrator-page.pages.role-user.create', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat form tambah data user. ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedData = $this->validateData($request); //ambil data request dari validatedData
            RoleUser::create($validatedData); //create validatedData ke DB

            Session::flash('success', 'Data role user berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.role_user.index');
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
            $role_user = RoleUser::find($id);

            $data = [
                'header_name' => "Data Role User",
                'page_name' => "Detail Role User " . $role_user->nama
            ];
            return view('administrator-page.pages.role-user.read', compact('role_user', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data role user. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $role_user = RoleUser::find($id);
            $data = [
                'header_name' => "Role User",
                'page_name' => "Edit Data Role User " . $role_user->name
            ];
            return view('administrator-page.pages.role-user.edit', compact('role_user', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data role user. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Cari user berdasarkan ulid
            $role_user = RoleUser::find($id);

            // Validasi input
            $validatedData = $this->validateData($request);

            // Perbarui data role_user
            $role_user->update($validatedData);

            return redirect()->route('dashboard.administrator.role_user.show', ['role_user' => $role_user->id])
                ->with('success', 'Data role user (' . $role_user->nama . ') berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        try {
            $user = RoleUser::find($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data RoleUser berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data user : ' . $e->getMessage()
            ]);
        }
    }
}
