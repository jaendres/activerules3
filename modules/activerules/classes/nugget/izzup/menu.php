<?php
/**
 * Izzup Menu
 */
class Activerules_Nugget_Izzup_Menu extends Activerules_Object
{
     // The meta object type
    protected $meta_type = 'nugget';

    // The specific object type
    protected $type = 'izzup_menu';

    // The object attributes
    protected $attributes = array (
        'name' => array(
            'value' => NULL,
            'validation' => array(
                'max' => 50,
            ),
            'default' => 'Menu',
        ),
        'description' => array(
            'value' => NULL,
            'validation' => array(
                'max' => 200,
            ),
            'default' => NULL,
        ),
        'entree_price_range' => array(
            'min' => NULL,
            'max' => NULL,
        ),
        'hours' => array(
            'sunday' => array (
                'breakfast' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'lunch' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'dinner' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'late_night' => array(
                    'start' => NULL,
                    'end' => NULL,
                ),
            ),
            'monday' => array (
                'breakfast' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'lunch' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'dinner' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'late_night' => array(
                    'start' => NULL,
                    'end' => NULL,
                ),
            ),
            'tuesday' => array (
                'breakfast' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'lunch' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'dinner' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'late_night' => array(
                    'start' => NULL,
                    'end' => NULL,
                ),
            ),
            'wednesday' => array (
                'breakfast' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'lunch' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'dinner' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'late_night' => array(
                    'start' => NULL,
                    'end' => NULL,
                ),
            ),
            'thursday' => array (
                'breakfast' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'lunch' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'dinner' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'late_night' => array(
                    'start' => NULL,
                    'end' => NULL,
                ),
            ),
            'friday' => array (
                'breakfast' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'lunch' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'dinner' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'late_night' => array(
                    'start' => NULL,
                    'end' => NULL,
                ),
            ),
            'saturday' => array (
                'breakfast' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'lunch' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'dinner' => array(
                    'start' => NULL,
                    'end' => NULL,
                    ),
                'late_night' => array(
                    'start' => NULL,
                    'end' => NULL,
                ),
            ),
        ),

        // The menu data will come in as an array from the Google Spreadsheet
        'menu_data' => array(),

        // The default data shaper used to process the menu_data
        'data_shaper' => 'basic_izzup_menu',
    );

    // The object relations
    protected $relations = array();

    // Define the object storage options
    // DATA
    protected $default_attribute_storage = 'google_spreadsheet';
    protected $duplicate_attribute_storage = NULL;
    // RELATIONS
    protected $default_relation_storage = 'xeround_mysql';
    
}
?>
