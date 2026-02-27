<?php
/**
 * Template de página genérico para deportes con Equipos, Calendario y Estadísticas.
 * Usado por: Básquet, Vóley.
 *
 * @package sportivo-balnearia
 * Template Name: Deporte (con Equipos)
 */

get_header();

// Slug del deporte (se extrae del slug de la página)
$deporte_slug = get_post_field( 'post_name', get_the_ID() );
?>

<main id="main" class="site-main">

    <!-- Encabezado del deporte -->
    <section class="csb-hero" style="min-height: 250px;">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="csb-hero__bg" style="background-image: url('<?php the_post_thumbnail_url('csb-hero'); ?>');" aria-hidden="true"></div>
        <?php endif; ?>
        <div class="csb-hero__content">
            <h1 class="csb-hero__title"><?php the_title(); ?></h1>
        </div>
    </section>

    <!-- Contenido introductorio de la página (desde el editor) -->
    <?php if ( get_the_content() ) : ?>
    <section class="csb-section">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- EQUIPOS -->
    <section class="csb-section--bg" id="equipos">
        <div class="csb-section">
            <h2 class="csb-section__title">Equipos / Plantilla</h2>
            <?php
            // WP Club Manager: mostrar jugadores del club asociado al deporte
            echo do_shortcode( '[wpcm-players]' );
            ?>
        </div>
    </section>

    <!-- CALENDARIO -->
    <section class="csb-section" id="calendario">
        <h2 class="csb-section__title">Calendario de Partidos</h2>
        <?php echo do_shortcode( '[wpcm-fixtures]' ); ?>
    </section>

    <!-- ESTADÍSTICAS -->
    <section class="csb-section--bg" id="estadisticas">
        <div class="csb-section">
            <h2 class="csb-section__title">Estadísticas</h2>
            <!-- Estadísticas de jugadores via WP Club Manager -->
            <?php echo do_shortcode( '[wpcm-player-stats]' ); ?>
            <!-- Tabla de posiciones manual via Tableberg (añadir bloque desde editor) -->
            <?php the_content( '', true ); ?>
        </div>
    </section>

    <!-- Sub-páginas (si existen páginas hijas) -->
    <?php
    $children = get_pages( array(
        'parent'      => get_the_ID(),
        'sort_column' => 'menu_order',
        'sort_order'  => 'ASC',
    ) );

    if ( $children ) :
    ?>
    <section class="csb-section" id="sub-categorias">
        <h2 class="csb-section__title">Categorías</h2>
        <nav class="csb-deportes-grid">
            <?php foreach ( $children as $child_page ) : ?>
                <a href="<?php echo esc_url( get_permalink( $child_page->ID ) ); ?>" class="csb-deporte-card">
                    <span class="csb-deporte-card__name"><?php echo esc_html( $child_page->post_title ); ?></span>
                </a>
            <?php endforeach; ?>
        </nav>
    </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
