<?php
/**
 * Output library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Output
{

	// Session singleton
	protected static $instance;

	protected static $page = NULL;

    /**
	 * Instance of Output.
	 */
	public static function & instance()
	{
		if (Activerules_Output::$instance == NULL)
		{
			// Create a new instance
			Activerules_Output::$instance = new Activerules_Output();
		}

		return Activerules_Output::$instance;
	}

	/**
	 * On first Output instance creation, it creates Output.
	 */
	public function __construct()
	{
		// This part only needs to be run once
		if (Activerules_Output::$instance === NULL)
		{
			// Singleton instance
			Activerules_Output::$instance = $this;
		}
	}

    public function set_page($page)
    {
        self::$page = $page;
    }

    
} // End Output Class
