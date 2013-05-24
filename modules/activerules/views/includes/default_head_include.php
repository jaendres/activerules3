<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Include JS and CSS views
 *
 * @package    ActiveRules
 * @package	   Site
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri - Brian Winkers
 */
$out = '';

// Google Hosted jQuery and jQuery UI
$out .= View::factory('html/google_jquery_ui')->render();

// Google Hosted jQuery and jQuery UI
$out .= View::factory('html/active_js')->render();

// ActiveRules CSS file includes
//$out .= View::factory('html/active_css')->render();

// ActiveRules Former class support files
$out .= View::factory('html/jquery_document_ready')->render();

// Google Hosted jQuery and jQuery UI
$out .= View::factory('html/active_css')->render();

echo $out;