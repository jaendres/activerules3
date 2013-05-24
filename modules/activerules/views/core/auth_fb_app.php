<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
echo View::factory('html/facebook_enable_xfbml')->render();
?>
<script>
    FB.init({
        appId  : <?php __c('app_id')?>,
        status : true, // check login status
        cookie : true, // enable cookies to allow the server to access the session
        xfbml  : true  // parse XFBML
    });
    FB.getLoginStatus(function(response) {
    if (! response.session) {
    // no user session available, someone you dont know
    top.location.href = "https://www.facebook.com/dialog/oauth?client_id=<?php echo Page::get_core_data('app_id') ?>&redirect_uri=<?php echo Page::get_core_data('app_canvas_url') ?>" ;
    }
});
</script>
<div class="core_content">
<p>
<a target="_blank" href="http://facebook.com/add.php?api_key=<?php __c('app_id')?>&pages=1&page=221496891218703 ">PAGE NAME</a><br/>
<a href="https://www.facebook.com/connect/uiserver.php?app_id=<?php __c('app_id')?>&method=permissions.request&display=page&next=<?php __c('app_canvas_url')?>&response_type=code&canvas=1"><?php ___('facebook_app.auth_app', array(':app_name'=>Page::get_core_data('app_name'))); ?></a></p>
</p>
<p><a href="https://www.facebook.com/dialog/oauth?client_id=<?php echo Page::get_core_data('app_id') ?>&redirect_uri=<?php echo Page::get_core_data('app_canvas_url') ?>"><?php ___('facebook_app.auth_app', array(':app_name'=>Page::get_core_data('app_name'))); ?></a></p>
</div>
