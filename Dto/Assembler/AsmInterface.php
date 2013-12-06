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
use Tesla\Bundle\DtoBundle\Dto\Assembler\AssemblyProduct;

/**
 * Class AsmInterface
 * Assembly component - Assemble a DTO from a domain object
 * @package Tesla\Bundle\DtoBundle\Dto\Assembler
 */
interface AsmInterface
{


    /**
     * Implementation of assembly of domain object in a DTO (or other type of object)
     * The asm component can assume prechecks have been done for suitability
     * (by a selection strategy and an optional precheck if the asm supports AsmPreAssemblyCheckInterface)
     *
     * @param AsmRequest $req request containing the source object
     * @return AssemblyProduct  product container with success status
     */
    function assemble(AsmRequest $req);


}