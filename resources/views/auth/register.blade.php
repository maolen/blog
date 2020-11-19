@extends('layouts.main')

@section('content')
    <h1>Регистрация</h1>

    @include('components.form-errors')

    <form action="{{ route('register') }}" method="post">
        @csrf

        <div>
            <label for="name">Имя</label>
            <input value="{{ old('name') }}" type="text" id="name" name="name" placeholder="Иван">
        </div>

        <div>
            <label for="email">Email</label>
            <input value="{{ old('email') }}"  type="email" id="email" name="email" placeholder="someone@example.com">
        </div>

        <div>
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password">
        </div>

         <div>
            <label for="password_confirmation">Подтверждение</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button>Зарегистрироваться</button>

    </form>
@endsection
