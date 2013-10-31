<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 11/10/13
 * Time: 04:13
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Assembler;
use Tesla\Bundle\DtoBundle\Assembler;
use Tesla\Bundle\DtoBundle\AssemblerInterface;

/**
 * Class AbstractContext
 * Interface for Assembler context
 * @package Tesla\Bundle\DtoBundle\Dto\Assembler
 */
abstract class AbstractContext
{

    private $initialized = false;

    /**
     * @var AssemblerInterface
     */
    private $assembler;

    /**
     * @return $this
     * @throws \LogicException
     */
    public function initialize(AssemblerInterface $assembler)
    {
        $this->assertMutable();
        $this->assembler = $assembler;
        $this->initialized = true;
        return $this;
    }

    /**
     * @return \Tesla\Bundle\DtoBundle\AssemblerInterface
     */
    public function getAssembler()
    {
        return $this->assembler;
    }

    private function assertMutable()
    {
        if (!$this->initialized) {
            return;
        }
        throw new \LogicException('This context was already initialized and is immutable; you cannot modify it anymore.');
    }

}