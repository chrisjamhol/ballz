@extends('layout')

@section('content')
	<article class="is-post is-post-excerpt">
		<header>										
			<h2><a href="#">Ballz!</a></h2>
			<span class="byline">The Game of Balls</span>
		</header>
		<div class="info">
			<span class="date"><span class="month">Mai<span></span></span> <span class="day">18</span><span class="year">, 2014</span></span>			
		</div>
		<a href="#" class="image image-full">{{HTML::image( asset('img/maennlichCards.jpg') )}}</a>
		<p>
			<strong>Hallo!</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>
	</article>	
@stop

@section('nav')
	<ul>
		<li>
			<a href="{{ URL::to('home') }}">Home</a>
		</li>
		<li>
			<a href="{{ URL::to('login') }}">Login</a>
		</li>
	</ul>
@stop