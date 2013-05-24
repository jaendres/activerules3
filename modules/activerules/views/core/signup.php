<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
?>
<div class="core_content">
<h1><?php ___('signup.headline'); ?></h1>

<div class="headline">
   <?php ___('signup.benefits.headline'); ?>
</div>
<ul>
    <?php
        foreach(__('signup.benefits.list') as $item)
        {
            echo '<li>'.$item.'</li>';
        }
    ?>
</ul>

<?php echo View::factory('html/signup_form_button'); ?>
</div>
