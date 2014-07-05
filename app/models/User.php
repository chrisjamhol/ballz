<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $layout = 'layout';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * @return int
     */
    public static function getLoggedInUserID()
    {
        $currentUserID = Auth::user()->id;
        return $currentUserID;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * @param int $gameID
     * @return array
     */
    public function getUserNamesByGameID($gameID) {
        $gameID = (int)$gameID;
        $users = Game::find($gameID)
                ->users()
                ->where('game_id', '=', $gameID)
                ->get(array('nickname'));
        ;
        $names = $this->getUserNamesFromUserObject($users);
        return $names;
    }

    /**
     * @param $users
     * @return array
     */
    private function getUserNamesFromUserObject($users) {
        $names = array();
        foreach($users as $user):
            $names[$user->pivot->user_id] = $user->nickname;
        endforeach;
        return $names;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games() {
        return $this->belongsToMany('Game', 'user_games');
    }
}