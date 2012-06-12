<?php defined('SYSPATH') or die('No direct script access.');

$js_app_file = Kohana::$environment === Kohana::DEVELOPMENT
	? 'js/compiled/app.js'
	: 'js/compiled/app.min.js';

return array
(
	'default-template' => array
	(
		array('style', Media::url('css/vendor/jquery.ui.core.css'), 'head'),
		array('style', Media::url('css/vendor/jquery.ui.resizable.css'), 'head'),
		array('style', Media::url('css/vendor/styles.css'), 'head'),
		array('style', Media::url('css/compiled/styles.css'), 'head', 10),
		array('script', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js', 'body'),
		array('script', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js', 'body', 10),
		array('script', Media::url('js/vendor/ui/jquery.ui.core.js'), 'body', 11),
		array('script', Media::url('js/vendor/ui/jquery.ui.widget.js'), 'body', 12),
		array('script', Media::url('js/vendor/ui/jquery.ui.mouse.js'), 'body', 13),
		array('script', Media::url('js/vendor/ui/jquery.ui.draggable.js'), 'body', 14),
		array('script', Media::url('js/vendor/ui/jquery.ui.resizable.js'), 'body', 15),
		array('script', Media::url('js/vendor/ui/jquery.ui.rotatable.js'), 'body', 16),
		array('script', Media::url('js/vendor/jquery.hoverscroll.js'), 'body', 17),
		array('script', Media::url('js/vendor/hipsterscript.js'), 'body', 18),
		array('script', Media::url('js/mustache.js'), 'body', 10),
		array('script', Media::url('js/underscore-min.js'), 'body', 10),
		array('script', Media::url('js/backbone-min.js'), 'body', 20),
		array('script', Media::url($js_app_file), 'body', 40),
		array('style', 'http://fonts.googleapis.com/css?family=Lobster+Two', 'head')
	),
);