<?php defined('SYSPATH') or die('No direct script access.');

class View_Page_Main_Index extends Abstract_View_Page {

	public $title = 'Instahipster';

	public function logged_in()
	{
		return $this->_logged_in;
	}

}
