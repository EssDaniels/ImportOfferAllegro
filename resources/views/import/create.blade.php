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
    <h2>Dodawanie nowego użytkownika</h2>
    <form action="{{action('App\Http\Controllers\UserAllegroController@store')}}" method="POST" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="name">Nazwa fimry/Imię i nazwisko</label>
            <input type="text" class="form-control" name="name" />
            <label for="nip">NIP</label>
            <input type="text" class="form-control" name="nip" />
            <label for="password">Hasło</label>
            <input type="password" class="form-control" name="password" />
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Powtórz hasło') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" name="email" />
            <label for="phone">Telefon</label>
            <input type="text" class="form-control" name="phone" />


        </div>
        <input type="submit" value="Dodaj" class="btn btn-primary" />
    </form>
</div>
@endsection('content')