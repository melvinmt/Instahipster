<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'default' => array
	(
		'type'       => 'mysql',
		'connection' => array
		(
			// @TODO: change this to be project-specific
			'hostname'   => 'localhost',
			'username'   => 'root',
			'password'   => 'synapse',
			'database'   => 'vm',
			'persistent' => FALSE,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),
);
