<?php defined('SYSPATH') or die('No direct script access.');

if ( ! defined('KOHANA_START_TIME'))
{
	/**
	 * Define the start time of the application, used for profiling.
	 */
	define('KOHANA_START_TIME', microtime(TRUE));
}

if ( ! defined('KOHANA_START_MEMORY'))
{
	/**
	 * Define the memory usage at the start of the application, used for profiling.
	 */
	define('KOHANA_START_MEMORY', memory_get_usage());
}

/**
 * Get Localization Value
 * @param string $string The string dor notated string identifier
 * @param array $values stristr replacement values
 * @return string
 */
function __($string, array $values = NULL)
{
    return L10n::get($string, $values);
}

/**
 * Echo Localization Value
 * @param string $string The string dor notated string identifier
 * @param array $values stristr replacement values
 * @return string
 */
function ___($string, array $values = NULL)
{
    echo __($string, $values);
}


/**
 * Get Page Data
 * @param mixed $varname
 * @param mixed $default
 * @return mixed
 */
function _p($varname, $default=NULL)
{
    return Page::get_page_data($varname, $default);
}

/**
 * Echo Page Data
 * @param mixed $varname
 * @param mixed $default
 * @return mixed
 */
function __p($varname, $default=NULL)
{
    echo _p($varname, $default);
}

/**
 * Get Core Page Data
 * @param mixed $varname
 * @param mixed $default
 * @return mixed
 */
function _c($varname, $default=NULL)
{
    return Page::get_core_data($varname, $default);
}

/**
 * Echo Core Page Data
 * @param mixed $varname
 * @param mixed $default
 * @return mixed
 */
function __c($varname, $default=NULL)
{
    echo _c($varname, $default);
}

/**
 * Get Extra Page Data
 * @param mixed $varname
 * @param mixed $default
 * @return mixed
 */
function _e($varname)
{
    return Page::get_extra_data($varname);
}

/**
 * Echo Extra Page Data
 * @param mixed $varname
 * @param mixed $default
 * @return mixed
 */
function __e($varname)
{
    echo _e($varname);
}

/**
 * Get Site Config
 * @param mixed $varname
 * @param mixed $default
 * @return mixed
 */
function _s($varname, $default=FALSE)
{
    return Site::conf($varname, $default);
}

/**
 * Echo Site Config
 * @param mixed $varname
 * @param mixed $default
 * @return mixed
 */
function __s($varname, $default=FALSE)
{
    echo _s($varname, $default);
}

/**
 * Add to log
 */
function logit($value, $type=NULL, $replace_values)
{
	if(! $type)
    {
        $type = Site::conf('log.default_level');
    }

    Kohana_Log::instance()->add($type, $value, $replace_values);
}

/**
 * Get rid of any non ASCII letter
 * @param <type> $data_string
 * @return <type>
 */
function safe($data_string, $context=NULL)
{
    // Limit characters
    $data_string = preg_replace('/[^a-z0-9.]/','_',strtolower($data_string));

    // Get rid of duplicate underscore and any leading trailing ones.
    while (strpos($data_string, '__') !== false)
    {
        $data_string = str_replace('__', '_', $data_string);
    }

    return $data_string;
}

/**
 * Make safe for variable name, "very"="vari" get it?
 *
 * @param <type> $data_string
 * @return <type>
 */
function very_safe($data_string, $context=NULL)
{
    $string = safe($data_string);

    // If the first character is a letter we're good to go
    if(ctype_alpha($string[0]))
    {
        return $string;
    }
    else
    {
        // Prepend a string starting with a letter
        // We use 'ar__' since there is a chance we'd want to be able to strip it off.
        return 'ar__'.$string;
    }
}
