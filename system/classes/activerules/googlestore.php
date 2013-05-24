<?php
/**
 * Googlestore library - store data in a Google Spreadsheet
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Googlestore extends Activerules_Storage
{
	/**
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $key  Document key - get it from browser addres bar query key for your open spreadsheet
	 */
	public function __construct($username, $password)
	{
       	//---------------------------------------------------------------------------------
		// Init Zend Gdata service
		$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $service);
		$this->spreadSheetService = new Zend_Gdata_Spreadsheets($client);
    }

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
                Googlestore::_cache($container, $filename, $data);
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
                Googlestore::_cache($container, $filename, $data);
            }
        }

        return $data;

    }

    private function _get_spreadsheet($container, $filename)
    {
        // Wrap operations in try/catch to handle notices
		try
		{
			list($key, $sheet) = explode(':', $filename);

            $query = new Zend_Gdata_Spreadsheets_DocumentQuery();

			$query->setSpreadsheetKey($key);

			$feed = $this->spreadSheetService->getWorksheetFeed($query);

			$data = $feed->entries[$sheet]->getContentsAsRows();

            return $data;

		}
		catch (ErrorException $e)
		{
			// Handle ErrorException caused by failed unserialization
			if ($e->getCode() === E_NOTICE)
			{
				//throw new Exception(__METHOD__.' failed to load Google Spreadsheet : '.$e->getMessage());
			}

			// Otherwise throw the exception
			//throw $e;

            return FALSE;
		}
    }
}
