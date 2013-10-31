<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by JetBrains PhpStorm.
 * User: eapbachman
 * Date: 11/10/13
 * Time: 04:16
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Dto\Assembler;

/**
 * Class AssemblyProduct
 * @package Tesla\Bundle\DtoBundle\Dto\Assembler
 */
class AssemblyProduct
{

    private $result;
    private $errors = array();
    private $success = false;

    /**
     * @deprecated
     * @var
     */
    public $_debug = array();

    function __construct($result, $success = true)
    {
        $this->result = $result;
        $this->success = $success;
    }

    function getResult()
    {
        return $this->result;
    }

    function isError()
    {
        return count($this->errors) > 0;
    }

    function isSuccess()
    {
        return $this->success;
    }

    /**
     * @deprecated
     * @param $msg
     */
    function _addDebug($msg)
    {
        $this->_debug[] = $msg;
    }
}