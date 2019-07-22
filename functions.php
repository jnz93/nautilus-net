<?php 
/**
 * NautilusNet functions and definitions
 * 
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * 
 * @package Wordpress
 * @subpackage nautilusnet
 * @since 1.0.0
 */
if( ! function_exists('nautilus_setup') ){

    /**
     * Configurações padrões e adição de suporte a varios recursos do wordpress
     */
    function nautilus_setup(){

        // Deixar o wordpress lidar com a tag de título do site
        add_theme_support('title-tag');

        // Habilitar suporte a tipos de posts
        add_theme_support('post-formats', array(
            'aside',
            'gallery',
            'link',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat'
        ));

        /**
         * Habilitar suporte a thumbnails em posts e páginas
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /**
         * O tema vai utilizar o wp_nav_menu() em dois locais
         */
        register_nav_menus(array(
            'menu-navegacao'        => 'Menu de navegação',
            'menu-institucional'    => 'Menu institucional'
        ));

        /**
         * Habilitar custom logo
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height'        => 90,
            'width'         => 120,
            'flex-height'   => true,
            'flex-width'    => true
        ));

        /**
         * Esconde admin bar em produção
         */
        show_admin_bar(false);
    }
    add_action('after_setup_theme', 'nautilus_setup');
}

/**
 * Enfileirar scripts e estilos
 */
if( ! function_exists('nautilus_enqueue_scripts') ){
    function nautilus_enqueue_scripts(){

        $theme          = wp_get_theme();
        $theme_version  = $theme->get('Version');

        // Registro das folhas CSS
        wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.1', 'all');
        wp_register_style('flexbox', get_template_directory_uri() . '/css/flexboxgrid.min.css', array(), '6.3.1', 'all');
        wp_register_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1', 'all' );

        // Lista de folhas a serem carregadas
        wp_enqueue_style('normalize');
        wp_enqueue_style('flexbox');
        wp_enqueue_style('slick-css');


        // Registro de scripts JS
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), true);
        wp_register_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), true);
        wp_register_script('eva-icons', 'https://unpkg.com/eva-icons@1.1.1/eva.min.js', array(), true);

        // Lista de scripts a serem carregados
        wp_enqueue_script('jquery');
        wp_enqueue_script('slick-slider');
        wp_enqueue_script('eva-icons');
    }
    add_action('wp_enqueue_scripts', 'nautilus_enqueue_scripts');
}

/**
 * Registro de tipos de posts
 */
require get_template_directory() . '/inc/template-posttypes.php';

/**
 * Registro de meta_boxes para os tipos de posts
 */
require get_template_directory() . '/inc/template-metaboxes.php';

/**
 * Funções auxiliares do tema
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Shortcodes
 */
require get_template_directory() . '/inc/template-shortcodes.php';