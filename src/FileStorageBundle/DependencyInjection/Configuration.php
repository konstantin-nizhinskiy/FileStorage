<?php

namespace FileStorageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('file_storage');
        $rootNode->children()
            ->arrayNode('convert')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('resize')
                        ->defaultValue('1024')
                    ->end()
                    ->scalarNode('property')
                        ->defaultValue(
                            '-filter Triangle '.
                            '-define filter:support=2 ' .
                            '-unsharp 0.25x0.25+8+0.065. ' .
                            '-dither None ' .
                            '-quality 82 ' .
                            '-define jpeg:fancy-upsampling=off ' .
                            '-define png:compression-filter=5 ' .
                            '-define png:compression-level=9 ' .
                            '-define png:compression-strategy=1 ' .
                            '-define png:exclude-chunk=all ' .
                            '-interlace none ' .
                            '-colorspace sRGB ' .
                            '-strip '
                        )
                    ->end()

                ->end()
            ->end()
            ->arrayNode('CORS')
                ->prototype('scalar')->end()
            ->end()
        //    Access-Control-Allow-Origin
            ->arrayNode('preview')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('default')
                        ->defaultValue('200')
                    ->end()
                    ->arrayNode('save')
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end()

            ->arrayNode('dir')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('public')
                        ->defaultValue('%kernel.root_dir%/../web/fs/')
                    ->end()
                    ->scalarNode('preview')
                        ->defaultValue('%kernel.root_dir%/../web/fs/')
                    ->end()
                    ->scalarNode('private')
                        ->defaultValue('%kernel.root_dir%/../web/fs/')
                    ->end()
                    ->scalarNode('level')
                        ->defaultValue('2')
                    ->end()


                ->end()
            ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
