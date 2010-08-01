<?php defined('SYSPATH') or die('No direct script access.');

abstract class View_Website extends Kostache {

	protected $_partials = array
	(
		'header' => 'headers/default',
		'footer' => 'footers/default',
	);

	public function title()
	{
		$class = get_class($this);
		$title = str_replace('_', ' ', substr($class, 5));

		return $this->title = __($title);
	}

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
