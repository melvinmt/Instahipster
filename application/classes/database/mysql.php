<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @package     Nestablish
 * @author      Synapse Studios, LLC
 * @copyright   (c) 2010 Synapse Studios
 */
class Database_Mysql extends Kohana_Database_Mysql
{
	private $transaction_depth = 0;
	
	public function start_transaction()
	{	
		if ($this->transaction_depth === 0)
		{
			$this->query(NULL, 'START TRANSACTION', FALSE);
		}
		
		$this->transaction_depth++;
		
		return $this;
	}
	
	public function commit()
	{
		if ($this->transaction_depth < 1)
		{
			throw new BadMethodCallException('error.database.transaction-not-started');
		}
		
		if ($this->transaction_depth === 1)
		{
			$this->query(NULL, 'COMMIT', FALSE);
		}
		
		$this->transaction_depth--;
		
		return $this;
	}
	
	public function rollback()
	{
		if ($this->transaction_depth < 1)
		{
			return $this;
		}
		
		$this->query(NULL, 'ROLLBACK', FALSE);
		$this->transaction_depth = 0;
		
		return $this;
	}
}