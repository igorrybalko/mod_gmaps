<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
	
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$breadth = htmlspecialchars(trim($params->get('breadth')));
$longitude = htmlspecialchars(trim($params->get('longitude')));
$zoom = htmlspecialchars(trim($params->get('zoom')));
$desc = htmlspecialchars(trim($params->get('desk')));
$language = JFactory::getLanguage();
$lang = substr($language->getTag(), 0, 2);

$module_info = JModuleHelper::getModule('mod_gmaps');
$modyle_id = $module_info->id;
$correct = rand(1,1000);
$icon = '/modules/mod_gmaps/tmpl/img/marker.png';

if( is_numeric($zoom) == false || intval($zoom) < 1 ){
    $zoom = 14;
}
else{
	$zoom = intval($zoom);
}

if( is_numeric($breadth) == false){
    $breadth = 50.4472746;
}
if( is_numeric($longitude) == false){
    $longitude = 30.5236766;
}

require JModuleHelper::getLayoutPath('mod_gmaps', $params->get('layout', 'default'));