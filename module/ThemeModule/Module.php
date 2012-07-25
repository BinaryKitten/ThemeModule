<?php
namespace ThemeModule;
use Zend\ModuleManager\ModuleManager;

class Module
{
    public function init(ModuleManager $moduleManager) {
        $e = $moduleManager->getEvent();
        $moduleManager->setEvent(clone $e);
        $moduleManager->loadModule('DefaultTheme');
        $moduleManager->setEvent($e);
    }

    public function getConfig()
    {
        $file = __DIR__ . '/config/module.config.php';
        return include $file;
    }

    public function getAutoloaderConfig()
    {
        $src = __DIR__ . '/src/' . __NAMESPACE__;
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => $src
                ),
            ),
        );
    }
}
