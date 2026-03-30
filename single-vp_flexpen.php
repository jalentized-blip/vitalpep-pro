<?php
/**
 * Single FlexPen Detail Page — Showcase Only
 *
 * @package VitalPep_Pro
 */

get_header();

while ( have_posts() ) :
    the_post();

    $data        = vitalpep_get_flexpen_data( get_the_ID() );
    $categories  = wp_get_post_terms( get_the_ID(), 'research_category', array( 'fields' => 'names' ) );
    $category    = ! empty( $categories ) ? $categories[0] : 'Research Compound';
    $inquiry_url = home_url( '/contact/?product=' . urlencode( get_the_title() ) );
?>

<section class="page-hero" style="padding-bottom: 40px;">
    <div class="hex-overlay"></div>
    <div class="container">
        <nav style="font-size: 0.875rem; color: var(--vp-gray-400); margin-bottom: 16px;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: var(--vp-accent);">Home</a>
            <span style="margin: 0 8px;">/</span>
            <a href="<?php echo esc_url( home_url( '/flexpens/' ) ); ?>" style="color: var(--vp-accent);">FlexPens</a>
            <span style="margin: 0 8px;">/</span>
            <span><?php the_title(); ?></span>
        </nav>
    </div>
</section>

<section class="section section--light" style="padding-top: 40px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 60px; align-items: start;">
            <!-- Product Image -->
            <div>
                <div style="background: linear-gradient(180deg, var(--vp-ice-light), var(--vp-ice)); border-radius: var(--radius-xl); padding: 60px; display: flex; flex-direction: column; align-items: center; position: relative;">
                    <div style="position: absolute; top: 16px; left: 16px;">
                        <span class="product-card__badge product-card__badge--research">Research Only</span>
                    </div>
                    <div style="position: absolute; top: 16px; right: 16px;" class="product-card__purity">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                        <?php echo esc_html( $data['purity'] ); ?> PURITY
                    </div>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'large', array( 'style' => 'max-width: 280px; margin: 0 auto; border-radius: 12px;' ) ); ?>
                    <?php else : ?>
                        <svg viewBox="0 0 80 120" fill="none" style="width: 140px; height: 200px; color: var(--vp-primary);">
                            <rect x="25" y="8" width="30" height="90" rx="8" fill="currentColor" opacity="0.08" stroke="currentColor" stroke-width="1.5" opacity="0.3"/>
                            <rect x="30" y="4" width="20" height="12" rx="3" fill="currentColor" opacity="0.2"/>
                            <rect x="28" y="28" width="24" height="50" rx="4" fill="currentColor" opacity="0.06"/>
                            <rect x="35" y="98" width="10" height="16" rx="2" fill="currentColor" opacity="0.2"/>
                            <circle cx="40" cy="106" r="2" fill="currentColor" opacity="0.4"/>
                        </svg>
                    <?php endif; ?>
                </div>

                <?php if ( $data['batch'] ) : ?>
                <div style="margin-top: 16px; padding: 16px; background: var(--vp-ice-light); border-radius: var(--radius-md); display: flex; align-items: center; gap: 12px;">
                    <svg width="20" height="20" fill="none" stroke="var(--vp-primary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <div>
                        <div style="font-family: var(--font-mono); font-size: 0.6875rem; color: var(--vp-gray-400); text-transform: uppercase; letter-spacing: 0.08em;">Current Batch</div>
                        <div style="font-weight: 700; color: var(--vp-navy);"><?php echo esc_html( $data['batch'] ); ?></div>
                    </div>
                    <a href="<?php echo esc_url( home_url( '/coa-reports/' ) ); ?>" style="margin-left: auto; font-size: 0.8125rem; color: var(--vp-accent); text-decoration: underline;">View COA</a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Product Details -->
            <div>
                <div style="font-family: var(--font-mono); font-size: 0.75rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--vp-accent); margin-bottom: 8px;">
                    <?php echo esc_html( $category ); ?>
                </div>
                <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--vp-navy); margin-bottom: 16px; line-height: 1.1;">
                    <?php the_title(); ?>
                </h1>
                <div style="font-size: 1.0625rem; color: var(--vp-gray-500); line-height: 1.8; margin-bottom: 32px;">
                    <?php the_content(); ?>
                </div>

                <!-- Specs -->
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 32px;">
                    <?php
                    $specs = array(
                        array( 'label' => 'Concentration', 'value' => $data['concentration'], 'color' => 'var(--vp-navy)' ),
                        array( 'label' => 'Volume', 'value' => $data['volume'], 'color' => 'var(--vp-navy)' ),
                        array( 'label' => 'Verified Purity', 'value' => $data['purity'], 'color' => 'var(--vp-success)' ),
                        array( 'label' => 'Storage', 'value' => $data['storage'], 'color' => 'var(--vp-navy)' ),
                    );
                    foreach ( $specs as $spec ) :
                        if ( ! $spec['value'] ) continue;
                    ?>
                    <div style="padding: 20px; background: var(--vp-gray-50); border-radius: var(--radius-md);">
                        <div style="font-family: var(--font-mono); font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--vp-gray-400); margin-bottom: 4px;"><?php echo esc_html( $spec['label'] ); ?></div>
                        <div style="font-size: 1.125rem; font-weight: 700; color: <?php echo $spec['color']; ?>;"><?php echo esc_html( $spec['value'] ); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="product-card__thermal" style="width: fit-content; margin-bottom: 32px;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    Thermal Stability Verified &bull; Cold-Chain Shipping Available
                </div>

                <!-- Inquiry CTA -->
                <div style="padding: 32px; background: linear-gradient(135deg, var(--vp-navy), var(--vp-dark-blue)); border-radius: var(--radius-lg); color: var(--vp-white);">
                    <div style="font-size: 0.875rem; color: var(--vp-gray-300); margin-bottom: 8px;">This compound is available by inquiry only.</div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--vp-white); margin-bottom: 20px;">Interested in this FlexPen for your research?</h3>
                    <a href="<?php echo esc_url( $inquiry_url ); ?>" class="btn btn--white btn--lg">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        Request Inquiry
                    </a>
                </div>

                <div style="display: flex; gap: 24px; margin-top: 24px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.8125rem; color: var(--vp-gray-500);">
                        <svg width="16" height="16" fill="none" stroke="var(--vp-success)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                        cGMP Manufactured
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.8125rem; color: var(--vp-gray-500);">
                        <svg width="16" height="16" fill="none" stroke="var(--vp-success)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                        Third-Party Lab Verified
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.8125rem; color: var(--vp-gray-500);">
                        <svg width="16" height="16" fill="none" stroke="var(--vp-success)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                        Netherlands Origin
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
