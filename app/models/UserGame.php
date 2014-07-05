<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class UserGame
 */
class UserGame extends Eloquent
{
    protected $table = 'user_games';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function game() {
        return $this->hasOne('Game');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne('User');
    }
}