<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
?>
<div class="core_content">

    <p>Registration Required.</p>

    <p><a href="#" onclick="close_active_modal();">Close</a></p>

    <div id="fb-root"></div>
<script type="text/javascript">

      window.fbAsyncInit = function() {

        FB.init({appId:<?php __s('facebook.app_id') ?>, status: true, cookie: true, xfbml: true});

              /* All the events registered */
         FB.Event.subscribe('auth.login', function(response) {
             // do something with response
             close_active_modal();
         });
    };
    (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
    }());
</script>

<fb:login-button
<?php
echo "\n";
if(Site::conf('facebook.registration.active', FALSE))
{
    echo ' registration-url="'.Site::conf('base').'/register/" '."\n";
}
if($perms = Site::conf('facebook.login.perms', FALSE))
{
    echo ' perms="'.implode(',', $perms).'" />'."\n";
}
 ___('facebook_app.login_w_facebook') ?>
</fb:login-button>


</div>
