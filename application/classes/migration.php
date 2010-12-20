<?php defined('SYSPATH') or die('No direct script access.');

class Migration extends Doctrine_Migration_Base
{
	/**
	 * Extract this array into your migration methods to help you shorten the syntax.
	 *
	 *     public function up()
	 *     {
	 *         extract($this->helpers());
	 *     
	 *         $table = 'keywords';
	 *         $columns = array
	 *         (
	 *             'id'   => $int + $not_null + $unsigned + $ai + $primary,
	 *             'name' => $string(50) + $not_null,
	 *         );
	 *         $options = $innodb + $utf8 + array
	 *         (
	 *             'indexes' => $index('name', 'name', TRUE)
	 *         );
	 *         $this->createTable($table, $columns, $options);
	 *     }
	 *
	 * @return array
	 */
	public function helpers()
	{
		return array
		(
			// Table Options
			'innodb'   => array('type' => 'INNODB'),
			'utf8'     => array('charset' => 'utf8'),
			'index'    => function($name, $fields, $unique)
			{
				$fields = is_array($fields) ? $fields : array($fields);
				$unique = (bool)$unique ? array('type' => 'UNIQUE') : array();

				return array($name => array('fields' => $fields) + $unique);
			},

			// Index Options
			'unique'   => array('type' => 'unique'),
			'fields'   => function($fields)
			{
				return is_array($fields)
					? array('fields' => $fields)
					: array('fields' => array($fields));
			},

			// Field types
			'int'      => array('type' => 'integer'),
			'text'     => array('type' => 'text'),
			'longtext' => array('type' => 'longtext'),
			'date'     => array('type' => 'date'),
			'datetime' => array('type' => 'datetime'),
			'string'   => function($length = NULL)
			{
				$length = $length === NULL ? array() : array('length' => $length);

				return array('type' => 'string') + $length;
			},

			// Field properties
			'not_null' => array('notnull' => TRUE),
			'ai'       => array('autoincrement' => TRUE),
			'unsigned' => array('unsigned' => TRUE),
			'primary'  => array('primary' => TRUE),
			'length'   => function($length) {return array('length' => $length);},
			'default'  => function($value) {return array('default' => $value);},

			'fk'       => function($local, $foreign, $table, $on_update = NULL, $on_delete = NULL)
			{
				$on_update = $on_update === NULL ? array() : array('onUpdate' => $on_update);
				$on_delete = $on_delete === NULL ? array() : array('onDelete' => $on_delete);

				return array
				(
					'local'        => $local,
					'foreign'      => $foreign,
					'foreignTable' => $table,
				// Add any optional update/delete actions
				) + $on_update + $on_delete;
			},
		);
	}
}
