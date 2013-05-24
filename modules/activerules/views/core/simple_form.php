<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
// echo ar::core('simple_form_name');

// Load the correct form class
$form = ar::core('simple_form_object');

// Start with a NULL form string
$form_string = NULL;

// Create the containing div
$form_string .= "\n".'<div class="active_form">';

$form_string .= '<div>'.__($form->display_name).'</div>';

// write out some CSS overrides if they are set
if(isset($form->modal_style))
{
    $form_string .= "\n".'<style type="text/css">';
    $form_string .= '.active_modal { '.$form->modal_style.' }';
    $form_string .= '</style>';
}

//dbg::it($form->errors);
// If there are errors loop through and display them
if($form->errors OR $form->info)
{
    // Create a hidden div for the errors or messages
    $form_string .= "\n".'<div id="simple_form_messages">';

    if($form->errors)
    {
        // Display the errors header
        $form_string .= "\n".'<p>'.__('form.error').'</p>';

        // Start the error list
        $form_string .= "\n".'<ul>';

        // Loop through errors
        foreach($form->errors as $field => $errors)
        {
            // Each field can have an array of errors
            foreach($errors as $error_string)
            {
                $form_string .= "\n".'<li>'.$error_string.'</li>';
            }
        }

        // End the error list
        $form_string .= "\n".'</ol>';
    }

    // If there is info loop through and display each message
    if($form->info)
    {
        // Create a div with info class
        $form_string .= "\n".'<div class="info">';

        // Display the info header
        $form_string .= __('form.info');

        // Loop through info
        foreach($info as $field => $information)
        {
            // The information is defined as an l10n variable
            $form_string .= __($information);
        }

        // Close the info div
        $form_string .= "\n".'</div>';
    }

    // Close the message div
    $form_string .= "\n".'</div>';
}

// Create the form ID
$active_form_id = 'nugget_form_'.$form->uuid;

// Open the form
$form_string .= "\n".'<form name="'.$form->name.'" id="'.$active_form_id.'" action="'.__($form->action).'" method="'.$form->method.'">';

foreach($form->terms as $field_name => $definition)
{
    // Create different HTML based on form field input type
    switch($definition['input_type'])
    {
        case 'text':
        case 'password':
            $form_string .= "\n".'<div class="simple_form_field">';
            $form_string .= "\n".'<label for="'.$field_name.'">'.__($definition['label']).'</label><br>';
            if(isset($definition['html_options']))
            {
                $options = $definition['html_options'];
            }
            else
            {
                $options = NULL;
            }
            $form_string .= "\n".'<input type="'.$definition['input_type'].'" name="'.$field_name.'" value="'.$definition['value'].'" '.$options.' />';
            $form_string .= "\n".'</div>';
            break;

        case 'hidden':
            $form_string .= "\n".'<input type="hidden" name="'.$field_name.'" value="'.__($definition['value']).'" />';
            break;
    }
}

if(isset($form->controls))
{
    $form_string .= "\n".'<div class="simple_form_controls">';

    // Create the submit options
    foreach($form->controls as $control => $definition)
    {
        // Create different HTML based on form field input type
        switch($definition['input_type'])
        {
            case 'submit':
                if(Request::$is_ajax)
                {
                    $form_string .= "\n".'<input type="button" name="'.$control.'" value="'.__($definition['value']).'" onclick="javascript: active_form_submit(this.form);" />';
                }
                else
                {
                    $form_string .= "\n".'<input type="'.$definition['input_type'].'" name="'.$control.'" value="'.__($definition['value']).'" />';
                }
                break;

            default:
                break;
        }
    }

    $form_string .= "\n".'</div>';

    // Unset the last control to save memory.
    unset($control);
}

// Close the form
$form_string .= "\n".'</form>';

// Close the containing div
$form_string .= "\n".'</div>';

// Echo out the completed form
echo $form_string;

// logit('My Log message');

// Add an alternate locale
// L10n::add_alt_locale('en-ca');

// Add an alternate to the top of the alternates list
// L10n::add_preferred_alt_locale('es-us');

//___('signup_form.not_here', array(':form_name'=>ar::core('simple_form_name')), 'Good');

//echo ui::nada('simple_form_name');
?>
