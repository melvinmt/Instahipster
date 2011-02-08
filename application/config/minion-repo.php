<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'modules/auth' => array(
		'path'       => MODPATH.'auth',
		'fetch_from' => 'https://github.com/kohana/auth.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-auth.git',
		'checkout'   => 'origin/3.1/master',
	),
	'modules/database' => array(
		'path'       => MODPATH.'database',
		'fetch_from' => 'https://github.com/kohana/database.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-database.git',
		'checkout'   => 'origin/3.1/master',
	),
	'modules/image' => array(
		'path'       => MODPATH.'image',
		'fetch_from' => 'https://github.com/kohana/image.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-image.git',
		'checkout'   => 'origin/3.1/master',
	),
	'modules/minion' => array(
		'path'       => MODPATH.'minion',
		'fetch_from' => 'https://github.com/kohana-minion/core.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-minion.git',
		'checkout'   => 'origin/K3.1/develop',
	),
	'modules/orm' => array(
		'path'       => MODPATH.'orm',
		'fetch_from' => 'https://github.com/kohana/orm.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-orm.git',
		'checkout'   => 'origin/3.1/master',
	),
	'modules/unittest' => array(
		'path'       => MODPATH.'unittest',
		'fetch_from' => 'https://github.com/kohana/unittest.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-unittest.git',
		'checkout'   => 'origin/3.1/master',
	),
	'modules/userguide' => array(
		'path'       => MODPATH.'userguide',
		'fetch_from' => 'https://github.com/kohana/userguide.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-userguide.git',
		'checkout'   => 'origin/3.1/master',
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
		'checkout'   => 'origin/dev/0.5.x',
	),
	'modules/minion-tasks-migrations' => array(
		'path'       => MODPATH.'minion-tasks-migrations',
		'fetch_from' => 'https://github.com/kohana-minion/tasks-migrations.git',
		'push_to'    => 'git@github.com:synapsestudios/minion-tasks-migrations.git',
		'checkout'   => 'origin/develop',
	),
	'system' => array(
		'path'       => SYSPATH,
		'fetch_from' => 'https://github.com/kohana/core.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-core.git',
		'checkout'   => 'origin/3.1/master',
	),
	'modules/pagination' => array(
		'path'       => MODPATH.'pagination',
		'fetch_from' => 'https://github.com/kohana/pagination.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-pagination.git',
		'checkout'   => 'origin/3.1/develop',
	),
	'modules/notices' => array(
		'path'       => MODPATH.'notices',
		'fetch_from' => 'https://github.com/synapsestudios/kohana-notices.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-notices.git',
		'checkout'   => 'origin/dev/3.0.x',
	),
	'modules/acl' => array(
		'path'       => MODPATH.'acl',
		'fetch_from' => 'https://github.com/synapsestudios/kohana-acl.git',
		'push_to'    => 'git@github.com:synapsestudios/kohana-acl.git',
		'checkout'   => 'origin/dev/1.0.x',
	),
);
