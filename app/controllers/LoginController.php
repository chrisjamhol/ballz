<?php

class LoginController extends BaseController {

	protected $layout = 'login.layout';

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showLogin() {
		return View::make('login/login')->with('error', '');
	}

	public function doLogin() {
		$email = Input::get('email');
		$password = Input::get('password');
		if (Auth::attempt(array('email' => $email, 'password' => $password), true)):
			return Redirect::intended('home');
		else:
            $errorMessage = Lang::get('login.failed.general');
            return View::make('login/login')->with('error', $errorMessage);
		endif;	
	}

	public function showRegister() {
		return View::make('login/register');
	}

	public function doRegister() {
		$email = Input::get('email');
		$firstname = Input::get('fistname');
		$lastname = Input::get('lastname');
		$nickname = Input::get('nickname');
		$password = Input::get('password');
		$passwordRepeat = Input::get('passwordRepeat');
		if($password == $passwordRepeat):
			$passwordHash = $this->makePasswordHash($password);
			$user = $this->createNewUser(array(
					'email' => $email,
					'password' => $passwordHash,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'nickname' => $nickname					
				)				
			);			
			return Redirect::intended('login');
		else:
			return Redirect::intended('register');
		endif;		
	}

	protected function createNewUser($newUserData) {
		$newUserData = (object)$newUserData;
		$user = new User();
		$user->email = $newUserData->email;
		$user->password = $newUserData->password;
		$user->firstname = $newUserData->firstname;
		$user->lastname = $newUserData->lastname;
		$user->nickname = $newUserData->nickname;	
		$user->save();
		return $user;
	}

	protected function makePasswordHash($password){
		$password = (string)$password;
		$passwordHash = Hash::make($password);
		return $passwordHash;
	}
	
}