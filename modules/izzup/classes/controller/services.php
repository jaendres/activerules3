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
class Controller_Services extends Controller_Activerules
{
	public function  __construct(Kohana_Request $request)
    {
        parent::__construct($request);
    }

	public function action_index($key=NULL)
	{
		echo 'Izzup';
	}

    public function action_facebook_page_applications($key=NULL)
	{
		echo 'Izzup Facebook';
	}

    public function action_vanity_blogging_and_email($key=NULL)
	{
		echo 'Izzup Blogging';
	}

    	/**
	 * Loads the template [View] object.
	 */
	public function before($container=FALSE)
	{
		/* ActiveRules does NOT assume a controller will only use one template for layout.
        if ($this->auto_render === TRUE)
		{
			// Load the template
			$this->template = View::factory($this->template);
		}
        */
  		return parent::before($container);
	}
} // End Controller_Imenu

