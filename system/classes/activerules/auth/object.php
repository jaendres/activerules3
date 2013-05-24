<?php
/**
 * ActiveRules Auth Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Auth_Object extends  Activerules_Object
{
    // The meta object type
    final $meta_type = 'Auth';

    /**
     * Don't allow overriding object meta_type
     * @param string $meta_type
     */
    public function set_meta_type()
    {
       return FALSE;
    }


}
// End ActiveRules_Auth_Object abstract class