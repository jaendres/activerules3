<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
echo '<div class="error">';
foreach(ar::core('errors') as $error)
{
   ___($error);

   echo '<br>';
}
echo '</div>';
?>
