<?php

namespace BKThemeManager\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

/**
 * gets the path to an asset
 *
 * @author Kathryn Reeve
 * @method string css(string $fileName) get path for Css File
 * @method string img(string $fileName) get path for Image File
 * @method string js(string $fileName) get path for JavaScript File
 */
class ThemeAsset extends AbstractHelper implements ServiceManagerAwareInterface {

    /**
     * @var array Current Theme's Config
     */
    protected $themeConfig = null;

    /**
     * @var string Current Theme's Location
     */
    protected $themeLocation = '';

    /**
     * @var array Current Theme's asset locations
     */
    protected $assetLocations = array('js' => '', 'css' => '', 'img' => '');

    /**
     * @var array a simple extenion=>call map
     */
    protected $typeMap = array('jpg' => 'img', 'jpeg' => 'img', 'png' => 'img', 'image' => 'img');

    /**
     * Main invokation method
     * @param string $file
     * @return \ThemeModule\View\Helper\ThemeAsset
     */
    public function __invoke($file = null) {
        if ($file == null) {
            return $this;
        }

        $type = array_pop(explode('.', $file));
        return call_user_func(array($this, $type), $file);
    }

    /**
     * called to parse the config from the application
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return null
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $fullconfig = $serviceManager->getServiceLocator()->get('Config');
        if (!array_key_exists('theme', $fullconfig)) {
            return null;
        }
        $this->themeConfig = $fullconfig['theme'];

        if (array_key_exists('location', $this->themeConfig)) {
            $this->themeLocation = $this->themeConfig['location'];
        }

        $types = array_keys($this->assetLocations);

        $this->assetLocations = array_fill_keys($types, $this->themeLocation);
        if (array_key_exists('assets', $this->themeConfig)) {
            $this->assetLocations = array_merge($this->assetLocations, $this->themeConfig['assets']);
        }
        return null;
    }

    /**
     * main calling function for asset types
     * @param string $type
     * @param array $arguments
     * @return string
     */
    public function __call($type, $arguments) {
        $file = $arguments[0];
        $location = '';
        if (array_key_exists($type, $this->typeMap)) {
            $type = $this->typeMap[$type];
        }
        if (array_key_exists($type, $this->assetLocations)) {
            $location = $this->assetLocations[$type];
        }
        return $location . "/" . $file;
    }

}