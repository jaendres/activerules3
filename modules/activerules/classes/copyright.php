<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri - Brian Winkers
 */
class Copyright_Core {	

		
	/**     
	* This function is used for getting the date span for the site. The original year
	* is set in a config and it uses the date function to get the current year.
	* 	 
	* @return string copyright year span
	* @param bool $echo defaults to true if true echos the result if false returns it 	 
	*/	
	public static function copyright_span($echo=TRUE)	
	{		
		// Get current year        
		$year = date('Y');
		        
		// If the initial copyright is prior to this year create a span        
		if(Kohana::config('site.first_copyright') AND Kohana::config('site.first_copyright') < $year)        
		{            
			//creates variable that holds the copyright years
			$copyright_span = Kohana::config('site.first_copyright').'-'.$year;        
		} else {
			
			//returns just the current year because same as when site went live  
			$copyright_span = $year;        
		}        
		
		// If $echo set TRUE echo string, else return the string for further processing.
		if($echo)
		{
			echo $copyright_span;
		} else {
			return $copyright_span;
		}		
	} 
	
	
	/**
	* This function returns the copyright text in html form with the html copyright symbol;
	*     
	* @return string $copyright HTML formatted copyright
	* @param bool $echo defaults to true if true echos the result if false returns it 	 
	*/	
	public static function html($echo=TRUE)	
	{		
		//creates a string that holds the copyright string with html representation of the copyright symbol
		$copyright = ar::lang('legal.copyright', array(Kohana::config('site.copyright_holder', FALSE), copyright::copyright_span(FALSE)));

		// If $echo set TRUE echo string, else return the string for further processing.
		if($echo)
		{
			echo $copyright;
		} else {
			return $copyright;
		}
	}   
	
	/**
	* This function creates the copyright information that is a non html safe version.
	* Instead of useing html to create the copyright symbol it uses a string representaition
	* of the symbol.
	*      
	* @return string Text formatted copyright
	* @param bool $echo defaults to true if true echos the result if false returns it 
	* 	
	*/	
	public static function text($echo=TRUE)	
	{		
		
		//variable that holds the copyright information with no html dependent values
		$copyright = 'Copyright (c)'.copyright::copyright_span(FALSE).' '.Kohana::config('site.copyright_holder', FALSE);
		
		// If $echo set TRUE echo string, else return the string for further processing.
		if($echo)
		{
			echo $copyright;
		} else {
			return $copyright;
		}		
	}   
	
	/**
	 * This function creates the copyright information with a link to a page
	 * that is passed into the funtion.
	 * 
	 * @return string copyright
	 * @param string $url url to the copyright page
	 * @param bool $echo defaults to true if true echos the result if false returns it 
	 */    
	public static function link($echo=TRUE, $url='/copyright')
	{		
		
		//string that holds the html of the link with the copyright information
		$copyright = '<a href="'.$url.'">'.copyright::html(FALSE).'</a>';
		
		// If $echo set TRUE echo string, else return the string for further processing.
		if($echo)
		{
			echo $copyright;
		} else {
			return $copyright;
		}
		
	} 
	
} 
// End file