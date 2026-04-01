<?php
/**
 * @package mod_stepmap
 * @author Ihor Rybalko
 * @version 2.0.1
 * @copyright (C) 2026 https://webstep.top
 * @license GNU/GPL: https://www.gnu.org/licenses/gpl-3.0.html
 *
*/

namespace Webstep\Module\Stepmap\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\Input\Input;
use Joomla\Registry\Registry;

//use Joomla\CMS\Uri\Uri;

use Webstep\Module\Stepmap\Site\Helper\StepmapHelper;

class Dispatcher implements DispatcherInterface
{
    protected $module;
    
    protected $app;

    public function __construct(\stdClass $module, CMSApplicationInterface $app, Input $input)
    {
        $this->module = $module;
        $this->app = $app;
    }

    public function dispatch()
    {

        $language = Factory::getApplication()->getLanguage();
        $language->load('mod_stepmap', JPATH_BASE . '/modules/mod_stepmap');
        $lang = $language->getTag();

        $params = new Registry($this->module->params);

        $moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx') ?? '');
        $latCent = htmlspecialchars(trim($params->get('lat_cent') ?? ''));
        $lngCent = htmlspecialchars(trim($params->get('lng_cent') ?? ''));
        $zoom = htmlspecialchars(trim($params->get('zoom') ?? ''));
        $height = (int) htmlspecialchars(trim($params->get('height') ?? ''));
        $info = $params->get('items', []);
        $key = htmlspecialchars(trim($params->get('key') ?? ''));

        $wa = Factory::getApplication()->getDocument()->getWebAssetManager();

        $scriptSource = "https://maps.googleapis.com/maps/api/js?key=" . $key . "&language=" . $lang;
        $wa->registerAndUseScript('googlemaps.api', $scriptSource, [], ['defer' => true], []);

        $wr = $wa->getRegistry();
        $wr->addRegistryFile('media/mod_stepmap/joomla.asset.json');
        $wa->useScript('mod_stepmap.stepmap');

        // $document = Factory::getDocument();
        // $document->addScript(
        //     Uri::root(true) . '/modules/mod_stepmap/media/js/stepmap.js',
        //     ['defer' => true],
        //     ['relative' => false]
        // );

        if(!$height){
            $height = 300;
        }

        if( !is_numeric($zoom) || intval($zoom) < 1 ){
            $zoom = 14;
        }

        $fields = StepmapHelper::convert($info);
        $count = count($fields);
        $isNotSet = !is_numeric($latCent) || !is_numeric($lngCent);
        if ($count > 0 && ($count === 1 || $isNotSet)) {

            $latCent = $fields[0]['lat'];
            $lngCent = $fields[0]['lng'];
        }

        $mapId = uniqid('wsgmid_');

      
        $data = [
            'points' => $fields,
            'mapId' => $mapId,
            'center' => [
                'lat' => $latCent ? $latCent : 0,
                'lng' => $lngCent ? $lngCent : 0,
            ],
            'zoom' => $zoom,
        ];
        ?>

        <script class="wsm-data" type="application/json">
        <?php echo json_encode($data) ?>
        </script>
<?php

        require ModuleHelper::getLayoutPath('mod_stepmap');
    }
}

