<?php defined('SYSPATH') or die('No direct script access.');

class Kostache extends Kohana_Kostache
{
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
