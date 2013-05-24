<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
?>
<div class="core_content">


<div id="fb-root"></div>
<script type="text/javascript">

    function login()
    {
        //alert('login');
    }

    function logout()
    {
        //alert('logout');
    }

    function post()
    {
        FB.getLoginStatus(function(response) {
             if(response.status == 'notConnected' || response.status == 'unknown')
             {
                 active_modal('/active/regrequired');
             }
             else
             {
                 active_modal('/active/form/post');
             }
         });
    }

    window.fbAsyncInit = function() {
        FB.init({appId:<?php __s('facebook.app_id') ?>, status: true, cookie: true, xfbml: true});

             /* All the events registered */
         FB.Event.subscribe('auth.login', function(response) {
             // do something with response
             login();
         });
         FB.Event.subscribe('auth.logout', function(response) {
             // do something with response
             logout();
         });

         FB.getLoginStatus(function(response) {
             if (response.session) {
                 // logged in and connected user, someone you know
                 login();
             }
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

<button onClick="post();">Post</button>