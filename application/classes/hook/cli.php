<?php defined('SYSPATH') or die('No direct script access.');

class Hook_CLI
{
	public static function init()
	{
		// We need a $_SERVER['HTTP_HOST'] value for URI::base()
		$_SERVER['HTTP_HOST'] = Kohana::config('cli')->http_host;
		Request::$protocol = Kohana::config('cli')->protocol;
	}
}
