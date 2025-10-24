<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGallery extends Model
{
    use HasFactory;
    protected $table = 'category_galleries';
    protected $fillable = ['name', 'description'];
}
