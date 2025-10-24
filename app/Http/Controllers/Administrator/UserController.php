<?php

namespace App\Http\Controllers\Administrator;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    private function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            // 'role' => 'required|string',
            // 'password' => 'required|string',

        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            // 'role.required' => 'Role harus dipilih.',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "Daftar User",
                'page_name' => "User"
            ];
            $user = User::all();

            return view('administrator-page.pages.user.index', compact('data', 'user'));
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
                'header_name' => "User",
                'page_name' => "Form Tambah Data User"
            ];
            $role_user = RoleUser::all();
            return view('administrator-page.pages.user.create', compact('data', 'role_user'));
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
            $validatedData['password'] = $request->password;
            $validatedData['role'] = $request->role;
            User::create($validatedData); //create validatedData ke DB

            Session::flash('success', 'Data user berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.user.index');
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
            $user = User::find($id);

            $data = [
                'header_name' => "Data User",
                'page_name' => "Detail User " . $user->name
            ];
            return view('administrator-page.pages.user.read', compact('user', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data user. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $user = User::find($id);
            $data = [
                'header_name' => "User",
                'page_name' => "Edit Data User " . $user->name
            ];
            $role_user = RoleUser::all();
            // $password = Crypt::decryptString($user->password);
            return view('administrator-page.pages.user.edit', compact('user', 'data', 'role_user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data user. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Cari user berdasarkan ulid
            $user = User::find($id);

            // Validasi input
            $validatedData = $this->validateData($request);
            $validatedData['role'] = $request->role;
            // $validatedData['password'] = $user->password;

            // Perbarui data user
            $user->update($validatedData);

            return redirect()->route('dashboard.administrator.user.show', ['user' => $user->id])
                ->with('success', 'Data user (' . $user->name . ') berhasil diubah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput()->with('error', 'Terjadi kesalahan validasi. Silakan periksa kembali isian Anda.');
        }
    }

    public function updatePassword($id, Request $request)
    {
        try {
            $user = User::find($id);

            $data = [
                'header_name' => "Update Password",
                'page_name' => "Update Password " . $user->name
            ];
            return view('administrator-page.pages.user.update_password', compact('user', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data user. ' . $e->getMessage());
        }
    }

    public function updatePasswordValue($id, Request $request)
    {
        try {
            $user = User::find($id);
            $data = [
                'header_name' => "Update Password",
                'page_name' => "Update Password " . $user->name
            ];
            $validatedData['password'] = $request->password;
            $user->update($validatedData);
            return redirect()->route('dashboard.administrator.user.show', ['user' => $user->id])
                ->with('success', 'Password user (' . $user->name . ') berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data user. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data User berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data user : ' . $e->getMessage()
            ]);
        }
    }

    public function statusAkun($id, Request $request)
    {
        try {
            $user = User::where('id', $id)->first();
            if ($user->status_akun === 1) {
                $validatedData['status_akun'] = 0;
            } else if ($user->status_akun === 0) {
                $validatedData['status_akun'] = 1;
            }
            $user->where('id', $id)->update($validatedData);

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
