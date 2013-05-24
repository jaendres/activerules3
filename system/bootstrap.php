<?php defined('SYSPATH') or die('No direct script access.');

//-- Environment setup --------------------------------------------------------

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

//-- Configuration and initialization -----------------------------------------

/**
 * Set Kohana::$environment if $_ENV['KOHANA_ENV'] has been supplied.
 *
 */
if (isset($_ENV['KOHANA_ENV']))
{
	Kohana::$environment = $_ENV['KOHANA_ENV'];
}

//================================================//
//=========== START ACTIVERULES CHECK ============//
/**
 * ActiveRules Hostname configurable checks.
 * This allows for overrding the application, modules or system variables set above.
 * It can also set it's own unique error reporting.
 *
 */
$site = new Activerules_Site($_SERVER['HTTP_HOST']);

// Define the default initilization variable array.
// Options defined below are base_url, index_file, charset, cache_dir, errors, profile and caching
$init_array = array(
	'base_url'   => '/',
	);

// Define the default array of modules to load
$modules_array = array(
	// 'auth'       => MODPATH.'auth',       // Basic authentication
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	// 'database'   => MODPATH.'database',   // Database access
	// 'image'      => MODPATH.'image',      // Image manipulation
	// 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'oauth'      => MODPATH.'oauth',      // OAuth authentication
	// 'pagination' => MODPATH.'pagination', // Paging of results
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	);

// Define the router default config array
$router_defaults_array = array(
	'controller' => 'welcome',
	'action'     => 'index',
	);

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set(Site::conf('default_timezone', 'America/Chicago'));

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, Site::conf('locale', 'en_US.utf-8'));

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(Site::conf('init_array', $init_array));  // ActiveRules array created above is used to initialze Kohana

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(LOGPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(Site::conf('modules_array', $modules_array));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(Site::conf('router_defaults_array', $router_defaults_array));

/**
 * More Activerules goodness.
 * Get a list of routes from the Site library if available.
 */
$active_routes = Site::conf('active_routes', FALSE);

// Loop through configured routes and set each
if($active_routes)
{
	foreach($active_routes as $route=>$data)
	{
		Route::set($route, $data['uri'])
			->defaults($data['uri_defaults']);
	}
}

//============ END ACTIVERULES CHECK =============//
//================================================//

// Execute the request
Request::instance()->execute()->send_headers();
