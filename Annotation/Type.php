<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by PhpStorm.
 * User: eapbachman
 * Date: 27/10/13
 * Time: 21:57
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Annotation;


/**
 * Class Type
 * Indicates a type for a dto interface
 *
 * Suggested is the following naming convention:
 * [VENDOR URI].[APPLICATION].[RESOURCE-VARIANT].v[MAJOR VERSION]
 * i.e. 24hm.com.mywebservice.user-list.v1
 *
 * @package Tesla\Bundle\DtoBundle\Annotation
 * @Annotation
 */
class Type extends AbstractAnnotation
{

    public $type;

    public function __construct($values)
    {
        $this->type = $values['value'];
    }


    function getAliasName()
    {
        return 'tesla_dto_type';
    }

    function allowArray()
    {
        return false;
    }


} 