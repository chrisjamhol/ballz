@extends('game.layout')

@section('gameContent')
<h2>{{ Lang::get('strings.game.new.heading') }}</h2>
{{ Form::open(array('action' => 'GameController@doCreateNewGame')) }}
    <p class="errorMessage"><?php echo (isset($error)) ? $error : '' ?></p>
    {{ Form::text('name', Input::old('name'), array('placeholder' => 'Gamename')) }}
    {{ Form::input('number', 'initialCardCount', Input::old('initialCardCount'), array('placeholder' => 'Startanzahl')) }}
    {{ Form::submit('Erstellen') }}
{{ Form::close() }}
@stop

@section('nav')
<ul>
    <li>
        <a href="{{ URL::to('home') }}">{{ Lang::get('strings.nav.home') }}</a>
    </li>
    <li>
        <a href="{{ URL::to('games') }}">{{ Lang::get('strings.nav.games') }}</a>
    </li>
    <li>
        <a href="{{ URL::to('logout') }}">{{ Lang::get('strings.nav.logout') }}</a>
    </li>
</ul>
@stop