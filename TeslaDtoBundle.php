<?php

namespace Tesla\Bundle\DtoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tesla\Bundle\DtoBundle\DependencyInjection\Compiler\AssemblerCompilerPass;
use Tesla\Bundle\DtoBundle\DependencyInjection\Compiler\CollectControllerCompilerPass;
use Tesla\Bundle\DtoBundle\DependencyInjection\Compiler\SelectionStrategiesCompilerPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;

class TeslaDtoBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AssemblerCompilerPass());
        $container->addCompilerPass(new SelectionStrategiesCompilerPass());
        $container->addCompilerPass(new CollectControllerCompilerPass(), PassConfig::TYPE_BEFORE_REMOVING);

    }

}
