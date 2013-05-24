<?php defined('SYSPATH') or die('No direct script access.');
/**
 *	GA Tracking code
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri - Brian Winkers
 * 
 * Provides the JS required to enabled Google Analytics Tracking.
 * Uses site.ga_tracking_method to determine what sort of tracking to use:
 * 
 * OPTIONS
 *	
 * 	single domain (single)
 *  
 *  multiple domains (multi)
 *  
 *  subdomains of a single TLD (subdomains). 
 *  Subdomains require site.primary_domain to be set correctly.
 *  
 * 
 */
switch(AR::cv('ga_tracking_method'))
{
	case 'single': ?>

<!-- Track a single Domain -->		
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("<?= AR::cv('ga_tracking_code') ?>");
pageTracker._trackPageview();
} catch(err) {}</script>
			
<?php
	break;
				
	case 'subdomains': ?>

<!-- Track Multiple Subdomains within a single TLD -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("<?= ar::cv('ga_tracking_code') ?>");
pageTracker._setDomainName(".<?= ar::cv('ga_primary_domain') ?>");
pageTracker._trackPageview();
} catch(err) {}</script>
			
<?php
	break;
				
	case 'multi': ?>

<!-- Track Multiple Domains -->		
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("<?= ar::cv('ga_tracking_code') ?>");
pageTracker._setDomainName("none");
pageTracker._setAllowLinker(true);
pageTracker._trackPageview();
} catch(err) {}</script>
			
<?php
	break;
	
default:
	break;
	}
?>
