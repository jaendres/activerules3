<?php
/**
 * Site library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Site {

	// Session singleton
	protected static $instance;

	// Protected key names (cannot be set by the user)
	protected static $protect = array('name', 'dao', 'hostname', 'languages');

	// Configuration
	public static $config;
	public static $site_host_configs;

	// DAO
	protected static $dao;

	// Site languages array
	protected static $languages;

	// Boolean for whether the site the is dynamic, meaning supported by ActiveRules.
	public static $dynamic = FALSE;

	// Original hostname
	public static $hostname;

	// The hostname used to load configs
	protected static $root_host;

	// Dynamic sub_hosts are used to put username into the hostname.
	// Example: brian.packerfans.us
	// This is FALSE or the dynamic hostname part. Example: brian
	protected static $sub_host = FALSE;

	// protected static $hostname_alias;

	// List of names this domain supports for signup
	protected static $domains = FALSE;

	/**
	 * Instance of Site.
	 */
	public static function & instance($hostname=FALSE)
	{
		if (Activerules_Site::$instance == NULL)
		{
			// Create a new instance
			Activerules_Site::$instance = new Activerules_Site($hostname);
		}

		return Activerules_Site::$instance;
	}

	/**
	 * On first site instance creation, it creates site.
	 */
	public function __construct($hostname=FALSE)
	{
		// This part only needs to be run once
		if (Activerules_Site::$instance === NULL)
		{
			// Makes a mirrored array, eg: foo=foo
			//Site::$protect = array_combine(Site::$protect, Site::$protect);

			// Load Site Host Model
	       // self::$dao = new Site_Model();

			// Load the site configs from cache or database.
			// This also looks for certain site configs that affect further processing.
			// If it doesn't have any configs you get pretty much normal Kohana processing.
			self::_init_site($hostname);

			// Singleton instance
			Activerules_Site::$instance = $this;

			//Kohana::log('debug', 'Site Library initialization completed');
		}
	}


	/**
	 * Initialize the site
	 */
	private function _init_site($hostname)
	{
        // We'll assume this is the root supported hostname
        self::$root_host = $hostname;

        // If the site has any config entries its a dynamic framework site.
		// If it doesn't have any configs you get pretty much normal Kohana processing.
		if(self::_load_configs($hostname))
		{
			// The site is dynamic, enable all ActiveRules goodness.
			self::$dynamic = TRUE;

			// Signal constructor method all is good
			return TRUE;
		}

		// Configs weren't found so we'll try the last 2-3 array elements for the root hostname
		$name_array = explode('.',$hostname);

		// Set TLD and 2nd Level name
		$tld = array_pop($name_array);
		$level_2 = array_pop($name_array);

		// If the 2nd level element is a common resold one use the 3rd element as well.
		// This supports domains under co.uk, com.cn etc.
		if($level_2 == 'co' OR $level_2 == 'com' OR $level_2 == 'org' OR $level_2 == 'net')
		{
			 // Set third level name to hostname, purposely overwrite larger hostname.
			 $hostname = array_pop($name_array);

			 // Create hostname string.
			 self::$root_host = $level_3.'.'.$level_2.'.'.$tld;
		}
		else
		{
			// We have our hostname already, purposely overwrite larger hostname.
			self::$hostname = $level_2;

			// Create full hostname string.
			self::$root_host = $level_2.'.'.$tld;
		}

		// Drop name_array in case it was big
		unset($name_array);

		if (self::_load_configs(self::$root_host))
		{
			// If this site supports dynamic sub_hosts set the subhost name and return
			if(self::$get('sub_hosts'))
			{
				// This is the root supported hostname
				self::$root_host = $hostname;

				// The site is dynamic, enable all ActiveRules goodness.
				self::$dynamic = TRUE;

				// Set the sub_host name for sites that use it as an ActiveRules dimension.
				self::$sub_host =self::$hostname;

				// Signal constructor method all is good
				return TRUE;
			}
			else
			{
				url::redirect('http://'.self::$root_host);
			}
		}

		// We didn't find any configs for this hostname.
		return FALSE;
	}

	/**
	 * Load configs or throw error
	 */
	private function _load_configs($hostname)
	{
		// Define path to ActiveRules Host config files
        $active_host_path = MODPATH.DIRECTORY_SEPARATOR.'activerules'.DIRECTORY_SEPARATOR.'host'.DIRECTORY_SEPARATOR;

        // Define path to the specific ActiveRules Host config file
        $host_file = $active_host_path.$hostname.'.host'.EXT;

        //
        if(file_exists($host_file))
		{
            self::_load_site($host_file);
    	}
        else
        {
            // Put the hostname into an array
            $name_array = explode('.', $hostname);

            // Keep removing hostname parts until we're out of pieces
            while(count($name_array) > 2)
            {
                 // Removed initial hostname part since we know that doesn't match
                array_shift($name_array);

                $hostname = implode('.', $name_array);

                // Define path to the specific ActiveRules Host config file
                $host_file = $active_host_path.$hostname.'.host'.EXT;

                if(file_exists($host_file))
                {
                    self::_load_site($host_file);

                    //check for redirect in site/host config
                    self::site_redirect_check();


                    break;
                }
            }

        }

		return TRUE;
	}

    private function _load_site($host_file)
    {
            // Define path to ActiveRules Site config files
            $active_site_path = MODPATH.DIRECTORY_SEPARATOR.'activerules'.DIRECTORY_SEPARATOR.'site'.DIRECTORY_SEPARATOR;

            // Initial site array
            $site = array();

			// Include the file that defines a $host config array
			include_once($host_file);

			// Check to see if a 'site' is defined by the host, if so load the site config file.
			if(array_key_exists('site', $host))
			{
				// Define path to the specific ActiveRules Site config file
                $site_file = $active_site_path.$host['site'].'.site'.EXT;

                // If the Site config file exists include it
                if(file_exists($site_file))
				{
					include_once($site_file);
				}
			}

            // Set the configs, merging the arrays so that the host array overrides values in the site array.
            self::$config = array_merge($site, $host);
    }

	public function site_redirect_check()
	{
		if($redirect_url = _s('redirect_url', FALSE))
		{
			header('Location: '.$redirect_url);
		}
	}

	/**
	 * Get site configs
	 */
	public static function conf($var_name, $default=NULL)
	{
        // the var_name has a dot, it means this is a dot notated array request
        if (strpos($var_name, '.') !== FALSE)
        {
            return arr::path(Site::$config, $var_name, $default);
        }
        elseif(isset(self::$config[$var_name]))
        {
            return self::$config[$var_name];
        }

        return $default;
	}

	public function get_domains()
	{
		if(empty(self::$domains))
		{
			self::$domains = self::$dao->get_domains(self::$get('site_id'));
		}

		return self::$domains;
	}

	/**
	 * Get site subhost
	 */
	public function sub_host()
	{
		return self::$sub_host;
	}

	/**
	 * Get site subhost
	 */
	public function root_host()
	{
		return self::$root_host;
	}

	/**
	 * Set file host configs
	 * Set the site configs based off config file info
	 * @param array $configs Multi array of config data
	 */
	private function _set_sitehost_file_configs(&$configs)
	{
		foreach($configs AS $name => $value)
		{
			//Kohana::config_set('site.'.$name, $value);
		}
	}

	/**
	 * Set site configs
	 * Set the site configs based off database info
	 * @param array $configs Multi array of config data
	 */
	private function _set_sitehost_configs(&$configs)
	{
		// Set default site_id to 0 which has no supported services, same with parent.
		Kohana::config_set('site.site_id',0);

		// Loop through site config setting variables based on their type.
        foreach($configs as $ix => $row)
        {
            // Set the site_id, but only on the first loop through.
            if($ix == 0)
            {
				// Redirect if the site_host has redirect set, do this early to avoid undue processing.
				if($row['redirect'])
				{
					 url::redirect($row->redirect, 302);
				}

				// Set a variety of useful sites values
				// Id can be used for SQL queries
				Kohana::config_set('site.site_id',$row['site_id']);
				// Site name
				Kohana::config_set('site.site_name',$row['site_name']);
				// UUID can be used for referencing site in web apps. DO NOT USE ID FOR THIS!!
				Kohana::config_set('site.site_uuid',$row['uuid']);
				// The primary hostname is used for links to the main site from subhosts.
				Kohana::config_set('site.primary_hostname',$row['primary_hostname']);
            }

			// This will turn off any AR provided language support and options
			if($row['name'] == 'force_language')
			{
				Kohana::config_set('locale.language', array($row['value']));
			}

            // Set the ActiveRules variables for all records
            switch($row['type'])
            {
                // Small config arrays are stored as pipe delimited strings
				case 'array':
                    $array = explode('|', $row['value']);
                    Kohana::config_set('site.'.$row['name'],$array);
                    break;

				// If these gets stored in a session they'll be zero's and one's.
                case 'boolean':
                    if(!empty($row['value']))
                    {
                        Kohana::config_set('site.'.$row['name'],TRUE);
                    } else {
                        Kohana::config_set('site.'.$row['name'],FALSE);
                    }
                    break;

				// These just get set as name=>value
                case 'string':
                case 'integer':
                    Kohana::config_set('site.'.$row['name'],$row['value']);
                    break;
            }
        }
	}

} // End Site Class
