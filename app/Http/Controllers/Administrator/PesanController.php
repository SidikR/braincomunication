<?php

namespace App\Http\Controllers\administrator;

use App\Models\Pesan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [
                'header_name' => "Daftar Pesan",
                'page_name' => "Data Pesan"
            ];
            $pesan = Pesan::all();
            return view('administrator-page.pages.pesan.index', compact('pesan', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data pesan. ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $pesan = Pesan::findOrFail($id);
            $pesan->update(['dilihat' => true]);

            $data = [
                'header_name' => "Pesan",
                'page_name' => "Detail Pesan"
            ];

            return view('administrator-page.pages.pesan.read', compact('data', 'pesan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data pesan. ' . $e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pesan = Pesan::findOrFail($id);

            // Soft delete data
            $pesan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Pesan berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data pesan : ' . $e->getMessage()
            ]);
        }
    }
}
