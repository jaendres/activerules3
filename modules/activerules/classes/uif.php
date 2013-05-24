<?php defined('SYSPATH') or die('No direct script access.');
/**
 * UI Form Helper
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri Group LLC - Brian Winkers
 */
class uif_Core 
{	
	public static function row($row_html, $label, $type=NULL)
	{
		if($type==NULL)
		{
			$type = ar::core('formal_table_style', 'li');
		}
		return "\n".arf::row($row_html, $label, $type);
	}
	
	public static function single_row($row_html, $label, $type=NULL)
	{
		if($type==NULL)
		{
			$type = ar::core('formal_table_style', 'li');
		}
		return "\n".arf::single_row($row_html, $label, $type);
	}
	
	public static function fieldset_open()
	{
		return "\n\t<fieldset>\n";
	}
	
	public static function fieldset_close()
	{
		return "\n\n\t</fieldset>\n";
	}
	
	public static function legend($legend_text)
	{
		return "\n\t<legend>$legend_text</legend>\n";
	}
	
	public static function open($action_url='')
	{
		$form = "\n".'<div class="formalizer">'."\n";
		
		if(ar::cv('ssl_support', FALSE) AND ar::extra('force_ssl', TRUE) AND ar::extra('formal_ssl', TRUE))
		{
			$action_url = 'https://'.ar::get_conf('config', 'site_domain').$action_url;
		}
		
		$form .= "\n".form::open($action_url);
		
		return $form;
	}
	
	public static function close()
	{
		// Close form
		$form = "\n".form::close();
		
		// Close formalizer div
		$form .= "\n".'</div> <!-- close formalizer DIV -->';
		
		return $form;
	}
	
	public function button_row($buttons, $type='div')
	{
		return "\n".arf::button_row($buttons, $type);
	}
	
	public static function hidden($name, $value)
	{
		return "\n\n\t".form::hidden($name, $value); 
	}
	
	public static function form_table_open($style=FALSE)
	{
		$form = "\n\t";
		
		if(! $style)
		{
			$style = ar::core('formal_table_style');
		}
		
		switch($style)
		{
			case 'vert':
				$form .= ''; 
				break;
			
			case 'table':
				$form .= '<table>';
				break;
				
			case 'css_table':
				
				break;
				
			case 'li':
				$form .= '<ol>';
				break;
			
			case 'div':
				default:
				break;
		}
		
		
		return $form; 
	}
	
	public static function form_table_close($style=FALSE)
	{
		$form = "\n\t";
		
		if(! $style)
		{
			$style = ar::core('formal_table_style');
		}
		
		switch(ar::core('formal_table_style'))
		{
			case 'vert':
				$form .= '';
				break;
				
			case 'table':
				$form .= '</table>';
				break;
				
			case 'css_table':
				
				break;
				
			case 'li':
				$form .= '</ol>';
				break;
			
			case 'div':
				default:
				break;
		}
		
		
		return $form; 
	}

	public static function form_text_row($form_name, $term)
	{	
		// Define the label text and the field HTML
		$label = form::label($term, Kohana::lang(Former_Lib::term_label($form_name, $term)));
		$field_html = form::input($term, Former_Lib::valid_term($form_name, $term), arf::attrs($form_name, $term));  
		// Use ActiveRules Form (arf) helper to display the label and field as a form row.
		return self::row($field_html, $label);
	}
	
	public static function form_textarea_row($form_name, $term)
	{	
		// Define the label text and the field HTML
		$label = form::label($term, Kohana::lang(Former_Lib::term_label($form_name, $term)));
		$helper_array = array('id'=>$term, 
								'name'=>$term, 
								'value'=>Former_Lib::valid_term($form_name, $term),
								'class'=>'styled',
							);
		$field_html = form::textarea($helper_array);  
		// Use ActiveRules Form (arf) helper to display the label and field as a form row.
		return self::row($field_html, $label);
	}
	
	public static function form_single_check_row($form_name, $term)
	{		
		// Define the label text and the field HTML
		$label = form::label($term, Kohana::lang(Former_Lib::term_label($form_name, $term)));
		$field_html = form::checkbox($term, 'true', Former_Lib::checked($form_name, $term), arf::attrs($form_name, $term));  
		// Use ActiveRules Form (arf) helper to display the label and field as a form row.
		return self::single_row($field_html, $label);
	}
	
	public static function form_password_row($form_name, $term)
	{		
		// Define the label text and the field HTML
		$label = form::label($term, Kohana::lang(Former_Lib::term_label($form_name, $term)));
		$field_html = form::password($term, '', arf::attrs($form_name, $term));  
		// Use ActiveRules Form (arf) helper to display the label and field as a form row.
		return self::row($field_html, $label);
	}
	
	/**
	 * Creates an HTML form select tag, or "dropdown menu".
	 *
	 * @param   string|array  input name or an array of HTML attributes
	 * @param   array         select options, when using a name
	 * @param   string|array  option key(s) that should be selected by default
	 * @param   string        a string to be attached to the end of the attributes
	 * @return  string
	 */
	public static function dropdown($data, $options = NULL, $selected = NULL, $extra = '', $default_option)
	{
		if ( ! is_array($data))
		{
			$data = array('name' => $data);
		}
		else
		{
			if (isset($data['options']))
			{
				// Use data options
				$options = $data['options'];
			}

			if (isset($data['selected']))
			{
				// Use data selected
				$selected = $data['selected'];
			}
		}

		if (is_array($selected))
		{
			// Multi-select box
			$data['multiple'] = 'multiple';
		}
		else
		{
			// Single selection (but converted to an array)
			$selected = array($selected);
		}

		$input = '<select'.form::attributes($data, 'select').' '.$extra.'>'."\n";
		
		$sel = !$selected ? ' selected="selected"' : '';
		
		$input .= '<option value="" '.$sel.'>'.Kohana::lang($default_option).'</option>'."\n";
		
		foreach ((array) $options as $key => $val)
		{
			// Key should always be a string
			$key = (string) $key;

			if (is_array($val))
			{
				$input .= '<optgroup label="'.$key.'">'."\n";
				foreach ($val as $inner_key => $inner_val)
				{
					// Inner key should always be a string
					$inner_key = (string) $inner_key;

					$sel = in_array($inner_key, $selected) ? ' selected="selected"' : '';
					$input .= '<option value="'.$inner_key.'"'.$sel.'>'.$inner_val.'</option>'."\n";
				}
				$input .= '</optgroup>'."\n";
			}
			else
			{
				$sel = in_array($key, $selected) ? ' selected="selected"' : '';
				$input .= '<option value="'.$key.'"'.$sel.'>'.$val.'</option>'."\n";
			}
		}
		$input .= '</select>';

		return $input;
	}
	
	
} 