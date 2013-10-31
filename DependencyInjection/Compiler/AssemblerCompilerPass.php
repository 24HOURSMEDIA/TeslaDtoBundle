<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 11/10/13
 * Time: 01:58
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AssemblerCompilerPass
 * Compiler pass that searches for services tagged with tesla_dto_assembler
 * and adds them to the CompilerChain service
 *
 * This pass is registered in the TeslaDtoBundle class, of course.
 *
 * @package Tesla\Bundle\DtoBundle\DependencyInjection\Compiler
 */
class AssemblerCompilerPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     * @param ContainerBuilder $container
     * @api
     */
    public function process(ContainerBuilder $container)
    {

        // find all tagged assemblers that contain an assembler selection strategy
        $asmServices = $container->findTaggedServiceIds(
            'tesla_dto.asm_selection'
        );
        // find all services that are tagged to collect assemblers
        $collectors = $container->findTaggedServiceIds(
            'tesla_dto.asm_collector'
        );

        // make a map for 'default' strategies
        $asms = array();
        foreach ($asmServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                unset($attributes['name']);
                ksort($attributes);
                $key = json_encode($attributes);
                if (!isset($asms[$key])) {
                    $asms[$key] = array();
                }
                $asms[$key][] = array($id, $attributes);
            }
        }


        // now check each collector service if they want to collect the asm
        foreach ($collectors as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                unset($attributes['name']);
                ksort($attributes);
                $key = json_encode($attributes);
                if (array_key_exists($key, $asms)) {
                    foreach ($asms[$key] as $asm) {
                        $definition = $container->findDefinition($id);
                        $definition->addMethodCall(
                            'addAsmFromTaggedService',
                            array(new Reference($asm[0]), $asm[1])
                        );
                    }
                }
            }
        }


    }


}