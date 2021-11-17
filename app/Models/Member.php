<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'artisrt_id',
    ];

    public function artist()
    {
        return $this->belongsTo(\App\Models\Artist::class);
    }
}
