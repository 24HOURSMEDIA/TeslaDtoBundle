<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 13/10/13
 * Time: 14:53
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Instance;


use Tesla\Bundle\DtoBundle\Dto\Visitor\CompoundDtoVisitor;
use Tesla\Bundle\DtoBundle\Dto\Visitor\DtoVisitorInterface;

abstract class AbstractVisitableDto implements VisitableDtoInterface
{
    /**
     * Can the visitor do something with this Dto?
     * If yes, invoke $visitor->visit($this)
     * @param DtoVisitorInterface $visitor
     * @return mixed
     */
    function acceptVisitor(DtoVisitorInterface $visitor)
    {
        if ($visitor instanceof CompoundDtoVisitor) {
            $visitor->visit($this);
            return true;
        }
        // do not accept the visitor by default
        return false;
    }


}