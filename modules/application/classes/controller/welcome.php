<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Activerules
{

	public function action_index()
	{
		// Start the response view
        $this->response_template();

	}

} // End Welcome
