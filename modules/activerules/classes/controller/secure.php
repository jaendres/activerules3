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
class Controller_Secure extends Controller_Activerules_Full
{

	public function action_index()
	{
        $config = array('appId'=>Site::conf('facebook.app_id'), 'secret'=>Site::conf('facebook.app_secret'));

        Page::instance()->set_page_data('core_template', 'core/secure');
	}

     /**
	  * If we needed to override the default container we would do it here.
	  * This controls what JS and CSS includes are included as well as sets page titles etc.
	  * @return  void
	  */
	public function before($container=FALSE)
	{
        // Set any page includes
        Page::instance()->set_page_data('title', __('page_account.title'));

        return parent::before($container);
	}

} // End Homepage
