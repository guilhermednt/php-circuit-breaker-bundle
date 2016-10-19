<?php

namespace Ejsmont\CircuitBreakerBundle\Tests\Unit\DependencyInjection;

use Ejsmont\CircuitBreakerBundle\DependencyInjection\EjsmontCircuitBreakerExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class EjsmontCircuitBreakerExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadSetParameters()
    {
        $container = $this->createContainer();
        $container->registerExtension(new EjsmontCircuitBreakerExtension());
        $container->loadFromExtension('ejsmont_circuit_breaker', []);
        $this->compileContainer($container);

        $this->assertEquals(30, $container->getParameter('ejsmont_circuit_breaker.threshold'));
        $this->assertEquals(60, $container->getParameter('ejsmont_circuit_breaker.retry_timeout'));
    }

    private function createContainer()
    {
        $container = new ContainerBuilder(new ParameterBag(array(
            'kernel.cache_dir' => __DIR__,
            'kernel.root_dir' => __DIR__.'/Fixtures',
            'kernel.charset' => 'UTF-8',
            'kernel.debug' => false,
            'kernel.bundles' => array('EjsmontCircuitBreakerBundle' => 'Ejsmont\\CircuitBreakerBundle\\EjsmontCircuitBreakerBundle'),
        )));

        return $container;
    }

    private function compileContainer(ContainerBuilder $container)
    {
        $container->getCompilerPassConfig()->setOptimizationPasses(array());
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();
    }
}
