@extends('layouts.main')

@section('content')
    <h1>Посты</h1>

    @can('create', 'App\Models\Post')
    <p>
        <a href="{{ route('posts.create') }}">Новый пост</a>
    </p>
    @endcan

    @include('components.post-list')

@endsection
