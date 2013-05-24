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
class Controller_Register extends Controller_Activerules_Wideleft
{
    public function  __construct(Kohana_Request $request)
    {
        // Redirect to site home page if Facebook registration isn't active.
        if(! Site::conf('facebook.registration.active', FALSE))
        {
            Header( "HTTP/1.1 301 Moved Permanently" );
            Header( "Location: ".Site::conf('base') );
        }

        parent::__construct($request);
    }


    public function action_index()
    {
        Page::instance()->set_page_data('core_template', 'core/register');
    }

    public function action_success()
    {
        $config = array('appId'=>Site::conf('facebook.app_id'), 'secret'=>Site::conf('facebook.app_secret'));

        // The registration data will be in the POST signed_request
        $fbook = new Activerules_Fbook($config);

        // Grab the response
        $response = $fbook->getSignedRequest();

        $user_lib = new Fbuser();

        $user_lib->register(__s('name'), $response['user_id'], $response['registration']['name'], $response['registration']['email'], $response['registration']['birthday'], $response['registration']['gender'], $response['registration']['location']['name'], $response['user']['locale']);

        // Creat a new user object
        //$party = new Activerules_Party;

        //$party->register($response);

        //Page::instance()->set_page_data('core_template', 'core/register_success');
    }

    /**
      * If we needed to override the default container we would do it here.
      * This controls what JS and CSS includes are included as well as sets page titles etc.
      * @return  void
      */
    public function before($container=FALSE)
    {
        // Set any page includes
        Page::instance()->set_page_data('title', __('register.html_page_title'));

        return parent::before($container);
    }

} // End Homepage


