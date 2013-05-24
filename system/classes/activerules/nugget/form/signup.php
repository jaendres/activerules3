<?php
/**
 * ActiveRules Nugget Form Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
class Activerules_Nugget_Form_Signup extends Activerules_Nugget_Form_Object
{
    // UUID for form
    public $uuid = '36b4cd00-9f7a-11e0-8264-0800200c9a66';

    // Form title / Legend
    public $display_name = 'signup_form.display_name';

    // Form action
    public $action = 'signup_form.action';

    // Form name
    public $name = 'signup_form';

    // A multidimensional ActiveRules term array
    public $terms = array(
        'username' => array(
            'input_type' => 'text',
            'html_options' => ' size="40" maxlength="40" ',
            'label' => 'account.username.label',
            'help' => 'account.username.help',
            'pre_transform' => array('trim', 'strtolower', 'safe'),
            'validation' => array(
                'optional' => FALSE,
                'range' => array(2,40),
                ),
            'post_transform' => array(),
            'value' => '',
        ),
        'password' => array(
            'input_type' => 'password',
            'html_options' => ' size="40" maxlength="500" ',
            'label' => 'account.password.label',
            'help' => 'account.password.help',
            'pre_transform' => array(), // Don't mess with Passwords
            'validation' => array(
                'optional' => FALSE,
                'min_length' => array(8),
                // No max needed because we hash it.
                ),
            'post_transform' => array(),
            'value' => '',
        ),
        'email_address' => array(
            'input_type' => 'text',
            'html_options' => ' size="40" maxlength="200" ',
            'label' => 'account.email_address.label',
            'help' => 'account.email_address.help',
            'pre_transform' => array('trim', 'strtolower'),
            'validation' => array(
                'optional' => FALSE,
                'email' => TRUE,
                ),
            'post_transform' => array(),
            'value' => '',
        )
    );

    // A multidimensional ActiveRules term array
    public $controls = array(
        'submit_button' => array(
            'input_type' => 'submit',
            'value' => 'signup_form.submit.value',
            )
        );

    // Array of errors
    public $errors = FALSE;

    // Array of info messages
    public $info = FALSE;

    // Multi dimensional array of instructions
    // $instructions[i]=array('title'=>'Instruction Title', 'detail'=>'Details for this step')
    public $instructions = NULL;

    // Multdimensional array of rules and validators
    // Maps form terms and request variables as input to libraries
    // The libraries should return PASS/FAIL or anything that can be similarly interpreted like True/False.
    // Sequence IS important
    public $rules = array(
        'account_available' => array(
            'class' => 'Activerules_Account',
            'method' => 'available',
            'params' => array(
                ''
            )
        )
    );

    // Array of actions to take
    public $actions = array();

    // Custom modal styling
    public $modal_style = ' width: 400px; ';

}
// End ActiveRules_Nugget_Webpage_Object abstract class