<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Homepage
 *
 * @package    ActiverRules
 * @category   Controller
 * @author     Brian Winkers
 * @copyright  (c) 2010-2011
 * @license    http://kohanaphp.com/license
 */
class Controller_Contact extends Controller_Activerules_Standard
{

	public function action_index()
	{
        Page::instance()->set_page_data('core_template', 'core/standard');

        Page::instance()->set_extra_data('selected_nav', 'contact');

        Page::instance()->set_extra_data('localization_file', 'contact');
	}

     /**
	  * If we needed to override the default container we would do it here.
	  * This controls what JS and CSS includes are included as well as sets page titles etc.
	  * @return  void
	  */
	public function before($container=FALSE)
	{
        // Set any page includes
        Page::instance()->set_page_data('title', __('about.html_title'));

        return parent::before($container);
	}

} // End Homepage
