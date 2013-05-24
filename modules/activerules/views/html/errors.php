<?php
	if(!empty($extra['error_text']))
	{
		$out = "\n\t".'<div class="form_errors">';
		$out .= "\n\t\t".'<ul>';
		foreach($extra['error_text'] as $field => $error_text)
		{
			foreach($error_text as $error => $text)
			{
				$out .= "\n\t\t\t<li>".$text.'</li>';
			} 
		}
		$out .= "\n\t\t</ul>";
		$out .= "\n\t</div>";
		
		echo $out;
	}
?>
