<?php

namespace Alvario\ResponseBuilderBundle\DependencyInjection\Compiler;

use Alvario\ResponseBuilderBundle\ResponseBuilder;
use Alvario\ResponseBuilderBundle\SerializerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ResponseBuilderPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(ResponseBuilder::class)) {
            return;
        }

        $builderDefinition = $container->findDefinition(ResponseBuilder::class);

        // it is unused for now, but can be useful for multiple serializers
        $serializerServices = $container->findTaggedServiceIds(SerializerInterface::TAG);
        foreach (array_keys($serializerServices) as $serializerService) {
            $builderDefinition->addMethodCall('addSerializer', [new Reference($serializerService)]);
        }
    }
}
