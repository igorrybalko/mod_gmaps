<?php
/**
 * @package mod_gmaps
 * @author Ihor Rybalko
 * @version 2.0.0
 * @copyright (C) 2026 https://webstep.top
 * @license GNU/GPL: https://www.gnu.org/licenses/gpl-3.0.html
 *
*/

namespace Webstep\Module\Gmaps\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class GMapsHelper {
	public static function convert($items){
	    $converted = [];
	    foreach ($items as $item) {
	      
	            $converted[] = [
					'lat' => (float)$item->lat,
					'lng' => (float)$item->lng,
					'desc' => $item->desc,
				];
	        
	    }
	    return $converted;
	}
}