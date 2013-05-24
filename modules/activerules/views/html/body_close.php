	<?php defined('SYSPATH') or die('No direct script access.');
/**
 *	HTML BODY close tag
 *
 * @package    ActiveRules
 * @package	   Site
 * @author     Brian Winkers
 * @copyright  (c) 2005-2009 Ultri - Brian Winkers
 */
	echo "\n"; 
	// Include the Google Tracking code
 	View::factory('html/ga_tracking_code')->render(); 
?>
</body>