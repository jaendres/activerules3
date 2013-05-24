<?php
/**
 * Cloudfile library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Mongostore extends Activerules_Storage
{
	/**
	 * On first instance creation, it creates site.
	 */
	public function __construct($host, $port, $username, $pwd)
	{
        try 
        {
            $this->connection = new Mongo($host.':'.$port);

            $this->db = $this->connection->my_test;

            $this->db->authenticate($username, $pwd);

        }
        catch (MongoConnectionException $e)
        {
            die('Error connecting to MongoDB server');
        }
        catch (MongoException $e)
        {
            die('Error: ' . $e->getMessage());
        }
    }
    
    public function write($container, $filename, $data, $cache=FALSE)
    {
        try
		{
			// If caching is set store the file locally
            if($cache)
            {
                Mongostore::_cache($container, $filename, $data);
            }

            $collection = $this->db->$container;

            $data['_id'] = $filename;

            // Set the timestamp
            $data['_ts'] = time();

            $collection->save($data);

            // disconnect from server
            Mongostore::close();

            return TRUE;
		}
		catch (Exception $e)
		{
			throw $e;
		}
    }

    public function read($container, $filename, $cache=FALSE, $max_age=600)
    {
        // If we are using local chace check there first
        if($cache)
        {
            $data = Mongostore::_get_cache($container, $filename, $max_age);

            if($data)
            {
                return $data;
            }
        }
       
        return Mongostore::read_mongo($container, $filename);

    }

    public function read_mongo($container, $filename)
    {
        $collection = $this->db->$container;

        // execute query
        // retrieve all documents
        $filter = array('_id' => $filename);
        $cursor = $collection->find($filter);

        // Iterate through the result set to get the one record we want
        if($cursor->count() === 1)
        {
           foreach ($cursor as $obj)
           {
               unset($obj['_id']);
               return $obj;
           }
        }

        return FALSE;
    }

    public function close()
    {
        $this->connection->close();
    }

    public function read_cache($container, $filename, $max_age=NULL)
    {
        $data = Mongostore::_get_cache($container, $filename, $max_age);

        if($data)
        {
            return $data;
        }

        $data = Mongostore::read($container, $filename, TRUE);

        return $data;

    }

    /**
     * This does a modified date check to get the latest version from Mongo.
     * If the modified time is newer than the local object, the remote object is fetched.
     *
     * @param string $container
     * @param string $filename
     * @param integer $max_age
     * @return array
     */
    public function read_new($container, $filename)
    {
       // Get the remote file age from it's head request
       $mongo_time = Mongostore::timestamp($container, $filename);

       // The max_age is the number of seconds bewteen now and when the cloudfile was last written
       $max_age = (time() - $mongo_time);

       // Check the local cache passing in the max_age
       $data = Mongostore::_get_cache($container, $filename, $max_age);

       // If the local data is new enough it will be used
       if($data)
       {
           return $data;
       }

       // If the cache was outdated pull down the object from cloud
       // Turn caching on for this request so the new file gets saved.
       return Mongostore::read($container, $filename, TRUE);
    }

    public function get_timestamp($container, $filename)
    {
        $collection = $this->db->$container;

        // execute query
        // retrieve all documents
        $filter = array('_id' => $filename);
        $cursor = $collection->find($filter);
        $cursor->fields(array("_ts" => TRUE));

        // Iterate through the result set to get the one record we want
        if($cursor->count() === 1)
        {
           foreach ($cursor as $obj)
           {
                return $obj['_ts'];
           }
        }

        return FALSE;
    }

}
