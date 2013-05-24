<?php
/**
 * ActiveRules Party Organization Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Party_Organization_Object extends  Activerules_Party_Object
{
    // The meta object type
    final $type = 'Organization';

    /**
     * Don't allow overriding object type
     */
    public function set_type()
    {
       return FALSE;
    }


}
// End ActiveRules_Party_Organization_Object abstract class