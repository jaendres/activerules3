<?php
/**
 * Core ActiveRules library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Core  {

	// Session singleton
	protected static $instance;

	// Protected key names (cannot be set by the user)
	protected static $protect = array('instance', 'conf');

    // User conf array
	protected static $conf = array();

	/**
	 * Get site configs
	 */
	public static function conf($var_name, $default=NULL) 
	{
        // the var_name has a dot, it means this is a dot notated array request
        if (strpos($var_name, '.') !== FALSE)
        {
            return arr::path(self::$config, $var_name);
        }
        elseif(isset(self::$config[$var_name]))
        {
            return self::$config[$var_name];
        }
        else
        {
            return $default;
        }
	}


} // End User Class
