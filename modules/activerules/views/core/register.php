<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
?>
<div class="core_content">
<h1><?php ___('register.headline'); ?></h1>

<?php 
    echo View::factory('html/facebook_enable_xfbml')->render();
    echo View::factory('html/facebook_registration_xfbml')->render();
?>

</div>
