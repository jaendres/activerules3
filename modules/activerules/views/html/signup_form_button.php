<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Create a signup button.
 * This will open a modal with the signup form.
 * If the browser doesn't support JS the buitton will send them to the Active form controller.
 *
 * @package    ActiveRules
 * @package	   Site
 * @author     Brian Winkers
 * @copyright  (c) 2005-2009 Ultri - Brian Winkers
 */
?>
<button type="button" class="active_modal_trigger" onclick="active_modal('/active/form/signup');" class="active_modal_trigger"><?php ___('signup.button_text') ?></button>