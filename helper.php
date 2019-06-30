<?php 
/**
 * @package mod_gmaps
 * @author Rybalko Igor
 * @version 1.2.0
 * @copyright (C) 2019 https://greencomet.net
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class gMapsModHelper {
	public static function convert($items){
	    $converted = array();
	    foreach ($items as $key => $item) {
	        foreach ($item as $partkey => $value) {
	            $converted[$partkey][$key] = $value;
	        }
	    }
	    return $converted;
	}
}