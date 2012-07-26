<?php
namespace ThemeModule\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
/**
 * gets the path to an asset
 *
 * @author Kat
 */
class ThemeAsset extends AbstractHelper implements ServiceManagerAwareInterface
{
    protected $config = null;
    protected $themeLocation = '';
    protected $assetLocations = array(
        'js'    => '',
        'css'   => '',
        'img'   => ''
    );
    
    public function __invoke($file=null) {
        if ($file == null) { 
            return $this;     
        }
        //figger out the type here
        return call_user_func(array($this, $type), $file);
    }

    public function setServiceManager(ServiceManager $serviceManager) {
        $fullconfig = $serviceManager->getServiceLocator()->get('Config');
        if (!array_key_exists('theme', $fullconfig)) {
            return;
        }
        $this->config = $fullconfig['theme'];
        
        if (array_key_exists('location', $this->config)) {
            $this->themeLocation = $this->config['location'];
        }
        
        $types = array_keys($this->assetLocations);
        
        $this->assetLocations = array_fill_keys($types, $this->themeLocation);
        if (array_key_exists('assets', $this->config)) {
            $this->assetLocations = array_merge($this->assetLocations, $this->config['assets']);
        }
    }
    
//    public function css($file=null)
//    {
//        return $this->assetLocations['css'] . "/" . $file;
//    }
//    
//    public function image($file=null)
//    {
//        return $this->assetLocations['img'] . "/" . $file;
//    }
//    
//    public function img($file=null)
//    {
//        return $this->assetLocations['img'] . "/" . $file;
//    }
//    
//    public function js($file=null)
//    {
//        return $this->assetLocations['js'] . "/" . $file;
//    }
    
    public function __call($name, $arguments) {
        $file = $arguments[0];
        $location = '';
        if ($name == 'image') {
            $name = 'img';
        }
        if (array_key_exists($name, $this->assetLocations)) {
            $location = $this->assetLocations[$name];
        }
        return $location . "/" . $file;
    }
}