<?php
/**
 * FlexPen Catalog Archive — Showcase Only
 *
 * @package VitalPep_Pro
 */

get_header();
?>

<section class="page-hero">
    <div class="hex-overlay"></div>
    <div class="container">
        <span class="section-label" style="justify-content: center;">Research Catalog</span>
        <h1 class="page-hero__title">FlexPen <span style="background: linear-gradient(135deg, var(--vp-primary), var(--vp-accent)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Compounds</span></h1>
        <p class="page-hero__subtitle">Browse our complete catalog of precision-engineered research FlexPens. All compounds manufactured in our Netherlands cGMP facility. Inquire about any compound below.</p>
    </div>
</section>

<section class="section section--light">
    <div class="container">

        <!-- Filter Bar -->
        <div class="product-filters">
            <span class="product-filters__label">Filter by:</span>
            <button class="filter-pill filter-pill--active" data-filter="all">All Compounds</button>
            <?php
            $terms = get_terms( array( 'taxonomy' => 'research_category', 'hide_empty' => true ) );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
                foreach ( $terms as $term ) :
            ?>
                <button class="filter-pill" data-filter="<?php echo esc_attr( $term->slug ); ?>">
                    <?php echo esc_html( $term->name ); ?>
                </button>
            <?php endforeach; endif; ?>
            <?php if ( empty( $terms ) || is_wp_error( $terms ) ) : ?>
                <button class="filter-pill" data-filter="metabolic">Metabolic</button>
                <button class="filter-pill" data-filter="regenerative">Regenerative</button>
                <button class="filter-pill" data-filter="cognitive">Cognitive</button>
                <button class="filter-pill" data-filter="longevity">Longevity</button>
                <button class="filter-pill" data-filter="glp">GLP Agonists</button>
                <button class="filter-pill" data-filter="growth">Growth Hormone</button>
            <?php endif; ?>
        </div>

        <?php if ( have_posts() ) : ?>

            <div class="products-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/flexpen-card' ); ?>
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

            <!-- Static showcase when no CPT posts exist yet -->
            <div style="margin-bottom: 32px;">
                <span class="section-label">Full Catalog</span>
                <h2 class="section-title" style="font-size: 1.5rem;">Research <span>FlexPens</span></h2>
            </div>

            <!-- Extended showcase -->
            <div class="products-grid" style="margin-top: 28px;">
                <?php
                $showcase = array(
                    array( 'name' => 'TB-500 FlexPen', 'cat' => 'Tissue Regeneration', 'desc' => 'Thymosin Beta-4 fragment for tissue repair and wound healing mechanism studies in controlled research environments.', 'conc' => '5 mg', 'badge' => 'Popular' ),
                    array( 'name' => 'Tirzepatide FlexPen', 'cat' => 'Metabolic Research', 'desc' => 'Dual GIP/GLP-1 receptor agonist for advanced metabolic pathway investigations and glucose homeostasis research.', 'conc' => '10 mg', 'badge' => 'New' ),
                    array( 'name' => 'Sermorelin FlexPen', 'cat' => 'Growth Hormone Research', 'desc' => 'GHRH analog for growth hormone releasing pathway and pituitary function studies in laboratory settings.', 'conc' => '5 mg', 'badge' => 'Popular' ),
                    array( 'name' => 'Ipamorelin FlexPen', 'cat' => 'Growth Hormone Research', 'desc' => 'Selective GH secretagogue for clean growth hormone release mechanism research without cortisol elevation.', 'conc' => '5 mg', 'badge' => 'Popular' ),
                    array( 'name' => 'PT-141 FlexPen', 'cat' => 'Melanocortin Research', 'desc' => 'Melanocortin receptor agonist for MC3R/MC4R pathway and central nervous system research applications.', 'conc' => '10 mg', 'badge' => 'New' ),
                    array( 'name' => 'NAD+ FlexPen', 'cat' => 'Longevity Research', 'desc' => 'Nicotinamide adenine dinucleotide for cellular energy metabolism and sirtuin pathway studies.', 'conc' => '500 mg', 'badge' => 'Popular' ),
                    array( 'name' => 'Semax FlexPen', 'cat' => 'Cognitive Research', 'desc' => 'Synthetic ACTH analog for neuroprotective and nootropic mechanism investigations in research models.', 'conc' => '10 mg', 'badge' => 'New' ),
                    array( 'name' => 'MOTS-C FlexPen', 'cat' => 'Longevity Research', 'desc' => 'Mitochondrial-derived peptide for metabolic homeostasis and exercise mimetic studies in laboratory settings.', 'conc' => '10 mg', 'badge' => 'New' ),
                    array( 'name' => 'Selank FlexPen', 'cat' => 'Cognitive Research', 'desc' => 'Tuftsin analog peptide for anxiolytic mechanism research and immune modulation pathway studies.', 'conc' => '5 mg', 'badge' => 'Popular' ),
                    array( 'name' => 'AOD-9604 FlexPen', 'cat' => 'Metabolic Research', 'desc' => 'Modified hGH fragment for fat metabolism research and lipolytic pathway investigation studies.', 'conc' => '5 mg', 'badge' => 'New' ),
                    array( 'name' => 'LL-37 FlexPen', 'cat' => 'Immune Research', 'desc' => 'Human cathelicidin antimicrobial peptide for innate immunity and wound healing mechanism research.', 'conc' => '5 mg', 'badge' => 'New' ),
                    array( 'name' => 'Pinealon FlexPen', 'cat' => 'Cognitive Research', 'desc' => 'Short bioregulator peptide for pineal gland function, circadian rhythm, and neuroprotective research.', 'conc' => '10 mg', 'badge' => 'Popular' ),
                );

                foreach ( $showcase as $item ) :
                    $bc = $item['badge'] === 'New' ? 'new' : 'popular';
                ?>
                <div class="product-card animate-on-scroll">
                    <div class="product-card__image">
                        <div class="product-card__badges">
                            <span class="product-card__badge product-card__badge--research">Research Only</span>
                            <span class="product-card__badge product-card__badge--<?php echo $bc; ?>"><?php echo esc_html( $item['badge'] ); ?></span>
                        </div>
                        <div class="product-card__purity">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                            99%+ PURITY
                        </div>
                        <svg class="product-card__icon" viewBox="0 0 80 120" fill="none"><rect x="25" y="8" width="30" height="90" rx="8" fill="currentColor" opacity="0.08" stroke="currentColor" stroke-width="1.5" opacity="0.3"/><rect x="30" y="4" width="20" height="12" rx="3" fill="currentColor" opacity="0.2"/><rect x="28" y="28" width="24" height="50" rx="4" fill="currentColor" opacity="0.06"/><rect x="35" y="98" width="10" height="16" rx="2" fill="currentColor" opacity="0.2"/><circle cx="40" cy="106" r="2" fill="currentColor" opacity="0.4"/></svg>
                    </div>
                    <div class="product-card__body">
                        <div class="product-card__category"><?php echo esc_html( $item['cat'] ); ?></div>
                        <h3 class="product-card__name"><?php echo esc_html( $item['name'] ); ?></h3>
                        <p class="product-card__desc"><?php echo esc_html( $item['desc'] ); ?></p>
                        <div class="product-card__specs">
                            <div class="product-card__spec"><span class="product-card__spec-label">Concentration</span><span class="product-card__spec-value"><?php echo esc_html( $item['conc'] ); ?></span></div>
                            <div class="product-card__spec"><span class="product-card__spec-label">Volume</span><span class="product-card__spec-value">3 ml</span></div>
                            <div class="product-card__spec"><span class="product-card__spec-label">Purity</span><span class="product-card__spec-value">99%+</span></div>
                            <div class="product-card__spec"><span class="product-card__spec-label">Storage</span><span class="product-card__spec-value">2-8°C</span></div>
                        </div>
                        <div class="product-card__thermal">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                            Thermal Stability Verified
                        </div>
                        <a href="<?php echo esc_url( home_url( '/contact/?product=' . urlencode( $item['name'] ) ) ); ?>" class="btn btn--primary btn--full product-card__cta">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Request Inquiry
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
