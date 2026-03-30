<?php
/**
 * Single Post Template
 *
 * @package VitalPep_Pro
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="page-hero">
    <div class="hex-overlay"></div>
    <div class="container">
        <div style="font-family: var(--font-mono); font-size: 0.75rem; color: var(--vp-accent); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 12px;">
            <?php echo get_the_date( 'F j, Y' ); ?>
        </div>
        <h1 class="page-hero__title"><?php the_title(); ?></h1>
    </div>
</section>

<section class="section section--light">
    <div class="container container--narrow">
        <?php if ( has_post_thumbnail() ) : ?>
            <div style="margin-bottom: 40px; border-radius: var(--radius-lg); overflow: hidden;">
                <?php the_post_thumbnail( 'hero-image' ); ?>
            </div>
        <?php endif; ?>

        <article style="font-size: 1.0625rem; line-height: 1.9; color: var(--vp-gray-600);">
            <?php the_content(); ?>
        </article>

        <div style="margin-top: 60px; padding-top: 40px; border-top: 1px solid var(--vp-gray-100); display: flex; justify-content: space-between;">
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            ?>
            <div>
                <?php if ( $prev ) : ?>
                    <a href="<?php echo get_permalink( $prev ); ?>" class="btn btn--outline btn--sm">&larr; Previous</a>
                <?php endif; ?>
            </div>
            <div>
                <?php if ( $next ) : ?>
                    <a href="<?php echo get_permalink( $next ); ?>" class="btn btn--outline btn--sm">Next &rarr;</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
