<?php
/**
 * Funciones del tema hijo — Club Sportivo Balnearia
 *
 * @package sportivo-balnearia
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Carga los estilos del tema padre y del tema hijo.
 */
function csb_enqueue_styles() {
    $parent_style = 'twentytwentyfour-style';

    wp_enqueue_style(
        $parent_style,
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'sportivo-balnearia-style',
        get_stylesheet_uri(),
        array( $parent_style ),
        wp_get_theme()->get( 'Version' )
    );

    wp_enqueue_style(
        'sportivo-balnearia-main',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        array( 'sportivo-balnearia-style' ),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'csb_enqueue_styles' );

/**
 * Carga los scripts del tema hijo.
 */
function csb_enqueue_scripts() {
    wp_enqueue_script(
        'sportivo-balnearia-main',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'csb_enqueue_scripts' );

/**
 * Configuración del tema.
 */
function csb_theme_setup() {
    // Soporte para miniaturas de entradas
    add_theme_support( 'post-thumbnails' );

    // Tamaños de imagen personalizados
    add_image_size( 'csb-hero', 1920, 700, true );
    add_image_size( 'csb-card', 600, 400, true );
    add_image_size( 'csb-player', 300, 400, true );

    // Soporte para HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
}
add_action( 'after_setup_theme', 'csb_theme_setup' );

/**
 * Registro de menús de navegación.
 */
function csb_register_menus() {
    register_nav_menus( array(
        'menu-principal' => __( 'Menú Principal', 'sportivo-balnearia' ),
        'menu-futbol'    => __( 'Sub-menú Fútbol', 'sportivo-balnearia' ),
        'menu-footer'    => __( 'Menú Pie de Página', 'sportivo-balnearia' ),
    ) );
}
add_action( 'init', 'csb_register_menus' );

/**
 * Registro de áreas de widgets.
 */
function csb_register_sidebars() {
    register_sidebar( array(
        'name'          => __( 'Sidebar Deportes', 'sportivo-balnearia' ),
        'id'            => 'sidebar-deportes',
        'description'   => __( 'Sidebar lateral para páginas de deportes.', 'sportivo-balnearia' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer — Contacto', 'sportivo-balnearia' ),
        'id'            => 'footer-contacto',
        'description'   => __( 'Zona de contacto en el pie de página.', 'sportivo-balnearia' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'csb_register_sidebars' );

/**
 * Agrega clases al body según el deporte de la página actual.
 *
 * @param array $classes Clases actuales del body.
 * @return array Clases modificadas.
 */
function csb_body_classes( $classes ) {
    global $post;

    if ( isset( $post ) ) {
        $deportes = array( 'futbol', 'basquet', 'voley', 'patin', 'padel' );

        foreach ( $deportes as $deporte ) {
            if (
                has_term( $deporte, 'wpcm_league', $post ) ||
                strpos( $post->post_name, $deporte ) !== false
            ) {
                $classes[] = 'deporte-' . $deporte;
            }
        }
    }

    return $classes;
}
add_filter( 'body_class', 'csb_body_classes' );
