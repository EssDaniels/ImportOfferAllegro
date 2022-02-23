@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rejestracja') }}</div>
                <form action="{{action('App\Http\Controllers\UserAllegroController@store')}}" method="POST" role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <!-- <div class="form-group"> -->

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Nazwa firmy/Imię i Nazwisko</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="surname" class="col-md-4 col-form-label text-md-end">NIP</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nip" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">E-mail</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">Telefon</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Hasło</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Powtórz hasło') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Zarajestruj') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection