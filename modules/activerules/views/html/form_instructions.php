<?php
	$form = "\n\t".'<div class="form_instructions">';
	
	$form .= "\n\t<ul>";
	
	if(is_array($vdata['instructions']))
	{
		foreach($vdata['instructions'] as $instruction)
		{
			$form .= "\n\t\t<li>".$instruction.'</li>';
		}
	}
	elseif(is_string($vdata['instructions']))
	{
		$form .= "\n\t\t<li>".$vdata['instructions'].'</li>';	
	}
	
	$form .= "\n\t</ul>";
	
	$form .= "\n\t</div>";
	
	echo $form;
?>
