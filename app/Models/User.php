<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function posts()
    {
        return $this->hasMany(Post::class);
    }
    function comments()
    {
        return $this->hasMany(Comment::class);
    }

    function favourites() {
        return $this->belongsToMany(Post::class, Favourite::class);
    }

    function isFavourite(Post $post) {
        return $this->favourites()
            ->where('post_id', $post->id)
            ->exists();
    }
}
