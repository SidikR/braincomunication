<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PejabatContent extends Model
{
    use HasFactory;
    protected $table = 'officer_content';
    protected $fillable = ['content'];
}
