@extends('game.layout')

@section('gameContent')
<div class="gameFeed">
    <h2>{{ $gameDetails->game->name }}</h2>
    <a href="{{ URL::route('giveAction', array('gameid' => $gameID)) }}" class="button">{{ Lang::get('strings.game.action.createNewActionGiveButton') }}</a>
    <a href="{{ URL::route('takeAction', array('gameid' => $gameID)) }}" class="button">{{ Lang::get('strings.game.action.createNewActionTakeButton') }}</a>
    @foreach($gameDetails->actions as $action)
        <article class="action">
            <h3>{{ User::find($action->accusing)->nickname }} -> {{ User::find($action->accused)->nickname }}</h3>
            <p>{{ $action->description }}</p>
            @if($action->image)
                <img src="/useruploads/{{ $action->accusing }}/games/{{ $gameID }}/big/{{ $action->image }}" />
            @endif
        </article>
    @endforeach
</div>
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