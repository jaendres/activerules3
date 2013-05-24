<?php defined('SYSPATH') or die('No direct script access.');
/**
 * ActiveRules CSS file includes
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2010 Ultri - Brian Winkers
 */
    echo "\n";

    if(Site::conf('in_production', FALSE))
    {
        echo '<link rel="stylesheet" type="text/css" href="http://c3269252.r52.cf0.rackcdn.com/activerules/css/activerules.css" />';
        echo "\n".'<link rel="stylesheet" type="text/css" href="http://c3269252.r52.cf0.rackcdn.com/activerules/css/color/'.Site::conf('web_include.color_css').'" />';
    }
    else
    {
        echo '<link rel="stylesheet" type="text/css" href="/static/css/'.Page::get_page_data('layout_css').'" />';
        echo "\n".'<link rel="stylesheet" type="text/css" href="/static/css/color/'.Site::conf('web_include.color_css').'" />';
    }

    if($override = Page::css_override())
    {
        echo View::factory($override)->render();
    }
?>