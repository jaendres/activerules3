<?php defined('SYSPATH') or die('No direct script access.');
/**
 * ActiveRules Form (arf) helper
 * 
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2010 Ultri Group LLC
 */
class Arf_Core 
{	
	/**
	 * 
	 * @param string $field_html HTML for the form field
	 * @param string $label [optional]
	 * @param string $type [optional]
	 * @return 
	 */
	public static function row($field_html, $label=FALSE, $type=NULL)
	{
		if($type==NULL)
		{
			$type = ar::core('formal_table_style', 'li');
		}
		
		switch($type)
		{
			case 'vert':
				$form = "\n\t<div class=\"form_row\">".$label.'<br />';
				$form .= "\n\t".$field_html.'</div>';
				break;	
				
			case 'li':
				$form = "\n\t".'<li>';
				$form .= "\n\t".$label;
				$form .= "\n\t".$field_html;
				$form .= "\n\t".'</li>';
				break;
			
			case 'basic':
				$form = "\n\t".$label;
				$form .= "\n\t".$field_html;
				break;	
			
			case 'div':
				$form = "\n\t".'<div class="form_row">';
				$form .= "\n\t".$label;
				$form .= "\n\t".$field_html;
				$form .= "\n\t".'</div>';
				break;
			
			case 'css_table':
				$form = "\n\t".'<div class="form_row">';
				$form .= "\n\t".$label;
				$form .= "\n\t".$field_html;
				$form .= "\n\t".'</div>';
				break;
				
		}
		
		
		return $form;
	}
	
	/**
	 * 
	 * @param string $field_html HTML for the form field
	 * @param string $label [optional]
	 * @param string $type [optional]
	 * @return 
	 */
	public static function single_row($field_html, $label=FALSE, $type=NULL)
	{
		if($type==NULL)
		{
			$type = ar::core('formal_table_style', 'li');
		}
		
		switch($type)
		{
			case 'vert':
				$form = "\n\t<div class=\"form_row\">".$field_html.' '.$label.'</div>';
				break;	
				
			case 'li':
				$form = "\n\t".'<li>';
				$form .= "\n\t".$label;
				$form .= "\n\t".$field_html;
				$form .= "\n\t".'</li>';
				break;
			
			case 'basic':
				$form = "\n\t".$label;
				$form .= "\n\t".$field_html;
				break;	
			
			case 'div':
				$form = "\n\t".'<div class="form_row">';
				$form .= "\n\t".$label;
				$form .= "\n\t".$field_html;
				$form .= "\n\t".'</div>';
				break;
			
			case 'css_table':
				$form = "\n\t".'<div class="form_row">';
				$form .= "\n\t".$label;
				$form .= "\n\t".$field_html;
				$form .= "\n\t".'</div>';
				break;
				
		}
		
		
		return $form;
	}
	
	/**
	 * 
	 * @param string $buttons
	 * @param string $type [optional]
	 * @return 
	 */
	public static function button_row($buttons, $type='div')
	{
		$form = "\n\t".'<div class="form_row_submit">';
		foreach($buttons as $button_html)
		{
			$form .= "\n\t\t".$button_html;
		}
		$form .= "\n\t".'</div>';
		
		return $form;
	}
	
	public static function attrs($form_name, $term)
	{
		$attrs = '';
		
		switch(Former_Lib::term_type($form_name, $term))
		{
			// TEXT	
			case 'text':
			case 'password':
				
				if($size = Former_Lib::term_var($form_name, $term, 'size'))
				{
					$attrs .= ' size='.$size.' ';
				}
				
				if($maxlength = Former_Lib::term_var($form_name, $term, 'maxlength'))
				{
					$attrs .= ' maxlength='.$maxlength.' ';
				}
				
				break;

			// SELECT	
			case 'select':
				
				if($size = Former_Lib::term_var($form_name, $term, 'size'))
				{
					$attrs .= ' size='.$size.' ';
				}
				
				break;
			
			// SINGLE_CHECK
			case 'single_check':
					$attrs .= ' class="checkbox" ';
				break;
			
			// DEFAULT	
			default:
				break;
				
		}

		return $attrs;
	}
	
	
} // End file