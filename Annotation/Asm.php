<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by PhpStorm.
 * User: eapbachman
 * Date: 28/10/13
 * Time: 05:22
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Annotation;

/**
 * Class Asm
 * @package Tesla\Bundle\DtoBundle\Annotation
 * @Annotation
 */
class Asm extends AbstractAnnotation
{

    private $source;

    private $result;

    private $attributes = array();

    /**
     * @param mixed $result
     * @return $this
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }


    function getAliasName()
    {
        return 'tesla_dto_asm';
    }

    function allowArray()
    {
        return true;
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