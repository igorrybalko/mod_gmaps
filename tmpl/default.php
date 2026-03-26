<?php
/**
 * @package mod_gmaps
 * @author Ihor Rybalko
 * @version 2.0.0
 * @copyright (C) 2026 https://webstep.top
 * @license GNU/GPL: https://www.gnu.org/licenses/gpl-3.0.html
 *
*/

\defined('_JEXEC') or die;

if(!$key){
	echo $error_message;
}
?>

<div id="<?php echo $mapId; ?>" class="gmaps<?php echo $moduleclass_sfx;?>" style="height: <?php echo $height;?>px"></div>
