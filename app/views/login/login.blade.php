@extends('login.layout')

@section('loginContent')
	<span href="#" class="loginButton" id="toggle-login">Log in</span>
	<div id="login" class="loginWrapper">
	  <div id="triangle"></div>
	  <h1>Ballz!</h1>
	  {{ Form::open(array('action' => 'LoginController@doLogin')) }}
	  	<p class="errorMessage"><?php echo $error ?></p>
	  	{{ Form::email('email', Input::old('email'), array('placeholder' => 'Email')) }}
	  	{{ Form::password('password', array('placeholder' => 'Passwort')) }}
	  	{{ Form::submit('Log in') }}
	  	<span>Kein Zugang? <a href="{{action('LoginController@showRegister',null);}}">Registrieren</a></span>
	  {{ Form::close() }}	 	 
	</div>
@stop