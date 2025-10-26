<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationFile extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'information_files';
    public function information()
    {
        return $this->belongsTo(Information::class);
    }
}
