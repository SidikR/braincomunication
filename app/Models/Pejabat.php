<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pejabat extends Model
{
    use HasFactory;
    protected $table = 'officers';
    protected $fillable = ['ulid', 'name', 'position', 'nip', 'detail', 'image', 'alt_image'];

    public static function getOfficerByUlid($ulid)
    {
        return static::where('ulid', $ulid)
            ->firstOrFail();
    }
}
