<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Localization (L10n) class. Provides language loading and translation
 * methods without dependencies on [gettext](http://php.net/gettext).
 *
 * Typically this class would never be used directly, but used via the __()
 * function, which loads the message and replaces parameters:
 *
 *     // Display a translated message
 *     echo __('Hello, world');
 *
 *     // With parameter replacement
 *     echo __('Hello, :user', array(':user' => $username));
 *
 * [!!] The __() function is declared in `SYSPATH/base.php`.
 *
 */
class Activerules_L10n {

	/**
	 * @var  string   target language: en-us, es-es, zh-cn, etc
	 */
	public static $locale = 'en-us';

    public static $alt_locales = array();

    // Array of cached term sets
    public static $term_sets = array();

	/**
	 * Get and set the target language.
	 *
	 *     // Get the current language
	 *     $locale = L18n::locale();
	 *
	 *     // Change the current language to Spanish
	 *     L18n::locale('es-es');
	 *
	 * @param   string   new language setting
	 * @return  string
	 */
	public static function locale($locale = NULL)
	{
		if ($locale)
		{
			// Normalize the language
			L10n::$locale = strtolower(str_replace(array(' ', '_'), '-', $locale));
		}

		return L10n::$locale;
	}

    /**
     * Overwrite any existing alt_locales
     * @param <type> $locales
     */
    public static function set_alt_locales($locales = NULL)
	{
		L10n::$alt_locales = (array) $locales;
	}

    /**
     * Append another locale option onto the stack.
     * This will be run after any current alt_locales
     * @param <type> $locale
     */
    public static function add_alt_locale($locale)
	{
		L10n::$alt_locales = array_unique(array_merge((array)L10n::$alt_locales, (array)$locale));
	}

    /**
     * Append another locale option onto the stack.
     * This will be run after any current alt_locales
     * @param <type> $locale
     */
    public static function add_preferred_alt_locale($locale)
	{
		L10n::$alt_locales = array_unique(array_merge((array)$locale, (array)L10n::$alt_locales));
	}

    /**
     *
     * @param type $localization_key
     * @param type $replacement_array
     * @param type $default
     * @param type $locale
     * @return type 
     */
	public static function get($localization_key, $replacement_array=NULL, $default=NULL, $locale = NULL)
	{
        if ( ! $locale)
		{
			// Use the global target language
			$locale = L10n::$locale;
		}

        // Get the file name
        $key_parts = explode('.', $localization_key);
        $file_name = array_shift($key_parts);

        // The rest of the parst get passed in as the dot notated key
        $path = implode('.', $key_parts);

        // Determine what locales to check in.
        // Extra locales don't hurt because it stops at the first one it finds.
        //
        // NOTE: !!! We DO NOT merge files from different levels.
        // The first file found better have all the data.
        // If you need to have all matching context merged use L10n::merge (currently_unwritten)
        // Once merge'd calls to "get" should return the merged data
        $locales = array_merge(array($locale), L10n::$alt_locales);

        // Start with a NULL string
        $string = NULL;

        // Loop through each locale the first file we find is used and the rest ignored.
        foreach($locales as $locale)
        {
            // Split the locale on hyphens and use the parts for directories
            // We can support as many subsegments as someone wants to define.
            $file_path = str_replace('-', DIRECTORY_SEPARATOR, $locale).DIRECTORY_SEPARATOR.$file_name;

            if(isset(self::$term_sets[$locale][$file_name]))
            {
                // Use the already loaded language array
                $localization = self::$term_sets[$locale][$file_name];

                // Set the string if the element exists, default to FALSE
                $string = arr::path($localization, $path, FALSE);
            }
            else
            {
                // Verify the file exists
                if ($file = Kohana::find_file('l10n', $file_path, NULL, FALSE))
                {
                    // NOTE: !! This included file MUST define a $localization array
                    include($file);
                    // NOTE: !! This included file MUST define a $localization array

                    // Set the string if the element exists, default to FALSE
                    $string = arr::path($localization, $path, FALSE);

                    // Keep this l10n array around for further use
                    self::$term_sets[$locale][$file_name] = $localization;
                }
            }

            // Check to see if the string is defined
            if($string)
            {
                // If a replacement array was provided use it, if not return the string as is.
                return empty($replacement_array) ? $string : strtr($string, $replacement_array);
            }
        }

        // We didn't find anything so return the default provided.
        // The default MAY be a boolean or array.
        // Its up to the code that called this to know what to todo if the text wasn't available.
        return $default;
	}

} // End L10n
