<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenApi extends Model
{
    use HasFactory;
    protected $table = 'token_api';
    // protected $primaryKey = 'ulid';
    protected $fillable = ['ulid', 'token', 'aplikasi'];

    public static function getToken($ulid)
    {
        return static::where('ulid', $ulid)
            ->firstOrFail();
    }
}
