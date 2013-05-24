<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */

// If this is an AJax request we only display the core template
if(Request::$is_ajax)
{
    echo View::factory(Page::get_page_data('core_template'));
}
else
{
?>
<div id="wrapper">
	<div id="header">
		<?php echo View::factory(Site::conf('views.header', 'sections/header'))."\n"; ?>
	</div>
	<div id="container">

		<div id="content">
			<?php echo View::factory(Page::get_page_data('core_template'))."\n"; ?>
		</div>

	</div>
	<div id="footer">
		<?php echo View::factory(Site::conf('views.footer', 'sections/footer'))."\n"; ?>
	</div>
</div>

<?php
}
if(! Request::$is_ajax)
{
    echo View::factory('html/active_modal_div');
}
?>
