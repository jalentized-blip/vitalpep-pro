<?php
/**
 * Static Featured Products (fallback when WooCommerce has no featured products)
 *
 * @package VitalPep_Pro
 */

$products = array(
    array(
        'name'          => 'GHK-Cu FlexPen',
        'category'      => 'Skin & Collagen Research',
        'desc'          => 'Advanced copper peptide compound supporting research in skin renewal, collagen synthesis, and cellular regeneration pathways.',
        'concentration' => '100 mg',
        'volume'        => '3 ml',
        'purity'        => '99.2%',
        'storage'       => '2-8°C',
        'badge'         => 'Popular',
        'badge_class'   => 'popular',
    ),
    array(
        'name'          => 'BPC-157 FlexPen',
        'category'      => 'Tissue Regeneration',
        'desc'          => 'Body Protective Compound-157 for advanced research in tissue repair mechanisms, gastrointestinal recovery, and wound healing studies.',
        'concentration' => '5 mg',
        'volume'        => '3 ml',
        'purity'        => '99.4%',
        'storage'       => '2-8°C',
        'badge'         => 'Best Seller',
        'badge_class'   => 'category',
    ),
    array(
        'name'          => 'Semaglutide FlexPen',
        'category'      => 'Metabolic Research',
        'desc'          => 'GLP-1 receptor agonist FlexPen formulation for metabolic pathway research, glucose metabolism studies, and satiety signaling analysis.',
        'concentration' => '5 mg',
        'volume'        => '3 ml',
        'purity'        => '99.1%',
        'storage'       => '2-8°C',
        'badge'         => 'New',
        'badge_class'   => 'new',
    ),
    array(
        'name'          => 'Epithalon FlexPen',
        'category'      => 'Longevity Research',
        'desc'          => 'Tetrapeptide compound for investigating telomerase activity, cellular aging mechanisms, and pineal gland function in research models.',
        'concentration' => '10 mg',
        'volume'        => '3 ml',
        'purity'        => '99.3%',
        'storage'       => '2–8°C (36–46°F)',
        'badge'         => 'Popular',
        'badge_class'   => 'popular',
    ),
);
?>

<div class="products-grid">
    <?php foreach ( $products as $product ) : ?>
    <div class="product-card animate-on-scroll">
        <div class="product-card__image">
            <div class="product-card__badges">
                <span class="product-card__badge product-card__badge--research">Research Only</span>
                <span class="product-card__badge product-card__badge--<?php echo esc_attr( $product['badge_class'] ); ?>">
                    <?php echo esc_html( $product['badge'] ); ?>
                </span>
            </div>
            <div class="product-card__purity">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                <?php echo esc_html( $product['purity'] ); ?> PURITY
            </div>
            <!-- FlexPen SVG Icon -->
            <svg class="product-card__icon" viewBox="0 0 80 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="25" y="8" width="30" height="90" rx="8" fill="currentColor" opacity="0.08" stroke="currentColor" stroke-width="1.5" opacity="0.3"/>
                <rect x="30" y="4" width="20" height="12" rx="3" fill="currentColor" opacity="0.2"/>
                <rect x="28" y="28" width="24" height="50" rx="4" fill="currentColor" opacity="0.06"/>
                <rect x="35" y="98" width="10" height="16" rx="2" fill="currentColor" opacity="0.2"/>
                <circle cx="40" cy="106" r="2" fill="currentColor" opacity="0.4"/>
            </svg>
        </div>
        <div class="product-card__body">
            <div class="product-card__category"><?php echo esc_html( $product['category'] ); ?></div>
            <h3 class="product-card__name"><?php echo esc_html( $product['name'] ); ?></h3>
            <p class="product-card__desc"><?php echo esc_html( $product['desc'] ); ?></p>

            <div class="product-card__specs">
                <div class="product-card__spec">
                    <span class="product-card__spec-label">Concentration</span>
                    <span class="product-card__spec-value"><?php echo esc_html( $product['concentration'] ); ?></span>
                </div>
                <div class="product-card__spec">
                    <span class="product-card__spec-label">Volume</span>
                    <span class="product-card__spec-value"><?php echo esc_html( $product['volume'] ); ?></span>
                </div>
                <div class="product-card__spec">
                    <span class="product-card__spec-label">Purity</span>
                    <span class="product-card__spec-value"><?php echo esc_html( $product['purity'] ); ?></span>
                </div>
                <div class="product-card__spec">
                    <span class="product-card__spec-label">Storage</span>
                    <span class="product-card__spec-value"><?php echo esc_html( $product['storage'] ); ?></span>
                </div>
            </div>

            <div class="product-card__thermal">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                Thermal Stability Verified
            </div>

            <a href="<?php echo esc_url( home_url( '/contact/?product=' . urlencode( $product['name'] ) ) ); ?>" class="btn btn--primary btn--full product-card__cta">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Request Inquiry
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
