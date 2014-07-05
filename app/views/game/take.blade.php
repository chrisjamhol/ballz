@extends('game.layout')

@section('gameContent')
<h2>{{ Lang::get('strings.game.action.take.heading') }}</h2>
{{ Form::open(array('action' => 'GameController@doTakeAction', 'files' => true)) }}
    {{ Form::hidden('gameID', $gameID) }}

    {{ Form::label('accused', Lang::get('strings.game.action.take.form.label.accused')) }}
    {{ Form::select('accused', $usersOfGame) }}

    {{ Form::label('amount', Lang::get('strings.game.action.take.form.label.amount')) }}
    {{ Form::input('number', 'amount', Input::old('amount'), array('placeholder' => Lang::get('strings.game.action.take.form.placeholder.amount'))) }}

    {{ Form::label('actionflag', Lang::get('strings.game.action.take.form.label.actionflag')) }}
    {{ Form::select('actionflag', $actionFlags) }}

    {{ Form::label('description', Lang::get('strings.game.action.take.form.label.description')) }}
    {{ Form::textarea('description') }}

    {{ Form::label('image', Lang::get('strings.game.action.take.form.label.image')) }}
    {{ Form::file('image') }}

    {{ Form::submit(Lang::get('strings.game.action.take.form.submitButtonText')) }}
{{ Form::close() }}
@stop

@section('nav')
<ul>
    <li>
        <a href="{{ URL::route('home') }}">{{ Lang::get('strings.nav.home') }}</a>
    </li>
    <li>
        <a href="{{ URL::route('games') }}">{{ Lang::get('strings.nav.games') }}</a>
    </li>
    <li>
        <a href="{{ URL::route('logout') }}">{{ Lang::get('strings.nav.logout') }}</a>
    </li>
</ul>
@stop