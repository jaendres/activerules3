<?php
$site = array(
    // Site name
    'name' => 'Config Writer',

    // Define the Kohana init array
    'init_array' => array(
            'base_url'   => '/',
            'cache_dir'	=> CACHEPATH.'cache',
            'errors'	=> TRUE,
        ),

    // Define modules for this site
    'modules_array' => array(
            'blogs'             => MODPATH.'blogs',         // holds code for blog specific items
            'sportsword'        => MODPATH.'sportsword',    // holds code for the sportsword site
            'activerules'       => MODPATH.'activerules',   // Generic ActiveRules functionality
            'configuration'    	=> MODPATH.'configuration', // Configuration Files written by config_writer
            'database' 	        => MODPATH.'database',      // Kohana database module
            'mysqli' 	        => MODPATH.'mysqli',        // MySQLi driver, allows use of stored procedures
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
);

?>