@extends('layouts.main')

@section('content')
    <h1>{{ $post->title }}</h1>

    <small>
        Автор: {{ $post->user->name }}
    </small>

    <div>
        @can('update', $post)
            <a href="{{ route('posts.edit', $post) }}">Редактировать</a>
        @endcan

        @can('delete', $post)
            <a href="{{ route('posts.destroy', $post) }}"
               onclick="event.preventDefault(); document.getElementById('delete-form').submit()">Удалить</a>


            <form id="delete-form" action="{{ route('posts.destroy', $post) }}" method="post">
                @csrf @method('delete')
            </form>
        @endcan
    </div>

    <div>
        <img style="max-width: 100%;" src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}">
    </div>

    <p>{{ $post->content }}</p>

    <div>
        <h3>Комментарии</h3>

        @can('create', ['App\Models\Comment', $post])
        <form action="{{ route('comments.store', $post) }}" method="post">
            @csrf
            <strong>Новый комментарий</strong>

            @include('components.form-errors')

            <div>
                <textarea name="content" id="content" cols="30" rows="3">{{ old('content') }}</textarea>
            </div>
            <button>Добавить</button>
        </form>
    </div>
    @endcan


    @auth
        <button id="favourite-button" data-id="{{ $post->id }}">
            {{ auth()->user()->isFavourite($post) ? 'В избранном' : 'Добавить в избранное' }}
        </button>
    @endauth
    <hr/>

    @if($comments->isNotEmpty())
    <div>
        @foreach($post->comments as $comment)
            <div class="mb-3">
                <div>
                {{ $comment->content }}
                </div>

                @can('delete', $comment)
                <form method="post" action="{{ route('comments.destroy', $comment) }}">
                    @csrf @method('delete')
                    <button>Удалить</button>
                </form>
                @endcan

                <div>
                    <small>Автор: {{ $comment->user->name }}</small>
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @endforeach
    </div>
    @endif

@endsection
