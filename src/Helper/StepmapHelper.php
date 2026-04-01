<?php
/**
 * @package mod_stepmap
 * @author Ihor Rybalko
 * @version 2.0.1
 * @copyright (C) 2026 https://webstep.top
 * @license GNU/GPL: https://www.gnu.org/licenses/gpl-3.0.html
 *
*/

namespace Webstep\Module\Stepmap\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class StepmapHelper {
	public static function convert($items){
	    $converted = [];
	    foreach ($items as $item) {
	      
	            $converted[] = [
					'lat' => $item->lat,
					'lng' => $item->lng,
					'desc' => $item->desc,
				];
	        
	    }
	    return $converted;
	}
}