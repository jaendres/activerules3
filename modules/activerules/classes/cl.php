<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Code List helper
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri - Brian Winkers
 */
class cl_Core
{
	/**
	 * 
	 * @param   string   string to convert
	 * @param  string
	 * @return  string
	 */
	public static function val($list_name, $id)
	{
		
		// Define the file path from the Kohana SYSTEM diretcory.
		// This is in SYSTEM to STRONGLY encourage use of a common code lists.
		$file_path = SYSPATH.'code_list'.DIRECTORY_SEPARATOR.$list_name.EXT;
		
		if(file_exists($file_path))
		{
			// This file needs to define a list
			// This redefines $list string that was passed in.
			require($file_path);
		}
		
		if(array_key_exists($id, $list))
		{
			
			return $list[$id];
		}
		
		return NULL;
	}
	
	/**
	 * Performs a lookup to get the id from a value.
	 * 
	 * @param unknown_type $list
	 * @param unknown_type $id
	 */
	public static function key($list_name, $val)
	{
		
		// Define the file path from the Kohana SYSTEM diretcory.
		// This is in SYSTEM to STRONGLY encourage use of a common code lists.
		$file_path = SYSPATH.'code_list'.DIRECTORY_SEPARATOR.$list_name.EXT;
		
		if(file_exists($file_path))
		{
			
			// This file needs to define a list
			// This redefines $list string that was passed in.
			require($file_path);
			
			//make sure that the language code is in the list of languages
			if(in_array($val, $list))
			{
				
				//get the first key for the value pair in the array and return it
				return array_shift(array_keys($list, $val));
				
			}
		}
		
		
		
		return NULL;
	}

} // End UI helper
