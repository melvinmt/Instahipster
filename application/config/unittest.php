<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'environment'    => Kohana::TESTING,
	'temp_path'      => Kohana::$cache_dir.'/unittest',
	'cc_report_path' => 'report',
	'use_whitelist'  => TRUE,
	'whitelist'      => array(
		'app'        => TRUE,
		'modules'    => array(TRUE),
		'system'     => TRUE,
	),
	'use_blacklist' => TRUE,
	'blacklist' => array(
		'modules' => array('userguide'),
	),

	'db_connection' => 'default',
);
