<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;


/**
 * Class ActionFlags
 */
class ActionFlags extends Eloquent
{
    const manlyAction = 1;
    const unmanlyAction = 0;

    protected $table = 'actionflags';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions() {
        return $this->hasMany('Action');
    }
}