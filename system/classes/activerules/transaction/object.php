<?php
/**
 * ActiveRules Transaction Object Abstract Class.
 *
 * @package    ActiveRules
 * @Transactionor     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Transaction_Object extends  Activerules_Object
{
    // The meta object type
    final $meta_type = 'Transaction';

    /**
     * Don't allow overriding object meta_type
     * @param string $meta_type
     */
    public function set_meta_type()
    {
       return FALSE;
    }
}
// End ActiveRules_Transaction_Object abstract class