<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
?>
<div class="core_content">
<h1><?php ___('login.headline'); ?></h1>


<?php
    echo View::factory('html/facebook_enable_xfbml')->render();
    echo View::factory('html/facebook_login_xfbml')->render();
?>

</div>
