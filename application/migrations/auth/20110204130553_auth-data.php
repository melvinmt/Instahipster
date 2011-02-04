<?php defined('SYSPATH') or die('No direct script access.');

/**
 * auth data
 */
class Migration_Auth_20110204130553 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function up(Kohana_Database $db)
	{
		DB::insert('roles', array('name', 'description'))
			->values(array('login', 'Login privileges, granted after account confirmation.'))
			->values(array('admin', 'Administrative user, has access to everything.'))
			->execute($db);
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function down(Kohana_Database $db)
	{
		DB::delete('roles')
			->where('name', 'IN', array('login', 'admin'))
			->execute($db);
	}
}
