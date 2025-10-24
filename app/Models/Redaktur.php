<?php

namespace App\Models;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Redaktur extends Model
{
    use HasFactory;
    protected $table = 'redactors';
    protected $fillable = ['name', 'alias', 'description'];

    // public function berita()
    // {
    //     return $this->hasMany(Berita::class, 'penulis');
    // }
}
