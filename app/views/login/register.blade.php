@extends('login.layout')

@section('loginContent')
	<span href="#" class="registerButton" id="toggle-login">Registrieren</span>
	<div id="register" class="registerWrapper">
	  <div id="triangle"></div>
	  <h1>Ballz!</h1>
	  {{ Form::open(array('action' => 'LoginController@doRegister')) }}
	  	{{ Form::email('email', Input::old('email'), array('placeholder' => 'Email')) }}
	  	{{ Form::text('fistname', Input::old('firstname'), array('placeholder' => 'Vorname')) }}
	  	{{ Form::text('lastname', Input::old('lastname'), array('placeholder' => 'Name')) }}
	  	{{ Form::text('nickname', Input::old('nickname'), array('placeholder' => 'Nickname')) }}
	  	{{ Form::password('password', array('placeholder' => 'Passwort')) }}
	  	{{ Form::password('passwordRepeat', array('placeholder' => 'Passwort wiederholen')) }}
	  	{{ Form::submit('Registrieren') }}
	  {{ Form::close() }}	 
	</div>
@stop