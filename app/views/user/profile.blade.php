@extends('layout')

@section('sidebar')
	<ul>
		@foreach($userActions as $action => $link) 
			<li><a href="{{$link}}">{{$action}}</a></li>
		@endforeach
	</ul>
@stop

@section('content')
   <h1>{{$user->name}}</h1>
   <p>Nickname: {{$user->nick}}</p>
@stop