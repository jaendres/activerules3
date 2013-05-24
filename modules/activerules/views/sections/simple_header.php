<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if($img = _s('media.logo.name', FALSE))
{
    echo '<span class="lalign sitename"><a href="/"><img src="'.$img.'"></a></span>';
}
else
{
    echo '<span class="lalign sitename"><a href="/">'.Site::conf('name').'</a></span>';
}

?>
