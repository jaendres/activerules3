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
class Controller_Activerules_Full extends Controller_Activerules
{
     /**
	  * If we needed to override the default container we would do it here.
	  * This controls what JS and CSS includes are included as well as sets page titles etc.
	  * @return  void
	  */
	public function before($container=FALSE)
	{
        Page::instance()->set_page_data('layout_template', 'layout/full');

        Page::instance()->set_page_data('layout_css', 'activerules.css');

        Page::instance()->set_page_data('css_override', 'html/full_view_css_override');

        return parent::before($container);
	}

} // End Welcome

