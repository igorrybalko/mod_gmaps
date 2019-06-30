<?php
/**
 * @package mod_gmaps
 * @author Rybalko Igor
 * @version 1.2.0
 * @copyright (C) 2019 https://greencomet.net
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/

defined('_JEXEC') or die;

if(!$key){
	echo $error_message;
}
?>

<div class="gmaps<?php echo $moduleclass_sfx;?>">
	<div id="map<?php echo $correct; ?>" class="gmaps_h" style="height: <?php echo $height;?>px"></div>
</div>

