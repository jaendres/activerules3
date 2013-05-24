<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Database query wrapper.
 * Added to allow overriding condtructor and toString methods to allow passing in db connection.
 *
 * @package    ActiveRules/Database
 * @category   Query
 * @author     Brian winkers
 * @copyright  (c) 2010-2011 Ultri Group LLC
 * @license    http://kohanaphp.com/license
 */
class Database_Query extends Kohana_Database_Query 
{
	
    // DB connection for ActiveRules
	protected $_db;

    /**
	 * Creates a new SQL query of the specified type.
	 *
	 * @param   integer  query type: Database::SELECT, Database::INSERT, etc
	 * @param   string   query string
	 * @return  void
	 */
	public function __construct($type, $sql, $db_connection='default')
	{
		$this->_type = $type;
		$this->_sql = $sql;
        $this->_db_connection = $db_connection;
    }

    	/**
	 * Return the SQL query string.
	 *
	 * @return  string
	 */
	final public function __toString()
	{
		try
		{
            // Return the SQL string
			return $this->compile(Database::instance($this->_db_connection));
		}
		catch (Exception $e)
		{
			return Kohana::exception_text($e);
		}
	}

    /**
	 * Execute the current query on the given database.
	 *
	 * @param   mixed    Database instance or name of instance
	 * @return  object   Database_Result for SELECT queries
	 * @return  mixed    the insert id for INSERT queries
	 * @return  integer  number of affected rows for all other queries
	 */
	public function execute($db = NULL)
	{
		if($db === NULL)
        {
            $db = $this->_db_connection;
        }

        if ( ! is_object($db))
		{
			// Get the database instance
			$db = Database::instance($db);
		}

		// Compile the SQL query
		$sql = $this->compile($db);

		if ( ! empty($this->_lifetime) AND $this->_type === Database::SELECT)
		{
			// Set the cache key based on the database instance name and SQL
			$cache_key = 'Database::query("'.$db.'", "'.$sql.'")';

			if ($result = Kohana::cache($cache_key, NULL, $this->_lifetime))
			{
				// Return a cached result
				return new Database_Result_Cached($result, $sql, $this->_as_object);
			}
		}

		// Execute the query
		$result = $db->query($this->_type, $sql, $this->_as_object);

		if (isset($cache_key))
		{
			// Cache the result array
			Kohana::cache($cache_key, $result->as_array(), $this->_lifetime);
		}

		return $result;
	}
}
