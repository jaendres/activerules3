<?php
/**
 * Cloudfile library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Cloudfile extends Activerules_Storage
{
	/**
	 * On first instance creation, it creates site.
	 */
	public function __construct($username, $api_key)
	{
        // Init the Rackspace CloudFile integration
        include('cloudfile'.DIRECTORY_SEPARATOR.'cloudfiles.php');

        $auth = new CF_Authentication($username, $api_key);
        $auth->ssl_use_cabundle();  # bypass cURL's old CA bundle
        $auth->authenticate();

        $this->conn = new CF_Connection($auth);
        $this->conn->ssl_use_cabundle();
    }

    public function write($container, $filename, $data, $content_type=NULL, $cache=FALSE)
    {
        // Create a new connection
        $ar_container = $this->conn->get_container($container);

        // Craete a file object, this DOES NOT create the file
        $new_file = $ar_container->create_object($filename);

        // If a content type was sent it will use that, if not it will guess later.
        // NOTE allowing it to guess may provide weird results.
        if($content_type)
        {
            $new_file->content_type = $content_type;
        }

        // Try to properly encode the data
        try
		{
			$type = gettype($data);

			// Serialize the data
			$data = json_encode((object) array(
				'payload'  => ($type === 'string') ? $data : serialize($data),
				'type'     => $type
			));

			$size = strlen($data);
		}
		catch (ErrorException $e)
		{
			// If serialize through an error exception
			if ($e->getCode() === E_NOTICE)
			{
				// Throw a caching error
				throw new Activerules_Cloudfile_Exception(__METHOD__.' failed to serialize data for storage with message : '.$e->getMessage());
			}

			// Else rethrow the error exception
			throw $e;
		}

		try
		{
			$new_file->write($data);

             // If caching is set store the file locally
            if($cache)
            {
                Cloudfile::_cache($container, $filename, $data);
            }
			return TRUE;
		}
		catch (Exception $e)
		{
			throw $e;
		}
    }

    public function read($container, $filename, $cache=FALSE)
    {
        // If we are using local chace check there first
        if($cache)
        {
            $data = Cloudfile::_get_cache($container, $filename);

            if($data)
            {
                return $data;
            }
        }
       
        $data = Cloudfile::_get_cloudfile($container, $filename, $cache);

        return $data;
        
    }

    public function read_cache($container, $filename, $max_age=NULL)
    {
        $data = Cloudfile::_get_cache($container, $filename, $max_age);

        if($data)
        {
            return $data;
        }

        $data = Cloudfile::_get_cloudfile($container, $filename, TRUE);

        return $data;

    }

    /**
     * This does a head check to get the lates version from Cloudfiles.
     * If the modified time is newer than the local object, the remote object is fetched.
     *
     * @param string $container
     * @param string $filename
     * @param integer $max_age
     * @return array
     */
    public function read_new($container, $filename)
    {
        // Get the remote file age
       Cloudfile::head($container, $filename);

        // Use the remote file age to calculate the max_age.



    }

    public function head($container, $filename)
    {
        $head =  Cloudfile::_get_cloudfile_head($container, $filename);

        foreach($head as $name => $value)
        {
            if(is_string($value))
            {
                $out[$name] = $value;
            }
        }

        dbg::it($out);

        return $out;
    }

    private function _get_cloudfile_head($container, $filename)
    {
        // Wrap operations in try/catch to handle notices
		try
		{
			$ar_container = $this->conn->get_container($container);

            $file = $ar_container->get_object($filename);
//dbg::it($file);
            //$json = $file->read();

            // Decode the json into PHP object
           // $data = json_decode($json);

          //  return ($data);
            return $file;
		}
		catch (ErrorException $e)
		{
			// Handle ErrorException caused by failed unserialization
			if ($e->getCode() === E_NOTICE)
			{
				throw new Activerules_Cloudfile_Exception(__METHOD__.' failed to unserialize cloudfile object with message : '.$e->getMessage());
			}

			// Otherwise throw the exception
			throw $e;
		}
    }

    private function _get_cloudfile($container, $filename, $cache=FALSE)
    {
        // Wrap operations in try/catch to handle notices
		try
		{
			$ar_container = $this->conn->get_container($container);

            $file = $ar_container->get_object($filename);

            $json = $file->read();

            // We need to cache this data if locally if we're using caching
            if($cache)
            {
                Cloudfile::_cache($container, $filename, $json);
            }

            // Decode the json into PHP object
            $data = json_decode($json);

            return ($data->type === 'string') ? $data->payload : unserialize($data->payload);
		}
		catch (ErrorException $e)
		{
			// Handle ErrorException caused by failed unserialization
			if ($e->getCode() === E_NOTICE)
			{
				throw new Activerules_Cloudfile_Exception(__METHOD__.' failed to unserialize cloudifle object with message : '.$e->getMessage());
			}

			// Otherwise throw the exception
			throw $e;
		}
    }

    private function _get_cloudfile_if_newer($container, $filename, $date)
    {
        // Wrap operations in try/catch to handle notices
		try
		{
			$ar_container = $this->conn->get_container($container);

            $file = $ar_container->get_object($filename);
 
            $json = $file->read();

            // Decode the json into PHP object
            $data = json_decode($json);

            return ($data->type === 'string') ? $data->payload : unserialize($data->payload);
		}
		catch (ErrorException $e)
		{
			// Handle ErrorException caused by failed unserialization
			if ($e->getCode() === E_NOTICE)
			{
				throw new Activerules_Cloudfile_Exception(__METHOD__.' failed to unserialize cloudifle object with message : '.$e->getMessage());
			}

			// Otherwise throw the exception
			throw $e;
		}
    }





}
