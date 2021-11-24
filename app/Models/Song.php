<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    protected $appends = [
        'songs_count'
    ];

    // public function scopeSearch(Builder $query, $params)
    // {
    //     if (!empty($params['prefecture'])) {
    //         $query->whereHas('prefecture', function ($q) use ($params) {
    //             $q->where('name', 'like', '%' . $params['prefecture'] . '%');
    //         });
    //     }
    //     if (!empty($params['category'])) {
    //         $query->whereHas('category', function ($q) use ($params) {
    //             $q->where('name', 'like', '%' . $params['category'] . '%');
    //         });
    //     }
    //     return $query;
    // }


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

    public function getSongsCountAttribute()
    {
        return Song::count();
    }

}
