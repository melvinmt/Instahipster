<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	//@TODO change this to be environment-specific and override production value in environment config
	'save_path' => realpath(DOCROOT.'../../../sessions'),
	'native' => array
	(
		//@TODO change this to be project-specific
		'name' => 'project_template',
	),
	'database' => array
	(
		'group' => 'default',
		'table' => 'sessions',
	),
	'cookie' => array
	(
		'encrypted' => TRUE,
	),
);