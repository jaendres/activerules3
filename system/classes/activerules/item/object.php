<?php
/**
 * ActiveRules Item Object Abstract Class.
 *
 * @package    ActiveRules
 * @Itemor     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Item_Object extends  Activerules_Object
{
    // The meta object type
    final $meta_type = 'Item';

    /**
     * Don't allow overriding object meta_type
     * @param string $meta_type
     */
    public function set_meta_type()
    {
       return FALSE;
    }


}
// End ActiveRules_Item_Object abstract class