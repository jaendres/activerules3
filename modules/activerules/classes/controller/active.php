<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract controller class for automatic templating.
 *
 * @package    ActiverRules
 * @category   Controller
 * @author     Brian Winkers
 * @copyright  (c) 2010-2011
 * @license    http://kohanaphp.com/license
 */
class Controller_Active extends Controller_Activerules
{
    public function action_fblogin()
    {
        Page::instance()->set_page_data('core_template', 'core/login');
    }

    public function action_fbregisterlogin()
    {
        Page::instance()->set_page_data('core_template', 'core/registered_login');
    }

    public function action_fbregister()
    {
        Page::instance()->set_page_data('core_template', 'core/register_via_facebook');
    }

    public function action_regrequired()
    {
        Page::instance()->set_page_data('core_template', 'core/registration_required');
    }

    // Process an active form
	public function action_form($form_name=FALSE)
	{
		// The "before" method has already been called at this point

        $display_form = TRUE;

        $form = Form::load($form_name);

        if($form)
        {
            // If the form was posted we need to process it
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                logit('Request via POST not GET :file::line', 'logic_path', array(':file'=>__FILE__,':line'=>__LINE__));

                // Assume the submission fails, it needs to be explicitly allowed.
                $sucess = FALSE;

                // Perform preprocessing of terms and assign those values to the form object
                $form->pre_process($_POST);

                // Validate the form
                if($form->validate())
                {
                    // Perform any business rules
                    if($form->active_rules())
                    {
                        // Perform any post processing
                        $form->post_process();

                        // Perform any business processes
                        $form->business_processes();

                        $display_form = FALSE;
                    }
                    else
                    {
                        logit('Form "'.$form_name.'" failed business rules. :file::line', 'logic_path', array(':file'=>__FILE__,':line'=>__LINE__));
                    }
                }
                else
                {
                    logit('Form "'.$form_name.'" failed validation. :file::line', 'logic_path', array(':file'=>__FILE__,':line'=>__LINE__));
                }
            }
            else
            {
                logit('Request via GET not POST, display form without processing. :file::line', 'logic_path', array(':file'=>__FILE__,':line'=>__LINE__));
            }

            Form::set_in_page($form_name, $form);

        }
        else
        {
            // This determines the "wrapper" which may be nothing.
            Page::instance()->set_page_data('layout_template', 'layout/standard');

            // Set the default core template.
            // This gets wrapped with HTML and page chrome for web request and sent bare for Ajax Requests;
            Page::instance()->set_page_data('core_template', 'core/error_page');

            // Make the form name from the URL available to the page.
            // The display views should NOT look at the URL.
            // Container views may use the URL segments.
            Page::instance()->set_core_data('errors', array('form.form_unavailable'));

        }

        // Now the "after" method gets called by Kohana
    }


    /**
     * Display a Google map with locations
     * @param <type> $map_name
     */
    public function action_map($map_name=FALSE)
	{
		Page::add_body_attribute('onload', 'initialize()');

        if($map_name AND $_SERVER['REQUEST_METHOD'] === 'POST')
		{

			// Process the POST


			// If Succeeded in processing, follow action
			// This is usually a redirect away from the final submission page for a web UI.
			// For an Ajax app its the raw respsonse, in HTML, JSON, or XML

			// If processing FAILS
			// Display form with errors, this is taken care of automatically below.


		}

		// If the processing the form didn't get us out of here we display the form
		// Submitted data will be displayed where possible
		if($map_name)
		{

            // Define the data
            $spreadsheet_object = new Activerules_Googlestore(Site::conf('google.username'),  Site::conf('google.pwd'));
            // Send the data through a shaper

            $data = $spreadsheet_object->read('google_spreadsheet', Site::conf('google.maps_data_key'));

            // Set the default core template.
			// This gets wrapped with HTML and page chrome for web request and sent bare for Ajax Requests;
			Page::core_template('simple_map');

			Page::set_core_data('simple_map_data', $data);

			//dbg::it($this->request);
		}


	}

     /**
	  * If we needed to override the default container we would do it here.
	  * This controls what JS and CSS includes are included as well as sets page titles etc.
	  * @return  void
	  */
	public function before($container=FALSE)
	{
        // Set page title
        switch(ar::uri(2))
        {
            case 'form':
                Page::instance()->set_page_data('title', ar::uri(3));
                break;

            default:
                break;

        }

        Page::instance()->set_page_data('layout_css', 'activerules.css');

        return parent::before($container);
	}

} // End Welcome

