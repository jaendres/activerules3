<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri - Brian Winkers
 */
class uuid 
{
	public static function rand($bin=FALSE)
	{
		// Create a Random UUID
		if($bin)
		{
			return uuid_parse(uuid_create(UUID_TYPE_RANDOM));
		}
		else
		{
			return uuid_create(UUID_TYPE_RANDOM);
		}
	}
	
	public static function time($bin=FALSE)
	{
		// Create a Time based UUID
		if($bin)
		{
			return uuid_parse(uuid_create(UUID_TYPE_TIME));
		}
		else
		{
			return uuid_create(UUID_TYPE_TIME);
		}
	}
	
	public static function dce($bin=FALSE)
	{
		// Create a DCE UUID
		if($bin)
		{
			return uuid_parse(uuid_create(UUID_TYPE_DCE));
		}
		else
		{
			return uuid_create(UUID_TYPE_DCE);
		}
	}
	
	public static function def($bin=FALSE)
	{
		// Create a Time based UUID
		if($bin)
		{
			return uuid_parse(uuid_create(UUID_TYPE_DEFAULT));
		}
		else
		{
			return uuid_create(UUID_TYPE_DEFAULT);
		}
	}
	
	public static function hex2bin($uuid)
	{
		return uuid_parse($uuid);
	}
	
	public static function bin2hex($bin_uuid)
	{
		return uuid_unparse($bin_uuid);
	}
	
	public static function valid($uuid)
	{
		// UUID's are 26 (binary) or 36 (32 hex with 4 hyphens)
		$length = strlen($uuid);
		
		// Bin  Hex or invalid
		switch($length)
		{
			case 16:
				// Binary
				return TRUE; // uuid_unparse(uuid_valid($uuid));
				break;
				
			//case 32:
				// Hex
				//return TRUE; // uuid_valid($uuid);
				//break;
				
			case 36:
				// Hex
				return TRUE; //uuid_valid(str_replace('-', '', $uuid));
				break;

			default:
				// Invalid
				return FALSE;
				break;
		}
	}

} // End file