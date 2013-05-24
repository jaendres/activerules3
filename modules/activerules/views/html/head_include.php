<?php defined('SYSPATH') or die('No direct script access.');
/**
 *	Display head include files for JS and CSS
 *
 * @package    ActiveRules
 * @package	   Site
 * @author     Brian Winkers
 * @copyright  (c) 2005-2009 Ultri - Brian Winkers
 */
if(empty($head_include))
{
    $head_include = ar::conf('site', 'default_head_include', 'default_head_include');
}

echo View::factory('includes/'.$head_include)->render();