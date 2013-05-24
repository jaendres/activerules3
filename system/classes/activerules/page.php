<?php
/**
 * Page library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Page 
{
	// Session singleton
	protected static $instance;

	// Set object Meta type and Type
	protected static $meta_type = 'nugget';
	protected static $type = 'webpage';

	public static $object;

    public static $body_attributes = array();

    /**
	 * Instance of Page.
	 */
	public static function & instance($pagename=FALSE)
	{
		if (Activerules_Page::$instance == NULL)
		{
			// Create a new instance
			Activerules_Page::$instance = new Activerules_Page($pagename);
		}

		return Activerules_Page::$instance;
	}

	/**
	 * On first Page instance creation, it creates Page.
	 */
	public function __construct($pagename=FALSE)
	{
		// This part only needs to be run once
		if (Activerules_Page::$instance === NULL)
		{
			self::$object = new Activerules_Object;

			// Singleton instance
			Activerules_Page::$instance = $this;
		}
	}

    public static function set_page_data($name, $value=NULL, $sequence=1)
	{
		if($name)
		{
            // $group, $name, $value, $sequence=1
            self::$object->set_attribute('page', $name, $value, $sequence);
		}
	}

    public static function get_page_data($name, $default=NULL, $sequence=1)
	{
        if(isset(self::$object->attributes['page'][$name][$sequence]['value']))
        {
            return self::$object->attributes['page'][$name][$sequence]['value'];
        }

		return $default;
	}

    public static function set_core_data($name, $value=NULL)
	{
		if($name)
		{
            self::$object->set_attribute('core', $name, $value);
		}
	}

    public static function get_core_data($name, $default=NULL, $sequence=1)
	{
        if(isset(self::$object->attributes['core'][$name][$sequence]['value']))
        {
            return self::$object->attributes['core'][$name][$sequence]['value'];
        }

		return $default;
	}

    public static function set_extra_data($name, $value=NULL)
	{
		if($name)
		{
            self::$object->set_attribute('extra', $name, $value);
		}
	}

    public static function get_extra_data($name, $sequence=1, $default=NULL)
	{
        if(isset(self::$object->attributes['extra'][$name][$sequence]['value']))
        {
            return self::$object->attributes['extra'][$name][$sequence]['value'];
        }

		return $default;
	}

    public static function get_body_attributes()
    {
        $attributes = '';

        foreach(self::$body_attributes as $name => $value)
        {
            if($value === TRUE)
            {
                $attributes .= " $name "	;
            } else {
                $attributes .= " $name=\"$value\" "	;
            }
        } 

        return $attributes;
    }

    public static function add_body_attribute($name, $value=FALSE)
    {
        if($value)
        {
            self::$body_attributes[$name] = $value;
        }
        else
        {
           self::$body_attributes[$name] = TRUE;
        }
    }

    public static function get_attributes()
    {
        return self::$object->attributes;
    }

    public static function core_template($template=FALSE)
    {
        return Page::get_page_data('core_template', 'core/empty_page');
    }

    public static function css_override()
    {
        return Page::get_page_data('css_override', FALSE);
    }

	
} // End Page Class
