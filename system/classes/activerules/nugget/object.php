<?php
/**
 * ActiveRules Nugget Object Abstract Class.
 *
 * @package    ActiveRules
 * @Nuggetor     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Nugget_Object extends  Activerules_Object
{
    // The meta object type
    public $meta_type = 'nugget';

    /**
     * Don't allow overriding object meta_type
     * @param string $meta_type
     */
    public function set_meta_type($type)
    {
       return FALSE;
    }


}
// End ActiveRules_Nugget_Object abstract class