@extends('game.layout')

@section('gameContent')
<div class="allGames">
    <h2>{{ Lang::get('strings.game.heading') }}</h2>
    <div>
        <a href="{{ URL::to('game/new') }}" class="button">{{ Lang::get('strings.game.createNewGameButton') }}</a>
        <a href="{{ URL::to('game/join') }}" class="button">{{ Lang::get('strings.game.joinNewGameButton') }}</a>
    </div>
    <div class="allGamesListWrapper">
        <h3>{{  Lang::get('strings.game.yourGamesHeading') }}</h3>
        <ul class="allGamesList">
            @foreach($games as $game)
            <li>
                <a href="{{ URL::to('game/') }}/{{ $game->id }}" title="{{ $game->name }}">
                    {{ $game->name }} ( TODO: cardcount )
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
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