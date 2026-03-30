<?php
/**
 * inc/customizer.php — VitalPep Pro Customizer Settings
 *
 * @package VitalPep_Pro
 */


function vpp_customizer( $wp_customize ) {

    /* =========================================================================
       PANEL
       ========================================================================= */
    $wp_customize->add_panel( 'vpp_options', array(
        'title'    => 'VitalPep Pro Theme',
        'priority' => 10,
    ) );

    /* =========================================================================
       SECTION: General & Branding
       ========================================================================= */
    $wp_customize->add_section( 'vpp_general', array(
        'title' => 'General & Branding',
        'panel' => 'vpp_options',
    ) );

    $wp_customize->add_setting( 'vpp_site_tagline', array(
        'default'           => 'Pharmaceuticals',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_site_tagline', array(
        'label'   => 'Site Tagline',
        'section' => 'vpp_general',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'vpp_footer_brand_text', array(
        'default'           => 'Precision-engineered FlexPen research compounds manufactured in the Netherlands. Committed to analytical purity and compliance excellence for research institutions worldwide.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_footer_brand_text', array(
        'type'    => 'textarea',
        'label'   => 'Footer Brand Text',
        'section' => 'vpp_general',
    ) );

    $wp_customize->add_setting( 'vpp_footer_copyright', array(
        'default'           => 'VitalPep Pro Pharmaceuticals B.V. — The Netherlands',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_footer_copyright', array(
        'label'   => 'Footer Copyright Text',
        'section' => 'vpp_general',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'vpp_research_disclaimer', array(
        'default'           => 'For laboratory research use only',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_research_disclaimer', array(
        'label'   => 'Research Disclaimer (Footer)',
        'section' => 'vpp_general',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'vpp_handling_disclaimer', array(
        'default'           => 'Proper handling protocols required',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_handling_disclaimer', array(
        'label'   => 'Handling Disclaimer (Footer)',
        'section' => 'vpp_general',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'vpp_coa_disclaimer', array(
        'default'           => 'COA documentation available per batch',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_coa_disclaimer', array(
        'label'   => 'COA Disclaimer (Footer)',
        'section' => 'vpp_general',
        'type'    => 'text',
    ) );

    /* =========================================================================
       SECTION: Age Gate
       ========================================================================= */
    $wp_customize->add_section( 'vpp_age_gate', array(
        'title' => 'Age Gate',
        'panel' => 'vpp_options',
    ) );

    $age_gate_settings = array(
        'vpp_age_gate_badge'       => array( 'label' => 'Age Gate Badge',       'default' => 'Age Verification Required' ),
        'vpp_age_gate_title_1'     => array( 'label' => 'Title Part 1',          'default' => 'You Must Be' ),
        'vpp_age_gate_title_highlight' => array( 'label' => 'Title Highlight (21+)', 'default' => '21+' ),
        'vpp_age_gate_title_2'     => array( 'label' => 'Title Part 2',          'default' => 'To Enter' ),
        'vpp_age_gate_dob_label'   => array( 'label' => 'Date of Birth Label',   'default' => 'Date of Birth' ),
        'vpp_age_gate_btn'         => array( 'label' => 'Button Text',           'default' => 'Verify Age & Enter' ),
    );

    foreach ( $age_gate_settings as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_age_gate',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_age_gate_subtitle', array(
        'default'           => 'VitalPep Pro research compounds are intended exclusively for adults aged 21 and older. Please confirm your date of birth to proceed.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_age_gate_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Age Gate Subtitle',
        'section' => 'vpp_age_gate',
    ) );

    $wp_customize->add_setting( 'vpp_age_gate_disclaimer', array(
        'default'           => 'By entering this site you agree that you are 21 years of age or older and that research compounds are for laboratory use only. This site does not sell products for human consumption.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_age_gate_disclaimer', array(
        'type'    => 'textarea',
        'label'   => 'Age Gate Disclaimer',
        'section' => 'vpp_age_gate',
    ) );

    /* =========================================================================
       SECTION: Hero Section
       ========================================================================= */
    $wp_customize->add_section( 'vpp_hero', array(
        'title' => 'Hero Section',
        'panel' => 'vpp_options',
    ) );

    $hero_settings = array(
        'vpp_hero_badge'        => array( 'label' => 'Hero Badge',           'default' => 'Netherlands cGMP Laboratory' ),
        'vpp_hero_headline_1'   => array( 'label' => 'Headline Line 1',      'default' => 'Precision' ),
        'vpp_hero_headline_2'   => array( 'label' => 'Headline Line 2 (gradient)', 'default' => 'Research' ),
        'vpp_hero_headline_3'   => array( 'label' => 'Headline Line 3',      'default' => 'FlexPens' ),
        'vpp_hero_btn_primary'  => array( 'label' => 'Primary Button',       'default' => 'Explore Catalog' ),
        'vpp_hero_btn_secondary'=> array( 'label' => 'Secondary Button',     'default' => 'View Lab Reports' ),
        'vpp_hero_chip_1'       => array( 'label' => 'Chip 1 (top-left)',    'default' => 'cGMP Certified' ),
        'vpp_hero_chip_2'       => array( 'label' => 'Chip 2 (top-right)',   'default' => '99%+ Purity' ),
        'vpp_hero_chip_3'       => array( 'label' => 'Chip 3 (bottom-left)', 'default' => '2–8°C Storage' ),
        'vpp_hero_chip_4'       => array( 'label' => 'Chip 4 (bottom-right)','default' => 'Batch NL-2026' ),
    );

    foreach ( $hero_settings as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_hero',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_hero_subtitle', array(
        'default'           => 'Advanced peptide FlexPen formulations engineered for analytical precision. Every batch manufactured in our Netherlands facility under strict cGMP protocols with full third-party verification.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_hero_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Hero Subtitle',
        'section' => 'vpp_hero',
    ) );

    /* =========================================================================
       SECTION: Hero Pen Carousel
       ========================================================================= */
    $wp_customize->add_section( 'vpp_hero_carousel', array(
        'title'       => 'Hero Pen Carousel',
        'panel'       => 'vpp_options',
        'description' => 'Upload up to 6 pen images for the rotating hero carousel. Use transparent PNG images for best results. Leave a slot empty to skip it.',
    ) );

    for ( $i = 1; $i <= 6; $i++ ) {
        $wp_customize->add_setting( "vpp_carousel_img_{$i}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "vpp_carousel_img_{$i}", array(
            'label'   => "Pen Image #{$i}",
            'section' => 'vpp_hero_carousel',
        ) ) );

        $wp_customize->add_setting( "vpp_carousel_label_{$i}", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_carousel_label_{$i}", array(
            'label'   => "Pen #{$i} Label",
            'section' => 'vpp_hero_carousel',
            'type'    => 'text',
        ) );
    }

    /* =========================================================================
       SECTION: Product Reel
       ========================================================================= */
    $wp_customize->add_section( 'vpp_reel', array(
        'title' => 'Product Reel',
        'panel' => 'vpp_options',
    ) );

    $wp_customize->add_setting( 'vpp_reel_label', array(
        'default'           => 'Precision Research FlexPens',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_reel_label', array(
        'label'   => 'Reel Section Label',
        'section' => 'vpp_reel',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'vpp_reel_title', array(
        'default'           => 'The Complete Lineup',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_reel_title', array(
        'label'   => 'Reel Section Title',
        'section' => 'vpp_reel',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'vpp_reel_subtitle', array(
        'default'           => 'Seven precision-engineered FlexPens. One cGMP facility. Uncompromising purity standards across every compound we produce.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_reel_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Reel Section Subtitle',
        'section' => 'vpp_reel',
    ) );

    $reel_products = array(
        'p1' => array( 'name' => 'GHK-Cu',       'conc' => '100mg / 3ml', 'badge' => 'Popular',    'desc' => 'Copper peptide for tissue repair, collagen synthesis, and hair follicle regeneration research.' ),
        'p2' => array( 'name' => 'Retatrutide',   'conc' => '30mg / 3ml',  'badge' => 'New',        'desc' => 'Triple GIP/GLP-1/Glucagon receptor agonist for advanced metabolic pathway investigation.' ),
        'p3' => array( 'name' => 'Melanotan II',  'conc' => '10mg / 3ml',  'badge' => 'Popular',    'desc' => 'Melanocortin receptor agonist for MC1R/MC4R pigmentation and appetite regulation research.' ),
        'p4' => array( 'name' => 'NAD+',          'conc' => '500mg / 3ml', 'badge' => 'Best Seller','desc' => 'Essential coenzyme for sirtuin pathway activation, DNA repair, and mitochondrial research.' ),
    );

    foreach ( $reel_products as $pid => $pdata ) {
        $n = substr( $pid, 1 );

        $wp_customize->add_setting( "vpp_reel_{$pid}_name", array(
            'default'           => $pdata['name'] . ' FlexPen',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_reel_{$pid}_name", array(
            'label'   => "Product {$n} Name",
            'section' => 'vpp_reel',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_reel_{$pid}_conc", array(
            'default'           => $pdata['conc'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_reel_{$pid}_conc", array(
            'label'   => "Product {$n} Concentration",
            'section' => 'vpp_reel',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_reel_{$pid}_badge", array(
            'default'           => $pdata['badge'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_reel_{$pid}_badge", array(
            'label'   => "Product {$n} Badge",
            'section' => 'vpp_reel',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_reel_{$pid}_desc", array(
            'default'           => $pdata['desc'],
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( 'vpp_reel_{$pid}_desc', array(
        'type'    => 'textarea',
            'label'   => "Product {$n} Short Description",
            'section' => 'vpp_reel',
        ) );
    }

    /* =========================================================================
       SECTION: Dosing Info Section
       ========================================================================= */
    $wp_customize->add_section( 'vpp_dosing', array(
        'title' => 'Dosing Info Section',
        'panel' => 'vpp_options',
    ) );

    $dosing_top = array(
        'vpp_dosing_section_label'    => array( 'label' => 'Section Label',    'default' => 'Dosage Protocols' ),
        'vpp_dosing_section_title'    => array( 'label' => 'Section Title',    'default' => 'Need Dosing Information?' ),
    );

    foreach ( $dosing_top as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_dosing',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_dosing_section_subtitle', array(
        'default'           => 'Download the complete research protocol for each FlexPen compound, including concentration calculations, unit conversions, and administration guidelines.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_dosing_section_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Section Subtitle',
        'section' => 'vpp_dosing',
    ) );

    $dosing_products = array(
        'p1' => array( 'title' => 'GHK-Cu FlexPen',       'subtitle' => 'Dosage Manual — PDF' ),
        'p2' => array( 'title' => 'Retatrutide FlexPen',   'subtitle' => 'Dosage Manual — PDF' ),
        'p3' => array( 'title' => 'Melanotan II FlexPen',  'subtitle' => 'Dosage Manual — PDF' ),
        'p4' => array( 'title' => 'NAD+ FlexPen',          'subtitle' => 'Dosage Manual — PDF' ),
    );

    foreach ( $dosing_products as $pid => $pdata ) {
        $n = substr( $pid, 1 );

        $wp_customize->add_setting( "vpp_dosing_{$pid}_title", array(
            'default'           => $pdata['title'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_dosing_{$pid}_title", array(
            'label'   => "Product {$n} Title",
            'section' => 'vpp_dosing',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_dosing_{$pid}_subtitle", array(
            'default'           => $pdata['subtitle'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_dosing_{$pid}_subtitle", array(
            'label'   => "Product {$n} Subtitle",
            'section' => 'vpp_dosing',
            'type'    => 'text',
        ) );
    }

    /* =========================================================================
       SECTION: Stats / Trust Bar
       ========================================================================= */
    $wp_customize->add_section( 'vpp_stats', array(
        'title' => 'Stats / Trust Bar',
        'panel' => 'vpp_options',
    ) );

    $stats_top = array(
        'vpp_stats_label' => array( 'label' => 'Section Label', 'default' => 'By The Numbers' ),
        'vpp_stats_title' => array( 'label' => 'Section Title', 'default' => 'Research-Grade Standards, Every Batch' ),
    );

    foreach ( $stats_top as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_stats',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_stats_subtitle', array(
        'default'           => 'Every compound we produce is subjected to the same rigorous quality process regardless of order size.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_stats_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Section Subtitle',
        'section' => 'vpp_stats',
    ) );

    $stats = array(
        '1' => array( 'value' => '99%+', 'label' => 'Average Compound Purity' ),
        '2' => array( 'value' => '72hr',  'label' => 'Standard Processing Time' ),
        '3' => array( 'value' => '100%', 'label' => 'Batches Third-Party Tested' ),
        '4' => array( 'value' => '4',    'label' => 'Active Research Compounds' ),
    );

    foreach ( $stats as $n => $sdata ) {
        $wp_customize->add_setting( "vpp_stat_{$n}_value", array(
            'default'           => $sdata['value'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_stat_{$n}_value", array(
            'label'   => "Stat {$n} Value",
            'section' => 'vpp_stats',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_stat_{$n}_label", array(
            'default'           => $sdata['label'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_stat_{$n}_label", array(
            'label'   => "Stat {$n} Label",
            'section' => 'vpp_stats',
            'type'    => 'text',
        ) );
    }

    /* =========================================================================
       SECTION: FAQ
       ========================================================================= */
    $wp_customize->add_section( 'vpp_faq', array(
        'title' => 'FAQ',
        'panel' => 'vpp_options',
    ) );

    $faq_top = array(
        'vpp_faq_label' => array( 'label' => 'Section Label', 'default' => 'Common Questions' ),
        'vpp_faq_title' => array( 'label' => 'Section Title', 'default' => 'Frequently Asked' ),
        'vpp_faq_title_highlight' => array( 'label' => 'Title Highlight Word', 'default' => 'Questions' ),
    );

    foreach ( $faq_top as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_faq',
            'type'    => 'text',
        ) );
    }

    $faq_items = array(
        '1' => array(
            'q' => 'What is a FlexPen and how is it different from standard vials?',
            'a' => 'A FlexPen is a precision-engineered multi-dose injection device pre-loaded with a specific research compound. Unlike vials that require manual reconstitution, our FlexPens arrive pre-filled and ready for research use. Each pen delivers precise sub-milligram doses via a calibrated dial mechanism, eliminating measurement error and reducing compound waste.',
        ),
        '2' => array(
            'q' => 'Are your compounds suitable for human use?',
            'a' => 'No. All VitalPep Pro FlexPens are manufactured and sold strictly for laboratory research purposes. Our compounds are not approved for human or veterinary use. Purchasers must be qualified researchers operating within a licensed laboratory facility and must comply with all applicable local regulations.',
        ),
        '3' => array(
            'q' => 'Where are your FlexPens manufactured?',
            'a' => 'All VitalPep Pro FlexPens are manufactured in our cGMP-certified facility located in the Netherlands. Our European production standards ensure the highest levels of quality control, sterility, and batch traceability in accordance with EU pharmaceutical manufacturing regulations.',
        ),
        '4' => array(
            'q' => 'Do you provide Certificates of Analysis (COAs)?',
            'a' => 'Yes. Every batch produced at our facility is accompanied by a comprehensive Certificate of Analysis from independent third-party laboratories. COAs include HPLC purity results, mass spectrometry confirmation, endotoxin testing, and sterility verification. These are accessible through our COA Reports page.',
        ),
        '5' => array(
            'q' => 'Do you ship internationally?',
            'a' => 'Yes. We ship globally from our Netherlands facility. We offer DDP (Delivered Duty Paid) shipping for select regions, meaning all customs and import duties are handled on your behalf. Cold-chain shipping is available for temperature-sensitive FlexPen formulations to ensure compound integrity during transit.',
        ),
    );

    foreach ( $faq_items as $n => $fdata ) {
        $wp_customize->add_setting( "vpp_faq_q{$n}", array(
            'default'           => $fdata['q'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_faq_q{$n}", array(
            'label'   => "FAQ {$n} Question",
            'section' => 'vpp_faq',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_faq_a{$n}", array(
            'default'           => $fdata['a'],
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( 'vpp_faq_a{$n}', array(
        'type'    => 'textarea',
            'label'   => "FAQ {$n} Answer",
            'section' => 'vpp_faq',
        ) );
    }

    /* =========================================================================
       SECTION: Inquiry Section
       ========================================================================= */
    $wp_customize->add_section( 'vpp_inquiry', array(
        'title' => 'Inquiry Section',
        'panel' => 'vpp_options',
    ) );

    $inquiry_text = array(
        'vpp_inquiry_label'            => array( 'label' => 'Section Label',         'default' => 'Research Inquiries' ),
        'vpp_inquiry_title'            => array( 'label' => 'Title Part 1',           'default' => 'Ready to Start Your' ),
        'vpp_inquiry_title_highlight'  => array( 'label' => 'Title Highlight',        'default' => 'Research?' ),
        'vpp_inquiry_method1_title'    => array( 'label' => 'Method 1 Title',         'default' => 'Formal Inquiry' ),
        'vpp_inquiry_method1_text'     => array( 'label' => 'Method 1 Text',          'default' => 'Submit via form for detailed responses' ),
        'vpp_inquiry_method2_title'    => array( 'label' => 'Method 2 Title',         'default' => 'Live Research Support' ),
        'vpp_inquiry_method2_text'     => array( 'label' => 'Method 2 Text',          'default' => 'Chat with our team via secure messaging' ),
        'vpp_inquiry_method3_title'    => array( 'label' => 'Method 3 Title',         'default' => 'Bulk Research Orders' ),
        'vpp_inquiry_method3_text'     => array( 'label' => 'Method 3 Text',          'default' => 'Custom formulations and volume pricing' ),
        'vpp_inquiry_form_title'       => array( 'label' => 'Form Title',             'default' => 'Submit Research Inquiry' ),
        'vpp_inquiry_form_subtitle'    => array( 'label' => 'Form Subtitle',          'default' => 'Complete the form below and our team will contact you within 24-48 hours.' ),
        'vpp_inquiry_btn'              => array( 'label' => 'Submit Button Text',     'default' => 'Submit Inquiry' ),
    );

    foreach ( $inquiry_text as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_inquiry',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_inquiry_subtitle', array(
        'default'           => 'Submit a formal inquiry for any FlexPen compound in our catalog. Our research liaison team typically responds within 24-48 business hours.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_inquiry_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Section Subtitle',
        'section' => 'vpp_inquiry',
    ) );

    $wp_customize->add_setting( 'vpp_inquiry_disclaimer', array(
        'default'           => 'By submitting this form, you confirm your inquiry is for legitimate laboratory research purposes only. All communications are encrypted and handled in accordance with our privacy policy.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_inquiry_disclaimer', array(
        'type'    => 'textarea',
        'label'   => 'Form Disclaimer',
        'section' => 'vpp_inquiry',
    ) );

    /* =========================================================================
       SECTION: FlexPens Page
       ========================================================================= */
    $wp_customize->add_section( 'vpp_flexpens_page', array(
        'title' => 'FlexPens Page',
        'panel' => 'vpp_options',
    ) );

    $fp_hero = array(
        'vpp_fp_hero_badge'       => array( 'label' => 'Hero Badge',            'default' => 'Netherlands cGMP Facility · Batch NL-2026' ),
        'vpp_fp_hero_title_1'     => array( 'label' => 'Hero Title Part 1',     'default' => 'Seven' ),
        'vpp_fp_hero_title_highlight' => array( 'label' => 'Hero Title Highlight', 'default' => 'Precision Compounds.' ),
        'vpp_fp_hero_title_2'     => array( 'label' => 'Hero Title Part 2',     'default' => 'One Delivery System.' ),
        'vpp_fp_cta_title'        => array( 'label' => 'CTA Banner Title',      'default' => 'Ready to Order Your Research FlexPens?' ),
        'vpp_fp_cta_btn'          => array( 'label' => 'CTA Button Text',       'default' => 'Submit a Research Inquiry' ),
    );

    foreach ( $fp_hero as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_flexpens_page',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_fp_hero_subtitle', array(
        'default'           => 'Each VitalPep Pro FlexPen delivers a rigorously tested research compound in a precision-engineered 3ml reusable pen — manufactured to pharmaceutical standards and independently verified for purity.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_fp_hero_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Hero Subtitle',
        'section' => 'vpp_flexpens_page',
    ) );

    $wp_customize->add_setting( 'vpp_fp_cta_subtitle', array(
        'default'           => 'Our research liaison team handles all inquiries personally. Expect a response within 24–48 business hours with full pricing, availability, and COA documentation.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_fp_cta_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'CTA Banner Subtitle',
        'section' => 'vpp_flexpens_page',
    ) );

    // FlexPens page product defaults
    $fp_products = array(
        'p1' => array(
            'cat'     => 'Tissue Regeneration & Anti-Aging',
            'name'    => 'GHK-Cu',
            'tagline' => 'Glycine-Histidine-Lysine Copper Peptide · 33.33 mg/ml',
            'desc'    => 'GHK-Cu is a naturally occurring copper peptide complex found in human plasma that plays a critical role in wound healing, tissue remodeling, and cellular repair. Originally isolated by Dr. Loren Pickart, plasma GHK-Cu levels decline sharply with age — making it one of the most studied peptides in regenerative and anti-aging research. Each FlexPen delivers a precision 100mg payload in 3ml of carrier solution, providing consistent, measurable dosing for research protocols.',
            'moa'     => 'GHK-Cu binds and transports copper ions into cells, modulating the expression of over 4,000 human genes. It activates collagen and elastin synthesis via TGF-β pathway stimulation, promotes angiogenesis through VEGF upregulation, and exerts antioxidant activity by activating superoxide dismutase. At the nuclear level, it acts as a gene-regulating signal that resets cells toward a healthier, more youthful expression profile.',
            'b1'      => 'Wound healing & tissue repair mechanisms',
            'b2'      => 'Collagen & elastin synthesis pathways',
            'b3'      => 'Hair follicle cycle & growth studies',
            'b4'      => 'Angiogenesis & VEGF pathway research',
            'b5'      => 'Antioxidant & anti-inflammatory models',
            'b6'      => 'Nerve tissue regeneration & neuroprotection',
            'total'   => '100mg',
        ),
        'p2' => array(
            'cat'     => 'Advanced Metabolic Research',
            'name'    => 'Retatrutide',
            'tagline' => 'GIP / GLP-1 / Glucagon Triple Receptor Agonist · 10 mg/ml',
            'desc'    => 'Retatrutide (LY3437943) represents the cutting edge of metabolic research compounds — a novel triple agonist that simultaneously activates GIP, GLP-1, and glucagon receptors. This triple-action mechanism produces unmatched metabolic effects compared to single or dual agonists, making it the most studied next-generation compound in metabolic science. Each FlexPen delivers a precision 30mg payload for consistent, protocol-ready research dosing.',
            'moa'     => 'As a triple agonist: GIP receptor activation enhances insulin sensitivity and facilitates fat cell metabolism; GLP-1 receptor activation reduces appetite signaling, slows gastric emptying, and stimulates insulin secretion; Glucagon receptor activation increases hepatic glucose output, raises basal metabolic rate, and promotes lipolysis — creating a synergistic metabolic effect that exceeds dual-agonist approaches.',
            'b1'      => 'Advanced obesity & body composition research',
            'b2'      => 'Glucose homeostasis & insulin sensitivity',
            'b3'      => 'Hepatic steatosis mechanism studies',
            'b4'      => 'Cardiovascular metabolic risk research',
            'b5'      => 'Energy expenditure pathway investigation',
            'b6'      => 'Comparative studies vs. GLP-1 monotherapy',
            'total'   => '30mg',
        ),
        'p3' => array(
            'cat'     => 'Melanocortin System Research',
            'name'    => 'Melanotan II',
            'tagline' => 'Synthetic α-MSH Cyclic Lactam Analog · 3.33 mg/ml',
            'desc'    => 'Melanotan II (MT-II) is a synthetic cyclic lactam analog of alpha-melanocyte-stimulating hormone (α-MSH), originally developed at the University of Arizona as part of research into photoprotection and tanning. As a non-selective melanocortin receptor agonist, MT-II provides unparalleled access to the melanocortin system for studying pigmentation, appetite regulation, sexual function, and immune modulation pathways in a single compound.',
            'moa'     => 'MT-II binds with high affinity to melanocortin receptors: MC1R in melanocytes drives eumelanin production and photoprotection; MC3R in the hypothalamus regulates energy homeostasis and immune function; MC4R activation controls appetite suppression, libido pathways, and thermogenesis; MC5R plays a role in exocrine gland function. This multi-receptor profile makes MT-II a uniquely versatile research tool across multiple biological systems.',
            'b1'      => 'Melanogenesis & pigmentation pathway studies',
            'b2'      => 'MC4R appetite regulation research',
            'b3'      => 'Sexual function & libido pathway studies',
            'b4'      => 'Photoprotection & UV response models',
            'b5'      => 'Energy homeostasis & thermogenesis',
            'b6'      => 'Immune modulation & anti-inflammatory research',
            'total'   => '10mg',
        ),
        'p4' => array(
            'cat'     => 'Cellular Energy & Longevity Research',
            'name'    => 'NAD+',
            'tagline' => 'Nicotinamide Adenine Dinucleotide · 166.67 mg/ml',
            'desc'    => 'NAD+ (Nicotinamide Adenine Dinucleotide) is the essential coenzyme found at the center of cellular metabolism in every living cell. As a critical electron carrier in oxidative phosphorylation and a key substrate for longevity-regulating enzymes, NAD+ sits at the intersection of aging, energy production, and DNA repair research. At 500mg per 3ml cartridge, this FlexPen delivers the highest-concentration research payload in our lineup.',
            'moa'     => 'NAD+ serves as the primary substrate for sirtuins (SIRT1–7) — the master longevity deacetylases that regulate gene expression, mitochondrial biogenesis, and stress resistance. It is also required by PARP enzymes for DNA damage surveillance and repair. As an electron shuttle in the mitochondrial electron transport chain, NAD+ directly drives ATP synthesis. Age-related NAD+ depletion is mediated by CD38 and inflammatory SARP activity.',
            'b1'      => 'Sirtuin pathway activation & longevity research',
            'b2'      => 'DNA damage surveillance & repair (PARP)',
            'b3'      => 'Mitochondrial function & biogenesis studies',
            'b4'      => 'Neuroprotection & cognitive function models',
            'b5'      => 'Muscle metabolism & exercise physiology',
            'b6'      => 'Metabolic disease & aging pathway investigation',
            'total'   => '500mg',
        ),
    );

    foreach ( $fp_products as $pid => $pdata ) {
        $n = substr( $pid, 1 );

        $wp_customize->add_setting( "vpp_fp_{$pid}_cat", array(
            'default'           => $pdata['cat'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_fp_{$pid}_cat", array(
            'label'   => "Product {$n} Category",
            'section' => 'vpp_flexpens_page',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_fp_{$pid}_name", array(
            'default'           => $pdata['name'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_fp_{$pid}_name", array(
            'label'   => "Product {$n} Name",
            'section' => 'vpp_flexpens_page',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_fp_{$pid}_tagline", array(
            'default'           => $pdata['tagline'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_fp_{$pid}_tagline", array(
            'label'   => "Product {$n} Tagline",
            'section' => 'vpp_flexpens_page',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_fp_{$pid}_desc", array(
            'default'           => $pdata['desc'],
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( 'vpp_fp_{$pid}_desc', array(
        'type'    => 'textarea',
            'label'   => "Product {$n} Description",
            'section' => 'vpp_flexpens_page',
        ) );

        $wp_customize->add_setting( "vpp_fp_{$pid}_moa", array(
            'default'           => $pdata['moa'],
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( 'vpp_fp_{$pid}_moa', array(
        'type'    => 'textarea',
            'label'   => "Product {$n} Mechanism of Action",
            'section' => 'vpp_flexpens_page',
        ) );

        for ( $b = 1; $b <= 6; $b++ ) {
            $wp_customize->add_setting( "vpp_fp_{$pid}_b{$b}", array(
                'default'           => $pdata[ "b{$b}" ],
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'refresh',
            ) );
            $wp_customize->add_control( "vpp_fp_{$pid}_b{$b}", array(
                'label'   => "Product {$n} Benefit {$b}",
                'section' => 'vpp_flexpens_page',
                'type'    => 'text',
            ) );
        }

        $wp_customize->add_setting( "vpp_fp_{$pid}_total", array(
            'default'           => $pdata['total'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_fp_{$pid}_total", array(
            'label'   => "Product {$n} Total Content",
            'section' => 'vpp_flexpens_page',
            'type'    => 'text',
        ) );
    }

    /* =========================================================================
       SECTION: COA Reports Page
       ========================================================================= */
    $wp_customize->add_section( 'vpp_coa_page', array(
        'title' => 'COA Reports Page',
        'panel' => 'vpp_options',
    ) );

    $coa_page_settings = array(
        'vpp_coa_hero_badge'            => array( 'label' => 'Hero Badge',        'default' => 'Lab Documentation' ),
        'vpp_coa_hero_title'            => array( 'label' => 'Hero Title',         'default' => 'Certificates of' ),
        'vpp_coa_hero_title_highlight'  => array( 'label' => 'Hero Title Highlight','default' => 'Analysis' ),
        'vpp_coa_trust_1'               => array( 'label' => 'Trust Item 1',       'default' => 'HPLC Tested' ),
        'vpp_coa_trust_2'               => array( 'label' => 'Trust Item 2',       'default' => 'Mass Spec Confirmed' ),
        'vpp_coa_trust_3'               => array( 'label' => 'Trust Item 3',       'default' => 'Third-Party Verified' ),
        'vpp_coa_trust_4'               => array( 'label' => 'Trust Item 4',       'default' => 'Batch Traceable' ),
    );

    foreach ( $coa_page_settings as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_coa_page',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_coa_hero_subtitle', array(
        'default'           => 'Independent third-party verification for every batch. All COAs are HPLC tested, mass spectrometry confirmed, and issued by accredited EU laboratories.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_coa_hero_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Hero Subtitle',
        'section' => 'vpp_coa_page',
    ) );

    /* =========================================================================
       SECTION: Trust Bar (Front Page)
       ========================================================================= */
    $wp_customize->add_section( 'vpp_trust_bar', array(
        'title'       => 'Trust Bar (Front Page)',
        'panel'       => 'vpp_options',
        'description' => 'Edit the four trust items shown below the hero on the front page.',
    ) );

    $trust_defaults = array(
        '1' => array( 'title' => 'Every Batch 7x Tested',        'text' => 'HPLC & Mass Spec Verified' ),
        '2' => array( 'title' => 'cGMP Manufacturing',            'text' => 'Netherlands Certified Facility' ),
        '3' => array( 'title' => 'Global Research Shipping',      'text' => 'DDP — Cold Chain Available' ),
        '4' => array( 'title' => 'Dedicated Research Support',    'text' => 'Inquiry Response < 24 Hours' ),
    );

    foreach ( $trust_defaults as $n => $td ) {
        $wp_customize->add_setting( "vpp_trust_{$n}_title", array(
            'default'           => $td['title'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_trust_{$n}_title", array(
            'label'   => "Trust Item {$n} — Title",
            'section' => 'vpp_trust_bar',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_trust_{$n}_text", array(
            'default'           => $td['text'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_trust_{$n}_text", array(
            'label'   => "Trust Item {$n} — Subtitle",
            'section' => 'vpp_trust_bar',
            'type'    => 'text',
        ) );
    }

    /* =========================================================================
       SECTION: Transparency / Protocol Cards (Front Page)
       ========================================================================= */
    $wp_customize->add_section( 'vpp_transparency', array(
        'title'       => 'Transparency Section (Front Page)',
        'panel'       => 'vpp_options',
        'description' => 'Edit the "Committed to Transparency" section headings and four protocol cards.',
    ) );

    $trans_top = array(
        'vpp_trans_label'     => array( 'label' => 'Section Label',     'default' => 'Our Commitment' ),
        'vpp_trans_title'     => array( 'label' => 'Title Part 1',      'default' => 'Committed to' ),
        'vpp_trans_highlight' => array( 'label' => 'Title Highlight',   'default' => 'Transparency' ),
    );

    foreach ( $trans_top as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_transparency',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_trans_subtitle', array(
        'default'           => 'Every FlexPen leaving our Netherlands facility meets the highest standards of pharmaceutical-grade manufacturing and analytical verification.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_trans_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Section Subtitle',
        'section' => 'vpp_transparency',
    ) );

    $protocol_defaults = array(
        '1' => array( 'num' => 'Protocol 01', 'title' => 'For Laboratory Research Use Only',   'desc' => 'All VitalPep Pro FlexPen compounds are manufactured and distributed exclusively for legitimate laboratory research purposes. Strict compliance documentation accompanies every shipment.' ),
        '2' => array( 'num' => 'Protocol 02', 'title' => 'cGMP Certified Manufacturing',       'desc' => 'Our Netherlands-based production facility operates under current Good Manufacturing Practice standards, ensuring consistent quality, traceability, and sterility across all FlexPen formulations.' ),
        '3' => array( 'num' => 'Protocol 03', 'title' => 'Third-Party Laboratory Testing',     'desc' => 'Every batch undergoes independent third-party analysis including HPLC purity testing, endotoxin screening, and sterility verification. Full COA reports are publicly accessible.' ),
        '4' => array( 'num' => 'Protocol 04', 'title' => 'Research Institution Support',       'desc' => 'Our dedicated research liaison team provides comprehensive support for institutional inquiries, bulk research orders, and custom FlexPen formulation requests tailored to your laboratory protocols.' ),
    );

    foreach ( $protocol_defaults as $n => $pd ) {
        $wp_customize->add_setting( "vpp_protocol_{$n}_num", array(
            'default'           => $pd['num'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_protocol_{$n}_num", array(
            'label'   => "Card {$n} — Number Label",
            'section' => 'vpp_transparency',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_protocol_{$n}_title", array(
            'default'           => $pd['title'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_protocol_{$n}_title", array(
            'label'   => "Card {$n} — Title",
            'section' => 'vpp_transparency',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_protocol_{$n}_desc", array(
            'default'           => $pd['desc'],
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_protocol_{$n}_desc", array(
            'type'    => 'textarea',
            'label'   => "Card {$n} — Description",
            'section' => 'vpp_transparency',
        ) );
    }

    /* =========================================================================
       SECTION: About Preview (Front Page)
       ========================================================================= */
    $wp_customize->add_section( 'vpp_about_preview', array(
        'title'       => 'About Preview (Front Page)',
        'panel'       => 'vpp_options',
        'description' => 'Edit "The VitalPep Standard" section on the front page.',
    ) );

    $about_text = array(
        'vpp_about_label'     => array( 'label' => 'Section Label',    'default' => 'The VitalPep Standard' ),
        'vpp_about_title'     => array( 'label' => 'Title Part 1',     'default' => 'Analytical Precision,' ),
        'vpp_about_highlight' => array( 'label' => 'Title Highlight',  'default' => 'European Excellence' ),
        'vpp_about_image_text'=> array( 'label' => 'Image Placeholder Text', 'default' => 'Netherlands Research Facility' ),
    );

    foreach ( $about_text as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_about_preview',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_about_desc', array(
        'default'           => "Founded in the Netherlands, VitalPep Pro Pharmaceuticals was established to bridge the gap between research-grade peptide compounds and the rigorous quality standards demanded by modern laboratories. Our FlexPen delivery system represents the next evolution in precise, convenient research compound administration.\n\nEvery compound is synthesized, formulated, and quality-tested within our state-of-the-art EU facility, ensuring batch-to-batch consistency that researchers can rely on.",
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_about_desc', array(
        'type'    => 'textarea',
        'label'   => 'About Description',
        'section' => 'vpp_about_preview',
    ) );

    $about_stats = array(
        '1' => array( 'value' => '5',    'label' => 'FlexPen Compounds' ),
        '2' => array( 'value' => '99%+', 'label' => 'Purity Standard' ),
        '3' => array( 'value' => 'EU',   'label' => 'GMP Certified' ),
    );

    foreach ( $about_stats as $n => $sd ) {
        $wp_customize->add_setting( "vpp_about_stat_{$n}_value", array(
            'default'           => $sd['value'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_about_stat_{$n}_value", array(
            'label'   => "Stat {$n} — Value",
            'section' => 'vpp_about_preview',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "vpp_about_stat_{$n}_label", array(
            'default'           => $sd['label'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( "vpp_about_stat_{$n}_label", array(
            'label'   => "Stat {$n} — Label",
            'section' => 'vpp_about_preview',
            'type'    => 'text',
        ) );
    }

    /* =========================================================================
       SECTION: Contact Page
       ========================================================================= */
    $wp_customize->add_section( 'vpp_contact_page', array(
        'title'       => 'Contact / Inquiry Page',
        'panel'       => 'vpp_options',
        'description' => 'Edit all text on the Contact / Inquiry page.',
    ) );

    $contact_text = array(
        'vpp_contact_hero_label'    => array( 'label' => 'Hero Badge Label',     'default' => 'Research Inquiries' ),
        'vpp_contact_hero_title'    => array( 'label' => 'Hero Title',           'default' => 'Submit a Research Inquiry' ),
        'vpp_contact_sidebar_title' => array( 'label' => 'Sidebar Title',        'default' => 'How to Reach Us' ),
        'vpp_contact_method1_title' => array( 'label' => 'Method 1 Title',       'default' => 'Formal Inquiry Form' ),
        'vpp_contact_method1_text'  => array( 'label' => 'Method 1 Description', 'default' => 'Use the form to submit detailed compound requests with specifications' ),
        'vpp_contact_method2_title' => array( 'label' => 'Method 2 Title',       'default' => 'Secure Messaging' ),
        'vpp_contact_method2_text'  => array( 'label' => 'Method 2 Description', 'default' => 'Encrypted messaging available for established research partners' ),
        'vpp_contact_method3_title' => array( 'label' => 'Method 3 Title',       'default' => 'Institutional Orders' ),
        'vpp_contact_method3_text'  => array( 'label' => 'Method 3 Description', 'default' => 'Bulk orders and custom formulations for research institutions' ),
        'vpp_contact_form_title'    => array( 'label' => 'Form Card Title',      'default' => 'Research Inquiry Form' ),
        'vpp_contact_form_subtitle' => array( 'label' => 'Form Card Subtitle',   'default' => 'Fields marked with * are required. We typically respond within 24-48 business hours.' ),
        'vpp_contact_btn'           => array( 'label' => 'Submit Button Text',   'default' => 'Submit Research Inquiry' ),
        'vpp_contact_success_title' => array( 'label' => 'Success Title',        'default' => 'Inquiry Submitted Successfully' ),
        'vpp_contact_success_text'  => array( 'label' => 'Success Message',      'default' => 'Our research liaison team will review your inquiry and respond within 24-48 business hours. A confirmation has been sent to your email.' ),
    );

    foreach ( $contact_text as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_contact_page',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_contact_hero_subtitle', array(
        'default'           => 'Complete the form below to inquire about any FlexPen compound. Our research liaison team responds within 24-48 business hours.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_contact_hero_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Hero Subtitle',
        'section' => 'vpp_contact_page',
    ) );

    $wp_customize->add_setting( 'vpp_contact_sidebar_text', array(
        'default'           => 'VitalPep Pro Pharmaceuticals operates on an inquiry-based model to ensure proper documentation and compliance for all research compound requests.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_contact_sidebar_text', array(
        'type'    => 'textarea',
        'label'   => 'Sidebar Description',
        'section' => 'vpp_contact_page',
    ) );

    $wp_customize->add_setting( 'vpp_contact_notice', array(
        'default'           => 'All VitalPep Pro compounds are manufactured and distributed exclusively for legitimate laboratory research purposes. Inquiries must specify intended research use and institutional affiliation when applicable. We reserve the right to verify research credentials before fulfilling orders.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_contact_notice', array(
        'type'    => 'textarea',
        'label'   => 'Important Notice Box',
        'section' => 'vpp_contact_page',
    ) );

    $wp_customize->add_setting( 'vpp_contact_disclaimer', array(
        'default'           => 'By submitting this form, you confirm your inquiry is for legitimate laboratory research purposes. All communications are encrypted. We do not share your information with third parties. Response within 24-48 business hours.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_contact_disclaimer', array(
        'type'    => 'textarea',
        'label'   => 'Form Disclaimer',
        'section' => 'vpp_contact_page',
    ) );

    /* =========================================================================
       SECTION: Calculator Page
       ========================================================================= */
    $wp_customize->add_section( 'vpp_calculator', array(
        'title'       => 'Dosage Calculator Page',
        'panel'       => 'vpp_options',
        'description' => 'Edit headings and CTA text on the Dosage Calculator page.',
    ) );

    $calc_text = array(
        'vpp_calc_badge'      => array( 'label' => 'Header Badge',    'default' => 'Precision Research Dosing Tool' ),
        'vpp_calc_title_1'    => array( 'label' => 'Title Part 1',    'default' => 'FlexPen' ),
        'vpp_calc_title_2'    => array( 'label' => 'Title Highlight', 'default' => 'Dosage Calculator' ),
    );

    foreach ( $calc_text as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_calculator',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_calc_subtitle', array(
        'default'           => 'Select your compound, enter your target dose, and instantly see the exact dial setting on your VitalPep Pro FlexPen.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_calc_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Header Subtitle',
        'section' => 'vpp_calculator',
    ) );

    $wp_customize->add_setting( 'vpp_calc_cta', array(
        'default'           => 'Questions about dosing protocols? Our team is available to discuss research parameters and compound specifications.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_calc_cta', array(
        'type'    => 'textarea',
        'label'   => 'CTA Text',
        'section' => 'vpp_calculator',
    ) );

    /* =========================================================================
       SECTION: Social Media Links
       ========================================================================= */
    $wp_customize->add_section( 'vpp_social', array(
        'title'       => 'Social Media Links',
        'panel'       => 'vpp_options',
        'description' => 'Add social media profile URLs. Leave blank to hide an icon.',
    ) );

    $socials = array(
        'vpp_social_instagram' => 'Instagram URL',
        'vpp_social_twitter'   => 'X / Twitter URL',
        'vpp_social_linkedin'  => 'LinkedIn URL',
        'vpp_social_facebook'  => 'Facebook URL',
        'vpp_social_telegram'  => 'Telegram URL',
        'vpp_social_email'     => 'Contact Email Address',
    );

    foreach ( $socials as $key => $lbl ) {
        $wp_customize->add_setting( $key, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $lbl,
            'section' => 'vpp_social',
            'type'    => 'text',
        ) );
    }

    /* =========================================================================
       SECTION: Footer Badges
       ========================================================================= */
    $wp_customize->add_section( 'vpp_footer_badges', array(
        'title'       => 'Footer Badges',
        'panel'       => 'vpp_options',
        'description' => 'Edit the small badge labels shown at the bottom of the footer.',
    ) );

    $badge_defaults = array(
        'vpp_footer_badge_1' => 'SSL Encrypted',
        'vpp_footer_badge_2' => 'cGMP Certified',
        'vpp_footer_badge_3' => 'EU Manufactured',
    );

    foreach ( $badge_defaults as $key => $default ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => ucfirst( str_replace( array( 'vpp_footer_badge_', '_' ), array( 'Badge ', ' ' ), $key ) ),
            'section' => 'vpp_footer_badges',
            'type'    => 'text',
        ) );
    }

    /* =========================================================================
       SECTION: Brand Colors
       ========================================================================= */
    $wp_customize->add_section( 'vpp_colors', array(
        'title'       => 'Brand Colors',
        'panel'       => 'vpp_options',
        'description' => 'Customise your primary brand colours. Changes update CSS variables site-wide.',
    ) );

    $colors = array(
        'vpp_color_navy'         => array( 'label' => 'Dark Background',  'default' => '#0a1628' ),
        'vpp_color_primary'      => array( 'label' => 'Primary Blue',     'default' => '#1a5276' ),
        'vpp_color_accent'       => array( 'label' => 'Accent Blue',      'default' => '#2e86c1' ),
        'vpp_color_accent_light' => array( 'label' => 'Accent Light',     'default' => '#5dade2' ),
        'vpp_color_gradient_1'   => array( 'label' => 'Gradient Start (Purple)', 'default' => '#a78bfa' ),
        'vpp_color_gradient_2'   => array( 'label' => 'Gradient End (Blue)',     'default' => '#60a5fa' ),
    );

    foreach ( $colors as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_colors',
        ) ) );
    }

    /* =========================================================================
       SECTION: FAQ Page (full page — separate from front-page FAQ)
       ========================================================================= */
    $wp_customize->add_section( 'vpp_faq_page', array(
        'title'       => 'FAQ Page',
        'panel'       => 'vpp_options',
        'description' => 'Edit the hero text on the dedicated FAQ page. Individual FAQ items are managed via the FAQ post type in wp-admin.',
    ) );

    $faqpage_text = array(
        'vpp_faqpage_hero_label'    => array( 'label' => 'Hero Badge Label', 'default' => 'Support' ),
        'vpp_faqpage_hero_title'    => array( 'label' => 'Hero Title',       'default' => 'Frequently Asked Questions' ),
        'vpp_faqpage_cta_title'     => array( 'label' => 'CTA Title',        'default' => 'Still have questions?' ),
        'vpp_faqpage_cta_text'      => array( 'label' => 'CTA Text',         'default' => 'Our research team is here to help with any additional inquiries about our FlexPen compounds.' ),
        'vpp_faqpage_cta_btn'       => array( 'label' => 'CTA Button Text',  'default' => 'Submit an Inquiry' ),
    );

    foreach ( $faqpage_text as $key => $args ) {
        $wp_customize->add_setting( $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $key, array(
            'label'   => $args['label'],
            'section' => 'vpp_faq_page',
            'type'    => 'text',
        ) );
    }

    $wp_customize->add_setting( 'vpp_faqpage_hero_subtitle', array(
        'default'           => 'Find answers to common questions about VitalPep Pro FlexPen compounds, ordering, quality assurance, and compliance.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'vpp_faqpage_hero_subtitle', array(
        'type'    => 'textarea',
        'label'   => 'Hero Subtitle',
        'section' => 'vpp_faq_page',
    ) );
}
add_action( 'customize_register', 'vpp_customizer' );
