<?php

namespace Awaresoft\RedirectBundle\DependencyInjection;

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
        $node = $treeBuilder->root('awaresoft_redirect')->children();
        $node->arrayNode('providers')
            ->defaultValue([
                'awaresoft.redirect.provider.domain',
                'awaresoft.redirect.provider.url',
                'awaresoft.redirect.provider.error',
            ])
            ->prototype('scalar')->end()
            ->end();

        return $treeBuilder;
    }
}
