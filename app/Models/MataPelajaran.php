<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $fillable = ['nama_mata_pelajaran', 'keterangan'];

    public function materi_pembelajarans()
    {
        return $this->hasMany(MateriPembelajaran::class, 'mata_pelajaran_id');
    }
}
