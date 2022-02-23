@extends('template')

@section('content')
<div class="container">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h2>Autoryzacja do pobieranie ofert z Allegro</h2>
    Autoryzacja następuje w czterech krokach:
    <br>
    Krok 1.<br>
    Zarejestrować aplikację na Allegro <br>
    Podczas rejestrowania aplikacji w adresie przekierowania proszę podać: <strong>{{$url}}/user/token/new</strong> aby móc zatwierdzić użytkownika.
    <p>(<a href="https://apps.developer.allegro.pl/" target="_blank">Zarejestruj Aplikację</a>)</p>
    <br>
    Krok 2.<br>
    Proszę o wprowadzenie e-mail i klucze które został wygenerowane podczas rejestracji aplikacji na Allegro
    <form action="{{action('App\Http\Controllers\UserAllegroController@gettoken')}}" method="POST" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="name">E-mail</label>
            <input type="text" class="form-control" name="email" />
            <label for="nip">Client ID</label>
            <input type="text" class="form-control" name="clientId" />
            <label for="text">Client Secret</label>
            <input type="text" class="form-control" name="clientSecret" />
        </div>

        Krok 3.<br>
        Po zatwierdzeniu będzie trzeba autoryzować aplikację na koncie Allegro
        <br>
        <input type="submit" value="Dodaj" class="btn btn-primary" />
    </form>
</div>
@endsection('content')