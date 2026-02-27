<?php
/**
 * Template de página para deportes sin gestión de equipos (Patín, Pádel).
 * Solo muestra Calendario y Estadísticas via Tableberg.
 *
 * @package sportivo-balnearia
 * Template Name: Deporte (sin Equipos)
 */

get_header();
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

    <!-- Contenido introductorio -->
    <?php if ( get_the_content() ) : ?>
    <section class="csb-section">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- CALENDARIO (via sub-páginas hijas) -->
    <?php
    $page_calendario = get_page_by_path( get_post_field('post_name', get_the_ID()) . '/calendario' );
    if ( $page_calendario ) :
        $cal_content = get_post_field( 'post_content', $page_calendario->ID );
    ?>
    <section class="csb-section" id="calendario">
        <h2 class="csb-section__title">Calendario</h2>
        <p class="csb-nav-link"><a href="<?php echo esc_url( get_permalink( $page_calendario->ID ) ); ?>">Ver calendario completo →</a></p>
        <!-- El contenido se gestiona con Tableberg desde el editor de bloques -->
    </section>
    <?php endif; ?>

    <!-- ESTADÍSTICAS (via sub-páginas hijas) -->
    <?php
    $page_estadisticas = get_page_by_path( get_post_field('post_name', get_the_ID()) . '/estadisticas' );
    if ( $page_estadisticas ) :
    ?>
    <section class="csb-section--bg" id="estadisticas">
        <div class="csb-section">
            <h2 class="csb-section__title">Estadísticas</h2>
            <p class="csb-nav-link"><a href="<?php echo esc_url( get_permalink( $page_estadisticas->ID ) ); ?>">Ver estadísticas completas →</a></p>
            <!-- El contenido se gestiona con Tableberg desde el editor de bloques -->
        </div>
    </section>
    <?php endif; ?>

    <!-- Sub-navegación -->
    <?php
    $children = get_pages( array(
        'parent'      => get_the_ID(),
        'sort_column' => 'menu_order',
    ) );
    if ( $children ) :
    ?>
    <section class="csb-section">
        <nav class="csb-deportes-grid" aria-label="Secciones">
            <?php foreach ( $children as $child ) : ?>
                <a href="<?php echo esc_url( get_permalink( $child->ID ) ); ?>" class="csb-deporte-card">
                    <span class="csb-deporte-card__name"><?php echo esc_html( $child->post_title ); ?></span>
                </a>
            <?php endforeach; ?>
        </nav>
    </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
