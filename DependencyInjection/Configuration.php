<?php

namespace joaomlopes\HtmlToPDFBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('jl_html_to_pdf');

        $rootNode->children()
            ->scalarNode('file')->defaultValue('%kernel.root_dir%/../vendor/tecnickcom/tcpdf/tcpdf.php')->end()
            ->scalarNode('class')->defaultValue('JLHTMLToPDF')->end()
          ->end();

        $this->addTCPDFConfig($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds the core TCPDF configuration
     *
     * @param $rootNode
     */
    protected function addTCPDFConfig(ArrayNodeDefinition $rootNode)
    {
        $rootNode
          ->children()
          ->arrayNode('tcpdf')
          ->addDefaultsIfNotSet()
          ->children()

          // Core configuration values
          // These get defined when the TCPDF bundle is booted
          ->scalarNode('tcpdf_path_url')->defaultValue('%kernel.root_dir%/../vendor/tecnickcom/tcpdf/')->end()
          ->scalarNode('_path_main')->defaultValue('%kernel.root_dir%/../vendor/tecnickcom/tcpdf/')->end()
          ->scalarNode('tcpdf_path_fonts')->defaultValue('%kernel.root_dir%/../vendor/tecnickcom/tcpdf/fonts/')->end()
          ->scalarNode('tcpdf_path_cache')->defaultValue('%kernel.cache_dir%/tcpdf')->end()
          ->scalarNode('tcpdf_path_url_cache')->defaultValue('%kernel.cache_dir%/tcpdf')->end()
          ->scalarNode('tcpdf_path_images')->defaultValue('%kernel.root_dir%/../vendor/tecnickcom/tcpdf/examples/images/')->end()
          ->scalarNode('tcpdf_blantcpdf_image')->defaultValue('%kernel.root_dir%/../vendor/tecnickcom/tcpdf/examples/images/_blank.png')->end()
          ->scalarNode('tcpdf_cell_height_ratio')->defaultValue(1.25)->end()
          ->scalarNode('tcpdf_title_magnification')->defaultValue(1.3)->end()
          ->scalarNode('tcpdf_small_ratio')->defaultValue(2/3)->end()
          ->scalarNode('tcpdf_thai_topchars')->defaultTrue()->end()
          ->scalarNode('tcpdf_calls_in_html')->defaultFalse()->end()
          ->scalarNode('tcpdf_external_config')->defaultTrue()->end()

          // Optional nice-to-have values
          ->scalarNode('head_magnification')->defaultValue(1.1)->end()
          ->scalarNode('pdf_page_format')->defaultValue('A4')->end()
          ->scalarNode('pdf_page_orientation')->defaultValue('P')->end()
          ->scalarNode('pdf_creator')->defaultValue('TCPDF')->end()
          ->scalarNode('pdf_author')->defaultValue('TCPDF')->end()
          ->scalarNode('pdf_header_title')->defaultValue('')->end()
          ->scalarNode('pdf_header_string')->defaultValue('')->end()
          ->scalarNode('pdf_title')->defaultValue('Untitled')->end()
          ->scalarNode('pdf_subject')->defaultValue('')->end()
          ->scalarNode('pdf_keywords')->defaultValue('')->end()
          ->scalarNode('pdf_header_logo')->defaultValue('')->end()
          ->scalarNode('pdf_header_logo_width')->defaultValue('')->end()
          ->scalarNode('pdf_unit')->defaultValue('mm')->end()
          ->scalarNode('pdf_margin_header')->defaultValue(5)->end()
          ->scalarNode('pdf_margin_footer')->defaultValue(10)->end()
          ->scalarNode('pdf_margin_top')->defaultValue(27)->end()
          ->scalarNode('pdf_margin_bottom')->defaultValue(25)->end()
          ->scalarNode('pdf_margin_left')->defaultValue(15)->end()
          ->scalarNode('pdf_margin_right')->defaultValue(15)->end()
          ->scalarNode('pdf_font_name_main')->defaultValue('helvetica')->end()
          ->scalarNode('pdf_font_size_main')->defaultValue(10)->end()
          ->scalarNode('pdf_font_name_data')->defaultValue('helvetica')->end()
          ->scalarNode('pdf_font_size_data')->defaultValue(8)->end()
          ->scalarNode('pdf_font_monospaced')->defaultValue('courier')->end()
          ->scalarNode('pdf_image_scale_ratio')->defaultValue(1.25)->end()
          ->end()
          ->end()
          ->end()
        ;
    }
}
