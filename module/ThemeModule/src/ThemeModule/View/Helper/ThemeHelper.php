<?php
namespace ThemeModule\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
/**
 * Description of ThemeHelper
 *
 * @author Kat
 */
abstract class ThemeHelper extends AbstractHelper implements ServiceManagerAwareInterface
{
    protected $type = null;
    protected $config = null;
    protected $themeLocation = '';
    public function __invoke($file=null) {
        if ($this->type === null) {
            return $file;
        }
        
        return $this->themeLocation . "/" . $this->type . "/" . $file;
    }

    public function setServiceManager(ServiceManager $serviceManager) {
        $fullconfig = $serviceManager->getServiceLocator()->get('Config');
        $this->config = $fullconfig['theme'];
        
        $themeLocation  = realpath($this->config['location']);
        $docRoot        = realpath($_SERVER['DOCUMENT_ROOT']);
        $relative       = str_replace(
            array($docRoot,DIRECTORY_SEPARATOR),
            array('','/'),
            $themeLocation
        );
        $this->themeLocation = $relative;
    }
}