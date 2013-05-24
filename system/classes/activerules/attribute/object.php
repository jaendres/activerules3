<?php
/**
 * ActiveRules Attribute Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Attribute_Object extends  Activerules_Object
{
    // The meta object type
    final $meta_type = 'Attribute';

    /**
     * Don't allow overriding object meta_type
     * @param string $meta_type
     */
    public function set_meta_type()
    {
       return FALSE;
    }


}
// End ActiveRules_Attribute_Object abstract class