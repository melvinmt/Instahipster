<?php defined('SYSPATH') or die('No direct script access.');

class View_Layout_Default extends View_Website {

	public $uri = NULL;
	public $user = NULL;

	public function styles()
	{
		return array
		(
			array('style' => HTML::style('media/css/theme.css')),
			array('style' => HTML::style('media/css/style.css')),
			array('style' => HTML::style('media/css/theme1.css')),
			array('style' => HTML::style('media/css/notices.css')),
			array('style' => '<!--[if IE]>'.HTML::style('media/css/ie-sucks.css').'<![endif]-->'),
		);
	}

	public function scripts()
	{
		return array
		(
			array('script' => HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js')),
			array('script' => HTML::script('media/js/notices.js')),
		);
	}

	public function top_nav()
	{
		$nav = array
		(
			array
			(
				'link'    => HTML::anchor(Route::get('default')->uri(), __('Home')),
				'current' => Route::get('default')->uri() === $this->uri,
			),
			array
			(
				'link' => HTML::anchor(Route::get('menu')->uri(), __('Menus')),
				'current' => Route::get('menu')->uri() === $this->uri,
			),
		);

		if ($this->user->can_access('login'))
		{
			$nav[] = array
			(
				'link' => HTML::anchor(Route::get('auth')->uri(array('action' => 'login')), __('Login')),
				'current' => Route::get('auth')->uri(array('action' => 'login')) === $this->uri,
			);
		}
		if ($this->user->can_access('logout'))
		{
			$nav[] = array
			(
				'link' => HTML::anchor(Route::get('auth')->uri(array('action' => 'logout')), __('Logout')),
				'current' => Route::get('auth')->uri(array('action' => 'logout')) === $this->uri,
			);
		}

		return $nav;
	}
}
