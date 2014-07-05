<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

use Illuminate\Support\Facades\Redirect;

if (Auth::viaRemember())
{
    Redirect::intended('home/feed');
}

Route::get('/', function(){
    if (Auth::viaRemember()){
        Redirect::intended('home/feed');
    }else{
        return Redirect::to('login');
    }
});

Route::get('login', array('as' => 'login', 'uses' => 'LoginController@showLogin'));
Route::post('login', array('as' => 'loginPost', 'uses' => 'LoginController@doLogin'));

Route::get('register', array('as' => 'register', 'uses' => 'LoginController@showRegister'));
Route::post('register', array('as' => 'registerPost', 'uses' => 'LoginController@doRegister'));


Route::group(array('before' => 'auth'), function(){

    Route::get('/image/{size}/{file}', 'ImageController@getImage');
    Route::get('/useruploads/{userID}/games/{gameID}/{size}/{file}', 'ImageController@getGameImage');

    Route::get('home', array('as' => 'home', function(){
	    return View::make('home/feed');
	}));

	Route::get('users', function(){
		$users = User::all();
	    return View::make('user/users')
	    	->with('users', $users)
		;	
	});

    /**  Game */
    Route::get('games', array('as' => 'games', 'uses' => 'GameController@showAllGames'));

    Route::get('game/new', array('as' => 'newGame', 'uses' => 'GameController@showCreateNewGame'));
    Route::post('game/new', array('as' => 'newGamePost', 'uses' => 'GameController@doCreateNewGame'));

    Route::get('game/{id}', array('uses' => 'GameController@showGameByID'))
        ->where('id', '[0-9]+');

    Route::get('game/action/give', array('as' => 'giveAction', 'uses' => 'GameController@showNewGiveAction'));
    Route::post('game/action/give', array('as' => 'giveActionPost', 'uses' => 'GameController@doGiveAction'));

    Route::get('game/action/take', array('as' => 'takeAction', 'uses' => 'GameController@showNewTakeAction'));
    Route::post('game/action/take', array('as' => 'takeActionPost', 'uses' => 'GameController@doTakeAction'));

    /** User */
	Route::get('user/{id}', array('as' => 'profile', 'uses' => 'UserController@showProfile'))
        ->where('id', '[0-9]+');

    Route::get('logout', array('as' => 'logout', function(){
        Auth::logout();
        return Redirect::intended('login');
    }));
});


