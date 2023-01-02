<?php

namespace Taxcom\Core\Traits;

trait SingletonTrait
{
    private static $instance = null;

    private function __construct()
    {
    }
    private function __clone()
    {
    }
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize.");
    }

    /**
     * Singleton
     * @return object
     */
    public static function getInstance(): object
    {
        return (is_null(self::$instance)) ?
            self::$instance = new static() :
            self::$instance;
    }
}
