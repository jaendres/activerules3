<fb:login-button
<?php
echo "\n";
if(Site::conf('facebook.login.registration', FALSE))
{
    echo ' registration-url="'.Site::conf('base').'/register/" '."\n";
}
if($perms = Site::conf('facebook.login.perms', FALSE))
{
    echo ' perms="'.implode(',', $perms).'" '."\n";
}
?>
on-login="top.location = '<?php echo Site::conf('base')?>' "/>
<?php ___('facebook_app.login_w_facebook') ?>
</fb:login-button>
