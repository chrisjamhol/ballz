<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class Game
 */
class Game extends Eloquent
{
    protected $table = 'games';

    protected $layout = 'games.layout';

    /**
     * @param int $userID
     * @return mixed
     */
    public function getUserGames($userID) {
        $userID = (int)$userID;
        $userGames = User::find($userID)->games;
        return $userGames;
    }

    /**
     * @param $gameID
     * @return mixed
     */
    public function getGameDetailsByGameID($gameID) {
        $gameID = (int)$gameID;
        $game = Game::find($gameID);
        $actions = $game->actions;
        $gameDetails = [
            'game' => $game,
            'actions' => $actions
        ];
        return (object)$gameDetails;
    }

    /**
     * @param $gameID
     * @return array
     */
    public function getNamesOfUsersFromGame($gameID) {
        $gameID = (int)$gameID;
        $modelUser = new User();
        $namesOfUser = $modelUser->getUserNamesByGameID($gameID);
        return $namesOfUser;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany('User', 'user_games');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function actions() {
        return $this->hasMany('Action');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userGames() {
        return $this->hasMany('UserGame');
    }

}