<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 13/10/13
 * Time: 13:31
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Instance;


use Tesla\Bundle\DtoBundle\Dto\Visitor\DtoVisitorInterface;

interface VisitableDtoInterface extends DtoInterface
{

    /**
     * Can the visitor do something with this Dto?
     * If yes, invoke $visitor->visit($this)
     * @param DtoVisitorInterface $visitor
     * @return mixed
     */
    function acceptVisitor(DtoVisitorInterface $visitor);


}