<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 11/10/13
 * Time: 18:33
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Assembler;

/**
 * Class AsmRequest
 * @package Tesla\Bundle\DtoBundle\Dto\Assembler
 */
class AsmRequest
{

    /**
     * @var AbstractContext
     */
    private $context;
    /**
     * @var mixed
     */
    private $subject;

    /**
     * @var string
     */
    private $dtoType;

    private $attributes = array();

    /**
     * @param AssemblyContext $context
     */
    public function __construct(AssemblyContext $context)
    {
        $this->context = $context;

    }

    /**
     * @return AbstractContext|AssemblyContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param $type
     */
    public function setDtoType($type)
    {
        $this->dtoType = $type;
    }

    /**
     * @return string
     */
    public function getDtoType()
    {
        return $this->dtoType;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }


}