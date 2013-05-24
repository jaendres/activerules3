<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2010 Ultri Group LLC
 */
class Fbuser
{
	public function __construct()
    {
        $this->dao = new Model_Fbuser();
    }

    public function register($site, $facebook_user_id, $name, $email, $birthday, $gender, $location, $locale)
    {
        $user_id = $this->dao->register_user(_s('alias'), $facebook_user_id, $name, $email, $birthday, $gender, $location, $locale);

        return $user_id;
    }

} // End file