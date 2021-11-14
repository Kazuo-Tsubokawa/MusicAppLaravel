<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function artists()
    {
        return $this->hasMany(\App\Models\Artist::class);
    }
}
