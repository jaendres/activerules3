<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2010 Ultri Group LLC
 */
class Activerules_Ar
{
    /**
     * DEPRECATED legacy rapper to "conf"
     */
    public static function get_conf($config, $var_name, $default=FALSE)
    {
        return Ar::conf($config, $var_name, $default);
    }

	public static function get_limt($data, $limit=1, $offset=0)
	{
		if(empty($data))
		{
			return FALSE;
		}

		if(is_array($data))
		{
			return array_slice($data, $offset, $limit, TRUE);
		}
	}

    public static function uri($segment=FALSE)
    {
        if($segment)
        {
            $segments = explode('/', Request::instance()->uri);

            if(isset($segments[$segment-1]))
            {
                return $segments[$segment-1];
            }

            return FALSE;
        }
    }

    public static function core($var_name, $data=NULL)
    {
        if($data)
        {
             Page::instance()->set_core_data($var_name, $data);
        }
        else
        {
            return Page::get_core_data($var_name);
        }
    }

    public static function opt($var_name, $default=FALSE, $sequence=1)
    {
        {
            return Page::get_core_data($var_name, $sequence, $default);
        }
    }

    public static function extra($var_name)
    {
       if($data)
        {
             Page::instance()->set_extra_data($var_name, $data);
        }
        else
        {
            return Page::get_extra_data($var_name);
        }
    }

    public static function page($var_name)
    {
        if($data)
        {
             Page::instance()->set_page_data($var_name, $data);
        }
        else
        {
            return Page::get_page_data($var_name);
        }
    }


	public static function get_row($data)
	{
		if(empty($data))
		{
			return FALSE;
		}

		if(is_array($data))
		{
			foreach($data as $ix => $row)
			{
				return $row;
			}
		}
	}

	public function get_single($data, $element)
	{
		if(empty($data))
		{
			return FALSE;
		}

		if(is_array($data))
		{
			foreach($data as $ix => $row)
			{
				if($element AND isset($row[$element]) AND ! empty($row[$element]) )
				{
					return $row[$element];
				}
				else
				{
					foreach($row as $value)
					{
						return $value;
					}
				}
			}

			return FALSE;
		}
	}
	
    /**
     *
     * @param <type> $config
     * @param <type> $var_name
     * @param <type> $default
     * @return <type>
     */
    public static function cv($var_name, $default=FALSE)
    {
        return Ar::conf(array('user','site'), $var_name, $default);
    }

    	/**
	 * Provide a value from Kohana configs, returns the first matching value found.
	 * Extends the Kohana config by:
	 * 1. Allowing recursive checks through multiple configs.
	 * 2. Allows checking for multiple configs
	 * 3. Allows setting a default value.
	 *
	 * NOTES:
	 * A. All variables in a config are checked before checking the next config.
	 * B. The default can be an object, string, array, etc.
	 *
	 * @param mixed string or array of Kohana config names
	 * @param mixed string or array of variable names
	 * @param mixed a default value
	 */
	public static function conf($config, $var_name, $default=FALSE)
	{
		// Check one config (string) or many (array)?
		if(is_string($config))
		{
			if(ar::get_conf_options($config, $var_name))
			{
                return ar::get_conf_options($config, $var_name);
			}
		}
		elseif(is_array($config))	// Loop through checking each variable in order.
		{
			foreach($config as $conf)
			{
				if(ar::get_conf_options($conf, $var_name))
				{
					return ar::get_conf_options($conf, $var_name);
				}
			}
		}

        // If we haven't found anything return the default value
		return $default;
	}

	/**
	 * Provide a value from an array of vars within a single Kohana config file.
	 * @param mixed string or array of Kohana config names
	 * @param mixed string or array of variable names
	 */
	public static function get_conf_options($config, $var_name)
	{
        $config = strtolower($config);

        switch($config)
        {
            // Site active config options come from the site class
            case 'site':
   
                if(is_string($var_name))
                {
                    if(Site::conf($var_name, FALSE))
                    {
                        return Site::conf($var_name);
                    }
                }
                elseif(is_array($var_name))
                {
                    foreach($var_name as $var)
                    {
                        if(Site::conf($var, FALSE))
                        {
                            return Site::conf($var);
                        }
                    }
                }
            break;

            // User active config options come from the site class
            case 'user':
                if(is_string($var_name))
                {
                    if(Activerules_User::conf($var_name, FALSE))
                    {
                        return Activerules_User::conf($var_name);
                    }
                }
                elseif(is_array($var_name))
                {
                    foreach($var_name as $var)
                    {
                        if(Activerules_User::conf($var, FALSE))
                        {
                            return Activerules_User::conf($var, FALSE);
                        }
                    }
                }
            break;

            default:
                if(is_string($var_name))
                {
                    if(ar::get_kohana_conf($config, $var_name))
                    {
                        return ar::get_kohana_conf($config, $var_name);
                    }
                }
                elseif(is_array($var_name))
                {
                    foreach($var_name as $var)
                    {
                        if(ar::get_kohana_conf($config, $var))
                        {
                            return ar::get_kohana_conf($config, $var);
                        }
                    }
                }
            break;
        }
	}

    /**
	 * Provide a value from a single Kohana config call.
	 * @param mixed string or array of Kohana config names
	 * @param mixed string or array of variable names
	 */
	public static function get_kohana_conf($config, $var_name)
	{
		if(Kohana::config($config.'.'.$var_name))
		{
			return Kohana::config($config.'.'.$var_name);
		}
	}
} // End file