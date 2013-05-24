<?php
/**
 * User library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_User {

	// Session singleton
	protected static $instance;

	// Protected key names (cannot be set by the user)
	protected static $protect = array('instance', 'name', 'dao', 'conf', 'languages');

    // User conf array
	protected static $config = array();

	/**
	 * Instance of User.
	 */
	public static function & instance()
	{
		if (Activerules_User::$instance == NULL)
		{
			// Create a new instance
			Activerules_User::$instance = new Activerules_User();
		}

		return Activerules_User::$instance;
	}

	/**
	 * On first site instance creation, it creates site.
	 */
	public function __construct()
	{
		// This part only needs to be run once
		if (Activerules_User::$instance === NULL)
		{
			// Singleton instance
			Activerules_User::$instance = $this;
		}
	}

	/**
	 * Get site configs
	 */
	public static function conf($var_name, $default=NULL) 
	{
        // the var_name has a dot, it means this is a dot notated array request
        if (strpos($var_name, '.') !== FALSE)
        {
            return arr::path(Activerules_User::$config, $var_name);
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
