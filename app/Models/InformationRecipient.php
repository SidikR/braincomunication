<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationRecipient extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'information_recipients';

    public function information()
    {
        return $this->belongsTo(Information::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
