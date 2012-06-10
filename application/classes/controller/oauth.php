<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Oauth extends Abstract_Controller_Page {

	public function action_index() {

		if ($code = Arr::get($_GET, 'code'))
		{
			$url = 'http://via.me/oauth/access_token';

			$params = array(
				'client_id' => Kohana::$config->load('viame.client_id'),
				'client_secret' => Kohana::$config->load('viame.client_secret'),
				'grant_type' => 'authorization_code',
				'redirect_uri' => Kohana::$config->load('viame.redirect_uri'),
				'code' => $code,
				'response_type' => 'token',
			);

			$r = curl::get_ssl($url, $params);

			if($access_token = Arr::get(json_decode($r, true), 'access_token'))
			{
				Cookie::set('access_token', $access_token);
			}
		}

		// redirect to homepage
		$this->request->redirect('/');

	}

}