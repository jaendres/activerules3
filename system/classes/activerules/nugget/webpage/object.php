<?php
/**
 * ActiveRules Nugget Webpage Object Abstract Class.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2011 Ultri Group LLC - Brian Winkers
 */
abstract class Activerules_Nugget_Webpage_Object extends  Activerules_Nugget_Object
{
    // The meta object type
    final $type = 'webpage';

    protected $title;

    // HTML META Tags
    protected $meta = array();

    // Dublin Core, yes that still exists.
    protected $dc = array();

    protected $head_css = array();

    protected $head_js = array();

    protected $layout;

    protected $core;

    /**
     * Don't allow overriding object type
     */
    public function set_type()
    {
       return FALSE;
    }

}
// End ActiveRules_Nugget_Webpage_Object abstract class