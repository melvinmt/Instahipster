<?php defined('SYSPATH') or die('No direct script access.');

class Kohana extends Kohana_Core
{
	const APP_VERSION = '0.0.0';
	const QA = 5;
	const BETA = 6;

	// Useful for when the constant is too vague as an int
	public static $environment_string = 'development';

	public static function app_revision()
	{
		static $revision;

		if ( ! $revision)
		{
			$git = new Git(APPPATH);
			$revision = $git->execute('log --pretty=format:\'%H\' -1');
		}

		return $revision;
	}
}
