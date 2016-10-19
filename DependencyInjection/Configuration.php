<?php

namespace Ejsmont\CircuitBreakerBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ejsmont_circuit_breaker');
        $rootNode
            ->children()
                ->integerNode('threshold')
                    ->min(0)
                    ->defaultValue(30)
                ->end()
                ->integerNode('retry_timeout')
                    ->min(0)
                    ->defaultValue(60)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
