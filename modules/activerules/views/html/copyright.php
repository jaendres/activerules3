<?php
	if($first_year = Site::conf('copyright.first_year', FALSE))
	{
		echo '<span class="smallprint">&copy; '.Site::conf('copyright.first_year').'&ndash;'.date('Y').' '.Site::conf('copyright.holder', Site::conf('name')).' &mdash; '.__('sitewide.all_rights_reserved').'</span>';
	}
    else
    {
        echo '<span class="smallprint">&copy; '.date('Y').' '.Site::conf('copyright.holder', Site::conf('name')).' &mdash; '.__('sitewide.all_rights_reserved').'</span>';
    }
?>
