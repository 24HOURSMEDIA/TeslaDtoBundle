<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 13/10/13
 * Time: 14:46
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Visitor;


class CompoundDtoVisitorFactory /* implements chain of responsibility, visitorfactoryinterface */
{

    private $factories = array();

    public function addFactory($factory)
    {

        $this->factories[] = $factory;
    }

    /**
     * @return array
     */
    public function getFactories()
    {
        return $this->factories;
    }

    /**
     * @return array
     */
    public function create()
    {
        $visitors = array();
        foreach ($this->factories as $factory) {
            $visitors[] = $factory->create();
        }
        return new CompoundDtoVisitor($visitors);
    }


}