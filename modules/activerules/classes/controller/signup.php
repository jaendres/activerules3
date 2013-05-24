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
class Controller_Signup extends Controller_Activerules_Wideright
{

    // Process an active form
	public function action_index()
	{
		// The "before" method has already been called at this point

        // Set the default core template.
        // This gets wrapped with HTML and page chrome for web request and sent bare for Ajax Requests;
        Page::instance()->set_page_data('core_template', 'core/signup');

        // Now the "after" method gets called by Kohana
    }

     /**
	  * If we needed to override the default container we would do it here.
	  * This controls what JS and CSS includes are included as well as sets page titles etc.
	  * @return  void
	  */
	public function before($container=FALSE)
	{
        // Set any page includes
        Page::instance()->set_page_data('title', __('signup.html_page_title'));

        return parent::before($container);
	}

} // End Welcome

