<?php

namespace ThrowawayDCI\Test;

use ThrowawayDCI\Dispatcher;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{

    protected $dispatcher;
    protected static $configuredRoutes = array(
        "/" => array(
            "useCase" => "ThrowawayDCITest\\Context\\SomeUseCase",
            "step" => "start"
        ),
        "/SomeUseCase" => array(
            "useCase" => "ThrowawayDCITest\\Context\\SomeUseCase",
            "step" => "start"
        ),
        "/SomeUseCase/someStep" => array(
            "useCase" => "ThrowawayDCITest\\Context\\AliasedUseCase",
            "step" => "someStep"
        ),
        "/OtherUseCase/notEscaped" => array(
            "useCase" => "ThrowawayDCITest\\Context\\OtherUseCase",
            "step" => "start"
        )
    );
    protected static $notConfiguredRoutes = array(
        "/UnknownUseCase" => array(
            "useCase" => "ThrowawayDCITest\\Context\\UnknownUseCase",
            "step" => "default"
        ),
        "/UnknownUseCase/start" => array(
            "useCase" => "ThrowawayDCITest\\Context\\UnknownUseCase",
            "step" => "start"
        )
    );

    public function setUp()
    {
        $this->dispatcher = new Dispatcher();
    }

    public function testGetPathFromRoutesFileOK()
    {
        $this->_testRoutes(self::$configuredRoutes);
    }

    public function testGetPathOutFromRoutesFileOK()
    {
        $this->_testRoutes(self::$notConfiguredRoutes);
    }

    private function _testRoutes($routes)
    {
        foreach ($routes as $path => $expectedRoute) {
            $route = $this->dispatcher->getRoute($path);
            $this->assertTrue(is_array($route));
            $this->assertEquals($expectedRoute, $route, "The assertion fails testing the path [$path]");
        }
    }

}
