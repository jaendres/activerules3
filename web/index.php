<?php

/**
 * The directory in which your application specific resources are located.
 * The application directory must contain the bootstrap.php file.
 *
 * @see  http://kohanaframework.org/guide/about.install#application
 */

/**
 * The directory in which your modules are located.
 *
 * @see  http://kohanaframework.org/guide/about.install#modules
 */
$modules = '../modules';

/**
 * The directory in which the Kohana resources are located. The system
 * directory must contain the classes/kohana.php file.
 *
 * @see  http://kohanaframework.org/guide/about.install#system
 */
$system = '../system';

/**
 * The default extension of resource files. If you change this, all resources
 * must be renamed to use the new extension.
 *
 * @see  http://kohanaframework.org/guide/about.install#ext
 */
define('EXT', '.php');

/**
 * Set the PHP error reporting level. If you set this in php.ini, you remove this.
 * @see  http://php.net/error_reporting
 *
 * When developing your application, it is highly recommended to enable notices
 * and strict warnings. Enable them by using: E_ALL | E_STRICT
 *
 * In a production environment, it is safe to ignore notices and strict warnings.
 * Disable them by using: E_ALL ^ E_NOTICE
 *
 * When using a legacy application with PHP >= 5.3, it is recommended to disable
 * deprecated notices. Disable with: E_ALL & ~E_DEPRECATED
 */
error_reporting(E_ALL ^ E_NOTICE);

//================================================//
//=========== START ACTIVERULES CHECK ============//
/**
 * ActiveRules Hostname configurable checks.
 * This allows for overrding the application, modules or system variables set above.
 * It can also set it's own unique error reporting.
 */
// Define the LOG directory
define('LOGPATH', '/var/www/apache/');
// Define the CACHE directory
define('CACHEPATH', '/var/www/apache/cache/');

// This is our nod to the fact that most PHP code is written by web developers.
// We key off the hostname quite often and this breaks Command Line (cli) apps.
// To ease development we set the $_SERVER['HTTP_HOST'] to "localhost".
if (PHP_SAPI === 'cli')
{
	$_SERVER['HTTP_HOST']='localhost';
}

/**
 * At this stage we only do Active checks for hardcoded host.
 * Sites that need different libraries ought usually be run on different servers.
 */
$override_hostname = array();

if(in_array($_SERVER['HTTP_HOST'], $override_hostname))
{
    // Set the ActiveRules config file name
    $active_config = $modules.DIRECTORY_SEPARATOR.'activerules'.DIRECTORY_SEPARATOR.'system_config'.DIRECTORY_SEPARATOR.$_SERVER['HTTP_HOST'].'.active_config.php';

    // If the override file exists include it.
    if(file_exists($active_config))
    {
        // Include the file to override variables set above.
        include_once($active_config);
    }
}
//============ END ACTIVERULES CHECK =============//
//================================================//

/**
 * End of standard configuration! Changing any of the code below should only be
 * attempted by those with a working knowledge of Kohana internals.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 */

// Set the full path to the docroot
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Make the application relative to the docroot
//if ( ! is_dir($application) AND is_dir(DOCROOT.$application))
//	$application = DOCROOT.$application;

// Make the modules relative to the docroot
if ( ! is_dir($modules) AND is_dir(DOCROOT.$modules))
	$modules = DOCROOT.$modules;

// Make the system relative to the docroot
if ( ! is_dir($system) AND is_dir(DOCROOT.$system))
	$system = DOCROOT.$system;

// Define the absolute paths for configured directories
// define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);

// Clean up the configuration vars
// Activerules removed application
unset($modules, $system, $skins);

// Load the base, low-level functions
require SYSPATH.'base'.EXT;

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

/*
if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}
*/

// ActiveRules only loads the empty core extension, it has no APPPATH
require SYSPATH.'classes/kohana'.EXT;

// Bootstrap the application
require SYSPATH.'bootstrap'.EXT;


