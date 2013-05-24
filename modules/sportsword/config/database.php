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
    'sportsword_mysql' => array
    (
        'type'       => 'mysqli',
        'connection' => array(
            'hostname'   => 'db16639-private.mysql.fathomdb.com',
            'username'   => 'root',
            'password'   => 'CXy0cBW4iq2MrdB5',
            'persistent' => FALSE,
            'database'   => 'activerules',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'profiling'    => TRUE,
        'port'         => '16639',
    ),
    'izzup_xeround' => array(
        'type'       => 'mysqli',
        'connection' => array(
            'hostname'   => '50.56.28.153',
            'username'   => 'activerules',
            'password'   => 'j3nnyr0x',
            'persistent' => FALSE,
            'database'   => 'activerules',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'profiling'    => TRUE,
        'port'         => '3006',
    ),
);
?>
