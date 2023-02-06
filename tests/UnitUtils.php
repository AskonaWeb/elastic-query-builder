<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests;

use ReflectionClass;
use ReflectionException;

class UnitUtils
{
    /**
     * @param object|class-string|trait-string $obj
     * @param string $name
     * @param mixed ...$args
     * @return mixed
     * @throws ReflectionException
     */
    public static function callMethod($obj, string $name, ...$args)
    {
        $class  = new ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }
}
