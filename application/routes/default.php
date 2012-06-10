<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */


Route::set('img', 'img/<id>', array('id' => '.*'))
	->defaults(array(
		'controller' => 'img',
		'action'     => 'get',
	));

Route::set('pic', 'pic/<id>', array('id' => '.*'))
	->defaults(array(
		'controller' => 'pic',
		'action'     => 'index',
	));

Route::set('default', '(<controller>(/<action>(/<id>)))', array('id' => '.*'))
	->defaults(array(
		'controller' => 'main',
		'action'     => 'index',
	));