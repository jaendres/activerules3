<?php if(ar::cv('head_logo')) { ?>
	<span class="logo_text"><a href="<?php ui::cv('root_url') ?>/"><img src="<?php ui::cv('head_logo') ?>"></a></span>
<?php } else { ?>
	<span class="largetext"><a href="<?php ui::cv('root_url') ?>/"><?php echo ar::cv('common_name') ?></a></span>
<?php } ?>
	<sup>BETA</sup>