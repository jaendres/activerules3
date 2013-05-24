<?php
/**
 * ActiveRules Event Object Abstract Class.
 *
 * @package    ActiveRules
 * @Eventor     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Event_Object extends  Activerules_Object
{
    // The meta object type
    final $meta_type = 'Event';

    /**
     * Don't allow overriding object meta_type
     * @param string $meta_type
     */
    public function set_meta_type()
    {
       return FALSE;
    }


}
// End ActiveRules_Event_Object abstract class