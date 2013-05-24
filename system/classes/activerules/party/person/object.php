<?php
/**
 * ActiveRules Party Person Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Party_Person_Object extends  Activerules_Party_Object
{
    // The meta object type
    final $type = 'person';

    /**
     * Don't allow overriding object type
     */
    public function set_type()
    {
       return FALSE;
    }


}
// End ActiveRules_Party_Person_Object abstract class