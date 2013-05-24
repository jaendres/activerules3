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
class Controller_Facebook extends Controller_Activerules
{
	public function  __construct(Kohana_Request $request)
    {
        parent::__construct($request);

    }

	public function action_index($key=NULL)
	{
		

		$this->output = dbg::it($this->googlestore->read('izzup_menu', $key, TRUE));
	}

    public function action_canvas($page_id)
	{
        echo $page_id;

        $fb = new Activerules_Fbook();


	}

     public function action_tab($page_id)
	{
        dbg::it($_REQUEST)         ;

        $fb = new Activerules_Fbook();


	}

	/**
	 * Loads the template [View] object.
	 */
	public function before()
	{
  		return parent::before();
	}

	/**
	 * Assigns the template [View] as the request response.
	 */
	public function after()
	{
		//return parent::after();
	}
}
?>