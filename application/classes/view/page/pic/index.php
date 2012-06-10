<?php defined('SYSPATH') or die('No direct script access.');

class View_Page_Pic_Index extends Abstract_View_Page {

	public $title = 'Instahipster';

	public function img_url()
	{
		return '/img/'.$this->_img;
	}

	public function img()
	{
		return $this->_img;
	}

}
