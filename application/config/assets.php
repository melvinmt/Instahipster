<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'default-template' => array
	(
		array('style', 'media/css/compiled/styles.css', 'head'),
		array('script', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', 'head'),
		array('script', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js', 'body', 10),
	),
);
