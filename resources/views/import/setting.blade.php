@extends('template')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <form action="{{action('App\Http\Controllers\AdminController@settingstore')}}" method="POST" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="name">Domena np http://example.pl do ustawień Autoryzacji Aplikacji</label>
            <input type="text" class="form-control" name="url" />
            <label for="nip">Ścieżka do folderu gdzie mają być zapisywanie plik z importu</label>
            <input type="text" class="form-control" name="file" />
        </div>
        <input type="submit" value="Dodaj" class="btn btn-primary" />
    </form>
</div>
@endsection('content')