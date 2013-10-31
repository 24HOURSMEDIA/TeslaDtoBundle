<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 13/10/13
 * Time: 13:32
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Visitor;


use Tesla\Bundle\DtoBundle\Dto\Instance\DtoInterface;

interface DtoVisitorInterface
{

    /**
     * Do something with a Dto.
     * Called by the Dto after it checked that it accepts the visitor.
     * @param DtoInterface $dto
     */
    function visit(DtoInterface $dto);


}