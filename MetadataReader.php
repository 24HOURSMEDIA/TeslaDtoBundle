<?php
// $Id:  $
// $HeadURL:  $
/**
 * Created by PhpStorm.
 * User: eapbachman
 * Date: 27/10/13
 * Time: 22:03
 * To change this template use File | Settings | File Templates.
 */

namespace Tesla\Bundle\DtoBundle;

use JMS\DiExtraBundle\Annotation as DI;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Annotations\FileCacheReader;
use Symfony\Component\Routing\RequestContext;
use Tesla\Bundle\DtoBundle\Annotation\AbstractAnnotation;
use Tesla\Bundle\DtoBundle\Util\ControllerClassResolver;
use ProxyManager\Proxy\LazyLoadingInterface;

/**
 * Class MetaDataReader
 * @package Tesla\Bundle\DtoBundle
 * @DI\Service("tesla_dto.metadata_reader")
 */
class MetadataReader
{

    /**
     *
     * @var Reader
     */
    public $reader;


    /**
     * @var array
     */
    private $annotCache = array();

    /**
     * @var array
     */
    private $annotMethodCache = array();

    /**
     * @var array
     */
    private $responseTypeCache = array();

    /**
     * @DI\Inject("%tesla_dto.reader_cache_path%")
     * @var string
     */
    public $cacheDir = "";


    /**
     * @DI\Inject("tesla_dto.controller_class_resolver")
     * @var ControllerClassResolver
     */
    public $controllerResolver;

    private $debug = false;

    /**
     * @DI\InjectParams({
     *     "cacheDir" = @DI\Inject("%tesla_dto.reader_cache_path%"),
     *     "reader" = @DI\Inject("annotation_reader"),
     *      "env" = @DI\Inject("%KERNEL.ENVIRONMENT%")
     * })
     */
    public function __construct($cacheDir, $reader, $env)
    {
        if (!is_dir($cacheDir)) {
            $this->createDir($cacheDir);
        }
        if (!is_writable($cacheDir)) {
            throw new InvalidArgumentException(sprintf('The cache directory "%s" is not writable.', $dir));
        }

        $this->debug = stristr($env, 'dev');
        $this->cacheDir = $cacheDir;
        $this->reader = new FileCacheReader($reader, $this->cacheDir, $this->debug);

    }

    private function createDir($dir)
    {
        if (is_dir($dir)) {
            return;
        }

        if (false === @mkdir($dir, 0777, true)) {
            throw new RuntimeException(sprintf('Could not create directory "%s".', $dir));
        }
    }


    /**
     * Returns a response type for a route (by resolving the @ Result annotation
     *
     * @param $routeName
     * @return null
     */
    function getResponseType($routeName)
    {
        $clsAndMethod = $this->controllerResolver->resolveRouteToClassAndMethod($routeName);
        if (!$clsAndMethod) {
            return $this->responseTypeCache[$routeName] = null;
        }
        $annots = $this->getAnnotationsForMethod($clsAndMethod['class'], $clsAndMethod['method']);
        if (isset($annots['tesla_dto_result']) && count($annots['tesla_dto_result'])) {
            return $this->responseTypeCache[$routeName] = $this->getDtoType($annots['tesla_dto_result'][0]->class);
        }
        return $this->responseTypeCache[$routeName] = null;
    }

    private function getAnnotationsForMethod($class, $method)
    {
        // get a real class name in case of lazy loading
        $implements = class_implements($class);
        if (isset($implements['ProxyManager\Proxy\LazyLoadingInterface'])) {
            $class = get_parent_class($class);
        }

        if (array_key_exists($class . ':' . $method, $this->annotMethodCache)) {
            return $this->annotCache[$class . ':' . $method];
        }

        $method = new \ReflectionMethod($class, $method);
        $annotations = $this->reader->getMethodAnnotations($method);
        foreach ($annotations as $annot) {
            if ($annot instanceof AbstractAnnotation) {
                if (!isset($set[$annot->getAliasName()]))
                    $set[$annot->getAliasName()] = array();
                $set[$annot->getAliasName()][] = $annot;
            }
        }
        return $this->annotCache[$class . ':' . $method] = $set;
    }

    /**
     * Return the annotated type for a dto or null if not available
     * @param $dto
     */
    function getDtoType($dto)
    {
        $className = $dto;
        if (is_object($dto)) {
            $className = get_class($dto);
        } else if (is_string($dto)) {
            $className = $dto;
        } else {
            return null;
        }
        $annotations = $this->getAnnotationsForClass($className);
        if (isset($annotations['tesla_dto_type']) && count($annotations['tesla_dto_type']))
            return $annotations['tesla_dto_type'][0]->type;
    }

    public function getAnnotationsForClass($class)
    {
        // get a real class name in case of lazy loading
        $implements = class_implements($class);
        if (isset($implements['ProxyManager\Proxy\LazyLoadingInterface'])) {
            $class = get_parent_class($class);
        }

        if (array_key_exists($class, $this->annotCache)) {
            return $this->annotCache[$class];
        }


        $object = new \ReflectionClass($class);

        $annotations = $this->reader->getClassAnnotations($object);
        $set = array();
        foreach ($annotations as $annot) {
            if ($annot instanceof AbstractAnnotation) {
                if (!isset($set[$annot->getAliasName()]))
                    $set[$annot->getAliasName()] = array();
                $set[$annot->getAliasName()][] = $annot;
            }
        }
        return $this->annotCache[$class] = $set;
    }


}