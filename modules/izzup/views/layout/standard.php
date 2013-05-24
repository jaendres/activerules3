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
<header>
    <?php echo View::factory(_s('views.header', 'sections/header'))."\n"; ?>
</header>
<nav>
    <!-- Navigation -->
    <?php echo View::factory(_s('views.navigation', 'sections/navigation'))."\n"; ?>
</nav>

    <?php echo View::factory(_p('core_template'))."\n"; ?>

<footer>
    <!-- Footer -->
    <?php echo View::factory(Site::conf('views.footer', 'sections/footer'))."\n"; ?>
</footer>
<?php
}
if(! Request::$is_ajax)
{
    echo View::factory('html/active_modal_div');
}
?>
