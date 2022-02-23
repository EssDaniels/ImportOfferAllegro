@extends('template')

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nazwa firmy/Imię i nazwisko</th>
                <th>E-mail</th>
                <th>Telefon</th>
                <th>NIP</th>
            </tr>
        </thead>
        @foreach($data as $row)
        <tr>
            <td><a href="{{URL::to('/user/list\/')}}{{$row->name}}">{{$row->name}}</a></td>
            <td>{{$row->email}}</td>
            <td>{{$row->phone}}</td>
            <td>{{$row->nip}}</td>
        </tr>
        @endforeach

    </table>
</div>
@endsection('content')