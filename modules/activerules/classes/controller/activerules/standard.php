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
class Controller_Activerules_Standard extends Controller_Activerules
{
    /**
	  * If we needed to override the default container we would do it here.
	  * This controls what JS and CSS includes are included as well as sets page titles etc.
	  * @return  void
	  */
	public function before($container=FALSE)
	{
        Page::instance()->set_page_data('layout_template', 'layout/standard');

        Page::instance()->set_page_data('layout_css', _s('web_include.activerules_css', 'activerules.css'));

        return parent::before($container);
	}

} // End Welcome

