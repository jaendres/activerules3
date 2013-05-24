<?php
/**
 *
 * @package    Auth
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri Group LLC
 */
class Model_Fbuser extends Model
{
    /**
     * Construct this model with proper database connection.
     * The library accessing the model should set the database connection.
     */
    public function __construct()
    {
        parent::__construct();

        $this->db_connection = 'xeround';

        $this->db = Database::instance($this->db_connection);
    }

    public function register_user($site, $facebook_user_id, $name, $email, $birthday, $gender, $location, $locale)
    {
        // Count how many jobs are assigned or processing
        $sql = "CALL register_site_user('$site', $facebook_user_id, '$name', '$email', '$birthday', '$gender', '$location', '$locale')";

        // compile SQL
        $query = DB::query(NULL, $sql, $this->db_connection);

        // Run SQL
        $query->execute();
    }
}
?>
