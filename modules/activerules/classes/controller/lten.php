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
class Controller_Lten extends Controller_Activerules_Full
{

	public function action_index()
	{
        Page::instance()->set_page_data('core_template', 'core/lten');
	}

    public function action_utf8($vanity_url=NULL)
	{
        if($vanity_url)
        {
            echo 'Bare: '.$vanity_url;
            echo '<br>Decoded: '.urldecode($vanity_url);
            echo '<br>Encoded: '.urlencode($vanity_url);
        }
        else
        {
            echo 'Give me some UTF8.';
        }

	}

     /**
	  * If we needed to override the default container we would do it here.
	  * This controls what JS and CSS includes are included as well as sets page titles etc.
	  * @return  void
	  */
	public function before($container=FALSE)
	{
        // Set any page includes
        Page::instance()->set_page_data('title', __('page_login.title'));

        return parent::before($container);
	}

} // End Homepage
