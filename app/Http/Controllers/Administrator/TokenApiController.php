<?php

namespace App\Http\Controllers\administrator;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TokenApi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class TokenApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tokens = TokenApi::all();
        $data = [
            'header_name' => "Daftar Token",
            'page_name' => "Data Token"
        ];
        return view('administrator-page.pages.token-generator.index', compact('tokens', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'header_name' => "Token",
            'page_name' => "Tambah Token"
        ];
        return view('administrator-page.pages.token-generator.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            // Handling single data entry
            $validatedData = $request->validate([
                'token' => 'required',
                'aplikasi' => 'nullable|max:255'
            ], [
                'token.required' => 'Token harus diisi.',
                'aplikasi.max' => 'Nama aplikasi tidak boleh lebih dari 255 karakter.'
            ]);


            TokenApi::create([
                'ulid' => Str::ulid(),
                'token' => $validatedData['token'],
                'aplikasi' => $validatedData['aplikasi'],
            ]);

            Session::flash('success', 'Data token berhasil ditambahkan');
            return redirect()->route('dashboard.administrator.token-generator.index');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validation failed: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($ulid)
    {
        // dd($ulid);
        $token = TokenApi::getToken($ulid);
        $data = [
            'header_name' => "Token",
            'page_name' => "Detail Token"
        ];
        return view('administrator-page.pages.token-generator.read', compact('data', 'token'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ulid)
    {
        $token = TokenApi::getToken($ulid);
        $data = [
            'header_name' => "Token",
            'page_name' => "Edit Token"
        ];
        return view('administrator-page.pages.token-generator.edit', compact('data', 'token'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ulid)
    {
        try {
            $token = TokenApi::getToken($ulid);
            // Validating request data
            $validatedData = $request->validate([
                'token' => 'required',
                'aplikasi' => 'nullable|max:255'
            ], [
                'token.required' => 'Token harus diisi.',
                'aplikasi.max' => 'Nama aplikasi tidak boleh lebih dari 255 karakter.'
            ]);


            // Updating the existing TokenApi instance
            $token->where('ulid', $ulid)->update([
                'token' => $validatedData['token'],
                'aplikasi' => $validatedData['aplikasi'],
            ]);

            // Flashing success message and redirecting
            Session::flash('success', 'Data token berhasil diperbarui');
            return redirect()->route('dashboard.administrator.token-generator.index');
        } catch (ValidationException $e) {
            // Redirecting back with errors if validation fails
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Terjadi kesalahan saat memproses permintaan Anda.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ulid)
    {
        try {
            $token = TokenApi::getToken($ulid);

            // Soft delete data
            $token->where('ulid', $ulid)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Token berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data token : ' . $e->getMessage()
            ]);
        }
    }
}
