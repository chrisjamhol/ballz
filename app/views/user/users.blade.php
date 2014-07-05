@extends('layout')

@section('content')
    @foreach($users as $user)
        <h2>{{ $user->name }}</h2>
        <p>{{ $user->nick }}</p>
    @endforeach
@stop