<?php defined('SYSPATH') or die('No direct script access.');

abstract class View_Page extends View_Layout {

	public $title = 'Default Page Title';

	public function i18n()
	{
		return function($string)
		{
			return __($string);
		};
	}

	public function _initialize()
	{
		Assets::add_group('default-template');
		parent::_initialize();
	}

	public function title()
	{
		return __($this->title);
	}

	public function notices()
	{
		return Notices::display();
	}

	public function profiler()
	{
		return View::factory('profiler/stats');
	}

	public function assets_head()
	{
		$assets = '';
		foreach (Assets::get('head') as $asset)
		{
			$assets .= $asset."\n";
		}

		return $assets;
	}

	public function assets_body()
	{
		$assets = '';
		foreach (Assets::get('body') as $asset)
		{
			$assets .= $asset;
		}

		return $assets;
	}

	public function render($template = null, $view = null, $partials = null)
	{
		$content = parent::render($template, $view, $partials);

		return str_replace(array
		(
			'[[assets_head]]',
			'[[assets_body]]'
		), array
		(
			$this->assets_head(),
			$this->assets_body()
		), $content);
	}
}
