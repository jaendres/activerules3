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