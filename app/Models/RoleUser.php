<?php

namespace App\Models;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = "role_user";
    protected $fillable = ['nama'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
