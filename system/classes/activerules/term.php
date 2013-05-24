<?php
/**
 * Party library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Party {

	// Session singleton
	protected static $instance;

	// Protected key names (cannot be set by the user)
	protected static $protect = array('type', 'uuid');

	// Configuration
	public static $type; // person or org
	
    /**
	 * Instance of Party.
	 */
	public static function & instance($hostname=FALSE)
	{
		if (Activerules_Party::$instance == NULL)
		{
			// Create a new instance
			Activerules_Party::$instance = new Activerules_Party($hostname);
		}

		return Activerules_Party::$instance;
	}

	/**
	 * On first Party instance creation, it creates Party.
	 */
	public function __construct($hostname=FALSE)
	{
		// This part only needs to be run once
		if (Activerules_Party::$instance === NULL)
		{
			// Singleton instance
			Activerules_Party::$instance = $this;
		}
	}



} // End Party Class
