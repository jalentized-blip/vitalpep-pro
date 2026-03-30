<?php
/**
 * Main Index Template
 *
 * @package VitalPep_Pro
 */

get_header();
?>

<section class="page-hero">
    <div class="hex-overlay"></div>
    <div class="container">
        <h1 class="page-hero__title">
            <?php
            if ( is_home() ) {
                echo 'Research Updates';
            } elseif ( is_search() ) {
                printf( 'Search Results for: %s', get_search_query() );
            } elseif ( is_archive() ) {
                the_archive_title();
            } else {
                the_title();
            }
            ?>
        </h1>
        <p class="page-hero__subtitle">Latest news and publications from VitalPep Pro Pharmaceuticals.</p>
    </div>
</section>

<section class="section section--light">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="products-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="product-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="product-card__image">
                                <?php the_post_thumbnail( 'product-card' ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="product-card__body">
                            <div class="product-card__category">
                                <?php echo get_the_date( 'M j, Y' ); ?>
                            </div>
                            <h3 class="product-card__name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="product-card__desc"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn--outline btn--sm">Read More</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="text-center" style="margin-top: 48px;">
                <?php the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&larr; Previous',
                    'next_text' => 'Next &rarr;',
                ) ); ?>
            </div>
        <?php else : ?>
            <div class="text-center" style="padding: 80px 0;">
                <h2>No posts found</h2>
                <p class="section-subtitle" style="margin: 16px auto;">Check back soon for research updates and publications.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
