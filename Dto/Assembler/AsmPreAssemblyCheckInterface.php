<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by PhpStorm.
 * User: eapbachman
 * Date: 04/11/13
 * Time: 19:22
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Assembler;

use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmRequest;

/**
 * Interface AsmPreAssemblyCheckInterface
 * If an assembler implements this interface, the assembler is checked before the assembly call
 * wether it supports the requested assembly.
 *
 * @package Tesla\Bundle\DtoBundle\Dto\Assembler
 */
interface AsmPreAssemblyCheckInterface
{

    /**
     * Do some tests here to check wether the assembler component can handle this request.
     * These tests are done additional to the selection strategy.
     *
     * @param AsmRequest $r
     * @return boolean
     */
    public function preAssemblyCheck(AsmRequest $req);

} 