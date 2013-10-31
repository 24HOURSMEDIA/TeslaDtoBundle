<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 12/10/13
 * Time: 12:50
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Strategy;


class StrategyManager
{

    private $strategies = array();

    public function addStrategy($strategy, $alias)
    {
        // @TODO check type of strategy..
        $this->strategies[$alias] = $strategy;
    }

    /**
     * @param $alias
     * @return AsmSelectionStrategyInterface | null
     */
    public function getStrategy($alias)
    {
        return array_key_exists($alias, $this->strategies) ? $this->strategies[$alias] : null;
    }

}