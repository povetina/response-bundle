<?php

namespace Alvario\ResponseBuilderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('response_builder');
        $treeBuilder
            ->getRootNode()
            ->children()
                ->scalarNode('serializer')->end()
            ->end();

        return $treeBuilder;
    }
}
