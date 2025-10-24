<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    protected $fillable = ['jadwal_belajar_id', 'user_id', 'nilai'];

    public function jadwalBelajar()
    {
        return $this->belongsTo(JadwalBelajar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
