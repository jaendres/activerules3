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
class Controller_Izzup extends Controller_Activerules
{
	public function  __construct(Kohana_Request $request)
    {
        parent::__construct($request);
// echo phpinfo(); exit;
        // Creat an instance of the RackSpace CloudFile
		$this->googlestore = new Googlestore(Site::conf('google.username'), Site::conf('google.pwd'));

		if(Request::$client_ip == '66.188.123.88' OR Request::$client_ip == '71.13.182.7')
		{
			// dbg::it($this->mongostore->get_timestamp('activerules', Site::conf('uuid')));

			//dbg::it($this->cf->read_cache('activerules', 'test3', 1));

			// dbg::it($this->cf->read_new('activerules', 'test3'));
		}
    }

	public function action_index($key=NULL)
	{
		if(! $key)
		{
			$key = Site::conf('google.menu_key');
		}

		$this->output = dbg::it($this->googlestore->read('izzup_menu', $key, TRUE));
	}

	/**
	 * Loads the template [View] object.
	 */
	public function before()
	{
		/* ActiveRules does NOT assume a controller will only use one template for layout.
        if ($this->auto_render === TRUE)
		{
			// Load the template
			$this->template = View::factory($this->template);
		}
        */
  		return parent::before();
	}

	/**
	 * Assigns the template [View] as the request response.
	 */
	public function after()
	{
		// Close our MongoDB connection
        $this->mongostore->close();

        // If auto render is on set this->output as the response to the request.
        if ($this->auto_render === TRUE)
		{
			$this->request->response = $this->output;
		}

		return parent::after();
	}

    public function response_template($template=NULL)
    {
        // @TODO add some useful logic to set template based on browser/site/page
        if($template)
        {
             $this->output = View::factory($template);
             return;
        }

        $this->output = View::factory(Site::conf('default_layout_template', 'error/http_404'));
		return;
    }

} // End Controller_Activerules

