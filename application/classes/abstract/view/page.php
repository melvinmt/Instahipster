<?php defined('SYSPATH') or die('No direct script access.');

abstract class Abstract_View_Page extends Abstract_View_Layout {

	public $title = 'Default Page Title';

	public function assets($assets)
	{
		$assets->group('default-template');
		return parent::assets($assets);
	}

	public function i18n()
	{
		return function($string)
		{
			return __($string);
		};
	}

	public function site_name()
	{
		return array(
			'title' => 'Project Template',
			'url'   => URL::site(''),
		);
	}

	public function title()
	{
		return __($this->title);
	}

	public function notices()
	{
		$data = array();

		foreach (Notices::get() as $array)
		{
			$message_path = $array['type'].'.'.$array['key'];
			$data[] = array
			(
				'type'     => $array['type'],
				'key'      => $array['key'],
				'message'  => Kohana::message('notices', $message_path, $message_path),
			);
		}

		return $data;
	}

	public function profiler()
	{
		return View::factory('profiler/stats');
	}

	public function assets_head()
	{
		if ( ! $this->_assets)
			return '';

		$assets = '';
		foreach ($this->_assets->get('head') as $asset)
		{
			$assets .= $asset."\n";
		}

		return $assets;
	}

	public function assets_body()
	{
		if ( ! $this->_assets)
			return '';

		$assets = '';
		foreach ($this->_assets->get('body') as $asset)
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
