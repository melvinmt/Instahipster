<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pic extends Abstract_Controller_Page {

	protected $_img;

	public function action_index()
	{
		if( ! $this->_img = $this->request->param('id'))
			$this->request->redirect('/');
	}

	public function after()
	{
		$this->_view
				->set('_img', $this->_img);

		parent::after();
	}

}
