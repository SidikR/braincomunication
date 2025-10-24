<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // public function schedulesAsTeacher()
    // {
    //     return $this->hasMany(JadwalBelajar::class, 'teacher_ids');
    // }

    // public function schedulesAsStudent()
    // {
    //     return $this->hasMany(JadwalBelajar::class, 'student_ids');
    // }

    public function schedulesAsStudent()
    {
        return $this->belongsToMany(JadwalBelajar::class, 'jadwal_belajar_users', 'user_id', 'jadwal_belajar_id');
    }

    public function schedulesAsTeacher()
    {
        return $this->belongsToMany(JadwalBelajar::class, 'jadwal_belajar_users', 'user_id', 'jadwal_belajar_id');
    }



    public function scopeTeachers($query)
    {
        return $query->where('role', 'staf_pengajar');
    }

    public function scopeStudents($query)
    {
        return $query->where('role', 'siswa');
    }

    public function roles()
    {
        return $this->belongsTo(RoleUser::class);
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
