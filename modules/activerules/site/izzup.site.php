<?php
$site = array(
    // Site name
    'name' => 'Izzup!',

	'uuid' => 'IzzupRocks',

    'base' => 'http://izzup.com',

    'copyright' => array(
        'holder' => 'Ultri Group LLC',
        'first_year' => '2007',
    ),

    // Define the Kohana settings init array
    'init_array' => array(
            'base_url'   => '/',
            'cache_dir'	=> CACHEPATH.'izzup',
            'errors'	=> TRUE,
        ),

    // Define modules for this site
    'modules_array' => array(
            'izzup'				=> MODPATH.'izzup',			// iZZUP! specfic files.
            'activerules'       => MODPATH.'activerules',   // Generic ActiveRules functionality
            'mysqli' 	        => MODPATH.'mysqli',        // MySQLi driver, allows use of stored procedures
            'database' 	        => MODPATH.'database',      // Kohana database module

            'cache'      		=> MODPATH.'cache',         // Kohana caching with multiple backends
        ),


    // Define the router default config array
    'router_defaults_array' => array(
            'controller' => 'homepage',
            'action'     => 'index',
        ),

    // Set active routes
    'active_routes' => array(
        'active'=>  array(
            'uri'=>'(<controller>(/<action>(/<id1>(/<id2>(/<id3>(/<id4>(/<id5>)))))))',
                'uri_defaults'=>array(
                    'controller' => 'homepage',
                    'action'     => 'index',
                ),
            ),
        ),

	'rackspace' => array (
        'enabled' => TRUE,
		'username' => 'bwinkers',
		'api_key' => 'fce1a1eb6940279a0f5f1134dc2387d9',
		),

	'mongo' => array(
        'enabled' => TRUE,
		'hostname' => '10.179.98.224',
		'port' => '27047',
		'username' => 'activerules',
		'pwd' => '4ct1vM0nGopWD',
		),

	'google' => array(
        'enabled' => TRUE,
		'username' => 'bwinkers@gmail.com',
		'pwd' => '4myr0x1t',
		'menu_key' => '0Atuw1ogKS5BjdFQzb0xxMXBOb3lTNXlGamx2OGQyQWc',
        'maps_data_key' => '0Atuw1ogKS5BjdHFFU2Y4aGtnMVZzWlBxRDJSUHhzaGc',
		'api_key' => 'ABQIAAAANOg7G4M95luJyMYaMFN7-hTcNp5lLDiqAKoWMcfTOMiJ4JKhhBQnmZp9VwMaUD5u1aZ9tP4rEHnk1Q'
		),

	// Enable FirePHP debugging
	'fire_php' => array(
        'enabled' => FALSE,
        ),

    // Enable Zend libraries, enabled by default
	'zend' => array(
        'enabled' => TRUE,
        ),

     // Enable MySQL usually at FathomDB
	'mysql' => array(
        'enabled' => TRUE,
        'datasource' => 'mysql',
        ),

    // Enable Xeround MySQL
	'xeround' => array(
        'enabled' => TRUE,
        'datasource' => 'xeround',
        ),

    // Contexts supported by this site
	'contexts' => array(
        'en_US' => 'English',
        'es_US' => 'Español',
        ),

    // Tyhe log levels to write
    'log'   => array(
        'write_levels' => array('info', 'logic_path', 'debug'),
        'fire_php' => TRUE,
        'kohana' => FALSE,
        'default_level' => 'info',
     ),

    'supported_forms' => array(
        'signup','post',
    ),

    'views' => array (
        'default_layout' => 'layout/standard',
        'header' => 'sections/header',
        'footer' => 'sections/footer',
        'sidebar' => 'sections/sidebar',
        'menu' => 'sections/menu',
    ),

    'web_include' => array (
        'activerules_js' => 'min/activerules.js',
        'activerules_css' => 'activerules.css',
        'color_css' => 'easy_blue.css',
    ),

	'default_layout_template' => 'generic',

    'in_production' => FALSE,

    'facebook' => array (
        'like' => array (
            'active' => TRUE,
            'show_faces' => 'false', // Note this is a STRING not a BOOLEAN
            'colorscheme' => 'light',
            'border_color' => '',
            'stream' => 'false',
            'header=' => 'false',
            'send' => 'false',
            'layout' => 'standard',
            'width' => '450',

        ),
        'registration' => array(
            'active' => TRUE,
            'fb_only' => TRUE,
            'fields' => 'name,birthday,gender,email,location',
            'uri' => "/register",
        ),
        'login' => array(
            'perms' => array('manage_pages'),
            ),
        'site_url' => 'http://izzup.com/',
        'app_id' => '203878593752',
        'api_key' => '4ecc949217d3626c01d6b13e433bba15',
        'app_secret' => '506e6d65e6dcea1fdc7da3c94128b5bd',
        'domain' => 'izzup.com',
    )

);

?>
