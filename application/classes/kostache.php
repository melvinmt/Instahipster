<?php defined('SYSPATH') or die('No direct script access.');

class Kostache extends Kohana_Kostache
{
	public static function factory($path, $template = null, $view = null, $partials = null)
	{
		// Check if the class exists exactly where it's defined
		$file = Kohana::find_file('classes', 'view/'.$path);
		if ($file)
		{
			include_once $file;
		}

		if ( ! $template AND Kohana::find_file('templates', $path, 'mustache'))
		{
			// This will ensure that Kostache does not rename the path of the template
			$template = $path;
		}

		return parent::factory($path, $template, $view, $partials);
	}

	public function __construct($template = null, $view = null, $partials = null)
	{
		parent::__construct($template, $view, $partials);

		// Allow for some setup to be done
		$this->_initialize();
	}

	/**
	 * Allows for things to be setup in View classes.
	 * Avoids having to extend the constructor and pass around all those parameters.
	 *
	 * @return  void
	 */
	public function _initialize() {}
}
