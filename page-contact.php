<?php
/**
 * Template Name: Contact / Inquiry Page
 *
 * @package VitalPep_Pro
 */

get_header();

$pre_product = isset( $_GET['product'] ) ? sanitize_text_field( $_GET['product'] ) : '';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="hex-overlay"></div>
    <div class="container">
        <span class="section-label" style="justify-content: center;"><?php echo vpp_text( 'vpp_contact_hero_label', 'Research Inquiries' ); ?></span>
        <h1 class="page-hero__title"><?php echo vpp_text( 'vpp_contact_hero_title', 'Submit a Research Inquiry' ); ?></h1>
        <p class="page-hero__subtitle"><?php echo vpp_textarea( 'vpp_contact_hero_subtitle', 'Complete the form below to inquire about any FlexPen compound. Our research liaison team responds within 24-48 business hours.' ); ?></p>
    </div>
</section>

<!-- Inquiry Section -->
<section class="section section--light">
    <div class="container">
        <div class="inquiry__grid" style="align-items: start;">
            <!-- Contact Methods -->
            <div>
                <h2 class="section-title" style="font-size: 1.75rem;"><?php echo vpp_text( 'vpp_contact_sidebar_title', 'How to Reach Us' ); ?></h2>
                <p class="section-subtitle" style="margin-bottom: 32px;">
                    <?php echo vpp_textarea( 'vpp_contact_sidebar_text', 'VitalPep Pro Pharmaceuticals operates on an inquiry-based model to ensure proper documentation and compliance for all research compound requests.' ); ?>
                </p>

                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div class="inquiry__method" style="background: var(--vp-ice-light); border-color: var(--vp-gray-100);">
                        <div class="inquiry__method-icon" style="background: var(--vp-ice); color: var(--vp-primary);">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <div class="inquiry__method-title" style="color: var(--vp-navy);"><?php echo vpp_text( 'vpp_contact_method1_title', 'Formal Inquiry Form' ); ?></div>
                            <div class="inquiry__method-text" style="color: var(--vp-gray-500);"><?php echo vpp_text( 'vpp_contact_method1_text', 'Use the form to submit detailed compound requests with specifications' ); ?></div>
                        </div>
                    </div>
                    <div class="inquiry__method" style="background: var(--vp-ice-light); border-color: var(--vp-gray-100);">
                        <div class="inquiry__method-icon" style="background: var(--vp-ice); color: var(--vp-primary);">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <div>
                            <div class="inquiry__method-title" style="color: var(--vp-navy);"><?php echo vpp_text( 'vpp_contact_method2_title', 'Secure Messaging' ); ?></div>
                            <div class="inquiry__method-text" style="color: var(--vp-gray-500);"><?php echo vpp_text( 'vpp_contact_method2_text', 'Encrypted messaging available for established research partners' ); ?></div>
                        </div>
                    </div>
                    <div class="inquiry__method" style="background: var(--vp-ice-light); border-color: var(--vp-gray-100);">
                        <div class="inquiry__method-icon" style="background: var(--vp-ice); color: var(--vp-primary);">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <div class="inquiry__method-title" style="color: var(--vp-navy);"><?php echo vpp_text( 'vpp_contact_method3_title', 'Institutional Orders' ); ?></div>
                            <div class="inquiry__method-text" style="color: var(--vp-gray-500);"><?php echo vpp_text( 'vpp_contact_method3_text', 'Bulk orders and custom formulations for research institutions' ); ?></div>
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div style="margin-top: 32px; padding: 24px; background: var(--vp-ice-light); border: 1px solid var(--vp-gray-100); border-radius: var(--radius-md);">
                    <h4 style="font-size: 0.875rem; font-weight: 700; color: var(--vp-navy); margin-bottom: 12px;">
                        <svg width="16" height="16" fill="none" stroke="var(--vp-accent)" viewBox="0 0 24 24" style="vertical-align: -2px; margin-right: 6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Important Notice
                    </h4>
                    <p style="font-size: 0.875rem; color: var(--vp-gray-500); line-height: 1.7;">
                        <?php echo vpp_textarea( 'vpp_contact_notice', 'All VitalPep Pro compounds are manufactured and distributed exclusively for legitimate laboratory research purposes. Inquiries must specify intended research use and institutional affiliation when applicable. We reserve the right to verify research credentials before fulfilling orders.' ); ?>
                    </p>
                </div>
            </div>

            <!-- Inquiry Form -->
            <div class="inquiry__form" style="box-shadow: var(--shadow-lg); border: 1px solid var(--vp-gray-100);">
                <h3 class="inquiry__form-title"><?php echo vpp_text( 'vpp_contact_form_title', 'Research Inquiry Form' ); ?></h3>
                <p class="inquiry__form-subtitle"><?php echo vpp_text( 'vpp_contact_form_subtitle', 'Fields marked with * are required. We typically respond within 24-48 business hours.' ); ?></p>

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
                                <?php
                                // Pull products dynamically from FlexPen CPT
                                $fp_posts = get_posts( array(
                                    'post_type'      => 'vp_flexpen',
                                    'posts_per_page' => 50,
                                    'orderby'        => 'title',
                                    'order'          => 'ASC',
                                    'post_status'    => 'publish',
                                ) );
                                // Built-in products (always shown even without CPT entries)
                                $builtin = array( 'GHK-Cu FlexPen', 'Retatrutide FlexPen', 'Melanotan II FlexPen', 'NAD+ FlexPen', 'Semaglutide FlexPen', 'Tirzepatide FlexPen', 'BPC-157 + TB-500 Blend FlexPen' );
                                $shown = array();
                                // Show CPT products first
                                foreach ( $fp_posts as $fp ) {
                                    $name = esc_html( $fp->post_title );
                                    $shown[] = $name;
                                    echo '<option value="' . esc_attr( $name ) . '"' . selected( $pre_product, $name, false ) . '>' . $name . '</option>';
                                }
                                // Show built-ins not already covered by CPT
                                foreach ( $builtin as $bp ) {
                                    if ( ! in_array( $bp, $shown ) ) {
                                        echo '<option value="' . esc_attr( $bp ) . '"' . selected( $pre_product, $bp, false ) . '>' . esc_html( $bp ) . '</option>';
                                    }
                                }
                                ?>
                                <option value="Custom / Bulk Order" <?php selected( $pre_product, 'Custom / Bulk Order' ); ?>>Custom / Bulk Order</option>
                                <option value="Other" <?php selected( $pre_product, 'Other' ); ?>>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inquiry_qty">Estimated Quantity</label>
                        <select id="inquiry_qty" name="quantity">
                            <option value="">Select quantity range</option>
                            <option value="1-5">1-5 units</option>
                            <option value="6-20">6-20 units</option>
                            <option value="21-50">21-50 units</option>
                            <option value="50+">50+ units (Bulk)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inquiry_message">Research Inquiry Details *</label>
                        <textarea id="inquiry_message" name="message" required placeholder="Describe your research requirements, specific concentrations needed, delivery timeline, and any special formulation requests..." style="min-height: 140px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary btn--full btn--lg">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        <?php echo vpp_text( 'vpp_contact_btn', 'Submit Research Inquiry' ); ?>
                    </button>
                    <p class="form-disclaimer">
                        <?php echo vpp_textarea( 'vpp_contact_disclaimer', 'By submitting this form, you confirm your inquiry is for legitimate laboratory research purposes. All communications are encrypted. We do not share your information with third parties. Response within 24-48 business hours.' ); ?>
                    </p>
                </form>

                <div id="inquirySuccess" style="display: none; text-align: center; padding: 40px 0;">
                    <svg width="60" height="60" fill="none" stroke="#27ae60" viewBox="0 0 24 24" style="margin: 0 auto 16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3 style="color: var(--vp-navy); margin-bottom: 8px;"><?php echo vpp_text( 'vpp_contact_success_title', 'Inquiry Submitted Successfully' ); ?></h3>
                    <p style="color: var(--vp-gray-500);"><?php echo vpp_text( 'vpp_contact_success_text', 'Our research liaison team will review your inquiry and respond within 24-48 business hours. A confirmation has been sent to your email.' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
