<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Template extends Kohana_Controller_Template {

	/**
	 * @var  string  page template
	 */
	public $template = 'templates/default';

	/**
	 * @var  string  page title
	 */
	public $title = 'New World';

	/**
	 * Assigns the title to the template.
	 *
	 * @param   string   request method
	 * @return  void
	 */
	public function after()
	{
		$this->template->title = $this->title;
		parent::after();
	}

}
