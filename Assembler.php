<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 11/10/13
 * Time: 00:57
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle;

use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmChain;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmChainElement;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmInterface;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AssemblyProduct;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AssemblyContext;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmRequest;
use Tesla\Bundle\DtoBundle\Dto\Strategy\StrategyManager;

/**
 * Class Assembler
 * Main assembler engine that delivers AssemblerProducts
 * @package Tesla\Bundle\DtoBundle
 */
class Assembler extends AsmChain implements AssemblerInterface
{
    /**
     * @var AsmChain[]
     */
    private $mappedChains = array();

    /**
     * @var StrategyManager
     */
    private $stratMan;

    /**
     * Sets the manager for selection strategies for Asm components
     * @param $stratMan
     */
    public function setAsmSelectionStrategyManager($stratMan)
    {
        $this->stratMan = $stratMan;
    }

    protected function createContext(AssemblyContext $context = null)
    {
        if (!$context) {
            $context = AssemblyContext::create();
        }
        $context->initialize($this);
        return $context;
    }

    /**
     * The compiler can automatically add Asm selected components from a tagged service to this main
     * assembler. The tag attributes are passed along with the assembler service.
     *
     * The tag attributes are used to create a selection strategy, and then an AsmChainElement is created
     * and added to the chain of responsibility.
     *
     * @param AsmInterface $asm
     * @param array $attrs
     */
    function addAsmFromTaggedService(AsmInterface $asm, array $attrs)
    {
        // generate a strategy from the $attrs
        $strategy = $this->stratMan->getStrategy($attrs['strategy']);
        $element = new AsmChainElement($asm, $attrs);
        $element->setStrategy($strategy);
        $this->addAsm($element);
        if (isset($attrs['mapping'])) {
            $map = $attrs['mapping'];
            if (!isset($this->mappedChains[$map])) {
                $this->mappedChains[$map] = new AsmChain();
            }
            $this->mappedChains[$map]->addAsm($element);
        }
    }

    /**
     * x
     * @param $domainObject
     * @param $map
     * @param AssemblyContext $context
     * @return AssemblyProduct
     * @deprecated
     */
    public function getProductFromMappedAsm($domainObject, $map, AssemblyContext $context = null)
    {
        $context = $this->createContext($context);
        if (!isset($this->mappedChains[$map])) {
            return new AssemblyProduct(null, false);
        }
        $request = new AsmRequest($context);
        // no need to set the type, it will be triggered only by mapping strategies
        $request->setSubject($domainObject);
        $product = $this->mappedChains[$map]->assemble($request);
        return $product;
    }

    /**
     * Get an assembled product from this configured assembler
     * @param $domainObject
     * @param $dtoType
     * @param AssemblyContext $context
     * @return AssemblyProduct
     */
    public function getProduct($domainObject, $dtoType, AssemblyContext $context = null)
    {

        $context = $this->createContext($context);
        $request = new AsmRequest($context);
        $request->setSubject($domainObject)->setDtoType($dtoType);
        $product = $this->assemble($request);
        return $product;
    }

}