<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by PhpStorm.
 * User: eapbachman
 * Date: 28/10/13
 * Time: 00:57
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle\Util;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class ControllerClassResolver
 * @package Tesla\Bundle\DtoBundle\Util
 * @DI\Service("tesla_dto.controller_class_resolver")
 */
class ControllerClassResolver
{

    /**
     * @DI\Inject("router")
     * @var RouterInterface
     */
    public $router;

    private $classMap = array();

    /**
     * Sets the class map from controller (done in compiler pass)
     * @param $map
     */
    public function _setClassMap(array $map)
    {

        $this->classMap = $map;
    }

    /**
     * @param $route
     * @return array(controller class, method)
     */
    public function resolveRouteToClassAndMethod($route)
    {
        $route = $this->router->getRouteCollection()->get($route);
        if (!$route) return null;
        $_controller = $route->getDefault('_controller');
        if (!$_controller) return null;
        $parts = explode('::', $_controller);
        if (count($parts) == 2) {
            return array('class' => $parts[0], 'method' => $parts[1]);
        }
        $parts = explode(':', $_controller);
        if (count($parts) == 2) {
            $serviceId = $parts[0];
            $method = $parts[1];
            $class = $this->classMap[$serviceId];
            if ($class && $method) {
                return array('class' => $class, 'method' => $method);
            }
        }
        return null;
    }


} 