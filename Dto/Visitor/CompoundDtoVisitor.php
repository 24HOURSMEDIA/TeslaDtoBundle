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

namespace Tesla\Bundle\DtoBundle\Dto\Visitor;

use Tesla\Bundle\DtoBundle\Dto\Instance\VisitableDtoInterface;
use Tesla\Bundle\DtoBundle\Dto\Instance\DtoInterface;

class CompoundDtoVisitor implements DtoVisitorInterface
{

    private $visitors;

    public function __construct(array $visitors = array())
    {
        $this->visitors = $visitors;
    }

    public function visit(DtoInterface $dto)
    {

        if ($dto instanceof VisitableDtoInterface) {
            foreach ($this->visitors as $visitor) {
                $dto->acceptVisitor($visitor);
            }
        }


    }

}