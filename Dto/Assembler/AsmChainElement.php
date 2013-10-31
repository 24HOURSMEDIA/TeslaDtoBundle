<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 12/10/13
 * Time: 12:05
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Assembler;

use Tesla\Bundle\DtoBundle\Dto\Strategy\AsmSelectionStrategyInterface;
use Vu\Content\DomainBundle\Entity\Resource;

/**
 * Class AsmChainElement
 * Concrete wrapper around an asm service
 * @package Tesla\Bundle\DtoBundle\Dto\Assembler
 */
final class AsmChainElement implements AsmInterface
{

    /**
     * @var AsmInterface
     */
    private $asm;

    /**
     * @var AsmSelectionStrategyInterface
     */
    private $strategy;

    /**
     * @var array
     */
    private $attrs;

    /**
     * @param AsmInterface $asm
     */
    public function __construct(AsmInterface $asm = null, $attrs = array(), AsmSelectionStrategyInterface $strategy = null)
    {
        $this->asm = $asm;
        $this->attrs = $attrs;
        $this->strategy = $strategy;
    }

    /**
     * @param \Tesla\Bundle\DtoBundle\Dto\Strategy\AsmSelectionStrategyInterface $strategy
     * @return $this
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
        return $this;
    }

    /**
     * @return AsmInterface
     */
    public function getAsm()
    {
        return $this->asm;
    }

    public function assemble(AsmRequest $request)
    {
        if ($this->strategy && $this->asm && $this->strategy->pass($request, $this->attrs, $this->asm)) {
            return $this->asm->assemble($request);
        }
        return new AssemblyProduct(null, false);
    }

}