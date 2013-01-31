<?php

namespace Soloist\Bundle\CalendarBundle\DependencyInjection;

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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('soloist_calendar');

        $rootNode
            ->children()
                ->arrayNode('import_mapping')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('startDate')->defaultValue('B')->end()
                        ->scalarNode('startTime')->defaultValue('D')->end()
                        ->scalarNode('endDate')->defaultValue('C')->end()
                        ->scalarNode('endTime')->defaultValue('E')->end()
                        ->scalarNode('title')->defaultValue('A')->end()
                        ->scalarNode('description')->defaultValue('S')->end()
                        ->scalarNode('place')->defaultValue(array('F', 'G', 'H', 'I'))->end()
                        ->scalarNode('price')->defaultValue('J')->end()
                        ->scalarNode('contactName')->defaultValue('K')->end()
                        ->scalarNode('contactEmail')->defaultValue('L')->end()
                        ->scalarNode('contactWebsite')->defaultValue('M')->end()
                        ->scalarNode('contactPhone')->defaultValue('N')->end()
                        ->scalarNode('contactPhone2')->defaultValue('O')->end()
                        ->scalarNode('contactAddress')->defaultValue('P')->end()
                        ->scalarNode('contactPostCode')->defaultValue('Q')->end()
                        ->scalarNode('contactCity')->defaultValue('R')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
