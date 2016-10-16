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

require_once dirname(__FILE__) . '/helper.php';

$i = 0;	
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$breadthCent = htmlspecialchars(trim($params->get('breadth_cent')));
$longitudeCent = htmlspecialchars(trim($params->get('longitude_cent')));
$zoom = htmlspecialchars(trim($params->get('zoom')));
$height = (int) htmlspecialchars(trim($params->get('height')));
$info = json_decode($params->get('items'), 1);
$key = htmlspecialchars(trim($params->get('key')));

$language = JFactory::getLanguage();
$lang = substr($language->getTag(), 0, 2);

$scriptSource = "https://maps.googleapis.com/maps/api/js?key=" . $key . "&language=" . $lang; 

$doc = JFactory::getDocument();
$doc->addScript($scriptSource);

$correct = rand(1,1000);
$icon = '/modules/mod_gmaps/img/marker.png';

if(!$height){
    $height = 300;
}

$error_message = JText::_('MOD_GMAPS_ERROR') . ' <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/">https://developers.google.com/maps/documentation/javascript/</a>';

if( !is_numeric($zoom) || intval($zoom) < 1 ){
    $zoom = 14;
}

if( !is_numeric($breadthCent)){
    $breadthCent = 50.4472746;
}
if( !is_numeric($longitudeCent)){
    $longitudeCent = 30.5236766;
}

if($info){
    $items = gMapsModHelper::convert($info);
    if(count($items) == 1){
        $breadthCent = $items[0]['breadth'];
        $longitudeCent = $items[0]['longitude'];
    }
}else{
    $items = array();
    $items[0]["breadth"] = $breadthCent;
    $items[0]["longitude"] = $longitudeCent;
    $items[0]["desc"] = '';
}
?>

<script>

    function initializegmap<?php echo $correct;?>() {
        var ukCent = new google.maps.LatLng(<?php echo $breadthCent . ', ' . $longitudeCent;?>);
        var mapOptions = {
            zoom: <?php echo intval($zoom); ?>,
            center: ukCent,
            scrollwheel: false,
            mapTypeControl: false
        }
        var map = new google.maps.Map(document.getElementById('map<?php echo $correct ?>'), mapOptions);

        <?php foreach($items as $item){
            $i++;
        ?>

        var markerType = new google.maps.MarkerImage(
            '<?php echo $icon?>',
            new google.maps.Size(22,40),
            new google.maps.Point(0,0),
            new google.maps.Point(11,40)
        );

        var myLatlng<?php echo $i; ?> = new google.maps.LatLng(<?php echo $item['breadth']. " , " . $item['longitude']; ?>);
        var marker<?php echo $i; ?> = new google.maps.Marker({
            position: myLatlng<?php echo $i; ?>,
            map: map,
            title: 'maps',
            icon: markerType
        });

        var contentString<?php echo $i; ?> = '<?php echo $item['desc']; ?>';

        var infowindow<?php echo $i; ?> = new google.maps.InfoWindow({
            content: contentString<?php echo $i; ?>
        });

        marker<?php echo $i; ?>.addListener('click', function() {
            infowindow<?php echo $i; ?>.open(map, marker<?php echo $i; ?>);
        });
        <?php } ?>

    }
    google.maps.event.addDomListener(window, 'load', initializegmap<?php echo $correct;?>);

</script>
<?php
require JModuleHelper::getLayoutPath('mod_gmaps', $params->get('layout', 'default'));