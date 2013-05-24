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
        echo '<iframe src="http://www.facebook.com/plugins/like.php?
            app_id='.Site::conf('facebook.app_id').'&amp;
            href='.urlencode(Site::conf('facebook.site_url')).'&amp;
            send='.Site::conf('facebook.like.send', 'false').'&amp;
            layout='.Site::conf('facebook.like.layout', 'standard').'&amp;
            width='.Site::conf('facebook.like.layout', '450').'&amp;
            show_faces='.Site::conf('facebook.like.show_faces').'&amp;
            action=like&amp;
            colorscheme='.Site::conf('facebook.like.colorscheme').'&amp;
            font&amp;
            height=50"
            scrolling="no"
            frameborder="0"
            style="border:none; overflow:hidden; width:'.Site::conf('facebook.like.layout', '450').'px; height:50px;"
            allowTransparency="true">
            </iframe>';
    }
?>


