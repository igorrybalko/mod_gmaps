<?php
	defined('_JEXEC') or die;
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&language=<?php echo $lang; ?>"></script>

<script>
    function initialize() {
        var myLatlng = new google.maps.LatLng(<?php echo $breadth . ", " . $longitude; ?>);
        var mapOptions = {
            zoom: <?php echo $zoom; ?>,
            center: myLatlng,
            scrollwheel: false, 
            mapTypeControl: false
        }
        var map = new google.maps.Map(document.getElementById('map<?php echo $correct . "_id_" . $modyle_id ?>'), mapOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'maps',
            icon: '<?php echo $icon; ?>'
        });
        var contentString = '<?php echo $desc; ?>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
         });         
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<style>
    .gmaps_h{
        height: 220px;
    }
</style>

<div class="gmaps<?php echo $moduleclass_sfx;?>">
	<div id="map<?php echo $correct.'_id_'.$modyle_id ?>" class="gmaps_h"></div>
</div>