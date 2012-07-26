<?php
namespace DefaultTheme;
/**
 * Description of Module
 *
 * @author K.Reeve@ctidigial.com
 */
class Module 
{
    public function getConfig()
    {
        return array(
            'view_manager'=>array(
                'template_path_stack'=> array(
                    __DIR__.'/system'
                )
            ),
            'theme' => array(
                'name'      => __NAMESPACE__,
                'location'  => '/themes/'.__NAMESPACE__,
                'assets'    => array(
                    'css'   => '/themes/'.__NAMESPACE__.'/css',
                    'js'    => '/themes/'.__NAMESPACE__.'/js',
                    'img'   => '/themes/'.__NAMESPACE__.'/images',
                    'flash' => '/themes/'.__NAMESPACE__.'/flash',
                )
            )
        );
    }
}