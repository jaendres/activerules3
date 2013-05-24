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
             if(response.status == 'notConnected')
             {
                 active_modal('/active/fbregister');
             }
         });
    }

    window.fbAsyncInit = function() {
        FB.init({appId:<?php __s('facebook.app_id') ?>, status: true, cookie: true, xfbml: true});
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

<fb:registration
  fields="<?php echo Site::conf('facebook.registration.fields', 'name,email') ?>"
  <?php
    if(Site::conf('facebook.registration.fb_only', TRUE))
    {
        echo 'fb_only="true"';
    }
  ?>
  redirect-uri="<?php echo Site::conf('facebook.site_url').'register/success/'?>"
  width="530">
</fb:registration>
