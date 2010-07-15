<?php defined('SYSPATH') or die('No direct script access.');

class View_Layout_Default extends View_Website {

	public $uri = NULL;
	public $user = NULL;

	public function _initialize()
	{
		Assets::add_group(array
		(
			'default-template', 'jquery-ui',
		));
	}
}
