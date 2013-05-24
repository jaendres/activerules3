<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract controller class for automatic templating.
 *
 * @package    ActiverRules
 * @category   Controller
 * @author     Brian Winkers
 * @copyright  (c) 2010-2011
 * @license    http://kohanaphp.com/license
 */
class Controller_Activerules extends Controller
{
	/**
	 * @var  boolean  auto render template
	 **/
	public $auto_render = TRUE;

    // The view that provides the wrapping HTML code
    // Includes the opening and  closing HTML BODY tags
    protected static $container = FALSE;

    // Define the layout view to use
    // This will often change between site sections.
    // This controls menus, headers, footers, side bars etc.
    // Basically the parts of the page that are shared amongst unique pages.
    protected static $layout = FALSE;

    // Define the core view this will contain the data the user requested.
    // This is where a JSON or XML request would echo out the data
    protected static $core = '';

    public function __construct(Kohana_Request $request)
    {
        parent::__construct($request);

        session_start();

        // Add Zend support
        $this->include_zend();

        // Create SITE data connections, Apps may use their own connections.
        $this->active_data();

        // Initialize FirePHP plugin if enabled for site
		$this->set_firephp();
    }

    /**
	 * Automatically executed before the controller action. Can be used to set
	 * class properties, do authorization checks, and execute other custom code.
	 *
	 * @return  void
	 */
	public function before($container=FALSE)
	{
        // The Layout defines the HTML HEAD includes
        // The includes define the CSS and JS to be loaded in the HEAD
        //
        // We do this first because we want a small number of unique HEAD includes that can be sent immediately.
        // The determination of which options to support should be made at a high level in the code and be universal.

        // Check to see if the child set the container
        if($container)
        {
            self::$container = $container;
        }
        else
        {
             self::$container = self::determine_container();
        }

        // If there is a container we need to wrap the page output with it.
        if(self::$container)
        {
            // Send the headers right away so any remote JS, CSS etc files can start being loaded
            self::send_to_browser(self::$container.'__open');
        }

        return parent::before();
	}

	/**
	 * Runs after any controlelrs processing
     * Assigns the template [View] as the request response.
	 */
	public function after()
	{
		// echo View::factory(self::$container.'__open')->render();
        // If auto render is on set this->output as the response to the request.
        if ($this->auto_render === TRUE)
		{
            self::send_to_browser(Page::get_page_data('layout_template', 'layout/bare'));

            // If there is a container we need to wrap the page output with it.
            if(self::$container)
            {
                // Send the headers right away so any remote JS, CSS etc files can start being loaded
                // Send the headers right away so any remote JS, CSS etc files can start being loaded
                self::send_to_browser(self::$container.'__close');
            }
		}

        // Close our MongoDB connection
        if(Site::conf('mongo.enabled', FALSE))
        {
            $this->mongostore->close();
        }

        // Explicitly close DB connections
        if(Site::conf('mysql.active') OR Site::conf('xeround.active'))
        {
            Database::$instances = array();
        }

		return parent::after();
	}

    /**
     * Send the view to the browser
     * NOTE: ApAche or browser settings could defeat our attempts at making this useful
     */
    public static function send_to_browser($view)
    {
        echo View::factory($view)->render();

        // If fire_php is enabled we can't send the headers right away since we want to log into them.
        if (! Site::conf('fire_php.enabled', FALSE) AND _e('send_head_asap', FALSE))
        {
            // Flush the buffer to send this to the browser.
            // This is most useful when sending the HTML HEAD
            // Empty page loads with remote jQuery scripts went from 2.6 seconds to 1.6 seconds.
            ob_flush();
            flush();
            ob_start();
        }

    }

    /**
     * Hook in Zend libraries by loading the Zend autoloader
     * This will make it easy to laod Zend libraries.
     */
    public function include_zend()
    {
        // By default include in the Zend Auto loader
       if(Site::conf('zend.enabled', TRUE))
       {
            require_once 'Zend/Loader/Autoloader.php';
            $autoloader = Zend_Loader_Autoloader::getInstance();
            $autoloader->setFallbackAutoloader(true);
       }
    }

    /**
     * Establish or define database connections
     */
    public function active_data()
    {
        // Create an instance of the RackSpace CloudFile store
        if(Site::conf('rackspace.enabled'))
        {
            $this->cloudstore = new Cloudstore(Site::conf('rackspace.username'), Site::conf('rackspace.api_key'));
        }

        // Create a connection to Mongo
        // Stores complex objects w/o defining schema
        if(Site::conf('mongo.enabled'))
        {
            $this->mongostore = new Mongostore(Site::conf('mongo.hostname'), Site::conf('mongo.port'),  Site::conf('mongo.username'), Site::conf('mongo.pwd'));
        }

        // Create a connection to FathomDB MySQL
        // This is used for ActiveRules internal data
        if(Site::conf('mysql.enabled'))
        {
            $this->mysql = Database::instance(Site::conf('mysql.datasource'));
        }

        // Create connection to Xeround MySQL
        // This is used for all USER data
        if(Site::conf('xeround.enabled'))
        {
           $this->xeround = Database::instance(Site::conf('xeround.datasource'));
        }
    }


    /**
     * Determine if FireBug content should be adde to headers.
     * This a SECURITY RISK inh production.
     */
	public function set_firephp()
	{
        if (Site::conf('fire_php.enabled') == TRUE)
        {
            include SYSPATH.'classes'.DIRECTORY_SEPARATOR.'FirePHP.php';
            FB::setEnabled(true);
            FB::info('FirePHP Debugging Enabled from Site config');
        }
	}

    /**
     * Determine which master layout template to use.
     * The related layout definition file will define the resources required for the layout template.
     *
     * NOTE: This will eventually be quite a bit more complex thatn it is now.
     */
    public function determine_container()
    {
        if(Request::$is_ajax)
		{
			// No container needed for AJAX
            // It's going to return AJAX or JSON
            return FALSE;
		}

		return 'wrapper';
    }

} // End Controller_Activerules

