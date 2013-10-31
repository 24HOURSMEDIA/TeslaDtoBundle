<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 11/10/13
 * Time: 04:35
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Assembler;

/**
 * Class AsmInterface
 * Assemble something
 * @package Tesla\Bundle\DtoBundle\Dto\Assembler
 */
interface AsmInterface
{


    /**
     * Creates a DTO from a domain object
     * @param $domainObject
     * @return AssemblyProduct
     */
    function assemble(AsmRequest $req);


}