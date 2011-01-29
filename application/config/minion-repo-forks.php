<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'modules/auth' => array(
		'path'       => MODPATH.'auth',
		'fetch_from' => 'https://github.com/kohana/auth.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-auth.git',
		'checkout'   => 'origin/3.1/develop',
	),
	'modules/database' => array(
		'path'       => MODPATH.'database',
		'fetch_from' => 'https://github.com/kohana/database.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-database.git',
		'checkout'   => 'origin/3.1/develop',
	),
	'modules/image' => array(
		'path'       => MODPATH.'image',
		'fetch_from' => 'https://github.com/kohana/image.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-image.git',
		'checkout'   => 'origin/3.1/develop',
	),
	'modules/minion' => array(
		'path'       => MODPATH.'minion',
		'fetch_from' => 'https://github.com/BRMatt/kohana-minion.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-minion.git',
		'checkout'   => 'origin/develop',
	),
	'modules/orm' => array(
		'path'       => MODPATH.'orm',
		'fetch_from' => 'https://github.com/kohana/orm.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-orm.git',
		'checkout'   => 'origin/3.1/develop',
	),
	'modules/unittest' => array(
		'path'       => MODPATH.'unittest',
		'fetch_from' => 'https://github.com/kohana/unittest.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-unittest.git',
		'checkout'   => 'origin/3.1/develop',
	),
	'modules/userguide' => array(
		'path'       => MODPATH.'userguide',
		'fetch_from' => 'https://github.com/kohana/userguide.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-userguide.git',
		'checkout'   => 'origin/3.1/develop',
	),
	'modules/git' => array(
		'path'       => MODPATH.'git',
		'fetch_from' => 'https://github.com/Zeelot/kohana-git.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-git.git',
		'checkout'   => 'origin/3.1/develop',
	),
	'modules/minion-tasks-repo' => array(
		'path'       => MODPATH.'minion-tasks-repo',
		'fetch_from' => 'https://github.com/Zeelot/minion-tasks-repo.git',
		'push_to'    => 'git@github.com:synapsestudios/minion-tasks-repo.git',
		'checkout'   => 'origin/3.1/develop',
	),
);
