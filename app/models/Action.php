<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class Game
 */
class Action extends Eloquent
{
    const takeAction = 0;
    const giveAction = 1;

    protected $table = 'actions';

    protected $layout = 'actions.layout';

    /**
     * @param int $gameID
     * @param int $accusingUser
     * @param int $accusedUser
     * @param int $amount
     * @param int $actionFlag
     * @param string $description
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $image
     * @return bool
     */
    public function saveTakeAction($gameID, $accusingUser, $accusedUser, $amount, $actionFlag,  $description, $image = null) {
        $gameID = (int)$gameID;
        $accusingUser = (int)$accusingUser;
        $accusedUser = (int)$accusedUser;
        $amount = (int)$amount;
        $actionFlag = (int)$actionFlag;
        $description = (string)$description;

        $this->saveAction($gameID, $accusingUser, $accusedUser, $actionFlag, $amount, $description, $image);

        $this->updateCardCountForUserInGame($gameID, $accusedUser, $amount, self::takeAction);

        return true;
    }

    /**
     * @param int $gameID
     * @param int $accusingUser
     * @param int $accusedUser
     * @param int $amount
     * @param int $actionFlag
     * @param string $description
     * @param string $image
     * @return bool
     */
    public function saveGiveAction($gameID, $accusingUser, $accusedUser, $amount, $actionFlag, $description, $image = null) {
        $gameID = (int)$gameID;
        $accusingUser = (int)$accusingUser;
        $accusedUser = (int)$accusedUser;
        $amount = (int)$amount;
        $actionFlag = (int)$actionFlag;
        $description = (string)$description;

        $this->saveAction($gameID, $accusingUser, $accusedUser, $actionFlag, $amount, $description, $image);

        $this->updateCardCountForUserInGame($gameID, $accusedUser, $amount, self::giveAction);

        return true;
    }

    /**
     * @param int $gameID
     * @param int $accusedUser
     * @param int $amount
     * @param int $action
     */
    private function updateCardCountForUserInGame($gameID, $accusedUser, $amount, $action) {
        $gameID = (int)$gameID;
        $accusedUser = (int)$accusedUser;
        $amount = (int)$amount;
        $action = (int)$action;
        $updatedCardCount = 0;

        $userGame = UserGame::where('user_id', '=', $accusedUser)
                        ->where('game_id', '=', $gameID)
                        ->get()
                        ->first();

        switch($action):
            case(self::takeAction):
                $updatedCardCount = $userGame->cardcount - $amount;
                break;
            case(self::giveAction):
                $updatedCardCount = $userGame->cardcount + $amount;
                break;
        endswitch;

        UserGame::where('user_id', '=', $accusedUser)
            ->where('game_id', '=', $gameID)
            ->update(array('cardcount' => $updatedCardCount));
    }

    /**
     * @param int $gameID
     * @param int $accusingUser
     * @param int $accusedUser
     * @param int $actionFlag
     * @param int $amount
     * @param string $description
     * @param $image
     */
    private function saveAction($gameID, $accusingUser, $accusedUser, $actionFlag, $amount, $description, $image) {
        $gameID = (int)$gameID;
        $accusingUser = (int)$accusingUser;
        $accusedUser = (int)$accusedUser;
        $actionFlag = (int)$actionFlag;
        $amount = (int)$amount;
        $description = (string)$description;

        $action = new Action;
        $action->game_id = $gameID;
        $action->accusing = $accusingUser;
        $action->accused = $accusedUser;
        $action->amount = $amount;
        $action->actionflag_id = $actionFlag;
        $action->description = $description;

        if ($image != null):
            $imageName = (new ImageController())->saveUserUploadImageGame($accusingUser, $gameID, $image);
            if ($imageName):

                $action->image = $imageName;
            endif;
        endif;

        $action->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function game() {
        return $this->belongsTo('Game', 'game_actions');
    }

    public function actionFlag() {
        $this->hasOne('ActionFlags');
    }
}