<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Hipsterize extends Abstract_Controller_Page {

	protected $_logged_in = false;
	protected $_img;
	protected $_user;
	protected $_access_token;

	public function before()
	{

		if($this->_access_token = Cookie::get('access_token'))
		{
			// make a test!
			$url = 'http://api.via.me/v1/users/me';

			$params = array(
				'access_token' => $this->_access_token,
			);

			$request = Request::factory($url)->query($params)->execute();

			if($this->_user = Arr::path(json_decode($request->body(), true), 'response.user'))
			{
				$this->_logged_in = TRUE;
			}

		}

		if( ! $this->_logged_in)
			$this->request->redirect('/');

		parent::before();
	}

	public function action_edit()
	{
		if( ! $this->_img = Arr::get($_GET, 'img'))
			$this->request->redirect('/hipsterize');
	}

	public function action_index()
	{

	}

	public function after()
	{
		$this->_view
				->set('_user', $this->_user)
				->set('_access_token', $this->_access_token)
				->set('_img', $this->_img);

		parent::after();
	}

	public function action_upload()
	{

		if($file = Arr::get($_FILES, 'file'))
		{

			$tmp_dir = ini_get('upload_tmp_dir');

			if(!is_dir($tmp_dir)){
				mkdir($tmp_dir, 0777, true);
			} else if (!is_writable($tmp_dir)) {
				chmod($tmp_dir, 0777);
			}

			$img_path = $tmp_dir.'/'.sha1($file['name'].rand()).$file['name'];

			file_put_contents($img_path, file_get_contents($file['tmp_name']));

			$url = '/hipsterize/edit/?'.http_build_query(array(
				'img' => '/img/'.basename($img_path),
			));

			$this->request->redirect($url);

		}

		$this->request->redirect('/hipsterize');
	}


}
