<?php

namespace Alvario\ResponseBuilderBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ResponseBuilderBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        // add compiler pass here if necessary
        $container
            ->registerForAutoconfiguration(SerializerInterface::class)
            ->addTag(SerializerInterface::TAG);
    }
}
