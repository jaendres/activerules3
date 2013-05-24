<?php defined('SYSPATH') or die('No direct script access.');
/**
 * ActiveRules CSS file includes
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri - Brian Winkers
 */
    echo "\n";

    if(Site::conf('facebook.like.active', FALSE))
    {
        echo '<iframe src="http://www.facebook.com/plugins/like.php?href='.Site::conf('facebook.like.active', FALSE).'"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>';
    }
?>
