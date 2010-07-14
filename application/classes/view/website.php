<?php defined('SYSPATH') or die('No direct script access.');

abstract class View_Website extends Kostache {

	public function notices()
	{
		return Notices::display();
	}

	public function profiler()
	{
		return View::factory('profiler/stats');
	}
}
