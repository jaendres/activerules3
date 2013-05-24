<?php
/**
 * ActiveRules Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
class Activerules_Test extends Activerules_Object
{
    // The meta object type
    protected $meta_type = 'party';

    // The specific object type
    protected $type = 'person';

    // The object UUID
    protected $uuid = '0000000-0000-0000-0000-100000000000';

    // The object attributes
    protected $attributes = array();
    
    // The object relations
    protected $relations = array(
        
        'presentation'
    );

    // Define the object storage options
    // DATA
    protected $default_attribute_storage = 'object';
    protected $duplicate_attribute_storage = array();
    // RELATIONS
    protected $default_relation_storage = 'mysql';
    protected $duplicate_relation_storage = array();
}
// End ActiveRules_Object abstract class