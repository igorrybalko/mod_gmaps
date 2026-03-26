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

use Joomla\CMS\Extension\Service\Provider\Module as ModuleServiceProvider;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory as ModuleDispatcherFactoryServiceProvider;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class () implements ServiceProviderInterface {

    public function register(Container $container): void
    {
        $container->registerServiceProvider(new ModuleDispatcherFactoryServiceProvider('\\Webstep\\Module\\Gmaps'));
        $container->registerServiceProvider(new ModuleServiceProvider());
    }
};
