<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by PhpStorm.
 * User: eapbachman
 * Date: 28/10/13
 * Time: 05:28
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Strategy;


use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmRequest;

use Tesla\Bundle\DtoBundle\MetadataReader;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmInterface;

/**
 * Class AsmAnnotationStrategy
 * @package Tesla\Bundle\DtoBundle\Dto\Strategy
 */
class AsmAnnotationStrategy implements AsmSelectionStrategyInterface
{
    /**
     * @var MetadataReader
     */
    public $reader;

    public function setReader(MetadataReader $reader) {
        $this->reader = $reader;
    }

    public function pass(AsmRequest $request, $attrs, AsmInterface $asm = null)
    {
        $requestedType = $request->getDtoType();
        $subject = $request->getSubject();
        if (!is_object($subject)) {
            return;
        }

        //echo get_class($subject) . ':'.$requestedType . ' -- ';
        $annots = $this->reader->getAnnotationsForClass(get_class($asm));
        if (isset($annots['tesla_dto_asm'])) {
            foreach ($annots['tesla_dto_asm'] as $key => $annot) {
                $supportedSubjectClass = $annot->getSource();
                $supportedResultType = $this->reader->getDtoType($annot->getResult());
                //  echo $supportedSubjectClass . ' : ' . $supportedResultType . '<br/>';
                if ($subject instanceof $supportedSubjectClass && $supportedResultType == $requestedType) {
                    $request->setAttributes($annot->getAttributes());

                    return true;
                }

            }
        }

    }


} 