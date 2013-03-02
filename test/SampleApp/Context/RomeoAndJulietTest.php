<?php

namespace SampleApp\Test;

use SampleApp\Context\RomeoAndJuliet;

class RomeoAndJuliettTest extends \PHPUnit_Framework_TestCase
{

    protected $context;

    public function setUp()
    {
        $this->context = new RomeoAndJuliet('start');
    }

    public function testStepMethod()
    {
        $result = $this->context->startStep();
        $this->assertTrue(is_array($result));
        $this->assertTrue(empty($result['errors']));
        $this->assertArrayNotHasKey('useCase', $result);
        $this->assertArrayNotHasKey('step', $result);
    }

    public function testStepMethodRedirection()
    {
        $result = $this->context->start();
        $this->assertTrue(is_array($result));
        $this->assertTrue(empty($result['errors']));
        $this->assertArrayHasKey('useCase', $result);
        $this->assertArrayHasKey('step', $result);
        $this->assertEquals('start', $result['step']);
    }

    /**
     * @expectedException \ThrowawayDCI\Exception
     */
    public function testConstructorFailsWithUnknownStep()
    {
        new RomeoAndJuliet('unknown');
    }

    /**
     * @expectedException \ThrowawayDCI\Exception
     */
    public function testUnknownStep()
    {
        $step = "unknown";
        $this->context->$step();
    }

}
