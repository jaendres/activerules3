<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
?>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js#appId=<?php echo Site::conf('facebook.app_id') ?>&xfbml=1&async=1"></script>

<script>
<!--
function publishWallPost(slug) {
    var attachment = {'name':'My Super Cool Website','description':'This is a test of the Facebook Broadcast System.  If this was real, you would be reading something useful.','media':[{'type':'image','src':'http://MySuperCoolWebsite.com/images/facebook_image.png','href':'http://www.MySuperCoolWebsite.com/' + slug + '/'}]};
    FB.ui({
        method: 'stream.publish',
        message: 'I just found this Super Cool Website!',
        attachment: attachment,
        user_message_prompt: 'post this to your wall?',
        
    });
}
//-->
</script>

<script>
window.fbAsyncInit = function() {
    FB.init({appId: '<?php echo Site::conf('facebook.app_id') ?>', status: true, cookie: true, xfbml: true});
        };
    (function() {
        var e = document.createElement('script'); e.async = true; e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
</script>

<a href="#" onclick="publishWallPost('{{ page.slug }}')"> Post to Facebook </a>
