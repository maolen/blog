<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image_path'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function comments()
    {
        return $this->hasMany(Comment::class);
    }

    function favourites() {
        return $this->belongsToMany(User::class, Favourite::class);
    }

    function deleteImage()
    {
        if(!$this->image_path) {
            return;
        }

        $file = storage_path('app/' . $this->image_path);

        if(!file_exists($file)) {
            return;
        }

        unlink($file);
    }
}
