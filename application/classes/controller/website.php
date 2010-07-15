<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Website extends Controller_Template {

	/**
	 * @var  string  page template
	 */
	public $template = 'layout/default';

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
		if ($this->auto_render === TRUE)
		{
			// Load the template
			$this->template = Kostache::factory($this->template);

			// Set default title and content views (path only)
			$directory = $this->request->directory;
			$controller = $this->request->controller;
			$action = $this->request->action;

			// Removes leading slash if this is not a subdirectory controller
			$controller_path = trim($directory.'/'.$controller.'/'.$action, '/');
			$message_path = str_replace('/', '.', $controller_path);

			$this->title = Kohana::message('titles', $message_path, $message_path);

			try
			{
				$this->content = Kostache::factory($controller_path);
			}
			catch (Exception $x)
			{
				/*
				 * The View class could not be found, so the controller action is
				 * repsonsible for making sure this is resolved.
				 */
				$this->content = NULL;
			}
		}
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
			// If content is NULL, then there is no View to render
			if ($this->content === NULL)
				throw new Kohana_View_Exception('There was no View created for this request.');

			/**
			 * Assign these at the very last moment
			 * This allows the actions to replace these values
			 */
			$this->template->content = $this->content;
			$this->template->title = $this->title;
		}
		parent::after();
	}

	/**
	 * Returns true if the request has a valid CSRF
	 *
	 * @param   string the namespace used in the form csrf field
	 * @param   bool   TRUE if an invalid CSRF token causes a notice to be sent (optional, default TRUE)
	 * @return  bool
	 */
	public function valid_request($namespace = 'default', $method = 'post')
	{
		if (Request::upload_too_large())
		{
			echo 'fail';
			Notices::add('error', __('Max filesize of :max exceeded.', array(':max' => ini_get('post_max_size').'B')));
			return FALSE;
		}

		if ($method == 'post')
		{
			$values = $_POST;
		}
		elseif ($method == 'get')
		{
			$values = $_GET;
		}

		$has_csrf = isset($values['csrf-token-'.$namespace]);

		$valid_csrf = $has_csrf 
			? CSRF::valid($namespace, $values['csrf-token-'.$namespace])
			: FALSE;

		if ($has_csrf && ! $valid_csrf)
		{
			die(Kohana::debug($valid_csrf));
			Notices::add('error', __('This form has expired. Please try submitting it again.'));
			return FALSE;
		}

		return $has_csrf && $valid_csrf;
	}
}
