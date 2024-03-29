<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function artist()
    {
        return $this->belongsTo(\App\Models\Artist::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
