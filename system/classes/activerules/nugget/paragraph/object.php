<?php
/**
 * ActiveRules Nugget Paragraph Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Nugget_Paragraph_Object extends  Activerules_Nugget_Object
{
    // The meta object type
    final $type = 'Paragraph';

    /**
     * Don't allow overriding object type
     */
    public function set_type()
    {
       return FALSE;
    }


}
// End ActiveRules_Nugget_Paragraph_Object abstract class