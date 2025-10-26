<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformationControllerUser extends Controller
{
    public function index()
    {
        $data = [
            'header_name' => "Data Informasi",
            'page_name' => "Data Informasi"
        ];
        return view('role.informasi.index', compact('data'));
    }

    public function show($id)
    {
        $information = Information::with('files', 'recipients')->findOrFail($id);

        // Update status read hanya untuk user login
        $information->recipients()
            ->updateExistingPivot(Auth::user()->id, ['is_read' => true]);

        // Ambil pivot is_read untuk user login
        $isRead = $information->recipients()
            ->where('user_id', Auth::user()->id)
            ->first()?->pivot->is_read ?? false;

        $data = [
            'page_name' => 'Detail Notifikasi',
            'information' => $information,
            'files' => $information->files,
            'is_read' => $isRead, // <-- tambahkan ini
        ];
        

        return view('role.informasi.read', compact('data'));
    }
}
