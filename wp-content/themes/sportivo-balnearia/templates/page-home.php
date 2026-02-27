<?php
/**
 * Template de página: Inicio
 *
 * @package sportivo-balnearia
 * Template Name: Página de Inicio
 */

get_header();
?>

<main id="main" class="site-main">

    <!-- Hero Section -->
    <section class="csb-hero">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="csb-hero__bg" style="background-image: url('<?php the_post_thumbnail_url('csb-hero'); ?>');" aria-hidden="true"></div>
        <?php endif; ?>
        <div class="csb-hero__content">
            <h1 class="csb-hero__title">
                Club Sportivo<br><span>Balnearia</span>
            </h1>
            <p class="csb-hero__subtitle">Pasión, deporte y comunidad</p>
        </div>
    </section>

    <!-- Acceso rápido a deportes -->
    <section class="csb-section">
        <h2 class="csb-section__title">Nuestros Deportes</h2>
        <nav class="csb-deportes-grid" aria-label="Deportes del club">
            <a href="<?php echo esc_url( get_permalink( get_page_by_path('futbol') ) ); ?>" class="csb-deporte-card csb-deporte-card--futbol">
                <span class="csb-deporte-card__icon" aria-hidden="true">⚽</span>
                <span class="csb-deporte-card__name">Fútbol</span>
            </a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path('basquet') ) ); ?>" class="csb-deporte-card csb-deporte-card--basquet">
                <span class="csb-deporte-card__icon" aria-hidden="true">🏀</span>
                <span class="csb-deporte-card__name">Básquet</span>
            </a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path('voley') ) ); ?>" class="csb-deporte-card csb-deporte-card--voley">
                <span class="csb-deporte-card__icon" aria-hidden="true">🏐</span>
                <span class="csb-deporte-card__name">Vóley</span>
            </a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path('patin') ) ); ?>" class="csb-deporte-card csb-deporte-card--patin">
                <span class="csb-deporte-card__icon" aria-hidden="true">🛼</span>
                <span class="csb-deporte-card__name">Patín</span>
            </a>
            <a href="<?php echo esc_url( get_permalink( get_page_by_path('padel') ) ); ?>" class="csb-deporte-card csb-deporte-card--padel">
                <span class="csb-deporte-card__icon" aria-hidden="true">🎾</span>
                <span class="csb-deporte-card__name">Pádel</span>
            </a>
        </nav>
    </section>

    <!-- Próximos partidos (WP Club Manager) -->
    <section class="csb-section--bg">
        <div class="csb-section">
            <h2 class="csb-section__title">Próximos Partidos</h2>
            <?php echo do_shortcode('[wpcm-fixtures limit="5"]'); ?>
        </div>
    </section>

    <!-- Últimos resultados (WP Club Manager) -->
    <section class="csb-section">
        <h2 class="csb-section__title">Últimos Resultados</h2>
        <?php echo do_shortcode('[wpcm-results limit="5"]'); ?>
    </section>

    <!-- Últimas noticias -->
    <section class="csb-section--bg">
        <div class="csb-section">
            <h2 class="csb-section__title">Últimas Noticias</h2>
            <?php
            $noticias = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );

            if ( $noticias->have_posts() ) :
                echo '<div class="csb-deportes-grid">';
                while ( $noticias->have_posts() ) :
                    $noticias->the_post();
                    ?>
                    <article class="csb-player-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'csb-card', array( 'class' => 'csb-player-card__photo' ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="csb-player-card__info">
                            <h3 class="csb-player-card__name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="csb-player-card__position"><?php echo get_the_date(); ?></p>
                        </div>
                    </article>
                    <?php
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            else :
                echo '<p>No hay noticias disponibles aún.</p>';
            endif;
            ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
