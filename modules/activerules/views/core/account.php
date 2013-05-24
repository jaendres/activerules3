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
?>

   <script>
      // window.fbAsyncInit = function() {
           FB.getLoginStatus(function(response) {
              if (! response.session) {
                // no user session available
               active_modal('/active/fbregisterlogin');
                //alert('no');
                // no user session available, someon
              }
              else
                 {
                     // alert('yes');
                 }
           });
     //  };
   </script>
   <p id="userName"></p>

</div>
