<?php

    /**
     * Class UserController
     */
    class UserController extends BaseController {

        /**
         * @param int $id
         * @return \Illuminate\View\View
         */
        public function showProfile($id)
	    {
	        $user = User::find($id);
	        $userActions = $this->getUserActions();

	        return View::make('user.profile', array(
	        	'appPath' => app_path(),
	        	'user' => $user,
	        	'userActions' => $userActions
        	));
	    }

        /**
         * @return array
         */
        protected function getUserActions() {
	    	return array(
	    		'Account' => 'account',
	    		'logout' => 'logout'
	    	);
	    }

	}

?>