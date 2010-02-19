<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Template extends Kohana_Controller_Template {

	/**
	 * @var  string  page template
	 */
	public $template = 'templates/default';

	/**
	 *
	 * @var object the content View object
	 */
	public $content;

	/**
	 * @var  string  page title
	 */
	public $title;

	public function before()
	{
		parent::before();

		// Set default title and content views (path only)
		$directory = $this->request->directory;
		$controller = $this->request->controller;
		$action = $this->request->action;

		// Removes leading slash if this is not a subdirectory controller
		$controller_path = trim($directory.'/'.$controller.'/'.$action, '/');

		$message_path = str_replace('/', '.', $controller_path);

		$this->title = Kohana::message('titles', $message_path, $message_path);
		$this->content = View::factory($controller_path);
	}

	/**
	 * Assigns the title to the template.
	 *
	 * @param   string   request method
	 * @return  void
	 */
	public function after()
	{
		if ($this->auto_render === TRUE)
		{
			/**
			 * Assign these at the very last moment
			 * This allows the actions to replace these values
			 */
			$this->template->content = $this->content;
			$this->template->title = $this->title;
		}
		parent::after();
	}

}
