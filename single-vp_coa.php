<?php
/**
 * Single COA view
 * @package VitalPep_Pro
 */

get_header();
while ( have_posts() ) : the_post();
    $strength = get_post_meta( get_the_ID(), '_vp_coa_strength', true );
    $batch    = get_post_meta( get_the_ID(), '_vp_coa_batch', true );
    $date     = get_post_meta( get_the_ID(), '_vp_coa_date', true );
    $file_url = get_post_meta( get_the_ID(), '_vp_coa_file_url', true );
    $ext_link = get_post_meta( get_the_ID(), '_vp_coa_link', true );
    $coa_url  = $file_url ? $file_url : $ext_link;
    ?>
    <section class="coa-hero" style="padding: 120px 0 60px;">
        <div class="container" style="text-align:center;">
            <span class="section-label">Certificate of Analysis</span>
            <h1 class="fp-hero__title"><?php the_title(); ?></h1>
            <?php if ( $strength ) : ?><p style="color:rgba(255,255,255,0.6);"><?php echo esc_html( $strength ); ?></p><?php endif; ?>
            <?php if ( $batch ) : ?><p style="color:rgba(255,255,255,0.4); font-family: var(--font-mono); font-size:0.8rem;">Batch: <?php echo esc_html( $batch ); ?></p><?php endif; ?>
            <?php if ( $coa_url ) : ?>
                <a href="<?php echo esc_url( $coa_url ); ?>" class="btn btn--primary" style="margin-top:24px;" target="_blank">Download / View COA</a>
            <?php endif; ?>
        </div>
    </section>
    <?php
endwhile;
get_footer();
