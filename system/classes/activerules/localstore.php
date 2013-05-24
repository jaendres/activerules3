<?php
/**
 * Googlestore library - store data in a Google Spreadsheet
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Localstore extends Activerules_Storage
{

    public function write($container, $filename, $data, $cache=FALSE)
    {
        // Create a new connection
        $ar_container = $this->conn->get_container($container);

        // Create a file object, this DOES NOT create the file
        $new_file = $ar_container->create_object($filename);

        // For ActiveRules object storage we set conent type explicitly
        $new_file->content_type = 'text/plain';


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
				throw new Activerules_Cloudstore_Exception(__METHOD__.' failed to serialize data for storage with message : '.$e->getMessage());
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
                Localstore::_cache($container, $filename, $data);
            }
			return TRUE;
		}
		catch (Exception $e)
		{
			throw $e;
		}
    }

    /**
     *
     * @param string $container - The cache container
     * @param type $filename - The spreadhseet ID
     * @param boolean $cache - Should we cahce the data?
     * @param integer $max_age - cache age
     * @return type
     */
    public function read($container, $filename, $cache=FALSE, $max_age=600)
    {
        // If we are using local cache check there first
        if($cache)
        {
            $data = self::_get_cache($container, $filename, $max_age);

            if($data)
            {
                return $data;
            }
        }

        $data = self::_get_spreadsheet($container, $filename);

        // If we are using local cache check there first
        if($cache)
        {
            // We need to cache this data if locally if we're using caching
            if($cache)
            {
                Localstore::_cache($container, $filename, $data);
            }
        }

        return $data;

    }

}
