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

	public function assets()
	{
		$assets = array();
		foreach (Assets::get() as $asset)
		{
			$assets[] = array('asset' => $asset);
		}

		return $assets;
	}
}
