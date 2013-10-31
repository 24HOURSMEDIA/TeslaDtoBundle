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
use JMS\DiExtraBundle\Annotation as DI;
use Tesla\Bundle\DtoBundle\MetadataReader;
use Tesla\Bundle\DtoBundle\Dto\Assembler\AsmInterface;

/**
 * Class AsmAnnotationStrategy
 * @package Tesla\Bundle\DtoBundle\Dto\Strategy
 * @DI\Service("asm_annotation_strategy")
 * @DI\Tag("asm_selection_strategy", attributes = {"alias" = "annotation"})
 */
class AsmAnnotationStrategy implements AsmSelectionStrategyInterface
{
    /**
     * @DI\Inject("tesla_dto.metadata_reader")
     * @var MetaDataReader
     */
    public $reader;

    public function pass(AsmRequest $request, $attrs, AsmInterface $asm = null)
    {
        $subject = $request->getSubject();
        if (!is_object($subject)) {
            return;
        }
        $requestedType = $request->getDtoType();
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