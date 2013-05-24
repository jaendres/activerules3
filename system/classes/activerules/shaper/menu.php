<?php
/**
 * project ActiveRules
 *
 * copyright 2011 Ultri Group LLC
 */
class Activerules_Shaper_Menu extends Activerules_Shaper
{
	/**
	 * Shape the data
	 */
	private function _shape($data)
	{
		$out = array();

		foreach($data as $ix => $row)
		{
			$out[] = $row;
		}

		return $out;
	}
}
?>
