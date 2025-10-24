<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileUserController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'header_name' => "Detail Akun",
            'page_name' => "Detail Akun"
        ];
        $user = $request->user();

        return view('dashboard.profile.edit', compact('user', 'data'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|min:6|confirmed',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'email');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Upload gambar profil jika ada
        if ($request->hasFile('image')) {
            if ($user->image && $user->image !== 'storage/gallery/person.svg') {
                Storage::delete(str_replace('storage/', 'public/', $user->image));
            }
            $path = $request->file('image')->store('public/profile');
            $data['image'] = str_replace('public/', 'storage/', $path);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
