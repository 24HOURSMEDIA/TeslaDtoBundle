<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 12/10/13
 * Time: 18:53
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Strategy;


use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmRequest;
use Tesla\Bundle\DtoBundle\Dto\Strategy\AsmSelectionStrategyInterface;
use Vu\Content\DomainBundle\Entity\Resource;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmInterface;

class ResourceTypeSelectionStrategy implements AsmSelectionStrategyInterface
{

    private $mapping = array();

    public function addMapping($dtoMappingName, $resourceType)
    {

        if (!array_key_exists($dtoMappingName, $this->mapping)) {
            $this->mapping[$dtoMappingName] = array();
        }
        $this->mapping[$dtoMappingName][] = $resourceType;
    }

    public function pass(AsmRequest $request, $attrs, AsmInterface $asm = null)
    {

        if (!$request->getSubject() instanceof Resource) {
            return false;
        }

        $resourceType = $request->getSubject()->getType();
        if (array_key_exists($attrs['mapping'], $this->mapping)) {
            $types = $this->mapping[$attrs['mapping']];

            $ok = in_array($resourceType, $types);;
            //  echo 'match ' . $resourceType . ' to ' .json_encode($this->mapping[$attrs['mapping']]) . '::' . $ok . '<br/>';
            //var_dump($types);echo $resourceType;exit;
            // var_dump($this->mapping);exit;
            return $ok;
        }
        return false;
    }


}