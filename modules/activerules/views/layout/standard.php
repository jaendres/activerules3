<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */

// If this is an AJax request we only display the core template
if(Request::$is_ajax)
{
    echo View::factory(Page::core_template());
}
else
{
?>
<div id="header_container">
    <div id="header">
		<?php echo View::factory(_s('views.header', 'sections/header'))."\n"; ?>
	</div>
</div>
<div id="body_container">
	<div id="content_container">
		<div id="side-a">
			<?php echo View::factory(_s('views.menu', 'sections/menu'))."\n"; ?>
		</div>

		<div id="content">
			<?php echo Page::core_template(); exit;//View::factory(Page::core_template())."\n"; ?>
		</div>

		<div id="side-b">
			<?php echo View::factory(_s('views.sidebar', 'sections/charity_sidebar'))."\n"; ?>
		</div>
	</div>
	<div id="footer">
		<?php echo View::factory(_s('views.footer', 'sections/footer'))."\n"; ?>
	</div>
</div>

<?php
}
if(! Request::$is_ajax)
{
    echo View::factory('html/active_modal_div');
}
?>
