<?php
/**
 * Basic Izzup Menu Shaper library.
 *
 * @package    ActiveRules
 * @author     Brian Winkers
 * @copyright  (c) 2005-2011 Ultri - Brian Winkers
 */
class Activerules_Shaper_Izzup_Menu_Basic
{
	public function __construct($data, $map=FALSE)
	{
		return $this->_shape($data, $map);
	}

	/**
	 * Shape the data
     * This provides basic key mapping capabilities.
     * This may be extended with far more complex shapers
	 */
	private function _shape($data, $map)
	{
		$out = array();

        // Loop through data
		foreach($data as $ix => $row)
		{
			// If the data's key has a mapping change the output key to the value of the mapped key
            if($map AND array_key_exists($ix, $map))
            {
                $out[$map[$ix]] = $row;
            }
            else
            {
                // Just reassign the value to the same key in the output array
                $out[$ix] = $row;
            }
		}

		return $out;
	}
}
