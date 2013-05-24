<?php defined('SYSPATH') or die('No direct script access.');

class DB extends Kohana_DB {
    
    /**
	 * Create a new [Database_Query] of the given type.
	 *
	 *     // Create a new SELECT query
	 *     $query = DB::query(Database::SELECT, 'SELECT * FROM users');
	 *
	 *     // Create a new DELETE query
	 *     $query = DB::query(Database::DELETE, 'DELETE FROM users WHERE id = 5');
	 *
	 * Specifying the type changes the returned result. When using
	 * `Database::SELECT`, a [Database_Query_Result] will be returned.
	 * `Database::INSERT` queries will return the insert id and number of rows.
	 * For all other queries, the number of affected rows is returned.
	 *
	 * @param   integer  type: Database::SELECT, Database::UPDATE, etc
	 * @param   string   SQL statement
     * @param   string   DB connection/instance string
	 * @return  Database_Query
	 */
	public static function query($type, $sql, $db_connection='default')
	{
		return new Database_Query($type, $sql, $db_connection);
	}
}
