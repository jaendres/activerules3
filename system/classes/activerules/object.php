<?php
/**
 * ActiveRules Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
class Activerules_Object 
{
    // The meta object type
    public $meta_type = NULL;

    // The specific object type
    public $type = NULL;

    // The object UUID
    public $uuid = '0000000-0000-0000-0000-000000000000';

    // The object attributes
    public $attributes = array();
    
    // The object relations
    public $relations = array();

    // Define the object storage options
    // DATA
    protected $default_attribute_storage = 'object';
    protected $duplicate_attribute_storage = array();
    // RELATIONS
    protected $default_relation_storage = 'mysql';
    protected $duplicate_relation_storage = array();

    /**
     * Set the object meta_type
     * @param string $meta_type
     */
    public function set_meta_type($meta_type)
    {
        $this->meta_type = $meta_type;
    }

    /**
     * Set the object type
     * @param string $type
     */
    public function set_type($type)
    {
        $this->type = $type;
    }

    /**
     * Set the object uuid
     * @param string $uuid
     */
    public function set_uuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * Set the object meta_type
     * @param string $meta_type
     */
    public function get_meta_type()
    {
        return $this->meta_type;
    }

    /**
     * Set the object type
     * @param string $type
     */
    public function get_type()
    {
        return $this->type;
    }

    /**
     * Set the object uuid
     * @param string $uuid
     */
    public function get_uuid()
    {
        return $this->uuid;
    }
    
    /**
     * Set a sequenced, named attribute
     * @param string $group
     * @param string $name
     * @param string $value
     * @param integer $sequence
     */
    public function set_attribute($group, $name, $value, $sequence=1)
    {
        $this->attributes[$group][$name][$sequence]['value'] = $value;
    }


    /**
     * Get a sequenced, named attribute
     * @param string $group
     * @param string $name
     * @param string $value
     * @param integer $sequence
     */
    public function get_attribute($group, $name, $sequence=1)
    {
        if(isset($this->attributes[$group][$name][$sequence]['value']))
        {
            return $this->attributes[$group][$name][$sequence]['value'];
        }

		return FALSE;
    }

	/**
     * Get a sequenced, named attribute
     * @param string $group
     * @param string $name
     * @param string $value
     * @param integer $sequence
     */
    public function get_limit($group, $name, $limit=1, $offset=0)
    {
        $data = $this->get_attribute($group, $name);

		return ar::get_limit($data, $limit, $offset);
    }

	/**
     * Get a sequenced, named attribute
     * @param string $group
     * @param string $name
     * @param string $value
     * @param integer $sequence
     */
    public function get_row($group, $name)
    {
        $data = $this->get_limit($group, $name, 1, 0);

		return ar::get_row($data);
    }

	/**
     * Get a sequenced, named attribute
     * @param string $group
     * @param string $name
     * @param string $value
     * @param integer $sequence
     */
    public function get_single($group, $name, $element=FALSE)
    {
        $data = $this->get_limit($group, $name, 1, 0);

		return ar::get_single($data, $element);
    }


    /**
     * Set a sequenced, named attribute
     * @param string $name
     * @param string $value
     * @param integer $sequence
     */
    public function set_relation($name, $value, $sequence=1)
    {
        $this->relations[$name][$sequence] = $value;
    }


    /**
     * Get a sequenced, named relation
     * @param string $name
     * @param integer $sequence
     * @return mixed
     */
    public function get_relation($name, $sequence=1)
    {
        if(isset($this->relations[$name][$sequence]))
        {
            return $this->relations[$name][$sequence];
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Magic function called when Object is treated like a string.
     */
    public function __toString()
    {
       return json_encode($this);

    }

    /**
     * Store an object
     * 
     * Storage rules:
     *  Attribute storage based on object_meta_type/object_type/attribute_group/attribute
     *  Relation storage based on object_meta_type/object_type/relation_type
     *  
     *  Need to enable relation attributes
     */
    public function store()
    {
        // Object UUID, meta_type, and type are used as keys in all storage systems
        
        // Loop through attributes
        // Storage is based on attribute and attribute_group
        // By default the full attribute values are stored in the object based storage systems.

         ///////////////////////////////////////////////////////////////////////
        // Storing Attributes in object storage systems
        //
        // The attributes will already be in the proper format.
        // ['attributes']
        //      ['name'] = array
        //          ['common_name'][1] = ['John Doe']
        //      ['biometric'] = array
        //          ['height']['inches'][1]   =   '72',
        //          ['weight']['pounds'][1]   =   '200'
        //      ['social'] = array
        //          ['sports']['played'][1]    =   array('golf','darts','pool'),
        //          ['sports']['watched'][1]    =  array('football','ufc'),
        //
        //          VS
        //
        //      ['social'] = array
        //          ['sports']['played'][1]    =   'golf',
        //          ['sports']['played'][2]   =   'darts',
        //          ['sports']['played'][3]    =   'pool',
        //          ['sports']['watched'][1]    =   'football'
        //          ['sports']['watched'][2]   =   'ufc',
        //          ['favorite']['movies'][1]    = 'Blue Velvet',
        //          ['favorite']['movies'][2]    =  'Princess Bride',
        //


        
        ///////////////////////////////////////////////////////////////////////
        // Storing Attributes in relational storage systems
        // 
        // The Object UUID maps to object.uuid
        // Attribute group maps to attribute_group.code
        // Attribute maps to attribute.code
        //
        // Attributes belong to one attribute_group.
        // Attribute groups belong to one object meta_type.
        // This means a "name" attribute for a party  is NOT the same as a "name" attribute for an item.
        //
        // An objects attribute values are assigned in sequence in the object_attribute_value table.
        // This allows any attribute to have multiple values.
        // The presentation layer needs to agree with the backend on what duplicate sequence values mean.
        // 
        // The actual UTF8 string that represents the value assignment is through reference to a row in the "data" table.
        // This allows the application level logic to decide if it wants to share data assignments between objects and attributes.
        //
        //  ['social'] = array
        //          ['sports']['played'][1]    =   array('golf','darts','pool'),
        //          ['sports']['watched'][1]    =  array('football','ufc'),
        //
        //  There needs to be a "social" attribute_group.code
        //  The sub-typed attribute names are appended with double underscores to create a flattened variable name.
        //      ['sports']['played'] and ['sports']['watched'] become 'sports__played' and 'sports__watched'.
        //      Which means you can't use double undercores in attribute names.
        //  Those attribute names are persisted in attribute.code.
        //
        //  So...
        //
        //  Loop through attributes
        //  For each meta_type create attribute_group.code record, then loop through types.
        //  For each type create attribute.code record.
        //  Create object_attribute record for object and attribute
        //  Create object_attribute_value records as needed
        //
        //
        // 
        
        
        // Loop through relations
        // Storage is based on relation type
        // By default the relations and relation attributes are stored in the relational storage systems.
        
        ///////////////////////////////////////////////////////////////////////
        // Storing Relations 
        // 
        // The Object UUID maps to object.uuid
        // Relation type code maps to relation_type.code
        // Related object UUID maps to a object.uuid
        // The "relation" table maps a related_object to a an object using a relation_type.
        //
        // 
        
        
    }
}
// End ActiveRules_Object abstract class