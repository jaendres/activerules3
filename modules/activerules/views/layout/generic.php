<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
echo View::factory(Page::get_page_data('core_template'));

if(! Request::$is_ajax)
{
    echo View::factory('html/active_modal_div');
}
?>
