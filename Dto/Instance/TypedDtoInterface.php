<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by PhpStorm.
 * User: eapbachman
 * Date: 27/10/13
 * Time: 21:15
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Instance;


interface TypedDtoInterface
{

    /**
     * Return the type identifier of the dto.
     * Suggested is the following naming convention:
     * [VENDOR URI].[APPLICATION].[RESOURCE-VARIANT].v[MAJOR VERSION]
     * i.e. 24hm.com.mywebservice.user-list.v1
     * @return string
     */
    function getDtoType();
} 