<?php defined('SYSPATH') or die('No direct script access.');

/**
 * auth tables
 */
class Migration_Auth_20110204130322 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function up(Kohana_Database $db)
	{
		$db->query(NULL, '
			CREATE TABLE IF NOT EXISTS `roles` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(32) NOT NULL,
			`description` VARCHAR(255) NOT NULL,
			PRIMARY KEY  (`id`),
			UNIQUE KEY `uk_name` (`name`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
		');

		$db->query(NULL, '
			CREATE TABLE IF NOT EXISTS `pvt_roles_users` (
			`user_id` INT UNSIGNED NOT NULL,
			`role_id` INT UNSIGNED NOT NULL,
			PRIMARY KEY  (`user_id`,`role_id`),
			KEY `k_user_id` (`user_id`),
			KEY `k_role_id` (`role_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		');

		$db->query(NULL, '
			CREATE TABLE IF NOT EXISTS `users` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`email` VARCHAR(127) NOT NULL,
			`username` VARCHAR(32) NOT NULL DEFAULT \'\',
			`password` VARCHAR(64) NOT NULL,
			`logins` INT UNSIGNED NOT NULL DEFAULT \'0\',
			`last_login` INT UNSIGNED,
			PRIMARY KEY  (`id`),
			UNIQUE KEY `uk_username` (`username`),
			UNIQUE KEY `uk_email` (`email`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
		');

		$db->query(NULL, '
			CREATE TABLE IF NOT EXISTS `user_tokens` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`user_id` INT UNSIGNED NOT NULL,
			`user_agent` VARCHAR(40) NOT NULL,
			`token` VARCHAR(40) NOT NULL,
			`type` VARCHAR(100) NOT NULL,
			`created` INT UNSIGNED NOT NULL,
			`expires` INT UNSIGNED NOT NULL,
			PRIMARY KEY  (`id`),
			UNIQUE KEY `uk_token` (`token`),
			KEY `k_user_id` (`user_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
		');
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function down(Kohana_Database $db)
	{
		$db->query(NULL, 'DROP TABLE pvt_roles_users');
		$db->query(NULL, 'DROP TABLE roles');
		$db->query(NULL, 'DROP TABLE users');
		$db->query(NULL, 'DROP TABLE user_tokens');
	}
}
