<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'informations';

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // public function recipients()
    // {
    //     return $this->belongsToMany(User::class, 'information_recipients');
    // }

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'information_recipients')
            ->withPivot('is_read');
    }


    public function files()
    {
        return $this->hasMany(InformationFile::class);
    }
}
