<?php

namespace FileStorageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FileStorageExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('file.storage.convert.resize',$config['convert']['resize']);
        $container->setParameter('file.storage.convert.property',$config['convert']['property']);
        $container->setParameter('file.storage.dir.public',$config['dir']['public']);
        $container->setParameter('file.storage.dir.private',$config['dir']['private']);
        $container->setParameter('file.storage.dir.preview',$config['dir']['preview']);
        $container->setParameter('file.storage.dir.level',$config['dir']['level']);
        $container->setParameter('file.storage.CORS',$config['CORS']);

        $container->setParameter('file.storage.preview.save',$config['preview']['save']);
        $container->setParameter('file.storage.preview.default',$config['preview']['default']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
