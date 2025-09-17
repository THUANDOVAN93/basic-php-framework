<?php

namespace Core;

class App
{
    protected static $container;

    public static function setContainer($container)
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }

    public static function resolve($name)
    {
        return static::$container->resolve($name);
    }

    public static function bind($key, $resolver): void
    {
        static::container()->bind($key, $resolver);
    }
}