<?php defined('SYSPATH') or die('No direct script access.');

abstract class Abstract_Controller_Website extends Controller {

	/**
	 * @var object the content View object
	 */
	public $view;

	public function before()
	{
		// Set default title and content views (path only)
		$directory = $this->request->directory();
		$controller = $this->request->controller();
		$action = $this->request->action();

		// Removes leading slash if this is not a subdirectory controller
		$controller_path = trim($directory.'/'.$controller.'/'.$action, '/');

		try
		{
			$this->view = Kostache::factory('page/'.$controller_path)
				->assets(new Assets);
		}
		catch (Kohana_Exception $x)
		{
			/*
			 * The View class could not be found, so the controller action is
			 * repsonsible for making sure this is resolved.
			 */
			$this->view = NULL;
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
		// Only try to render a view if we have one set
		if ($this->view !== NULL)
		{
			$this->response->body($this->view);
		}


	}

	/**
	 * Returns true if the post has a valid CSRF
	 *
	 * @return  bool
	 */
	public function valid_post()
	{
		if ($this->request->method() !== HTTP_Request::POST)
			return FALSE;

		if (Request::post_max_size_exceeded())
		{
			Notices::add('error', __('Max filesize of :max exceeded.', array(':max' => ini_get('post_max_size').'B')));
			return FALSE;
		}

		$csrf = $this->request->post('csrf-token');
		$has_csrf = ! empty($csrf);
		$valid_csrf = $has_csrf AND CSRF::valid($csrf);

		if ($has_csrf AND ! $valid_csrf)
		{
			// CSRF was submitted but expired
			Notices::add('error', __('This form has expired. Please try submitting it again.'));
			return FALSE;
		}

		return $has_csrf AND $valid_csrf;
	}
}