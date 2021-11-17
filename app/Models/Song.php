<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Song extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'title',
        'file_name',
        'description'
    ];

    public function artist()
    {
        return $this->belongsTo(\App\Models\Artist::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

}
