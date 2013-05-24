<?php
/**
 * ActiveRules Form Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
class Activerules_Form extends Kohana_Form
{
    /**
     * Load a form
     */
    public static function load($form_name)
    {
        // Check to see if theis site supports this form
        if(in_array($form_name, Site::conf('supported_forms', array())))
        {
            // We only support valid form classes so no further checking is needed.
            $class =  'Activerules_Nugget_Form_'.ucfirst($form_name);

            // Load the form class
            $form = new $class;
        }
        else
        {
            // Various of other pieces of code that access the should handle a FALSE form gracefully.
            $form = FALSE;
        }

        return $form;
    }

    /**
     * Display a form using simple_form
     */
    public static function set_in_page($form_name, $form_obj)
    {
        // This determines the "wrapper" which may be nothing.
        Page::instance()->set_page_data('layout_template', 'layout/standard');

        // Set the default core template.
        // This gets wrapped with HTML and page chrome for web request and sent bare for Ajax Requests;
        Page::instance()->set_page_data('core_template', 'core/simple_form');

        // Make the form name from the URL available to the page.
        // The display views should NOT look at the URL.
        // Container views may use the URL segments.
        ar::core('simple_form_name',$form_name);
        ar::core('simple_form_object', $form_obj);
    }
}
// End ActiveRules_Form class