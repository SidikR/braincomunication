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

class ProfileController extends Controller
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
    public function index(Request $request)
    {
        try {
            $data = [
                'header_name' => "Data Pengguna",
                'page_name' => "Data Pengguna"
            ];
            $user = $request->user();

            return view('administrator-page.pages.profile.read', compact('data', 'user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data pengguna. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        try {
            $user = $request->user();

            $data = [
                'header_name' => "Data User",
                'page_name' => "Detail User " . $user->name
            ];
            return view('administrator-page.pages.profile.read', compact('user', 'data'));
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
            return view('administrator-page.pages.profile.edit', compact('user', 'data', 'role_user'));
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
            $validatedData['image'] = $request->image;

            // Perbarui data user
            $user->update($validatedData);

            return redirect()->route('dashboard.administrator.profile.show', ['profile' => $user->id])
                ->with('success', 'Data pengguna (' . $user->name . ') berhasil diubah');
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
            return view('administrator-page.pages.profile.update_password', compact('user', 'data'));
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
            return redirect()->route('dashboard.administrator.profile.show', ['profile' => $user->id])
                ->with('success', 'Password user (' . $user->name . ') berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat detail data user. ' . $e->getMessage());
        }
    }
}
