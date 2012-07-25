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
                'name'=>__NAMESPACE__,
                'location'=>__DIR__
            )
        );
    }
}