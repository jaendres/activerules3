<?php
/**
 * ActiveRules Nugget Form Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
class Activerules_Nugget_Form_Post extends Activerules_Nugget_Form_Object
{
    // UUID for form
    public $uuid = '36b4cd00-9f7a-11e0-4353-0800200c9a66';

    // Form title / Legend
    public $display_name = 'blog.post.display_name';

    // Form action
    public $action = 'blog.post.action';

    // Form name
    public $name = 'blog_post_form';

    // A multidimensional ActiveRules term array
    public $terms = array(
        'title' => array(
            'input_type' => 'text',
            'html_options' => ' size="40" maxlength="40" ',
            'label' => 'blog.post.title.label',
            'help' => 'blog.post.title.help',
            'pre_transform' => array('trim', 'strtolower', 'safe'),
            'validation' => array(
                'optional' => FALSE,
                'range' => array(2,40),
                ),
            'post_transform' => array(),
            'value' => '',
        ),
        'body' => array(
            'input_type' => 'password',
            'html_options' => ' size="40" maxlength="500" ',
            'label' => 'blog.post.body.label',
            'help' => 'blog.post.body.help',
            'pre_transform' => array(), // Don't mess with Passwords
            'validation' => array(
                'optional' => FALSE,
                'min_length' => array(8),
                // No max needed because we hash it.
                ),
            'post_transform' => array(),
            'value' => '',
        ),
    );

    // A multidimensional ActiveRules term array
    public $controls = array(
        'submit_button' => array(
            'input_type' => 'submit',
            'value' => 'blog.post.submit.value',
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
// End ActiveRules_Nugget_Form_Post abstract class