<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 12/10/13
 * Time: 12:58
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\DependencyInjection\Compiler;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Reference;


class SelectionStrategiesCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $asmManagerDefinition = $container->findDefinition('tesla_dto.asm_selection_strategy_manager');

        $asmStrategyServices = $container->findTaggedServiceIds('asm_selection_strategy');
        foreach ($asmStrategyServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attrs) {
                $asmManagerDefinition->addMethodCall(
                    'addStrategy',
                    array(new Reference($id), $attrs['alias'])
                );
            }
        }
    }
}