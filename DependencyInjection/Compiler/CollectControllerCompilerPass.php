<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by PhpStorm.
 * User: eapbachman
 * Date: 28/10/13
 * Time: 00:43
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class CollectControllerCompilerPass
 * Collect controller service class names
 * @package Tesla\Bundle\DtoBundle\DependencyInjection\Compiler
 */
class CollectControllerCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $resolver = $container->getDefinition('tesla_dto.controller_class_resolver');
        $ids = $container->getServiceIds();
        $controllers = array();
        foreach ($ids as $id) {
            try {
                $def = $container->getDefinition($id);
                if (stristr($def->getClass(), 'controller')) {
                    $class = $def->getClass();
                    $controllers[$id] = $class;
                }
            } catch (\Exception $e) {

            }
        }
        $resolver->addMethodCall('_setClassMap', array($controllers));


    }


} 