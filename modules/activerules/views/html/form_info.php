<?php
	// Show form instructions or errors
	if(empty($extra['error_text']))
	{
		if($core['formal_instructions'])
		{
			echo '<div class="msg">';
			
			$local['vdata']['instructions'] = Kohana::lang(Former_Lib::text($form_name, 'instructions'), $form_name);
			
			View::factory('html/form_instructions', $local)->render(TRUE);
			
			echo '</div>';
		}
	} 
	else
	{
		echo '<div class="msg">';
		
		View::factory('html/errors')->render(TRUE);	
		
		echo '</div>';
	}
?>
