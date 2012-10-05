<?php
namespace BKThemeManager;
use Zend\ModuleManager\ModuleManager;

class Module
{
    public function init(ModuleManager $moduleManager) {
        //@todo - Add in some way to figure out the current theme
        //@todo - Add in theme Merging for simplicity

        $moduleManager->loadModule('DefaultTheme');
    }

    public function getConfig()
    {
        return require(__DIR__ . '/config/module.config.php');
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ),
            ),
        );
    }
}
