<?php
/**
 * ActiveRules Classification Object Abstract Class.
 *
 * @package    ActiveRules
 * @Classificationor     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Classification_Object extends  Activerules_Object
{
    // The meta object type
    final $meta_type = 'Classification';

    /**
     * Don't allow overriding object meta_type
     * @param string $meta_type
     */
    public function set_meta_type()
    {
       return FALSE;
    }


}
// End ActiveRules_Classification_Object abstract class