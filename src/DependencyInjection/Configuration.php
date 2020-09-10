<?php

namespace Passioneight\Bundle\PimcoreFormsBundle\DependencyInjection;

use Passioneight\Bundle\PimcoreFormsBundle\Constant\Configuration as Config;
use Passioneight\Bundle\PimcoreFormsBundle\Form\Field\FormField;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(Config::ROOT);
        $rootNode = $treeBuilder->getRootNode();

        $this->addFormFieldConfiguration($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     */
    private function addFormFieldConfiguration(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode(Config::FORM_FIELD)
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode(Config::FORM_FIELD_LABEL_FORMAT)
                            ->defaultValue(FormField::DEFAULT_LABEL_FORMAT)
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
