<?php

namespace App\Models;

use App\Models\JadwalBelajar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalBelajarUser extends Model
{
    use HasFactory;
    protected $fillable = ['jadwal_belajar_id', 'user_id'];

    public function jadwalBelajar()
    {
        return $this->belongsTo(JadwalBelajar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
