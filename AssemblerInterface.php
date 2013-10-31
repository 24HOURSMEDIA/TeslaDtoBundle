<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 12/10/13
 * Time: 14:53
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AssemblyContext;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AssemblyProduct;

/**
 * Class AssemblerInterface
 * Get an assembled product from somewhere
 * @package Tesla\Bundle\DtoBundle
 */
interface AssemblerInterface
{

    /**
     * Get an assembled product from a domainObject containing a DTO of type $dtoType
     * @param $domainObject
     * @param $dtoType
     * @param AssemblyContext $context
     * @return AssemblyProduct
     */
    public function getProduct($domainObject, $dtoType, AssemblyContext $context = null);

    public function getProductFromMappedAsm($domainObject, $map, AssemblyContext $context = null);
}