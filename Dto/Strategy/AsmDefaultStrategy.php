<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 12/10/13
 * Time: 13:22
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Strategy;


use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmRequest;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmInterface;

class AsmDefaultStrategy implements AsmSelectionStrategyInterface
{

    public function pass(AsmRequest $request, $attrs, AsmInterface $asm = null)
    {
        //echo 'matching ' . $attrs['dto_type'] . ' to ' . $request->getDtoType() . '';
        //echo ' and matching ' . get_class($request->getSubject()) . ' to ' . $attrs['bo_class'] . '<br/>';

        return
            ($request->getDtoType() == $attrs['dto_type'])
            &&
            ($request->getSubject() instanceof $attrs['bo_class']);
    }
}