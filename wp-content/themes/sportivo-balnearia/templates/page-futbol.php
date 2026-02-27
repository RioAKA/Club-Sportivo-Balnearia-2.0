<?php
/**
 * Template de página: Fútbol (con sub-categorías: Primera/Reserva, Femenino, Inferiores).
 *
 * @package sportivo-balnearia
 * Template Name: Fútbol
 */

get_header();
?>

<main id="main" class="site-main deporte-futbol">

    <!-- Hero Fútbol -->
    <section class="csb-hero" style="min-height: 280px;">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="csb-hero__bg" style="background-image: url('<?php the_post_thumbnail_url('csb-hero'); ?>');" aria-hidden="true"></div>
        <?php endif; ?>
        <div class="csb-hero__content">
            <h1 class="csb-hero__title">⚽ <?php the_title(); ?></h1>
        </div>
    </section>

    <!-- Navegación por categorías de fútbol -->
    <section class="csb-section">
        <h2 class="csb-section__title">Categorías</h2>
        <nav class="csb-deportes-grid" aria-label="Categorías de fútbol">
            <a href="<?php echo esc_url( get_permalink( get_page_by_path('futbol/primera-reserva') ) ); ?>" class="csb-deporte-card csb-deporte-card--futbol">
                <span class="csb-deporte-card__icon" aria-hidden="true">🥇</span>
                <span class="csb-deporte-card__name">Primera y Reserva</span>
            </a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path('futbol/femenino') ) ); ?>" class="csb-deporte-card csb-deporte-card--futbol">
                <span class="csb-deporte-card__icon" aria-hidden="true">👩</span>
                <span class="csb-deporte-card__name">Femenino</span>
            </a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path('futbol/inferiores') ) ); ?>" class="csb-deporte-card csb-deporte-card--futbol">
                <span class="csb-deporte-card__icon" aria-hidden="true">⭐</span>
                <span class="csb-deporte-card__name">Inferiores</span>
            </a>
        </nav>
    </section>

    <!-- Próximos partidos — Fútbol (todos los equipos) -->
    <section class="csb-section--bg">
        <div class="csb-section">
            <h2 class="csb-section__title">Próximos Partidos</h2>
            <?php echo do_shortcode( '[wpcm-fixtures limit="6"]' ); ?>
        </div>
    </section>

    <!-- Últimos resultados — Fútbol -->
    <section class="csb-section">
        <h2 class="csb-section__title">Últimos Resultados</h2>
        <?php echo do_shortcode( '[wpcm-results limit="6"]' ); ?>
    </section>

</main>

<?php get_footer(); ?>
