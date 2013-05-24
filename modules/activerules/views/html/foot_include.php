<?php defined('SYSPATH') or die('No direct script access.');
/**
 *	Display foot include files for JS and CSS
 *
 * @package    ActiveRules
 * @package	   Site
 * @author     Brian Winkers
 * @copyright  (c) 2005-2009 Ultri - Brian Winkers
 */
echo "\n"; 
	
	if(empty($foot_include))
	{
		$foot_include = ar::get_conf(array('page', 'site'), 'foot_include', 'default_foot_include');
	}
	
	View::factory('includes/'.$foot_include)->render();
?> 