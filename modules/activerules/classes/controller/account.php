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
class Controller_Account extends Controller_Activerules_Full
{

	public function action_index()
	{
        $config = array('appId'=>Site::conf('facebook.app_id'), 'secret'=>Site::conf('facebook.app_secret'));

        // The registration data will be in the POST signed_request
        $facebook = new Activerules_Fbook($config);

        $user = $facebook->getUser();


if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

if ($user)
{
echo '<a href="'.$logoutUrl.'">Logout</a>';
}
else
{
echo '<a href="'.$loginUrl.'">Login</a>';
}






        Page::instance()->set_page_data('core_template', 'core/account');
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
