<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'default-template' => array
	(
		array('style', 'media/ko/css/compiled/styles/'.Kohana::APP_VERSION.'.css', 'head'),
		array('script', 'http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js', 'head'),
		array('script', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js', 'body', 10),
	),
);
