<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalBelajar extends Model
{
    // protected $table = 'jadwal_belajar';
    protected $fillable = ['title', 'keterangan',
        'mata_pelajaran_id',
        'start_time',
        'end_time',
        'status'
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'jadwal_belajar_users');
    }


    // public function teachers()
    // {
    //     return User::whereIn('id', $this->teacher_ids)->get();
    // }

    // public function students()
    // {
    //     return User::whereIn('id', $this->student_ids)->get();
    // }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'jadwal_belajar_users')
            ->where('users.role', 'teacher');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'jadwal_belajar_users')
            ->where('users.role', 'student');
    }


    public function nilaiSiswa()
    {
        return $this->hasMany(NilaiSiswa::class);
    }

    public function kehadiranSiswa()
    {
        return $this->hasMany(PresensiSiswa::class);
    }
}
