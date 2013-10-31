<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by PhpStorm.
 * User: eapbachman
 * Date: 27/10/13
 * Time: 23:04
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Annotation;

/**
 * Class Result
 * @package Tesla\Bundle\DtoBundle\Annotation
 * @Annotation
 */
class Result extends AbstractAnnotation
{

    public $class;

    public function __construct($values)
    {
        $this->class = $values['value'];
    }


    function getAliasName()
    {
        return 'tesla_dto_result';
    }

    function allowArray()
    {
        return false;
    }

} 