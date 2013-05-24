<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package ActiveRules
 * @subpackage	Helpers
 * @author     Brian Winkers
 * @copyright  (c) 2010-2011 Brian Winkers
 */
class Activerules_Dbg {


	/**
	 * Echo out a debug.
	 * Created because I'm too lazy to type echo in front of Kohana's debug.
	 * @var mixed variable to pass into Kohana::debug
	 * @var string Comment to explain what the debug contains [optional]
	 */
	public static function it($var, $comment=NULL, $position=0)
	{
		// Echo comment if one was provided
		if($comment)
		{
			echo "\n<br>".$comment;
		}
		
		//Use debug backtrace to find the file and line where this debug was called
		$trace = debug_backtrace();
		
		// Echo out the file and line 
       	echo "\n<br>Debug: ".$trace[$position]['file'].' :: '.$trace[$position]['line'];
		// use Kohana debug, which wraps var_dump in <pre> tag
		echo Kohana::debug($var);
	}
	
	/**
	 * Echo out a debug and exit.
	 * Created because I'm too lazy to type echo in front of Kohana's debug.
	 * @var mixed variable to pass into Kohana::debug
	 * @var string Comment to explain what the debug contains [optional]
	 */
	public static function ite($var, $comment=NULL, $position=0)
	{
		$position++;
		
		self::it($var, $comment, $position);
		
		exit;
	}
	
	/**
	 * Echo out a debug and enviro CONSTANTS
	 * Created because I'm too lazy to type echo in front of Kohana's debug.
	 * @var mixed variable to pass into Kohana::debug
	 * @var string Comment to explain what the debug contains [optional]
	 */
	public static function env($var='', $comment=NULL, $position=0)
	{
		echo '<br>SITE_DS: '.SITE_DS;
		echo '<br>CACHE_ROOT: '.CACHE_ROOT;
		// echo '<br>SYSTEM_DIR: '.SYSTEM_DIR;
		echo '<br>SYSTEM_PATH: '.SYSTEM_PATH;
		// echo '<br>MODULE_DIR: '.MODULE_DIR;
		echo '<br>MODULE_PATH: '.MODULE_PATH;
		echo '<br>ENVIRO: '.ENVIRO;
		
		echo '<p>Kohana constants<br>DOCROOT: '.DOCROOT;
		echo '<br>KOHANA: '.KOHANA;
		echo '<br>MODPATH: '.MODPATH;
		echo '<br>SYSPATH: '.SYSPATH;
		echo '<br>IN_PRODUCTION: '.IN_PRODUCTION;
		
		$position++;
		
		self::it($var, $comment, $position);
	}
	
	/**
	 * Echo out a debug and exit.
	 * Created because I'm too lazy to type echo in front of Kohana's debug.
	 * @var mixed variable to pass into Kohana::debug
	 * @var string Comment to explain what the debug contains [optional]
	 */
	public static function enve($var='', $comment=NULL, $position=0)
	{
		$position++;
		
		self::env($var, $comment, $position);
		
		exit;
	}

} // End file