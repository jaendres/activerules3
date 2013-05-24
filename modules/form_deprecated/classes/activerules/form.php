<?php
/**
 * Form library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri Group LLC - Brian Winkers
 */
class Activerules_Form
{
    var protected $forms = array();

    /**
     *
     * @param mixed string of $form_nam or array of from names
     * @return void
     */
    public function load($form_name)
    {

        if(is_array($form_name))
        {
            foreach($form_name as $form)
            {
                Form::load($form);
            }
        }
        else
        {
            if(! array_ key_exists($form_name, Form::$forms)
            {
                $form_file = Kohana::find_file('forms', $form_name);

                // This file defines a form in a Form-L JSON object
                include_once($form_file);

                Form::$forms[$form_name] = $definition;
            }
        }

        return TRUE;

    }


}

?>
