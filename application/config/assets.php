<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'default-template' => array
	(
		array(HTML::style('media/css/styles.css')),
		array(HTML::style('media/packages/notices/css/notices.css')),
		array(HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js')),
		array(HTML::script('media/packages/notices/js/notices.js'), 10),
	),
	'jquery-ui' => array
	(
		array(HTML::script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js'), 10),
	),
);
