<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Logout extends Abstract_Controller_Page {

	public function action_index() {

		Cookie::delete('access_token');

		// redirect to homepage
		$this->request->redirect('/');

	}

}