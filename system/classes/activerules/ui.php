<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri - Brian Winkers
 */
class Activerules_Ui
{	
	public static function first_text(& $data, $uuid, $text_type)
	{
		//echo $text_type;
		return self::numbered_text($data, $uuid);
	}
	
	public static function numbered_text(& $data, $uuid, $text_type='name', $sequence=1)
	{
		$count = 1;
		
		//make sure that the data is there before we try to access it
		if( array_key_exists( $uuid, $data->category_text) && array_key_exists( $text_type, $data->category_text[$uuid] ) ){
		
			//echo $text_type;
			foreach($data->category_text[$uuid][$text_type] as $text)
			{
				if($count === $sequence )
				{
					return  $text;
				}
			}
		}
	}

    public static function nada($data)
    {
        echo $data;
    }
	
	public static function cv($var_name, $default=NULL)
	{
		echo ar::cv($var_name, $default);
	}

    public static function core($var_name, $sequence=1, $default=FALSE)
    {
        Page::get_core_data($var_name, $sequence);
    }
	
	/**
	 * Wrap Kohana lang so we can returna  default instaed of the element name if value is not defined
	 * 
	 * @param string $element A full context element name
	 * @param array $data [optional] Sprintf data
	 * @param string $default [optional] Default string to return if not defined
	 * @return 
	 */
	public static function lang($element, $data=FALSE, $default=NULL)
	{		
		echo ar::lang($element, $data, $default);
	}
	
	public static function auth_user()
	{
		echo Session::instance()->get('username');
	}
} 