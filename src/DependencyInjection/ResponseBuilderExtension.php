<?php


namespace alvario\ResponseBuilderBundle\DependencyInjection;

use alvario\ResponseBuilderBundle\ResponseBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class ResponseBuilderExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $builder = $container->findDefinition(ResponseBuilder::class);
        if (!empty($configs['serializer'])) {
            $builder->addMethodCall('setSerializer', [new Reference($configs['serializer'])]);
        } else {
            $builder->addMethodCall('setSerializer', [new Reference('alvario_response_bundle.jma_array_adapter')]);
        }
    }
}
