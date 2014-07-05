<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Class GameController
 */
class GameController extends BaseController {

    protected $layout = 'game.layout';

    /**
     * @return \Illuminate\View\View
     */
    public function showAllGames()
    {
        $modelGame = new Game();
        $userID = User::getLoggedInUserID();
        $userGames = $modelGame->getUserGames($userID);
        return View::make('game.userGames')
            ->with('userID', $userID)
            ->with('games', $userGames)
        ;
    }

    /**
     * @param $gameID
     * @return \Illuminate\View\View
     */
    public function showGameByID($gameID) {
        $gameID = (int)$gameID;
        $modelGame = new Game();
        $gameDetails = $modelGame->getGameDetailsByGameID($gameID);

        return View::make('game.feed')
            ->with('gameDetails', $gameDetails)
            ->with('gameID', $gameID)
        ;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function showNewGiveAction() {
        $gameID = Input::get('gameid');
        $modelGame = new Game();
        $usersOfGame = $modelGame->getNamesOfUsersFromGame($gameID);
        $actionFlags = ActionFlags::where('manly', '=', ActionFlags::manlyAction)->lists('name', 'id');

        return View::make('game.give')
            ->with('gameID', $gameID)
            ->with('usersOfGame', $usersOfGame)
            ->with('actionFlags', $actionFlags)
            ;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doGiveAction() {
        $gameID = Input::get('gameID');
        $accusedUser = Input::get('accused');
        $accusingUser = User::getLoggedInUserID();
        $amount = Input::get('amount');
        $actionFlag = Input::get('actionflag');
        $description = Input::get('description');
        $imagePath = Input::file('image');

        $modelAction = new Action();
        $modelAction->saveGiveAction(
            $gameID,
            $accusingUser,
            $accusedUser,
            $amount,
            $actionFlag,
            $description,
            $imagePath
        );
        return Redirect::to('game/'.$gameID);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function showNewTakeAction() {
        $gameID = Input::get('gameid');
        $modelGame = new Game();
        $usersOfGame = $modelGame->getNamesOfUsersFromGame($gameID);
        $actionFlags = ActionFlags::where('manly', '=', ActionFlags::unmanlyAction)->lists('name', 'id');

        return View::make('game.take')
            ->with('gameID', $gameID)
            ->with('usersOfGame', $usersOfGame)
            ->with('actionFlags', $actionFlags)
        ;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doTakeAction() {
        $gameID = Input::get('gameID');
        $accusedUser = Input::get('accused');
        $accusingUser = User::getLoggedInUserID();
        $amount = Input::get('amount');
        $actionFlag = Input::get('actionflag');
        $description = Input::get('description');
        $imagePath = Input::file('image');

        $modelAction = new Action();
        $modelAction->saveTakeAction(
            $gameID,
            $accusingUser,
            $accusedUser,
            $amount,
            $actionFlag,
            $description,
            $imagePath
        );
        return Redirect::to('game/'.$gameID);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function showCreateNewGame() {
        return View::make('game.createNewGame');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function doCreateNewGame() {
        $gameName = Input::get('name');
        $initialCardCount = Input::get('initialCardCount');
        if($gameName != '' && $initialCardCount != 0):
            //$gameID = Game::create(array('name' => $gameName, 'initial_card_count' => $initialCardCount));

            //return Redirect::to('game/'.$gameID);
        else:
            return View::make('game.createNewGame')
                ->with('error', Lang::get('validation.custom.somethingMissing'))
            ;
        endif;
    }
}
