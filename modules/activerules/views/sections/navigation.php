<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$nav_elements = _s('main_navigation');

$menu = '<ul>'."\n";
foreach($nav_elements as $element => $data)
{
    if($element != _e('selected_nav'))
    {
        $class = NULL;
    }
    else
    {
        $class = ' class="selected"';
    }
    $menu .= '<li '.$class.'><a href="'.$data['url'].'">'.__($data['label']).'</a></li>'."\n";
}

$menu .= '</ul>'."\n";

echo "\n".$menu; 
?>
