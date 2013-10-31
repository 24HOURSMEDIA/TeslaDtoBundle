<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 11/10/13
 * Time: 03:48
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Assembler;

/**
 * Class AssemblyContext
 * This is the context for 'assembly'. Another possible context is 'DisAssemblyContext'
 *
 * @package Tesla\Bundle\DtoBundle\Dto\Assembler
 */

class AssemblyContext extends AbstractContext
{

    public static function create()
    {
        return new self();
    }
}