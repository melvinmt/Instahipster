<?php defined('SYSPATH') or die('No direct script access.');

return array(
	MODPATH.'auth' => array(
		'fetch_from' => 'https://github.com/kohana/auth.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-auth.git',
		'checkout'   => 'origin/3.1/develop',
	),
	MODPATH.'database' => array(
		'fetch_from' => 'https://github.com/kohana/database.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-database.git',
		'checkout'   => 'origin/3.1/develop',
	),
	MODPATH.'image' => array(
		'fetch_from' => 'https://github.com/kohana/image.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-image.git',
		'checkout'   => 'origin/3.1/develop',
	),
	MODPATH.'minion' => array(
		'fetch_from' => 'https://github.com/BRMatt/kohana-minion.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-minion.git',
		'checkout'   => 'origin/develop',
	),
	MODPATH.'orm' => array(
		'fetch_from' => 'https://github.com/kohana/orm.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-orm.git',
		'checkout'   => 'origin/3.1/develop',
	),
	MODPATH.'unittest' => array(
		'fetch_from' => 'https://github.com/kohana/unittest.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-unittest.git',
		'checkout'   => 'origin/3.1/develop',
	),
	MODPATH.'userguide' => array(
		'fetch_from' => 'https://github.com/kohana/userguide.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-userguide.git',
		'checkout'   => 'origin/3.1/develop',
	),
	MODPATH.'git' => array(
		'fetch_from' => 'https://github.com/Zeelot/kohana-git.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-git.git',
		'checkout'   => 'origin/3.1/develop',
	),
	MODPATH.'minion-tasks-repo' => array(
		'fetch_from' => 'https://github.com/Zeelot/minion-tasks-repo.git',
		'push_to'    => 'git@github.com:synapsestudios/minion-tasks-repo.git',
		'checkout'   => 'origin/3.1/develop',
	),
);
