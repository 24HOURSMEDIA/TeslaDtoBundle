<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 12/10/13
 * Time: 12:50
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Strategy;

use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmRequest;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmInterface;

/**
 * Class AsmSelectionStrategyInterface
 * Implement a selection algorithm to check if an assembly request is supported.
 * @package Tesla\Bundle\DtoBundle\Dto\Strategy
 */
interface AsmSelectionStrategyInterface
{

    public function pass(AsmRequest $request, $attrs, AsmInterface $asm = null);

}