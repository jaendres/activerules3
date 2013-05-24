<?php
/**
 * ActiveRules Nugget Layout Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Nugget_Layout_Object extends  Activerules_Nugget_Object
{
    // The meta object type
    final $type = 'Layout';

    /**
     * Don't allow overriding object type
     */
    public function set_type()
    {
       return FALSE;
    }


}
// End ActiveRules_Nugget_Layout_Object abstract class