<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'default-template' => array
	(
		// Very important for these 2 to be loaded first
		array('style', 'media/packages/restyle/reset.css', 'head', -100),
		array('style', 'media/packages/restyle/restyle.css', 'head', -90),

		array('style', 'media/css/styles.css', 'head'),
		array('style', 'media/packages/notices/css/notices.css', 'head'),
		array('script', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', 'head'),
		array('script', 'media/packages/notices/js/notices.js', 'body', 10),
	),
	'jquery-ui' => array
	(
		array('script', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js', 'body', 10),
	),
);
