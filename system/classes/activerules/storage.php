<?php
/**
 * Cloudfile library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Storage
{

    public function write($container, $filename, $data, $cache=FALSE)
    {

    }

    public function read($container, $filename, $cache=FALSE)
    {

    }

    /**
     * Lightweight caching.
     * This cacher doesn't encode the data as that has already been done.
     *
     * @param string $filename
     * @param <type> $data
     * @param <type> $size
     * @return boolean
     */
    protected function _cache($container, $filename, $data, $max_age=3600)
    {
        // Use the type to get the correct filepath
        $directory = Storage::_cache_dir($container);

        $data = serialize($data);

        //The filename needs a .php extension added
        $filename = $filename.EXT;

		// Open directory
		$dir = new SplFileInfo($directory);

		// If the directory path is not a directory
		if ( ! $dir->isDir())
		{
            // Create the directory
			if ( ! mkdir($directory, 0777, TRUE))
			{
                throw new Kohana_Cache_Exception(__METHOD__.' unable to create directory : :directory', array(':directory' => $directory));
			}

			// chmod to solve potential umask issues
			chmod($directory, 0777);
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
    }

    /**
     *
     * @param <type> $container
     * @param string $filename
     * @return mixed FALSE or the cached object
     */
    protected function _get_cache($container, $filename, $max_age=NULL)
    {
        // Use the type top get the correct filepath
        $directory = Storage::_cache_dir($container);

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

				return unserialize($data);
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
