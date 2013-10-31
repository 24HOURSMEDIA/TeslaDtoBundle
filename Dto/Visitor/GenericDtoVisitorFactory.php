<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 13/10/13
 * Time: 15:05
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Visitor;


class GenericDtoVisitorFactory
{

    private $class;

    public function setClass($class)
    {
        $this->class = $class;
    }

    public function create()
    {
        $visitor = new $this->class;
        if (!$visitor instanceof DtoVisitorInterface) {
            throw new \LogicException('GenericDtoVisitorFactory must create instances of DtoVisitorInterface, attempt was ' . $this->class);
        }
        return $visitor;
    }

}