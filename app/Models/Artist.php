<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'prefecture_id',
        'user_id',
        'introduction'
    ];

    public function members()
    {
        return $this->hasMany(\App\Models\Member::class);
    }

    public function songs()
    {
        return $this->hasMany(\App\Models\Song::class);
    }

    public function follows()
    {
        return $this->hasMany(\App\Models\Follow::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(\App\Models\Prefecture::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
