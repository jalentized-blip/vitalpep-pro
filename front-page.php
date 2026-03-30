<?php
/**
 * Front Page Template
 *
 * @package VitalPep_Pro
 */

get_header();
?>

<!-- ============================================
     PRODUCT SHOWCASE HERO
     ============================================ -->
<section class="showcase-hero">
    <div class="showcase-grid-lines"></div>
    <div class="hex-overlay" style="opacity: 0.02;"></div>
    <div class="container">
        <div class="showcase-hero__inner">
            <div class="showcase-hero__content">
                <div class="showcase-hero__eyebrow">
                    <span class="showcase-hero__eyebrow-dot"></span>
                    <?php echo vpp_text( 'vpp_hero_badge', 'Netherlands cGMP Laboratory' ); ?>
                </div>
                <h1 class="showcase-hero__title">
                    <?php echo vpp_text( 'vpp_hero_headline_1', 'Precision' ); ?><br><span class="showcase-hero__title-gradient"><?php echo vpp_text( 'vpp_hero_headline_2', 'Research' ); ?></span><br><?php echo vpp_text( 'vpp_hero_headline_3', 'FlexPens' ); ?>
                </h1>
                <p class="showcase-hero__desc"><?php echo vpp_textarea( 'vpp_hero_subtitle', 'Advanced peptide FlexPen formulations engineered for analytical precision. Every batch manufactured in our Netherlands facility under strict cGMP protocols with full third-party verification.' ); ?></p>
                <div class="showcase-hero__ctas">
                    <a href="<?php echo esc_url( home_url( '/flexpens/' ) ); ?>" class="btn btn--primary btn--lg">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        <?php echo vpp_text( 'vpp_hero_btn_primary', 'Explore Catalog' ); ?>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/coa-reports/' ) ); ?>" class="btn btn--outline btn--lg" style="border-color: rgba(255,255,255,0.2); color: rgba(255,255,255,0.8);">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <?php echo vpp_text( 'vpp_hero_btn_secondary', 'View Lab Reports' ); ?>
                    </a>
                </div>
                <div class="showcase-hero__trust">
                    <div class="showcase-hero__trust-item">
                        <div class="showcase-hero__trust-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                        <div><div class="showcase-hero__trust-label">99%+ Purity</div><div class="showcase-hero__trust-sub">HPLC Verified</div></div>
                    </div>
                    <div class="showcase-hero__trust-item">
                        <div class="showcase-hero__trust-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                        <div><div class="showcase-hero__trust-label">Global Shipping</div><div class="showcase-hero__trust-sub">DDP Available</div></div>
                    </div>
                    <div class="showcase-hero__trust-item">
                        <div class="showcase-hero__trust-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                        <div><div class="showcase-hero__trust-label">Verified COAs</div><div class="showcase-hero__trust-sub">Third-Party Lab</div></div>
                    </div>
                </div>
            </div>

            <div class="showcase-stage">
                <!-- Ambient glow layers -->
                <div class="hero-glow hero-glow--core"></div>
                <div class="hero-glow hero-glow--ring1"></div>
                <div class="hero-glow hero-glow--ring2"></div>

                <!-- Spinning orbital rings -->
                <div class="hero-orbit hero-orbit--1"></div>
                <div class="hero-orbit hero-orbit--2"></div>
                <div class="hero-orbit hero-orbit--3"></div>

                <!-- Particle dots -->
                <div class="hero-particles" id="heroParticles"></div>

                <!-- Floating spec chips (reveal on hover) -->
                <div class="showcase-chip showcase-chip--tl"><span class="showcase-chip__icon showcase-chip__icon--green"><svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg></span><?php echo vpp_text( 'vpp_hero_chip_1', 'cGMP Certified' ); ?></div>
                <div class="showcase-chip showcase-chip--tr"><span class="showcase-chip__icon showcase-chip__icon--blue"><svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg></span><?php echo vpp_text( 'vpp_hero_chip_2', '99%+ Purity' ); ?></div>
                <div class="showcase-chip showcase-chip--bl"><span class="showcase-chip__icon showcase-chip__icon--amber"><svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg></span><?php echo vpp_text( 'vpp_hero_chip_3', '2–8°C Storage' ); ?></div>
                <div class="showcase-chip showcase-chip--br"><span class="showcase-chip__icon showcase-chip__icon--purple"><svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></span><?php echo vpp_text( 'vpp_hero_chip_4', 'Batch NL-2026' ); ?></div>

                <!-- Pen carousel -->
                <div class="showcase-stage__product hero-pen-wrap" id="heroPen">
                    <div class="hero-pen-shadow"></div>
                    <div class="hero-carousel" id="heroCarousel">
                        <?php
                        /* Hero pens — pulled from FlexPen CPT (Show in Showcase checked) */
                        $hero_pen_posts = get_posts( array(
                            'post_type'      => 'vp_flexpen',
                            'post_status'    => 'publish',
                            'posts_per_page' => -1,
                            'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
                            'meta_query'     => array( array( 'key' => '_vpp_fp_show_in_reel', 'value' => '1' ) ),
                        ) );
                        $hero_pens = array();
                        foreach ( $hero_pen_posts as $hp ) {
                            /* Priority: dedicated carousel image → Featured Image → legacy fallback */
                            $img = get_post_meta( $hp->ID, '_vpp_fp_img_carousel', true );
                            if ( ! $img ) $img = get_the_post_thumbnail_url( $hp->ID, 'large' );
                            if ( ! $img ) {
                                $fb = get_post_meta( $hp->ID, '_vpp_fp_img_fallback', true );
                                if ( $fb ) $img = VITALPEP_URI . '/assets/images/' . $fb;
                            }
                            if ( ! $img ) continue;
                            $hero_pens[] = array( 'url' => $img, 'name' => get_the_title( $hp->ID ) );
                        }

                        /* Add any extra pens uploaded via Customizer (legacy support) */
                        for ( $s = 1; $s <= 6; $s++ ) {
                            $img   = get_theme_mod( "vpp_carousel_img_{$s}", '' );
                            $label = get_theme_mod( "vpp_carousel_label_{$s}", '' );
                            if ( $img ) {
                                $hero_pens[] = array( 'url' => $img, 'name' => $label ? $label : "Pen {$s}" );
                            }
                        }

                        foreach ( $hero_pens as $i => $pen ) : ?>
                            <img src="<?php echo esc_url( $pen['url'] ); ?>"
                                 alt="VitalPep Pro <?php echo esc_attr( $pen['name'] ); ?> FlexPen"
                                 class="hero-pen-img hero-carousel__slide<?php echo $i === 0 ? ' active' : ''; ?>"
                                 data-label="<?php echo esc_attr( $pen['name'] ); ?>"
                                 <?php echo $i === 0 ? 'id="heroPenImg"' : ''; ?>>
                        <?php endforeach; ?>
                    </div>
                    <div class="hero-pen-shine"></div>
                    <div class="hero-carousel__label" id="heroCarouselLabel"><?php echo esc_html( $hero_pens[0]['name'] ); ?></div>
                    <div class="hero-carousel__dots" id="heroCarouselDots">
                        <?php foreach ( $hero_pens as $i => $pen ) : ?>
                            <button class="hero-carousel__dot<?php echo $i === 0 ? ' active' : ''; ?>"
                                    data-index="<?php echo $i; ?>"
                                    aria-label="<?php echo esc_attr( $pen['name'] ); ?>"></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="showcase-hero__scroll"><span>Scroll to explore</span><div class="showcase-hero__scroll-line"></div></div>
</section>

<!-- ============================================
     TRUST BAR
     ============================================ -->
<section class="trust-bar">
    <div class="container">
        <div class="trust-bar__grid">
            <?php
            $trust_icons = array(
                '1' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
                '2' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                '3' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                '4' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>',
            );
            $trust_defaults = array(
                '1' => array( 'title' => 'Every Batch 7x Tested',     'text' => 'HPLC & Mass Spec Verified' ),
                '2' => array( 'title' => 'cGMP Manufacturing',         'text' => 'Netherlands Certified Facility' ),
                '3' => array( 'title' => 'Global Research Shipping',   'text' => 'DDP — Cold Chain Available' ),
                '4' => array( 'title' => 'Dedicated Research Support', 'text' => 'Inquiry Response < 24 Hours' ),
            );
            foreach ( $trust_defaults as $n => $td ) : ?>
            <div class="trust-bar__item">
                <div class="trust-bar__icon"><?php echo $trust_icons[ $n ]; ?></div>
                <div class="trust-bar__text">
                    <h4><?php echo vpp_text( "vpp_trust_{$n}_title", $td['title'] ); ?></h4>
                    <p><?php echo vpp_text( "vpp_trust_{$n}_text", $td['text'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     COMMITMENT / TRANSPARENCY SECTION
     ============================================ -->
<section class="section section--dark transparency">
    <div class="hex-overlay"></div>
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <span class="section-label"><?php echo vpp_text( 'vpp_trans_label', 'Our Commitment' ); ?></span>
            <h2 class="section-title"><?php echo vpp_text( 'vpp_trans_title', 'Committed to' ); ?> <span><?php echo vpp_text( 'vpp_trans_highlight', 'Transparency' ); ?></span></h2>
            <p class="section-subtitle" style="margin: 0 auto;">
                <?php echo vpp_textarea( 'vpp_trans_subtitle', 'Every FlexPen leaving our Netherlands facility meets the highest standards of pharmaceutical-grade manufacturing and analytical verification.' ); ?>
            </p>
        </div>

        <div class="transparency__grid">
            <?php
            $proto_defaults = array(
                '1' => array( 'num' => 'Protocol 01', 'title' => 'For Laboratory Research Use Only', 'desc' => 'All VitalPep Pro FlexPen compounds are manufactured and distributed exclusively for legitimate laboratory research purposes. Strict compliance documentation accompanies every shipment.' ),
                '2' => array( 'num' => 'Protocol 02', 'title' => 'cGMP Certified Manufacturing', 'desc' => 'Our Netherlands-based production facility operates under current Good Manufacturing Practice standards, ensuring consistent quality, traceability, and sterility across all FlexPen formulations.' ),
                '3' => array( 'num' => 'Protocol 03', 'title' => 'Third-Party Laboratory Testing', 'desc' => 'Every batch undergoes independent third-party analysis including HPLC purity testing, endotoxin screening, and sterility verification. Full COA reports are publicly accessible.' ),
                '4' => array( 'num' => 'Protocol 04', 'title' => 'Research Institution Support', 'desc' => 'Our dedicated research liaison team provides comprehensive support for institutional inquiries, bulk research orders, and custom FlexPen formulation requests tailored to your laboratory protocols.' ),
            );
            foreach ( $proto_defaults as $n => $pd ) : ?>
            <div class="transparency__card animate-on-scroll">
                <div class="transparency__card-number"><?php echo vpp_text( "vpp_protocol_{$n}_num", $pd['num'] ); ?></div>
                <h3 class="transparency__card-title"><?php echo vpp_text( "vpp_protocol_{$n}_title", $pd['title'] ); ?></h3>
                <p class="transparency__card-text"><?php echo vpp_textarea( "vpp_protocol_{$n}_desc", $pd['desc'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     THE VITALPEP STANDARD (ABOUT PREVIEW)
     ============================================ -->
<section class="section section--light molecular-bg">
    <div class="container">
        <div class="about-section__grid">
            <div class="about-section__image">
                <div class="about-section__image-placeholder">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    <span><?php echo vpp_text( 'vpp_about_image_text', 'Netherlands Research Facility' ); ?></span>
                </div>
            </div>
            <div>
                <span class="section-label"><?php echo vpp_text( 'vpp_about_label', 'The VitalPep Standard' ); ?></span>
                <h2 class="section-title"><?php echo vpp_text( 'vpp_about_title', 'Analytical Precision,' ); ?><br><span><?php echo vpp_text( 'vpp_about_highlight', 'European Excellence' ); ?></span></h2>
                <?php
                $about_desc = vpp_textarea( 'vpp_about_desc', "Founded in the Netherlands, VitalPep Pro Pharmaceuticals was established to bridge the gap between research-grade peptide compounds and the rigorous quality standards demanded by modern laboratories. Our FlexPen delivery system represents the next evolution in precise, convenient research compound administration.\n\nEvery compound is synthesized, formulated, and quality-tested within our state-of-the-art EU facility, ensuring batch-to-batch consistency that researchers can rely on." );
                $paragraphs = explode( "\n\n", $about_desc );
                foreach ( $paragraphs as $i => $para ) :
                    $mt = $i > 0 ? ' margin-top: 16px;' : '';
                ?>
                <p class="section-subtitle" style="max-width: 100%;<?php echo $mt; ?>"><?php echo wp_kses_post( $para ); ?></p>
                <?php endforeach; ?>

                <div class="about-section__stats">
                    <?php
                    $about_stat_defaults = array(
                        '1' => array( 'value' => '5',    'label' => 'FlexPen Compounds' ),
                        '2' => array( 'value' => '99%+', 'label' => 'Purity Standard' ),
                        '3' => array( 'value' => 'EU',   'label' => 'GMP Certified' ),
                    );
                    foreach ( $about_stat_defaults as $n => $sd ) : ?>
                    <div class="about-stat">
                        <div class="about-stat__number"><?php echo vpp_text( "vpp_about_stat_{$n}_value", $sd['value'] ); ?></div>
                        <div class="about-stat__label"><?php echo vpp_text( "vpp_about_stat_{$n}_label", $sd['label'] ); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     DOSING INFORMATION
     ============================================ -->
<section class="section section--ice molecular-bg">
    <div class="container">
        <div class="text-center" style="margin-bottom: 48px;">
            <span class="section-label"><?php echo vpp_text( 'vpp_dosing_section_label', 'Dosage Protocols' ); ?></span>
            <h2 class="section-title"><?php echo vpp_text( 'vpp_dosing_section_title', 'Need Dosing Information?' ); ?></h2>
            <p class="section-subtitle" style="margin: 0 auto;">
                <?php echo vpp_textarea( 'vpp_dosing_section_subtitle', 'Download the complete research protocol for each FlexPen compound, including concentration calculations, unit conversions, and administration guidelines.' ); ?>
            </p>
        </div>

        <?php
        $dosing_query = new WP_Query( array(
            'post_type'      => 'vp_flexpen',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
            'meta_query'     => array( array( 'key' => '_vpp_fp_show_in_dosing', 'value' => '1' ) ),
        ) );
        $dosing_pdfs = array();
        foreach ( $dosing_query->posts as $dp ) {
            $pdf_url = get_post_meta( $dp->ID, '_vpp_fp_pdf', true );
            if ( ! $pdf_url ) continue;
            $dosing_pdfs[] = array(
                'name'  => get_the_title( $dp ),
                'label' => 'Dosage Manual — PDF',
                'pdf'   => $pdf_url,
            );
        }
        wp_reset_postdata();
        ?>

        <div class="objectives-grid">
            <?php foreach ( $dosing_pdfs as $item ) : ?>
            <a href="<?php echo esc_url( $item['pdf'] ); ?>" class="objective-card animate-on-scroll" target="_blank" rel="noopener noreferrer">
                <div class="objective-card__icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <div class="objective-card__title"><?php echo esc_html( $item['name'] ); ?></div>
                    <div class="objective-card__count"><?php echo esc_html( $item['label'] ); ?></div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     IMMERSIVE PRODUCT REEL — HORIZONTAL SCROLL
     ============================================ -->
<?php
$pdf_base = VITALPEP_URI . '/assets/pdfs/';
$img_base = VITALPEP_URI . '/assets/images/';

// ─────────────────────────────────────────────────────────────────────────────
// Homepage Showcase — driven by the FlexPens admin (Posts → FlexPens).
// To add a pen: create/edit a FlexPen post and tick "Show in Showcase".
// Display order follows the menu_order (drag-to-sort) column in the list view.
// ─────────────────────────────────────────────────────────────────────────────
$reel_query = new WP_Query( array(
    'post_type'      => 'vp_flexpen',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
    'meta_query'     => array(
        array( 'key' => '_vpp_fp_show_in_reel', 'value' => '1' ),
    ),
) );

$reel_products = array();
foreach ( $reel_query->posts as $fp ) {
    $g = function( $k ) use ( $fp ) { return get_post_meta( $fp->ID, $k, true ); };

    // Pen photo: dedicated showcase image → Featured Image → legacy fallback
    $thumb_url = $g( '_vpp_fp_img_showcase' );
    if ( ! $thumb_url && has_post_thumbnail( $fp->ID ) ) {
        $thumb_url = get_the_post_thumbnail_url( $fp->ID, 'full' );
    }
    if ( ! $thumb_url ) {
        $fb = $g( '_vpp_fp_img_fallback' );
        if ( $fb ) $thumb_url = VITALPEP_URI . '/assets/images/' . $fb;
    }
    $thumb_id  = get_post_thumbnail_id( $fp->ID );
    $thumb_alt = $thumb_id ? trim( get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ) : '';
    if ( ! $thumb_alt ) $thumb_alt = 'VitalPep Pro ' . get_the_title( $fp ) . ' label';

    // Build 5-badge spec list from existing meta fields
    $specs = array();
    if ( $g( '_vpp_fp_purity' ) )      $specs[] = array( 'icon' => 'green',  'text' => $g( '_vpp_fp_purity' ) );
    if ( $g( '_vpp_fp_badge1' ) )      $specs[] = array( 'icon' => 'blue',   'text' => $g( '_vpp_fp_badge1' ) );
    if ( $g( '_vpp_fp_storage' ) )     $specs[] = array( 'icon' => 'amber',  'text' => $g( '_vpp_fp_storage' ) );
    if ( $g( '_vpp_fp_batch' ) )       $specs[] = array( 'icon' => 'purple', 'text' => $g( '_vpp_fp_batch' ) );
    if ( $g( '_vpp_fp_reel_extra' ) )  $specs[] = array( 'icon' => 'green',  'text' => $g( '_vpp_fp_reel_extra' ) );

    $inq_param = $g( '_vpp_fp_inquiry' ) ?: urlencode( get_the_title( $fp ) );

    $reel_products[] = array(
        'name'      => get_the_title( $fp ),
        'category'  => $g( '_vpp_fp_category' ),
        'formula'   => $g( '_vpp_fp_tagline' ),
        'dose'      => $g( '_vpp_fp_badge1' ),
        'img_type'  => $thumb_url ? 'photo' : 'label',
        'img'       => $thumb_url,
        'img_alt'   => $thumb_alt,
        'tagline'   => $g( '_vpp_fp_tagline' ),
        'desc'      => $g( '_vpp_fp_desc' ),
        'specs'     => $specs,
        'pdf'       => $g( '_vpp_fp_pdf' ),
        'pdf_label' => get_the_title( $fp ) . ' Dosage Manual',
        'inquiry'   => home_url( '/contact/?product=' . $inq_param ),
    );
}
wp_reset_postdata();

// Icon SVG helpers
function vp_spec_icon( $type ) {
    $icons = array(
        'check'   => '<svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>',
        'flask'   => '<svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
        'snow'    => '<svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M12 3v18M5.636 5.636l12.728 12.728M18.364 5.636L5.636 18.364"/></svg>',
        'badge'   => '<svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>',
    );
    return $icons[ $type ] ?? $icons['check'];
}

$spec_icon_map = array(
    'green'  => 'check',
    'blue'   => 'flask',
    'amber'  => 'snow',
    'purple' => 'badge',
);
?>

<?php if ( ! empty( $reel_products ) ) : ?>
<section class="product-reel" id="productReel" aria-label="Featured FlexPen Products">
    <div class="reel-bg-grid"></div>
    <div class="reel-orb reel-orb--1"></div>
    <div class="reel-orb reel-orb--2"></div>

    <div class="reel-header">
        <div class="container">
            <div class="reel-header__titles">
                <span class="section-label">Featured Compounds</span>
                <h2 class="section-title">Research <span>FlexPen Showcase</span></h2>
            </div>
            <div class="reel-nav">
                <span class="reel-counter" id="reelCounter">01 / <?php echo sprintf( '%02d', count( $reel_products ) ); ?></span>
                <div class="reel-dots" id="reelDots" role="tablist">
                    <?php foreach ( $reel_products as $i => $rp ) : ?>
                    <button class="reel-dot <?php echo $i === 0 ? 'is-active' : ''; ?>"
                            data-index="<?php echo $i; ?>"
                            role="tab"
                            aria-label="<?php echo esc_attr( $rp['name'] ); ?>"
                            aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                    </button>
                    <?php endforeach; ?>
                </div>
                <button class="reel-nav__btn" id="reelPrev" aria-label="Previous compound" disabled>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="reel-nav__btn" id="reelNext" aria-label="Next compound">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>

    <div class="reel-track" id="reelTrack" role="region" aria-label="Product showcase — scroll or use arrow buttons">
        <?php foreach ( $reel_products as $i => $p ) : ?>
        <div class="reel-slide" data-index="<?php echo $i; ?>" role="tabpanel">

            <!-- Visual / Label Image -->
            <div class="reel-slide__visual">
                <div class="reel-slide__glow"></div>
                <?php if ( $p['img_type'] === 'photo' ) : ?>
                    <img
                        src="<?php echo esc_url( $p['img'] ); ?>"
                        alt="<?php echo esc_attr( $p['img_alt'] ); ?>"
                        class="reel-slide__label-img"
                        loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
                    >
                <?php else : ?>
                    <div class="reel-slide__label-card" role="img" aria-label="<?php echo esc_attr( $p['name'] ); ?> product label">
                        <div class="reel-label__stripe"></div>
                        <div class="reel-label__body">
                            <div class="reel-label__brand">VitalPep Pro<sup>™</sup></div>
                            <div class="reel-label__compound"><?php echo esc_html( $p['name'] ); ?></div>
                            <div class="reel-label__dose-badge"><?php echo esc_html( $p['dose'] ); ?></div>
                            <p class="reel-label__tagline"><?php echo esc_html( $p['tagline'] ); ?></p>
                            <div class="reel-label__row">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                                Keep refrigerated.
                            </div>
                            <div class="reel-label__row">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                                Manufactured in the Netherlands.
                            </div>
                            <div class="reel-label__footer">
                                <div class="reel-label__exp">EXP <strong>10/2029</strong></div>
                                <div class="reel-label__seal">Pharma<br>Grade<br>&#10003;</div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Content -->
            <div class="reel-slide__content">
                <div class="reel-slide__num"><?php echo sprintf( '%02d', $i + 1 ); ?></div>
                <span class="reel-slide__category"><?php echo esc_html( $p['category'] ); ?></span>
                <h3 class="reel-slide__name"><?php echo esc_html( $p['name'] ); ?></h3>
                <p class="reel-slide__formula"><?php echo esc_html( $p['formula'] ); ?></p>
                <p class="reel-slide__desc"><?php echo wp_kses_post( $p['desc'] ); ?></p>

                <div class="reel-slide__specs">
                    <?php foreach ( $p['specs'] as $spec ) :
                        $ico = vp_spec_icon( $spec_icon_map[ $spec['icon'] ] ?? 'check' );
                    ?>
                    <div class="reel-spec">
                        <span class="reel-spec__icon reel-spec__icon--<?php echo esc_attr( $spec['icon'] ); ?>">
                            <?php echo $ico; ?>
                        </span>
                        <?php echo esc_html( $spec['text'] ); ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="reel-slide__ctas">
                    <a href="<?php echo esc_url( $p['pdf'] ); ?>"
                       class="btn btn--outline"
                       target="_blank"
                       rel="noopener"
                       aria-label="Download <?php echo esc_attr( $p['pdf_label'] ); ?> PDF">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <?php echo esc_html( $p['pdf_label'] ); ?>
                    </a>
                    <a href="<?php echo esc_url( $p['inquiry'] ); ?>" class="btn btn--primary">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Request Inquiry
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Progress bar -->
    <div class="reel-progress" aria-hidden="true">
        <div class="reel-progress__bar" id="reelProgressBar"></div>
    </div>

    <!-- View full catalog link -->
    <div style="text-align: center; padding: 24px 0 48px; position: relative; z-index: 2;">
        <a href="<?php echo esc_url( home_url( '/flexpens/' ) ); ?>" class="btn btn--outline" style="border-color: rgba(255,255,255,0.18); color: rgba(255,255,255,0.7);">
            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            Browse Full Compound Catalog
        </a>
    </div>
</section>
<?php endif; ?>

<!-- ============================================
     FAQ PREVIEW
     ============================================ -->
<section class="section section--ice">
    <div class="container">
        <div class="text-center" style="margin-bottom: 60px;">
            <span class="section-label"><?php echo vpp_text( 'vpp_faq_label', 'Common Questions' ); ?></span>
            <h2 class="section-title"><?php echo vpp_text( 'vpp_faq_title', 'Frequently Asked' ); ?> <span><?php echo vpp_text( 'vpp_faq_title_highlight', 'Questions' ); ?></span></h2>
        </div>

        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-item__question">
                    <?php echo vpp_text( 'vpp_faq_q1', 'What is a FlexPen and how is it different from standard vials?' ); ?>
                    <span class="faq-item__icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </span>
                </button>
                <div class="faq-item__answer">
                    <p><?php echo vpp_textarea( 'vpp_faq_a1', 'A FlexPen is a precision-engineered multi-dose injection device pre-loaded with a specific research compound. Unlike vials that require manual reconstitution, our FlexPens arrive pre-filled and ready for research use. Each pen delivers precise sub-milligram doses via a calibrated dial mechanism, eliminating measurement error and reducing compound waste.' ); ?></p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-item__question">
                    <?php echo vpp_text( 'vpp_faq_q2', 'Are your compounds suitable for human use?' ); ?>
                    <span class="faq-item__icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </span>
                </button>
                <div class="faq-item__answer">
                    <p><?php echo vpp_textarea( 'vpp_faq_a2', 'No. All VitalPep Pro FlexPens are manufactured and sold strictly for laboratory research purposes. Our compounds are not approved for human or veterinary use. Purchasers must be qualified researchers operating within a licensed laboratory facility and must comply with all applicable local regulations.' ); ?></p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-item__question">
                    <?php echo vpp_text( 'vpp_faq_q3', 'Where are your FlexPens manufactured?' ); ?>
                    <span class="faq-item__icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </span>
                </button>
                <div class="faq-item__answer">
                    <p><?php echo vpp_textarea( 'vpp_faq_a3', 'All VitalPep Pro FlexPens are manufactured in our cGMP-certified facility located in the Netherlands. Our European production standards ensure the highest levels of quality control, sterility, and batch traceability in accordance with EU pharmaceutical manufacturing regulations.' ); ?></p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-item__question">
                    <?php echo vpp_text( 'vpp_faq_q4', 'Do you provide Certificates of Analysis (COAs)?' ); ?>
                    <span class="faq-item__icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </span>
                </button>
                <div class="faq-item__answer">
                    <p><?php echo vpp_textarea( 'vpp_faq_a4', 'Yes. Every batch produced at our facility is accompanied by a comprehensive Certificate of Analysis from independent third-party laboratories. COAs include HPLC purity results, mass spectrometry confirmation, endotoxin testing, and sterility verification. These are accessible through our COA Reports page.' ); ?></p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-item__question">
                    <?php echo vpp_text( 'vpp_faq_q5', 'Do you ship internationally?' ); ?>
                    <span class="faq-item__icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </span>
                </button>
                <div class="faq-item__answer">
                    <p><?php echo vpp_textarea( 'vpp_faq_a5', 'Yes. We ship globally from our Netherlands facility. We offer DDP (Delivered Duty Paid) shipping for select regions, meaning all customs and import duties are handled on your behalf. Cold-chain shipping is available for temperature-sensitive FlexPen formulations to ensure compound integrity during transit.' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     INQUIRY CTA SECTION
     ============================================ -->
<section class="section inquiry-section">
    <div class="container">
        <div class="inquiry__grid">
            <div>
                <span class="section-label"><?php echo vpp_text( 'vpp_inquiry_label', 'Research Inquiries' ); ?></span>
                <h2 class="section-title" style="color: var(--vp-white);"><?php echo vpp_text( 'vpp_inquiry_title', 'Ready to Start Your' ); ?> <span><?php echo vpp_text( 'vpp_inquiry_title_highlight', 'Research?' ); ?></span></h2>
                <p class="section-subtitle">
                    <?php echo vpp_textarea( 'vpp_inquiry_subtitle', 'Submit a formal inquiry for any FlexPen compound in our catalog. Our research liaison team typically responds within 24-48 business hours.' ); ?>
                </p>

                <div class="inquiry__methods">
                    <div class="inquiry__method">
                        <div class="inquiry__method-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <div class="inquiry__method-title"><?php echo vpp_text( 'vpp_inquiry_method1_title', 'Formal Inquiry' ); ?></div>
                            <div class="inquiry__method-text"><?php echo vpp_text( 'vpp_inquiry_method1_text', 'Submit via form for detailed responses' ); ?></div>
                        </div>
                    </div>
                    <div class="inquiry__method">
                        <div class="inquiry__method-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <div>
                            <div class="inquiry__method-title"><?php echo vpp_text( 'vpp_inquiry_method2_title', 'Live Research Support' ); ?></div>
                            <div class="inquiry__method-text"><?php echo vpp_text( 'vpp_inquiry_method2_text', 'Chat with our team via secure messaging' ); ?></div>
                        </div>
                    </div>
                    <div class="inquiry__method">
                        <div class="inquiry__method-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <div class="inquiry__method-title"><?php echo vpp_text( 'vpp_inquiry_method3_title', 'Bulk Research Orders' ); ?></div>
                            <div class="inquiry__method-text"><?php echo vpp_text( 'vpp_inquiry_method3_text', 'Custom formulations and volume pricing' ); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inquiry Form -->
            <div class="inquiry__form">
                <h3 class="inquiry__form-title"><?php echo vpp_text( 'vpp_inquiry_form_title', 'Submit Research Inquiry' ); ?></h3>
                <p class="inquiry__form-subtitle"><?php echo vpp_text( 'vpp_inquiry_form_subtitle', 'Complete the form below and our team will contact you within 24-48 hours.' ); ?></p>

                <form id="inquiryForm" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inquiry_name">Full Name *</label>
                            <input type="text" id="inquiry_name" name="name" required placeholder="Your name">
                        </div>
                        <div class="form-group">
                            <label for="inquiry_email">Email Address *</label>
                            <input type="email" id="inquiry_email" name="email" required placeholder="researcher@institution.org">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="inquiry_org">Organization / Institution</label>
                            <input type="text" id="inquiry_org" name="organization" placeholder="Research institution name">
                        </div>
                        <div class="form-group">
                            <label for="inquiry_product">Product of Interest</label>
                            <select id="inquiry_product" name="product">
                                <option value="">Select a FlexPen</option>
                                <option value="GHK-Cu FlexPen">GHK-Cu FlexPen</option>
                                <option value="Retatrutide FlexPen">Retatrutide FlexPen</option>
                                <option value="Melanotan II FlexPen">Melanotan II FlexPen</option>
                                <option value="NAD+ FlexPen">NAD+ FlexPen</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inquiry_message">Research Inquiry Details *</label>
                        <textarea id="inquiry_message" name="message" required placeholder="Describe your research requirements, desired quantities, and any specific formulation needs..."></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary btn--full btn--lg">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        <?php echo vpp_text( 'vpp_inquiry_btn', 'Submit Inquiry' ); ?>
                    </button>
                    <p class="form-disclaimer">
                        <?php echo vpp_textarea( 'vpp_inquiry_disclaimer', 'By submitting this form, you confirm your inquiry is for legitimate laboratory research purposes only. All communications are encrypted and handled in accordance with our privacy policy.' ); ?>
                    </p>
                </form>

                <div id="inquirySuccess" style="display: none; text-align: center; padding: 40px 0;">
                    <svg width="60" height="60" fill="none" stroke="#27ae60" viewBox="0 0 24 24" style="margin: 0 auto 16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3 style="color: var(--vp-navy); margin-bottom: 8px;">Inquiry Submitted</h3>
                    <p style="color: var(--vp-gray-500);">Our research team will respond within 24-48 business hours.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
