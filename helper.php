<?php 
/**
 * @package mod_gmaps
 * @author Rybalko Igor
 * @version 1.1
 * @copyright (C) 2016 http://wolfweb.com.ua
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

function convert($items)
{
    $converted = array();
    foreach ($items as $key => $item) {
        foreach ($item as $partkey => $value) {
            $converted[$partkey][$key] = $value;
        }
    }
    return $converted;
}