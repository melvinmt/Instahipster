<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'default-template' => array
	(
		array('style', Media::url('css/compiled/styles.css'), 'head'),
		array('script', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js', 'body'),
		array('script', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js', 'body', 10),
		array('script', Media::url('js/underscore-min.js'), 'body'),
		array('script', Media::url('js/backbone-min.js'), 'body'),
		array('script', Media::url('js/app/compiled/app.components.min.js'), 'body'),
		array('script', Media::url('js/app/compiled/app.min.js'), 'body'),
	),
);