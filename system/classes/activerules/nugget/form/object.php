<?php
/**
 * ActiveRules Nugget Form Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Nugget_Form_Object extends  Activerules_Nugget_Object
{
    // The meta object type
    public $type = 'form';

    // The object attributes
    public $attributes = array('legend','action','terms','instructions','rules','errors','info','actions');

    // Form title / Legend
    protected $legend;

    // Form action
    protected $action;

     // Form action
    public $method = 'POST';

    // A multidimensional ActiveRules term array
    protected $terms = array();

    // Multi dimensional array of instructions
    // $instructions[i]=array('title'=>'Instruction Title', 'detail'=>'Details for this step')
    protected $instructions = NULL;

    // Multdimensional array of rules and validators
    protected $rules = array();

    // Array of errors
    protected $errors = FALSE;

    // Array of info mesages
    protected $info = FALSE;

    // Array of actions to take
    protected $actions = array();

    /**
     * Don't allow overriding object type
     */
    public function set_type($type)
    {
       return FALSE;
    }

    /**
     * Apply transforms and set values
     *
     * @param <type> $data
     */
    public function validate()
    {
        $has_errors = FALSE;

        // Loop through the form objects terms.
        // Assign the POST values to the matching object term values.
        foreach($this->terms as $term => $definition)
        {
           if(isset($definition['validation']))
           {
               // If the optional attribute isn't FALSE the field MUST be populated
               $optional = Arr::get($definition['validation'], 'optional');

               if(! $optional)
               {
                   if(!isset($definition['value']) OR strlen($definition['value']) < 1)
                   {
                       // Add an error to this term form field using it's label
                       $this->errors[$term][] = __('form.required', array(':field_label'=>__($definition['label'])));

                       $has_errors = TRUE;
                   }
               }

               foreach($definition['validation'] as $validator => $option)
               {
                   switch($validator)
                   {
                       case 'optional':
                           break;

                       default:
                           break;
                   }
               }
           }
        }

        if($has_errors)
        {
            return FALSE;
        }

        return TRUE;
        
    }

    /**
     * Apply transforms and set values
     *
     * @param <type> $data
     */
    public function active_rules()
    {
        // Loop through the form objects terms.
        // Assign the POST values to the matching object term values.
        foreach($this->terms as $term => $definition)
        {
        
        }

        return TRUE;
    }

    /**
     * Apply transforms and set values
     *
     * @param <type> $data
     */
    public function business_processes()
    {
        // Loop through the form objects terms.
        // Assign the POST values to the matching object term values.
        foreach($this->terms as $term => $definition)
        {

        }

        return TRUE;
    }

    /**
     * Apply transforms and set values
     *
     * @param <type> $data
     */
    public function pre_process($data)
    {
        // Loop through the form objects terms.
        // Assign the POST values to the matching object term values.
        foreach($this->terms as $term => $definition)
        {
            // Get the value from POST
            $term_value = Arr::get($data, $term);

            // If there is a value use it
            if($term_value)
            {
                // Apply any pre validation transforms
                if(isset($definition['pre_transform']))
                {
                    foreach($definition['pre_transform'] as $method)
                    {
                        $term_value = $this->process_transform($method, $term_value);
                    }
                }

                // Set the term value
                $this->terms[$term]['value'] = $term_value;
            }
        }
    }

    /**
     * Apply any post transforms
     *
     * @param <type> $data
     */
    public function post_process()
    {
        // Loop through the form objects terms.
        // Assign the POST values to the matching object term values.
        foreach($this->terms as $term => $definition)
        {
            // Apply any post validation transforms
            if(isset($definition['post_transform']))
            {
                foreach($definition['post_transform'] as $method)
                {
                    $term_value = $this->process_transform($method, $definition['value']);

                    // Set the term value
                    $this->terms[$term]['value'] = $term_value;
                }
            }
        }
    }

    /**
     * Process a simple transform, we don't take any options.
     * You need options? Create wrapper methods.
     *
     * Transforms modify strings 
     */
    public static function process_transform($method, $data)
    {
        if (strpos($method, '::') === FALSE)
        {
            // Use a function call
            $function = new ReflectionFunction($method);

            // Call $function() with Reflection
            $data = $function->invokeArgs(array($data));
        }
        else
        {
            // Split the class and method of the rule
            list($class, $method) = explode('::', $method, 2);

            // Use a static method call
            $method = new ReflectionMethod($class, $method);

            // Call $Class::$method() with Reflection
            $data = $method->invokeArgs(NULL, $data);
        }

        return $data;
    }

    /**
     *
     */
    public function ajax_output()
    {
        foreach($this->terms AS $term => $data)
        {
            $out['terms'][$term]['value'] = $data['value'];

            if(isset($this->errors['$term']))
            {
                 $out['terms'][$term]['class'] = 'error';
            }
        }
 
        return ($out);
    }
}



// End ActiveRules_Nugget_Webpage_Object abstract class