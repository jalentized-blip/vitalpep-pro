<?php
/**
 * Template Name: FAQ Page
 *
 * FAQ items are managed as the "vp_faq" custom post type.
 * Each FAQ's title = question, content = answer.
 * Group them using the "faq_section" taxonomy.
 *
 * @package VitalPep_Pro
 */

get_header();

// Get all FAQ section terms, ordered by term_id (creation order)
$faq_sections = get_terms( array(
    'taxonomy'   => 'faq_section',
    'hide_empty' => true,
    'orderby'    => 'term_id',
    'order'      => 'ASC',
) );

// Fallback: if no FAQ CPT items exist yet, show a helpful admin notice
$total_faqs = wp_count_posts( 'vp_faq' );
$has_faqs   = ( isset( $total_faqs->publish ) && $total_faqs->publish > 0 );
?>

<section class="page-hero">
    <div class="hex-overlay"></div>
    <div class="container">
        <span class="section-label" style="justify-content: center;"><?php echo vpp_text( 'vpp_faqpage_hero_label', 'Support' ); ?></span>
        <h1 class="page-hero__title"><?php echo vpp_text( 'vpp_faqpage_hero_title', 'Frequently Asked Questions' ); ?></h1>
        <p class="page-hero__subtitle"><?php echo vpp_textarea( 'vpp_faqpage_hero_subtitle', 'Find answers to common questions about VitalPep Pro FlexPen compounds, ordering, quality assurance, and compliance.' ); ?></p>
    </div>
</section>

<section class="section section--light">
    <div class="container container--narrow">

        <?php if ( ! $has_faqs ) : ?>
            <?php if ( current_user_can( 'edit_posts' ) ) : ?>
                <div style="padding:40px;background:#fff3cd;border:1px solid #ffc107;border-radius:12px;text-align:center;margin-bottom:40px;">
                    <h3 style="color:#856404;margin-bottom:12px;">No FAQ Items Yet</h3>
                    <p style="color:#856404;margin-bottom:16px;">Add FAQ items from <strong>FAQ Items → Add New</strong> in the admin sidebar. Use the <strong>FAQ Sections</strong> taxonomy to group them (e.g., General, Quality & Testing, Ordering).</p>
                    <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=vp_faq' ) ); ?>" class="btn btn--primary" style="display:inline-block;padding:12px 24px;">Add Your First FAQ</a>
                </div>
            <?php else : ?>
                <p style="text-align:center;color:var(--vp-gray-500);padding:60px 0;">FAQ content coming soon.</p>
            <?php endif; ?>

        <?php elseif ( ! empty( $faq_sections ) && ! is_wp_error( $faq_sections ) ) : ?>

            <?php foreach ( $faq_sections as $section ) : ?>
                <?php
                $faqs = get_posts( array(
                    'post_type'      => 'vp_faq',
                    'posts_per_page' => 50,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'tax_query'      => array( array(
                        'taxonomy' => 'faq_section',
                        'field'    => 'term_id',
                        'terms'    => $section->term_id,
                    ) ),
                ) );
                if ( empty( $faqs ) ) continue;
                ?>
                <div style="margin-bottom: 48px;">
                    <h2 style="font-size: 1.375rem; font-weight: 700; color: var(--vp-navy); margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid var(--vp-ice);">
                        <?php echo esc_html( $section->name ); ?>
                    </h2>
                    <div class="faq-list">
                        <?php foreach ( $faqs as $faq ) : ?>
                            <div class="faq-item">
                                <button class="faq-item__question">
                                    <?php echo esc_html( $faq->post_title ); ?>
                                    <span class="faq-item__icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    </span>
                                </button>
                                <div class="faq-item__answer">
                                    <?php echo wp_kses_post( apply_filters( 'the_content', $faq->post_content ) ); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php
            // Also show any FAQs that have NO section assigned
            $uncategorized = get_posts( array(
                'post_type'      => 'vp_faq',
                'posts_per_page' => 50,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'tax_query'      => array( array(
                    'taxonomy' => 'faq_section',
                    'operator' => 'NOT EXISTS',
                ) ),
            ) );
            if ( ! empty( $uncategorized ) ) : ?>
                <div style="margin-bottom: 48px;">
                    <h2 style="font-size: 1.375rem; font-weight: 700; color: var(--vp-navy); margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid var(--vp-ice);">
                        Other
                    </h2>
                    <div class="faq-list">
                        <?php foreach ( $uncategorized as $faq ) : ?>
                            <div class="faq-item">
                                <button class="faq-item__question">
                                    <?php echo esc_html( $faq->post_title ); ?>
                                    <span class="faq-item__icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    </span>
                                </button>
                                <div class="faq-item__answer">
                                    <?php echo wp_kses_post( apply_filters( 'the_content', $faq->post_content ) ); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <?php
            // Fallback: show any FAQs without taxonomy filtering
            $all_faqs = get_posts( array(
                'post_type'      => 'vp_faq',
                'posts_per_page' => 50,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ) );
            ?>
            <div class="faq-list">
                <?php foreach ( $all_faqs as $faq ) : ?>
                    <div class="faq-item">
                        <button class="faq-item__question">
                            <?php echo esc_html( $faq->post_title ); ?>
                            <span class="faq-item__icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </span>
                        </button>
                        <div class="faq-item__answer">
                            <?php echo wp_kses_post( apply_filters( 'the_content', $faq->post_content ) ); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- CTA -->
        <div class="text-center" style="margin-top: 48px; padding: 40px; background: var(--vp-ice-light); border-radius: var(--radius-lg);">
            <h3 style="font-size: 1.25rem; color: var(--vp-navy); margin-bottom: 12px;"><?php echo vpp_text( 'vpp_faqpage_cta_title', 'Still have questions?' ); ?></h3>
            <p style="color: var(--vp-gray-500); margin-bottom: 24px;"><?php echo vpp_text( 'vpp_faqpage_cta_text', 'Our research team is here to help with any additional inquiries about our FlexPen compounds.' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <?php echo vpp_text( 'vpp_faqpage_cta_btn', 'Submit an Inquiry' ); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
