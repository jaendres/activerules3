<?php
/*
 * Database configs
 */
return array
(
    'default' => array
    (
        'type'       => 'mysqli',
        'connection' => array(
            'hostname'   => 'localhost',
            'username'   => '',
            'password'   => '',
            'persistent' => FALSE,
            'database'   => '',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'profiling'    => FALSE,
    ),
    'mysql' => array
    (
        'type'       => 'mysqli',
        'connection' => array(
            'hostname'   => 'db16639-private.mysql.fathomdb.com',
            'username'   => 'root',
            'password'   => 'CXy0cBW4iq2MrdB5',
            'persistent' => FALSE,
            'database'   => 'activerules',
            'port'         => '16639',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'profiling'    => TRUE,

    ),
    'xeround' => array(
        'type'       => 'mysqli',
        'connection' => array(
            'hostname'   => '50.57.87.237',
            'username'   => 'activerules',
            'password'   => 'j3nnyr0x',
            'persistent' => FALSE,
            'database'   => 'activerules',
            'port'         => '3002',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'profiling'    => TRUE,

    ),
);
?>
