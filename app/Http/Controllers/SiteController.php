<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    function index()
    {
        return view(
            'index',
            [
                'message' => 'Hello from view!'
            ]
        );
    }

    function form()
    {
        request()->validate(
            [
                'title' => 'required|string'
            ]
        );

        return request()->get('title');
    }
}
