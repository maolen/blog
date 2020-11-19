<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Post;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    // Toggle favourite
    public function __invoke(Post $post)
    {
        $favourites = $post->favourites();
        $exists = auth()->user()->isFavourite($post);
        if($exists) {
            $favourites->detach(auth()->id());
        } else {
            $favourites->attach(auth()->id());
        }

        return [
            'favourite' => !$exists
        ];
    }

    function index() {
        $posts = auth()->user()
            ->favourites()
            ->latest()
            ->paginate(10);

        return view('posts.favourites',
            [
                'posts' => $posts
            ]
        );
    }
}
