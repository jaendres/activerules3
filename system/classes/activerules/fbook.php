<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2010 Ultri Group LLC
 */
include('facebook'.DIRECTORY_SEPARATOR.'facebook.php');

class Activerules_Fbook extends Facebook
{
    public function __construct($config)
    {
        // Create our Application instance (replace this with your appId and secret).
         parent::__construct($config);

    }
    
} // End file

/*
 *         // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
          'appId'  => $app_id,
          'secret' => $secret,
        ));

        // Get User ID
        $user = $facebook->getUser();

        // We may or may not have this data based on whether the user is logged in.
        //
        // If we have a $user id here, it means we know the user is logged into
        // Facebook, but we don't know if the access token is valid. An access
        // token is invalid if the user logged out of Facebook.

        if ($user) {
          try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = $facebook->api('/me');
            dbg::it($user_profile);
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

        // This call will always work since we are fetching public data.
        // $naitik = $facebook->api('/naitik');
 */