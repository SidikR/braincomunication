<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PesanControllerClient extends Controller
{

    private function validateData(Request $request)
    {
        return $request->validate([
            'nama' => 'required|max:150',
            'hp' => 'required|max:16',
            'subject' => 'required|max:255',
            'pesan' => 'required'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 150 karakter.',
            'hp.required' => 'Nomor HP harus diisi.',
            'hp.max' => 'Nomor HP tidak boleh lebih dari 16 karakter.',
            'subject.required' => 'Subjek harus diisi.',
            'subject.max' => 'Subjek tidak boleh lebih dari 255 karakter.',
            'pesan.required' => 'Pesan harus diisi.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedData = $this->validateData($request); //ambil data request dari validatedData
            Pesan::create($validatedData); //create validatedData ke DB

            Session::flash('success', 'Berhasil mengirim pesan ...');
            return redirect()->route('homepage');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', $e->getMessage());
        }
    }
}
