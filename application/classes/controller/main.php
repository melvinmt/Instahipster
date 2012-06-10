<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Abstract_Controller_Page {

	protected $_logged_in = false;
	protected $_user;

	public function before()
	{

		if($access_token = Cookie::get('access_token'))
		{
			// make a test!
			$url = 'http://api.via.me/v1/users/me';

			$params = array(
				'access_token' => $access_token,
			);

			$request = Request::factory($url)->query($params)->execute();

			if($this->_user = Arr::path(json_decode($request->body(), true), 'response.user'))
			{
				$this->_logged_in = TRUE;
			}

		}

		echo Debug::vars($access_token);

		parent::before();
	}

	public function action_index()
	{


	}

	public function after()
	{
		$this->_view
				->set('_logged_in', $this->_logged_in);

		parent::after();
	}

}
