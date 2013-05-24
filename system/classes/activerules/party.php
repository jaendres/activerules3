<?php
/**
 * Party library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Party {

	private $id;
    private $uuid;
    private $private_uuid;
    private $timestamp;

    /**
	 * Constructor
	 */
	public function __construct()
	{
        $this->dao = new Model_Party;
	}

    public function register($response)
    {
        // Commit the party to the database
        $this->_create();

        // Add the email address for the user
        $this->add_email($response['registration']['email']);

        // Add the password for the user
        $this->set_password($response['registration']['email']);

        // Add the name for the user
        $this->set_name($response['registration']['name'], 'full');

        // Add the birthday and gender for the user
        $this->set_biodata(array('birthday'=>$response['registration']['birthday'], 'gender'=>$response['registration']['gender']));

        // Add the FB user ID if provided
        if(isset($response['user_id']))
        {
            $this->add_fb_account($response['user_id']);
        }

        // Add the locale the user used, with a preference of 1
        $this->add_locale($response['user']['locale'], 1);
    }

    private function create()
    {
        $this->uuid = uuid_parse(uuid_create(UUID_TYPE_RANDOM));

        $this->private_uuid = uuid_parse(uuid_create(UUID_TYPE_RANDOM));
    }

    public function add_email($email)
    {
        $this->dao->insert_email($email, $this->uuid);
    }

    public function set_name($name, $type='full')
    {
        $this->dao->force_name($name, $type, $this->uuid);
    }

    public function set_biodata($array)
    {
        $this->dao->force_biodata($array, $this->uuid);
    }

    public function set_password($password)
    {
        $this->dao->force_password($password, $this->uuid);
    }

    public function add_fb_account($user_id)
    {
        $this->dao->insert_email($user_id, $this->uuid);
    }

    public function add_locale($locale)
    {
        $this->dao->insert_email($locale, $priority, $this->uuid);
    }

} // End Party Class
