<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 11/10/13
 * Time: 05:32
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Assembler;

use Tesla\Bundle\DtoBundle\Dto\Strategy\StrategyManager;

/**
 * Class AsmChain
 * Asm chain of responsibility
 * @package Tesla\Bundle\DtoBundle\Dto\Assembler
 */
class AsmChain implements AsmInterface
{

    /**
     * @var AsmChainElement[]
     */
    protected $elements = array();

    /**
     * @var AsmChainElement
     */
    private $terminator;

    public function __construct()
    {
        // terminator (will return null since it has no service attached)
        $this->terminator = new AsmChainElement(null);
    }

    public function addAsm(AsmChainElement $element)
    {
        $this->elements[] = $element;
    }

    /**
     * Traverse the chain until a succesful product is returned
     * Otherwise return an error product
     *
     * @param $domainObject
     * @return AssemblyProduct | null
     */
    function assemble(AsmRequest $request)
    {
        foreach ($this->elements as $element) {
            $product = $element->assemble($request);
            if ($product->isSuccess()) {
                return $product;
            }
        }
        return new AssemblyProduct(null, false);

    }


}