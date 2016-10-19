<?php

namespace Ejsmont\CircuitBreakerBundle\Tests\Unit\DependencyInjection;


use Ejsmont\CircuitBreakerBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

/**
 * @group unit
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testGetConfigTreeBuilder()
    {
        $configuration = new Configuration();
        $this->assertInstanceOf(
            'Symfony\Component\Config\Definition\Builder\TreeBuilder',
            $configuration->getConfigTreeBuilder()
        );
    }

    public function testDefaultConfig()
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(new Configuration(), []);

        $this->assertEquals(self::getBundleDefaultConfig(), $config);
    }

    public function testNonDefaultConfig()
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(new Configuration(), [['threshold' => 20], ['retry_timeout' => 50]]);

        $expected = self::getBundleDefaultConfig();
        $expected['threshold'] = 20;
        $expected['retry_timeout'] = 50;
        $this->assertEquals($expected, $config);
    }

    protected static function getBundleDefaultConfig()
    {
        return [
            'threshold' => 30,
            'retry_timeout' => 60,
        ];
    }
}
