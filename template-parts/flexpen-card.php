<?php
/**
 * FlexPen Showcase Card (Custom Post Type)
 *
 * @package VitalPep_Pro
 */

$data          = vitalpep_get_flexpen_data( get_the_ID() );
$categories    = wp_get_post_terms( get_the_ID(), 'research_category', array( 'fields' => 'names' ) );
$category      = ! empty( $categories ) ? $categories[0] : 'Research Compound';
$inquiry_url   = home_url( '/contact/?product=' . urlencode( get_the_title() ) );
$badge         = $data['badge'];
$badge_classes = array(
    'Popular'     => 'popular',
    'Best Seller' => 'category',
    'New'         => 'new',
);
$badge_class = $badge_classes[ $badge ] ?? 'category';
?>

<div class="product-card animate-on-scroll">
    <div class="product-card__image">
        <div class="product-card__badges">
            <span class="product-card__badge product-card__badge--research">Research Only</span>
            <?php if ( $badge ) : ?>
                <span class="product-card__badge product-card__badge--<?php echo esc_attr( $badge_class ); ?>">
                    <?php echo esc_html( $badge ); ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="product-card__purity">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
            <?php echo esc_html( $data['purity'] ); ?> PURITY
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'flexpen-card', array( 'class' => 'product-card__thumb' ) ); ?>
        <?php else : ?>
            <svg class="product-card__icon" viewBox="0 0 80 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="25" y="8" width="30" height="90" rx="8" fill="currentColor" opacity="0.08" stroke="currentColor" stroke-width="1.5" opacity="0.3"/>
                <rect x="30" y="4" width="20" height="12" rx="3" fill="currentColor" opacity="0.2"/>
                <rect x="28" y="28" width="24" height="50" rx="4" fill="currentColor" opacity="0.06"/>
                <rect x="35" y="98" width="10" height="16" rx="2" fill="currentColor" opacity="0.2"/>
                <circle cx="40" cy="106" r="2" fill="currentColor" opacity="0.4"/>
            </svg>
        <?php endif; ?>
    </div>

    <div class="product-card__body">
        <div class="product-card__category"><?php echo esc_html( $category ); ?></div>
        <h3 class="product-card__name"><?php the_title(); ?></h3>
        <p class="product-card__desc"><?php echo esc_html( get_the_excerpt() ); ?></p>

        <div class="product-card__specs">
            <?php if ( $data['concentration'] ) : ?>
            <div class="product-card__spec">
                <span class="product-card__spec-label">Concentration</span>
                <span class="product-card__spec-value"><?php echo esc_html( $data['concentration'] ); ?></span>
            </div>
            <?php endif; ?>
            <?php if ( $data['volume'] ) : ?>
            <div class="product-card__spec">
                <span class="product-card__spec-label">Volume</span>
                <span class="product-card__spec-value"><?php echo esc_html( $data['volume'] ); ?></span>
            </div>
            <?php endif; ?>
            <div class="product-card__spec">
                <span class="product-card__spec-label">Purity</span>
                <span class="product-card__spec-value"><?php echo esc_html( $data['purity'] ); ?></span>
            </div>
            <div class="product-card__spec">
                <span class="product-card__spec-label">Storage</span>
                <span class="product-card__spec-value"><?php echo esc_html( $data['storage'] ); ?></span>
            </div>
        </div>

        <div class="product-card__thermal">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            Thermal Stability Verified
        </div>

        <a href="<?php echo esc_url( $inquiry_url ); ?>" class="btn btn--primary btn--full product-card__cta">
            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            Request Inquiry
        </a>
    </div>
</div>
