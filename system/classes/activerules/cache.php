<?php
/**
 * Googlestore library - store data in a Google Spreadsheet
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Cache
{

    public function write($container, $filename, $data, $cache=FALSE)
    {
        // Try to properly encode the data
        try
		{
			$type = gettype($data);

			// Serialize the data
			$data = json_encode((object) array(
				'type'     => $type,
                'payload'  => ($type === 'string') ? $data : serialize($data)
				));

			$size = strlen($data);
		}
		catch (ErrorException $e)
		{
			// If serialize through an error exception
			if ($e->getCode() === E_NOTICE)
			{
				// Throw a caching error
				throw new Activerules_Exception(__METHOD__.' failed to serialize data for storage with message : '.$e->getMessage());
			}

			// Else rethrow the error exception
			throw $e;
		}

		try
		{
			//The filename needs a .php extension added
            $filename = $filename.EXT;

            $directory = Activerules_Cache::_cache_dir($container);

            // Open directory
            $dir = new SplFileInfo($directory);

            // If the directory path is not a directory
            if ( ! $dir->isDir())
            {
                // Create the directory
                if ( ! mkdir($directory, 0775, TRUE))
                {
                    throw new Kohana_Cache_Exception(__METHOD__.' unable to create directory : :directory', array(':directory' => $directory));
                }

                // chmod to solve potential umask issues
                chmod($directory, 0775);
            }

            // Open file to inspect
            $resource = new SplFileInfo($directory.$filename);
            $file = $resource->openFile('w');
            $size = strlen($data);

            try
            {
                $file->fwrite($data, $size);
                //touch ( string $filename [, int $time = time() [, int $atime ]] )
                return (bool) $file->fflush();
            }
            catch (Exception $e)
            {
                throw $e;
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
    public function read($container, $filename, $max_age=3600)
    {
        // Use the type  get the correct filepath
        $directory = Activerules_Cache::_cache_dir($container);

        //The filename needs a .php extension added
        $filename = $filename.EXT;

		// Wrap operations in try/catch to handle notices
		try
		{
			// Open file
			$file = new SplFileInfo($directory.$filename);

            // If the max_age is set check the file age
            if($file->isFile() AND $max_age)
            {
                 // Check to see if the file is past the max_age
                if((time() - $file->getMTime()) > $max_age)
                {
                    return FALSE;
                }
            }

            // If file does not exist fetch from Cloudfiles
			if ($file->isFile())
			{
				// Open the file and extract the json
                $json = $file->openFile()->current();

				if(empty($json))
				{
					return FALSE;
				}

				// Decode the json into PHP object
				$data = json_decode($json);

				return unserialize($data->payload);
			}
			else
			{
				return FALSE;
			}

		}
		catch (ErrorException $e)
		{
			// Handle ErrorException caused by failed unserialization
			if ($e->getCode() === E_NOTICE)
			{
				throw new Kohana_Cache_Exception(__METHOD__.' failed to unserialize config object with message : '.$e->getMessage());
			}

			// Otherwise throw the exception
			throw $e;
		}

    }

    /**
     * Formulates the cache directory name for objects
     *
     * @param string $container
     * @return string
     */
    private static function _cache_dir($container)
    {
        return CACHEPATH.'object_cache'.DIRECTORY_SEPARATOR.Site::conf('uuid').DIRECTORY_SEPARATOR.$container.DIRECTORY_SEPARATOR;
    }

}
