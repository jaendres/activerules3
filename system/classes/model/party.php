<?php
/**
 *
 * @package    Auth
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri Group LLC
 */
class Model_Party extends Model
{
    /**
     * Construct this model with proper database connection.
     * The library accessing the model should set the database connection.
     */
    public function __construct($db_connection='default')
    {
        $this->db = Database::instance($db_connection);
    }

    public function next_queued_job()
    {
        // Start a DB transaction
        $this->db->query(NULL, 'START TRANSACTION', FALSE);

        // Count how many jobs are assigned or processing
        $sql = "SELECT count('x') AS counter
                FROM harvest_queue.".$this->workspace."_sql_to_config c
                WHERE status IN ('assigned', 'processing')";

        $result = $this->db->query(Database::SELECT, $sql, FALSE)->as_array();
        
        // If there is one or more jobs assigned or processing make the processor wait until that job is done.
        if((int)$result[0]['counter'] > 0)
        {
           // Commit, just be complete   
           $this->db->query(NULL, 'COMMIT', TRUE);
           
            return 'job_in_process';
        }

        // If there were no current running jobs grab the next scheduled job
        $sql = "SELECT id, scheduled_timestamp, start_timestamp, end_timestamp, object_identifier_md5, type, status, options, object_identifier
               FROM harvest_queue.".$this->workspace."_sql_to_config c
               WHERE status = 'pending'
               ORDER BY c.scheduled_timestamp
               LIMIT 1";

        $result = $this->db->query(Database::SELECT, $sql, FALSE)->as_array();
        if(!empty($result))
        {
             // Fetch the last completed job of this type and object_identifier
            $sql = "SELECT id, start_timestamp
                   FROM harvest_queue.".$this->workspace."_sql_to_config c
                   WHERE status = 'complete'
                   AND type = :type
                   AND object_identifier = :object_identifier
                   LIMIT 1";

            // Compile SQL
            $query = DB::query(Database::SELECT, $sql, $this->db_connection);
            // Bind variables
            $query->param(':object_identifier', $result[0]['object_identifier']);
            $query->param(':type', $result[0]['type']);
            // run query
            $result2 = $query->execute()->as_array();

            // The last time a harvest of this exact type was run
            if($result2)
            {
                //define('LAST_HARVEST_TIMESTAMP', $result2[0]['start_timestamp']);
                  $GLOBALS['last_harvest_timestamp'] = $result2[0]['start_timestamp'];
            }
            
            // Define the timestamp we'll use as the start time for this harvest.
            // define('START_HARVEST_TIMESTAMP', date('Y-m-d H:i:s'));
             $GLOBALS['start_harvest_timestamp'] = date('Y-m-d H:i:s');

            // Define the JOB_ID so we can access it from anywhere
            //define('JOB_ID', $result[0]['id']);
            $GLOBALS['job_id'] = $result[0]['id'];

            // Update the next scheduled job we just grabbed
            $sql = "UPDATE harvest_queue.".$this->workspace."_sql_to_config
                   SET status = 'processing',
                   start_timestamp = :start_timestamp
                   WHERE id = :assigned_job_id
                   LIMIT 1";

            // compile SQL
            $query = DB::query(Database::UPDATE, $sql, $this->db_connection);
            // Bind variables
            $query->param(':start_timestamp', $GLOBALS['start_harvest_timestamp']);
            $query->param(':assigned_job_id', $result[0]['id']);
            // Run SQL
            $query->execute();

            // Commit our changes
            $this->db->query(NULL, 'COMMIT', TRUE);

            // Return the data for the next queued job
            return $result[0];
        }
    }

    /**
     * Sets the status of a queued job to 'processing'
     * @param string $status
     * @param integer $job_id
     */
    public function set_job_started($job_id)
    {
        $sql = "UPDATE harvest_queue.".$this->workspace."_sql_to_config
               SET status = 'processing',
               start_timestamp = :started
               WHERE id = :job_id
               LIMIT 1";

        // compile SQL
        $query = DB::query(Database::UPDATE, $sql, $this->db_connection);
        // Bind variables
        $query->param(':job_id', $job_id);
        $query->param(':started', $GLOBALS['start_harvest_timestamp']);
        // Run SQL
        $query->execute();
    }

    /**
     * Sets the status of a queued job to 'complete'
     * @param string $status
     * @param integer $job_id
     */
    public function set_job_complete($job_id)
    {


        // Get the job identifier and scheduled timestamp
        
        // Update ALL jobs with the same job identifier,
        // and a scheduled timestamp >= the Id records's scheduled timestamp
        // and a scheduled timestamp < NOW


        $sql = "UPDATE harvest_queue.".$this->workspace."_sql_to_config
               SET status = 'complete',
               end_timestamp = NOW()
               WHERE id = :job_id
               LIMIT 1";

        // compile SQL
        $query = DB::query(Database::UPDATE, $sql, $this->db_connection);
        // Bind variables
        $query->param(':job_id', $job_id);
        // Run SQL
        $query->execute();

    }


    /**
     * Sets the status of a queued job to 'complete'
     * @param string $status
     * @param integer $job_id
     */
    public function get_contexts()
    {
        $sql = "SELECT context_id, `language`, country
                FROM v_context";

        // compile SQL
        $query = DB::query(Database::SELECT, $sql, $this->db_connection);
        // Bind variables

        $result = $query->execute()->as_array();

        return $result;
    }

     /**
     * Sets the status of a queued job to 'complete'
     * @param string $status
     * @param integer $job_id
     */
    public function set_job_pending($job_id)
    {
        $sql = "UPDATE harvest_queue.".$this->workspace."_sql_to_config
               SET status = 'pending',
               start_timestamp = '0000-00-00 00:00:00',
               end_timestamp = '0000-00-00 00:00:00',
               WHERE id = :job_id
               LIMIT 1";

        // compile SQL
        $query = DB::query(Database::UPDATE, $sql, $this->db_connection);
        // Bind variables
        $query->param(':job_id', $job_id);
        // Run SQL
        $query->execute();
    }


     /**
     * Sets the status of a queued job to 'complete'
     * @param string $status
     * @param integer $job_id
     */
    public function insert_queue_job($workspace, $type, $object_identifier, $scheduled_timestamp=FALSE, $options=NULL)
    {
        if(!$scheduled_timestamp)
        {
            $scheduled_timestamp = 'NOW()';
        }

        // get workspace so that appropriate table can be written to.
        $workspace = workspace::return_workspace_from_dbconnection($this->db_connection);

        $sql = "INSERT INTO harvest_queue.".$workspace."_sql_to_config(type, object_identifier, options, scheduled_timestamp)
               VALUES(:type, :object_identifier, :options, ".$scheduled_timestamp.")";

        // compile SQL
        $query = DB::query(Database::INSERT, $sql, $this->db_connection);
        // Bind variables
        $query->param(':type', $type);
        $query->param(':object_identifier', $object_identifier);
        $query->param(':options', $options);

        // Run SQL
        $query->execute();
    }
}


?>
