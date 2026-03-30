<?php
/**
 * VitalPep Pro Pharmaceuticals Theme Functions
 * Showcase & Inquiry Site — No WooCommerce
 *
 * @package VitalPep_Pro
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Helper to output Customizer text safely
function vpp_text( $key, $default = '' ) {
    return esc_html( get_theme_mod( $key, $default ) );
}
function vpp_textarea( $key, $default = '' ) {
    return wp_kses_post( get_theme_mod( $key, $default ) );
}

define( 'VITALPEP_VERSION', '2.0.0' );
define( 'VITALPEP_DIR', get_template_directory() );
define( 'VITALPEP_URI', get_template_directory_uri() );

/* =========================================================================
   THEME SETUP
   ========================================================================= */
function vitalpep_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script',
    ) );

    register_nav_menus( array(
        'primary'          => 'Primary Navigation',
        'footer'           => 'Footer Navigation',
        'footer_resources' => 'Footer — Resources',
        'footer_company'   => 'Footer — Company',
        'footer_legal'     => 'Footer — Legal',
    ) );

    add_image_size( 'flexpen-card', 600, 450, true );
    add_image_size( 'flexpen-hero', 1920, 1080, true );
}
add_action( 'after_setup_theme', 'vitalpep_setup' );

/* =========================================================================
   ENQUEUE ASSETS
   ========================================================================= */
function vitalpep_scripts() {
    wp_enqueue_style(
        'vitalpep-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap',
        array(), null
    );

    wp_enqueue_style(
        'vitalpep-style',
        get_stylesheet_uri(),
        array( 'vitalpep-fonts' ),
        VITALPEP_VERSION
    );

    wp_enqueue_script(
        'vitalpep-main',
        VITALPEP_URI . '/assets/js/main.js',
        array(), VITALPEP_VERSION, true
    );

    wp_localize_script( 'vitalpep-main', 'vitalPep', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'vitalpep_nonce' ),
        'siteUrl' => home_url(),
    ) );
}
add_action( 'wp_enqueue_scripts', 'vitalpep_scripts' );

/* =========================================================================
   CUSTOM POST TYPE — FLEXPEN COMPOUNDS (Showcase only)
   ========================================================================= */
function vitalpep_register_post_types() {

    // FlexPen Compounds
    register_post_type( 'vp_flexpen', array(
        'labels' => array(
            'name'               => __( 'FlexPens', 'vitalpep-pro' ),
            'singular_name'      => __( 'FlexPen', 'vitalpep-pro' ),
            'add_new_item'       => __( 'Add New FlexPen', 'vitalpep-pro' ),
            'edit_item'          => __( 'Edit FlexPen', 'vitalpep-pro' ),
            'all_items'          => __( 'All FlexPens', 'vitalpep-pro' ),
            'search_items'       => __( 'Search FlexPens', 'vitalpep-pro' ),
            'not_found'          => __( 'No FlexPens found', 'vitalpep-pro' ),
        ),
        'public'       => true,
        'has_archive'  => false,
        'rewrite'      => array( 'slug' => 'flexpen-compound' ),
        'menu_icon'    => 'dashicons-pills',
        'supports'     => array( 'title', 'thumbnail' ),
        'show_in_rest' => false,
    ) );

    // Research Categories taxonomy
    register_taxonomy( 'research_category', 'vp_flexpen', array(
        'labels' => array(
            'name'          => __( 'Research Categories', 'vitalpep-pro' ),
            'singular_name' => __( 'Research Category', 'vitalpep-pro' ),
            'add_new_item'  => __( 'Add Research Category', 'vitalpep-pro' ),
        ),
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => array( 'slug' => 'research-category' ),
        'show_in_rest' => true,
    ) );

    // Inquiries (private, admin-only)
    register_post_type( 'vp_inquiry', array(
        'labels' => array(
            'name'          => __( 'Inquiries', 'vitalpep-pro' ),
            'singular_name' => __( 'Inquiry', 'vitalpep-pro' ),
            'all_items'     => __( 'All Inquiries', 'vitalpep-pro' ),
        ),
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'menu_icon'       => 'dashicons-email-alt',
        'supports'        => array( 'title', 'editor' ),
        'capability_type' => 'post',
    ) );

    // FAQ Items
    register_post_type( 'vp_faq', array(
        'labels'       => array(
            'name'               => 'FAQ Items',
            'singular_name'      => 'FAQ Item',
            'add_new'            => 'Add New FAQ',
            'add_new_item'       => 'Add New FAQ Item',
            'edit_item'          => 'Edit FAQ Item',
            'new_item'           => 'New FAQ Item',
            'view_item'          => 'View FAQ Item',
            'search_items'       => 'Search FAQ Items',
            'not_found'          => 'No FAQ items found',
            'not_found_in_trash' => 'No FAQ items found in trash',
        ),
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'has_archive'  => false,
        'supports'     => array( 'title', 'editor', 'page-attributes' ),
        'show_in_rest' => false,
        'menu_icon'    => 'dashicons-editor-help',
        'menu_position'=> 28,
    ) );

    // FAQ Sections taxonomy
    register_taxonomy( 'faq_section', 'vp_faq', array(
        'labels'       => array(
            'name'          => 'FAQ Sections',
            'singular_name' => 'FAQ Section',
            'add_new_item'  => 'Add New FAQ Section',
            'edit_item'     => 'Edit FAQ Section',
            'search_items'  => 'Search FAQ Sections',
        ),
        'hierarchical' => true,
        'public'       => false,
        'show_ui'      => true,
        'show_admin_column' => true,
        'show_in_rest' => false,
    ) );
}
add_action( 'init', 'vitalpep_register_post_types' );

/* =========================================================================
   FLEXPEN META BOXES (Admin — Full Product Page Fields)
   ========================================================================= */
function vitalpep_add_meta_boxes() {
    add_meta_box( 'vpp_fp_page', __( 'FlexPen Page Content', 'vitalpep-pro' ), 'vpp_fp_meta_callback', 'vp_flexpen', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'vitalpep_add_meta_boxes' );

// Enqueue WP media library on the FlexPen edit screen
add_action( 'admin_enqueue_scripts', function( $hook ) {
    global $post;
    if ( ( $hook === 'post-new.php' || $hook === 'post.php' ) &&
         isset( $post ) && $post->post_type === 'vp_flexpen' ) {
        wp_enqueue_media();
    }
} );

function vpp_fp_meta_callback( $post ) {
    wp_nonce_field( 'vpp_fp_save', 'vpp_fp_nonce' );
    $g  = function( $k ) use ( $post ) { return get_post_meta( $post->ID, $k, true ); };
    $f  = function( $k, $l, $ph = '', $type = 'text' ) use ( $g ) {
        $v = esc_attr( $g( $k ) );
        echo "<tr><th style='width:180px'><label for='{$k}'>{$l}</label></th><td>";
        if ( $type === 'textarea' ) {
            echo "<textarea id='{$k}' name='{$k}' rows='4' class='large-text'>" . esc_textarea( $g( $k ) ) . "</textarea>";
        } else {
            echo "<input type='text' id='{$k}' name='{$k}' value='{$v}' placeholder='" . esc_attr( $ph ) . "' class='large-text'>";
        }
        echo "</td></tr>";
    };
    $h  = function( $label ) { echo "<tr><td colspan='2' style='padding:18px 0 6px'><strong style='font-size:13px;color:#1d2327;border-bottom:2px solid #2271b1;padding-bottom:4px'>{$label}</strong></td></tr>"; };
    echo '<table class="form-table widefat" style="border:none"><tbody>';

    $h( '📋 Product Basics' );
    $f( '_vpp_fp_category',     'Research Category',          'e.g. Tissue Regeneration &amp; Anti-Aging' );
    $f( '_vpp_fp_tagline',      'Tagline / Formula',          'e.g. Glycine-Histidine-Lysine Copper Peptide · 33.33 mg/ml · 100mg / 3ml' );
    $f( '_vpp_fp_badge1',       'Badge 1 (image overlay)',    'e.g. 100mg / 3ml' );
    $f( '_vpp_fp_badge2',       'Badge 2 (image overlay)',    'e.g. 99%+ Purity' );
    $f( '_vpp_fp_img_fallback', 'Fallback Image Filename',    'e.g. ghkcu-flexpen.jpg — legacy fallback from /assets/images/ (prefer the upload fields below)' );

    $h( '🖼️ Images (each section uses its own photo)' );
    // Helper to render an image upload row
    $img_upload = function( $key, $label, $desc ) use ( $g ) {
        $val = esc_attr( $g( $key ) );
        $fname = $val ? basename( $val ) : '';
        echo "<tr><th style='width:180px'><label for='{$key}'>{$label}</label></th><td>";
        echo "<div style='display:flex;align-items:center;gap:8px;margin-bottom:6px'>";
        echo "<input type='text' id='{$key}' name='{$key}' value='{$val}' placeholder='Upload or paste URL' class='large-text' style='flex:1'>";
        echo "<button type='button' class='button vpp-upload-img-btn' data-target='{$key}'><span class='dashicons dashicons-format-image' style='margin-top:3px;font-size:16px'></span>&nbsp;Upload</button>";
        echo "<button type='button' class='button vpp-clear-img-btn' data-target='{$key}' style='color:#b32d2e'>✕</button>";
        echo "</div>";
        if ( $val ) {
            echo "<div id='{$key}_preview' style='margin-bottom:4px'><img src='" . esc_url( $g( $key ) ) . "' style='max-height:60px;border-radius:4px;border:1px solid #ddd'></div>";
        } else {
            echo "<div id='{$key}_preview' style='margin-bottom:4px;color:#999;font-style:italic'>No image set — will fall back to Featured Image.</div>";
        }
        echo "<p class='description'>{$desc}</p>";
        echo "</td></tr>";
    };
    $img_upload( '_vpp_fp_img_carousel',  'Hero Carousel Image',  'Pen photo shown in the homepage hero rotating carousel.' );
    $img_upload( '_vpp_fp_img_showcase',  'Showcase Reel Image',  'Label/product photo shown in the homepage Research FlexPen Showcase section.' );
    $img_upload( '_vpp_fp_img_catalog',   'FlexPens Page Image',  'Product photo shown on the FlexPens catalog page section.' );

    $h( '📝 Content' );
    $f( '_vpp_fp_desc',     'Description',         '', 'textarea' );
    $f( '_vpp_fp_moa',      'Mechanism of Action', '', 'textarea' );

    $h( '✅ Benefits (up to 6)' );
    for ( $i = 1; $i <= 6; $i++ ) {
        $f( "_vpp_fp_b{$i}", "Benefit {$i}", 'e.g. Wound healing &amp; tissue repair mechanisms' );
    }

    $h( '📊 Specs Row' );
    $f( '_vpp_fp_total',   'Total Content', 'e.g. 100mg' );
    $f( '_vpp_fp_purity',  'Purity',        'e.g. 99%+' );
    $f( '_vpp_fp_storage', 'Storage',       'e.g. 2–8°C (36–46°F)' );
    $f( '_vpp_fp_batch',   'Batch',         'e.g. NL-2026-E' );

    $h( '🔗 Links' );
    // PDF field — text input + WP media upload button
    $pdf_val = esc_attr( $g( '_vpp_fp_pdf' ) );
    $pdf_filename = $pdf_val ? basename( $g( '_vpp_fp_pdf' ) ) : '';
    echo "<tr><th style='width:180px'><label for='_vpp_fp_pdf'>Dosage Manual PDF</label></th><td>";
    echo "<div style='display:flex;align-items:center;gap:8px;margin-bottom:6px'>";
    echo "<input type='text' id='_vpp_fp_pdf' name='_vpp_fp_pdf' value='{$pdf_val}' placeholder='https://... or upload below' class='large-text' style='flex:1'>";
    echo "<button type='button' class='button vpp-upload-pdf-btn' data-target='_vpp_fp_pdf'><span class='dashicons dashicons-upload' style='margin-top:3px;font-size:16px'></span>&nbsp;Upload PDF</button>";
    echo "<button type='button' class='button vpp-clear-pdf-btn' data-target='_vpp_fp_pdf' style='color:#b32d2e'>✕ Remove</button>";
    echo "</div>";
    if ( $pdf_filename ) {
        echo "<p class='description' id='_vpp_fp_pdf_preview'>📄 <a href='" . esc_url( $g( '_vpp_fp_pdf' ) ) . "' target='_blank'>" . esc_html( $pdf_filename ) . "</a></p>";
    } else {
        echo "<p class='description' id='_vpp_fp_pdf_preview'>No PDF selected.</p>";
    }
    echo "</td></tr>";
    // Generate PDF button row
    $gen_nonce = wp_create_nonce( 'vpp_gen_pdf' );
    echo "<tr><th><label>Auto-Generate PDF</label></th><td>";
    echo "<button type='button' id='vpp-gen-pdf-btn' class='button' data-post='" . intval( $post->ID ) . "' data-nonce='{$gen_nonce}'>";
    echo "<span class='dashicons dashicons-media-document' style='margin-top:3px;font-size:16px'></span>&nbsp;Generate PDF Manual</button>";
    echo " <span id='vpp-gen-pdf-status' style='margin-left:8px;color:#666'></span>";
    echo "<p class='description'>Automatically builds a dosage manual PDF from this post's fields (requires Python 3 + ReportLab on the server). Saves to <code>wp-content/uploads/vpp-manuals/</code> and fills the URL above.</p>";
    echo "</td></tr>";
    $f( '_vpp_fp_inquiry', 'Inquiry Product Name',  'e.g. My+Compound+FlexPen (used in contact URL)' );

    $h( '🏠 Homepage Showcase' );
    $checked = checked( $g( '_vpp_fp_show_in_reel' ), '1', false );
    echo "<tr><th><label for='_vpp_fp_show_in_reel'>Show in Showcase</label></th><td>";
    echo "<label><input type='checkbox' id='_vpp_fp_show_in_reel' name='_vpp_fp_show_in_reel' value='1' {$checked}> Show this FlexPen in the homepage Research FlexPen Showcase</label>";
    echo "<p class='description'>Use the drag handle (Order) column in the FlexPens list to control display order.</p></td></tr>";
    $f( '_vpp_fp_reel_extra', 'Extra Spec Badge', 'e.g. cGMP Netherlands · Phase 3 Validated' );

    $h( '📄 Homepage Dosing Section' );
    $checked_dosing = checked( $g( '_vpp_fp_show_in_dosing' ), '1', false );
    echo "<tr><th><label for='_vpp_fp_show_in_dosing'>Show in Dosing Section</label></th><td>";
    echo "<label><input type='checkbox' id='_vpp_fp_show_in_dosing' name='_vpp_fp_show_in_dosing' value='1' {$checked_dosing}> Show a dosage manual download card for this pen in the homepage Dosing Info section</label>";
    echo "<p class='description'>Requires a Dosage Manual PDF URL to be set in the Links section above.</p></td></tr>";

    $h( '🧮 Dosage Calculator' );
    $checked_calc = checked( $g( '_vpp_fp_show_in_calc' ), '1', false );
    echo "<tr><th><label for='_vpp_fp_show_in_calc'>Show in Calculator</label></th><td>";
    echo "<label><input type='checkbox' id='_vpp_fp_show_in_calc' name='_vpp_fp_show_in_calc' value='1' {$checked_calc}> Show this compound as a selectable option in the Dosage Calculator</label></td></tr>";
    $f( '_vpp_fp_calc_mg',      'Total mg in Pen',  'e.g. 100 — the total milligrams in the full cartridge' );
    $f( '_vpp_fp_calc_ml',      'Total ml in Pen',  'e.g. 3 — almost always 3 for standard FlexPens' );
    $f( '_vpp_fp_calc_maxdose', 'Max Dose',         'e.g. 5 — maximum recommended single dose in the unit below' );
    $unit_val = $g( '_vpp_fp_calc_unit' ) ?: 'mg';
    echo "<tr><th><label for='_vpp_fp_calc_unit'>Dose Unit</label></th><td><select id='_vpp_fp_calc_unit' name='_vpp_fp_calc_unit'>";
    foreach ( array( 'mg' => 'mg (milligrams)', 'mcg' => 'mcg (micrograms — for high-potency peptides like Melanotan II)' ) as $v => $l ) {
        printf( "<option value='%s'%s>%s</option>", esc_attr( $v ), selected( $unit_val, $v, false ), esc_html( $l ) );
    }
    echo "</select></td></tr>";
    $freq_val = $g( '_vpp_fp_calc_freq' ) ?: 'weekly';
    echo "<tr><th><label for='_vpp_fp_calc_freq'>Default Frequency</label></th><td><select id='_vpp_fp_calc_freq' name='_vpp_fp_calc_freq'>";
    foreach ( array( 'daily' => 'Daily', 'eod' => 'Every Other Day (EOD)', 'weekly' => 'Once Weekly' ) as $v => $l ) {
        printf( "<option value='%s'%s>%s</option>", esc_attr( $v ), selected( $freq_val, $v, false ), esc_html( $l ) );
    }
    echo "</select></td></tr>";
    $color_val = $g( '_vpp_fp_calc_color' ) ?: 'blue';
    echo "<tr><th><label for='_vpp_fp_calc_color'>Card Color</label></th><td><select id='_vpp_fp_calc_color' name='_vpp_fp_calc_color'>";
    foreach ( array( 'purple' => 'Purple', 'blue' => 'Blue', 'amber' => 'Amber / Gold', 'green' => 'Green', 'teal' => 'Teal', 'rose' => 'Rose / Pink' ) as $v => $l ) {
        printf( "<option value='%s'%s>%s</option>", esc_attr( $v ), selected( $color_val, $v, false ), esc_html( $l ) );
    }
    echo "</select></td></tr>";

    $h( '🔐 Verification (QR Code)' );
    $token = $g( '_vpp_fp_verify_token' );
    if ( $token ) {
        $verify_url = 'https://jalentized-blip.github.io/vitalpep-pro/verify/?t=' . $token;
        echo "<tr><th style='width:180px'>Verification Token</th><td>";
        echo "<code style='font-size:.85em;background:#f0f0f1;padding:4px 8px;border-radius:4px;user-select:all'>" . esc_html( $token ) . "</code>";
        echo "<p class='description' style='margin-top:6px'>QR URL: <a href='" . esc_url( $verify_url ) . "' target='_blank'>" . esc_html( $verify_url ) . "</a></p>";
        echo "<p class='description'>This token is read-only and is used to authenticate scans of the physical pen label QR code.</p>";
        echo "</td></tr>";
    } else {
        echo "<tr><th style='width:180px'>Verification Token</th><td>";
        echo "<span style='color:#999'>No token yet — will be assigned automatically on next admin page load.</span>";
        echo "</td></tr>";
    }

    $h( '🎨 Layout' );
    $layout = $g( '_vpp_fp_layout' );
    echo "<tr><th><label for='_vpp_fp_layout'>Section Style</label></th><td><select id='_vpp_fp_layout' name='_vpp_fp_layout'>";
    foreach ( array( '' => 'Auto (alternates dark/light/mid)', 'dark' => 'Dark (navy gradient)', 'light' => 'Light (white)', 'mid' => 'Mid (deep navy)' ) as $v => $l ) {
        printf( "<option value='%s'%s>%s</option>", esc_attr( $v ), selected( $layout, $v, false ), esc_html( $l ) );
    }
    echo "</select></td></tr>";
    $reverse = $g( '_vpp_fp_reverse' );
    echo "<tr><th><label for='_vpp_fp_reverse'>Image Side</label></th><td><select id='_vpp_fp_reverse' name='_vpp_fp_reverse'>";
    foreach ( array( '' => 'Auto (alternates left/right)', 'normal' => 'Image Left', 'reverse' => 'Image Right' ) as $v => $l ) {
        printf( "<option value='%s'%s>%s</option>", esc_attr( $v ), selected( $reverse, $v, false ), esc_html( $l ) );
    }
    echo "</select><p class='description'>Featured Image is used as the product photo — set it in the panel on the right.</p></td></tr>";

    echo '</tbody></table>';
    ?>
    <script>
    (function($){
        // Upload PDF button — opens WP media library filtered to PDFs
        $(document).on('click', '.vpp-upload-pdf-btn', function(e){
            e.preventDefault();
            var targetId = $(this).data('target');
            var frame = wp.media({
                title: 'Select or Upload Dosage Manual PDF',
                button: { text: 'Use this file' },
                multiple: false,
                library: { type: 'application/pdf' }
            });
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                var url = attachment.url;
                var filename = attachment.filename || url.split('/').pop();
                $('#' + targetId).val(url);
                $('#' + targetId + '_preview').html(
                    '📄 <a href="' + url + '" target="_blank">' + filename + '</a>'
                );
            });
            frame.open();
        });

        // Remove button — clears the field and preview
        $(document).on('click', '.vpp-clear-pdf-btn', function(e){
            e.preventDefault();
            var targetId = $(this).data('target');
            $('#' + targetId).val('');
            $('#' + targetId + '_preview').text('No PDF selected.');
        });

        // Live preview update when URL is typed/pasted manually
        $(document).on('input', '#_vpp_fp_pdf', function(){
            var val = $(this).val().trim();
            var preview = $('#_vpp_fp_pdf_preview');
            if ( val ) {
                var filename = val.split('/').pop();
                preview.html('📄 <a href="' + val + '" target="_blank">' + filename + '</a>');
            } else {
                preview.text('No PDF selected.');
            }
        });

        // Image upload buttons — opens WP media library filtered to images
        $(document).on('click', '.vpp-upload-img-btn', function(e){
            e.preventDefault();
            var targetId = $(this).data('target');
            var frame = wp.media({
                title: 'Select or Upload Image',
                button: { text: 'Use this image' },
                multiple: false,
                library: { type: 'image' }
            });
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                var url = attachment.url;
                $('#' + targetId).val(url);
                $('#' + targetId + '_preview').html('<img src="' + url + '" style="max-height:60px;border-radius:4px;border:1px solid #ddd">');
            });
            frame.open();
        });
        $(document).on('click', '.vpp-clear-img-btn', function(e){
            e.preventDefault();
            var targetId = $(this).data('target');
            $('#' + targetId).val('');
            $('#' + targetId + '_preview').html('<span style="color:#999;font-style:italic">No image set — will fall back to Featured Image.</span>');
        });

        // Generate PDF button — calls server-side Python generator via AJAX
        $(document).on('click', '#vpp-gen-pdf-btn', function(e){
            e.preventDefault();
            var btn    = $(this);
            var status = $('#vpp-gen-pdf-status');
            var postId = btn.data('post');
            var nonce  = btn.data('nonce');
            btn.prop('disabled', true);
            status.text('Generating PDF…').css('color', '#666');
            $.post(ajaxurl, {
                action:  'vpp_generate_pdf',
                nonce:   nonce,
                post_id: postId
            }, function(response){
                btn.prop('disabled', false);
                if ( response.success ) {
                    var url      = response.data.url;
                    var filename = response.data.filename;
                    $('#_vpp_fp_pdf').val(url);
                    $('#_vpp_fp_pdf_preview').html('📄 <a href="' + url + '" target="_blank">' + filename + '</a>');
                    status.text('✓ PDF generated successfully').css('color', '#2e7d32');
                } else {
                    status.text('✗ ' + (response.data ? response.data.message : 'Generation failed')).css('color', '#c62828');
                }
            }).fail(function(){
                btn.prop('disabled', false);
                status.text('✗ Request failed — check server error log').css('color', '#c62828');
            });
        });
    })(jQuery);
    </script>
    <?php
}

function vpp_fp_save_meta( $post_id ) {
    if ( ! isset( $_POST['vpp_fp_nonce'] ) || ! wp_verify_nonce( $_POST['vpp_fp_nonce'], 'vpp_fp_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_keys = array(
        '_vpp_fp_category', '_vpp_fp_tagline', '_vpp_fp_badge1', '_vpp_fp_badge2',
        '_vpp_fp_total', '_vpp_fp_purity', '_vpp_fp_storage', '_vpp_fp_batch',
        '_vpp_fp_pdf', '_vpp_fp_inquiry', '_vpp_fp_layout', '_vpp_fp_reverse',
        '_vpp_fp_b1', '_vpp_fp_b2', '_vpp_fp_b3', '_vpp_fp_b4', '_vpp_fp_b5', '_vpp_fp_b6',
        '_vpp_fp_reel_extra', '_vpp_fp_img_fallback',
        '_vpp_fp_img_carousel', '_vpp_fp_img_showcase', '_vpp_fp_img_catalog',
        '_vpp_fp_calc_mg', '_vpp_fp_calc_ml', '_vpp_fp_calc_maxdose',
        '_vpp_fp_calc_unit', '_vpp_fp_calc_freq', '_vpp_fp_calc_color',
    );
    foreach ( $text_keys as $k ) {
        if ( isset( $_POST[ $k ] ) ) update_post_meta( $post_id, $k, sanitize_text_field( $_POST[ $k ] ) );
    }
    foreach ( array( '_vpp_fp_desc', '_vpp_fp_moa' ) as $k ) {
        if ( isset( $_POST[ $k ] ) ) update_post_meta( $post_id, $k, sanitize_textarea_field( $_POST[ $k ] ) );
    }
    foreach ( array( '_vpp_fp_show_in_reel', '_vpp_fp_show_in_dosing', '_vpp_fp_show_in_calc' ) as $ck ) {
        if ( ! empty( $_POST[ $ck ] ) ) {
            update_post_meta( $post_id, $ck, '1' );
        } else {
            delete_post_meta( $post_id, $ck );
        }
    }
}
add_action( 'save_post_vp_flexpen', 'vpp_fp_save_meta' );

/* =========================================================================
   AUTO PDF GENERATION
   ========================================================================= */

/**
 * Find a usable Python executable on this server.
 * Returns the command string (e.g. 'python3') or false if none found.
 */
function vpp_find_python() {
    foreach ( array( 'python3', 'python', 'py' ) as $cmd ) {
        $out = shell_exec( escapeshellcmd( $cmd ) . ' --version 2>&1' );
        if ( $out && preg_match( '/Python\s+3\./i', $out ) ) {
            return $cmd;
        }
    }
    return false;
}

/**
 * Generate a PDF manual for a FlexPen post using gen_auto_manual.py.
 * Returns the public URL of the saved PDF, or false on failure.
 *
 * @param int $post_id
 * @return string|false
 */
function vpp_generate_flexpen_pdf( $post_id ) {
    $python = vpp_find_python();
    if ( ! $python ) return false;

    $script = ABSPATH . '../gen_auto_manual.py';
    // Support both root-level placement and inside the site directory
    if ( ! file_exists( $script ) ) {
        $script = ABSPATH . 'gen_auto_manual.py';
    }
    if ( ! file_exists( $script ) ) {
        // Try two levels up (WordPress installed in a subdir)
        $script = dirname( dirname( ABSPATH ) ) . '/gen_auto_manual.py';
    }
    if ( ! file_exists( $script ) ) {
        error_log( 'vpp_generate_flexpen_pdf: gen_auto_manual.py not found near ' . ABSPATH );
        return false;
    }

    $g = function( $k ) use ( $post_id ) {
        return get_post_meta( $post_id, $k, true );
    };

    // Collect benefits
    $benefits = array();
    for ( $i = 1; $i <= 6; $i++ ) {
        $b = $g( "_vpp_fp_b{$i}" );
        if ( $b ) $benefits[] = $b;
    }

    $mg      = floatval( $g( '_vpp_fp_calc_mg' ) );
    $ml      = floatval( $g( '_vpp_fp_calc_ml' ) ) ?: 3.0;
    $maxdose = floatval( $g( '_vpp_fp_calc_maxdose' ) );
    $unit    = $g( '_vpp_fp_calc_unit' ) ?: 'mg';
    $freq    = $g( '_vpp_fp_calc_freq' ) ?: 'weekly';
    $total   = $g( '_vpp_fp_total' ) ?: ( $mg > 0 ? "{$mg}mg/{$ml}ml" : '' );

    $data = array(
        'name'       => get_the_title( $post_id ),
        'category'   => $g( '_vpp_fp_category' ) ?: 'Research Peptide',
        'tagline'    => $g( '_vpp_fp_tagline' ) ?: get_the_title( $post_id ) . ' \u2014 Research Grade',
        'desc'       => $g( '_vpp_fp_desc' ) ?: '',
        'moa'        => $g( '_vpp_fp_moa' ) ?: '',
        'benefits'   => $benefits,
        'total'      => $total,
        'purity'     => $g( '_vpp_fp_purity' ) ?: '≥ 99.0% HPLC · Endotoxin < 1 EU/mg',
        'storage'    => $g( '_vpp_fp_storage' ) ?: '2–8°C · protect from light · do not freeze',
        'batch'      => $g( '_vpp_fp_batch' ) ?: 'NL-2026',
        'mg'         => $mg ?: 10.0,
        'ml'         => $ml,
        'maxdose'    => $maxdose ?: $mg,
        'unit'       => $unit,
        'freq'       => $freq,
    );

    // Write temp JSON
    $tmp_dir  = sys_get_temp_dir();
    $tmp_json = $tmp_dir . '/vpp_manual_' . $post_id . '_' . time() . '.json';
    file_put_contents( $tmp_json, json_encode( $data, JSON_UNESCAPED_UNICODE ) );

    // Determine output path
    $slug     = get_post_field( 'post_name', $post_id );
    $filename = sanitize_file_name( $slug . '-dosage-manual.pdf' );
    $upload   = wp_upload_dir();
    $pdf_dir  = $upload['basedir'] . '/vpp-manuals';
    $pdf_path = $pdf_dir . '/' . $filename;
    $pdf_url  = $upload['baseurl'] . '/vpp-manuals/' . $filename;

    if ( ! is_dir( $pdf_dir ) ) {
        wp_mkdir_p( $pdf_dir );
    }

    // Run generator
    $cmd = escapeshellcmd( $python ) . ' '
         . escapeshellarg( $script ) . ' '
         . escapeshellarg( $tmp_json ) . ' '
         . escapeshellarg( $pdf_path ) . ' 2>&1';
    $output  = array();
    $retcode = 0;
    exec( $cmd, $output, $retcode );

    @unlink( $tmp_json );

    if ( $retcode !== 0 || ! file_exists( $pdf_path ) ) {
        error_log( 'vpp_generate_flexpen_pdf error (exit ' . $retcode . '): ' . implode( "\n", $output ) );
        return false;
    }

    return $pdf_url;
}

/**
 * Auto-generate PDF on FlexPen publish/update when calculator fields are set.
 * Runs at priority 20 (after vpp_fp_save_meta at default priority 10).
 */
add_action( 'save_post_vp_flexpen', function( $post_id ) {
    static $running = false;
    if ( $running ) return;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    if ( get_post_status( $post_id ) !== 'publish' ) return;

    // Only auto-generate if calc fields (mg + maxdose) are filled in
    $mg      = floatval( get_post_meta( $post_id, '_vpp_fp_calc_mg', true ) );
    $maxdose = floatval( get_post_meta( $post_id, '_vpp_fp_calc_maxdose', true ) );
    if ( $mg <= 0 || $maxdose <= 0 ) return;

    // Don't overwrite a manually-set PDF unless the user explicitly regenerates
    $existing_pdf = get_post_meta( $post_id, '_vpp_fp_pdf', true );
    // Only auto-generate if no PDF is set yet
    if ( $existing_pdf ) return;

    $running = true;
    $url = vpp_generate_flexpen_pdf( $post_id );
    $running = false;

    if ( $url ) {
        update_post_meta( $post_id, '_vpp_fp_pdf', $url );
        set_transient( 'vpp_pdf_generated_' . $post_id, $url, 60 );
    }
}, 20 );

/**
 * AJAX handler — on-demand "Regenerate PDF" button in the meta box.
 */
add_action( 'wp_ajax_vpp_generate_pdf', function() {
    check_ajax_referer( 'vpp_gen_pdf', 'nonce' );
    $post_id = intval( $_POST['post_id'] ?? 0 );
    if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }
    $url = vpp_generate_flexpen_pdf( $post_id );
    if ( $url ) {
        update_post_meta( $post_id, '_vpp_fp_pdf', $url );
        wp_send_json_success( array( 'url' => $url, 'filename' => basename( $url ) ) );
    } else {
        wp_send_json_error( array( 'message' => 'PDF generation failed. Check that Python 3 and ReportLab are installed on the server, and that gen_auto_manual.py exists at the site root.' ) );
    }
} );

/* =========================================================================
   HELPER: Get FlexPen data array
   ========================================================================= */
function vitalpep_get_flexpen_data( $post_id ) {
    return array(
        'concentration' => get_post_meta( $post_id, '_vp_concentration', true ) ?: '',
        'volume'        => get_post_meta( $post_id, '_vp_volume', true ) ?: '',
        'purity'        => get_post_meta( $post_id, '_vp_purity', true ) ?: '99%+',
        'storage'       => get_post_meta( $post_id, '_vp_storage', true ) ?: '2-8°C',
        'batch'         => get_post_meta( $post_id, '_vp_batch', true ) ?: '',
        'badge'         => get_post_meta( $post_id, '_vp_badge', true ) ?: '',
    );
}

/* =========================================================================
   AJAX INQUIRY HANDLER
   ========================================================================= */
function vitalpep_handle_inquiry() {
    check_ajax_referer( 'vitalpep_nonce', 'nonce' );

    $name         = sanitize_text_field( $_POST['name'] ?? '' );
    $email        = sanitize_email( $_POST['email'] ?? '' );
    $organization = sanitize_text_field( $_POST['organization'] ?? '' );
    $product      = sanitize_text_field( $_POST['product'] ?? '' );
    $quantity     = sanitize_text_field( $_POST['quantity'] ?? '' );
    $message      = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }

    $inquiry_id = wp_insert_post( array(
        'post_type'    => 'vp_inquiry',
        'post_title'   => sprintf( 'Inquiry from %s — %s', $name, $product ?: 'General' ),
        'post_status'  => 'private',
        'post_content' => $message,
    ) );

    if ( $inquiry_id ) {
        update_post_meta( $inquiry_id, '_inquiry_email', $email );
        update_post_meta( $inquiry_id, '_inquiry_organization', $organization );
        update_post_meta( $inquiry_id, '_inquiry_product', $product );
        update_post_meta( $inquiry_id, '_inquiry_quantity', $quantity );
    }

    $admin_email = get_option( 'admin_email' );
    $subject     = sprintf( '[VitalPep Pro] New Inquiry: %s', $product ?: 'General' );
    $body        = sprintf(
        "New inquiry received:\n\nName: %s\nEmail: %s\nOrganization: %s\nProduct: %s\nQuantity: %s\n\nMessage:\n%s",
        $name, $email, $organization, $product, $quantity, $message
    );
    wp_mail( $admin_email, $subject, $body );

    wp_send_json_success( array(
        'message' => 'Your inquiry has been submitted successfully. Our team will respond within 24-48 business hours.',
    ) );
}
add_action( 'wp_ajax_vitalpep_inquiry', 'vitalpep_handle_inquiry' );
add_action( 'wp_ajax_nopriv_vitalpep_inquiry', 'vitalpep_handle_inquiry' );

/* =========================================================================
   INQUIRY ADMIN COLUMNS
   ========================================================================= */
function vitalpep_inquiry_columns( $columns ) {
    return array(
        'cb'           => $columns['cb'],
        'title'        => __( 'Inquiry', 'vitalpep-pro' ),
        'email'        => __( 'Email', 'vitalpep-pro' ),
        'organization' => __( 'Organization', 'vitalpep-pro' ),
        'product'      => __( 'Product', 'vitalpep-pro' ),
        'date'         => __( 'Date', 'vitalpep-pro' ),
    );
}
add_filter( 'manage_vp_inquiry_posts_columns', 'vitalpep_inquiry_columns' );

function vitalpep_inquiry_column_data( $column, $post_id ) {
    switch ( $column ) {
        case 'email':
            echo esc_html( get_post_meta( $post_id, '_inquiry_email', true ) );
            break;
        case 'organization':
            echo esc_html( get_post_meta( $post_id, '_inquiry_organization', true ) ?: '—' );
            break;
        case 'product':
            echo esc_html( get_post_meta( $post_id, '_inquiry_product', true ) ?: 'General' );
            break;
    }
}
add_action( 'manage_vp_inquiry_posts_custom_column', 'vitalpep_inquiry_column_data', 10, 2 );

/* =========================================================================
   NAV WALKER
   ========================================================================= */
class VitalPep_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes   = implode( ' ', $item->classes );
        $is_cta    = strpos( $classes, 'menu-cta' ) !== false;
        $is_active = in_array( 'current-menu-item', $item->classes );

        $class = 'main-nav__link';
        if ( $is_cta )    $class .= ' main-nav__link--cta';
        if ( $is_active ) $class .= ' main-nav__link--active';

        $output .= sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url( $item->url ),
            esc_attr( $class ),
            esc_html( $item->title )
        );
    }
    public function end_el( &$output, $item, $depth = 0, $args = null ) {}
    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}
}

/* =========================================================================
   BODY CLASSES
   ========================================================================= */
function vitalpep_body_classes( $classes ) {
    $classes[] = 'vitalpep-theme';
    if ( is_front_page() ) $classes[] = 'vitalpep-home';
    return $classes;
}
add_filter( 'body_class', 'vitalpep_body_classes' );

/* =========================================================================
   WIDGET AREAS
   ========================================================================= */
function vitalpep_widgets() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'vitalpep-pro' ),
        'id'            => 'footer-widgets',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer__column-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'vitalpep_widgets' );

/* =========================================================================
   EXCERPT LENGTH
   ========================================================================= */
add_filter( 'excerpt_length', function() { return 20; } );

/* =========================================================================
   FLUSH REWRITE ON THEME SWITCH
   ========================================================================= */
function vitalpep_rewrite_flush() {
    vitalpep_register_post_types();
    // Register verify rewrite rule before flushing so it's included
    add_rewrite_rule( '^verify/([a-f0-9]{32})/?$', 'index.php?pagename=verify&vpp_token=$matches[1]', 'top' );
    // Ensure permalinks are not Plain (Plain disables all rewrite rules)
    if ( get_option( 'permalink_structure' ) === '' ) {
        update_option( 'permalink_structure', '/%postname%/' );
    }
    flush_rewrite_rules();
    // Reset flush flag so admin_init re-runs on next visit
    delete_option( 'vpp_verify_rewrite_flushed_v2' );
}
add_action( 'after_switch_theme', 'vitalpep_rewrite_flush' );

/* =========================================================================
   AUTO-CREATE REQUIRED PAGES ON THEME ACTIVATION
   Creates FlexPens, COA Reports, and Contact pages if they don't exist,
   and assigns the correct page template to each.
   ========================================================================= */
function vitalpep_create_pages() {

    // Pages with their correct page templates
    $pages = array(
        array( 'title' => 'FlexPens',          'slug' => 'flexpens',    'template' => 'page-flexpens.php' ),
        array( 'title' => 'COA Reports',      'slug' => 'coa-reports', 'template' => 'page-coa-reports.php' ),
        array( 'title' => 'Dosage Calculator','slug' => 'calculator',  'template' => 'page-calculator.php' ),
        array( 'title' => 'Contact',          'slug' => 'contact',     'template' => 'page-contact.php' ),
        array( 'title' => 'FAQ',              'slug' => 'faq',         'template' => 'page-faq.php' ),
        array( 'title' => 'Verify',           'slug' => 'verify',      'template' => 'page-verify.php' ),
    );

    foreach ( $pages as $page ) {
        $existing = get_page_by_path( $page['slug'] );
        if ( ! $existing ) {
            $new_id = wp_insert_post( array(
                'post_title'  => $page['title'],
                'post_name'   => $page['slug'],
                'post_status' => 'publish',
                'post_type'   => 'page',
                'post_content'=> '',
            ) );
            if ( $new_id && ! is_wp_error( $new_id ) ) {
                update_post_meta( $new_id, '_wp_page_template', $page['template'] );
            }
        } else {
            // Always ensure the correct template is assigned
            update_post_meta( $existing->ID, '_wp_page_template', $page['template'] );
        }
    }

    // Set the front page to a static page named "Home" if not already set
    if ( 'page' !== get_option( 'show_on_front' ) ) {
        $home = get_page_by_path( 'home' );
        if ( ! $home ) {
            $home_id = wp_insert_post( array(
                'post_title'   => 'Home',
                'post_name'    => 'home',
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '',
            ) );
            update_post_meta( $home_id, '_wp_page_template', 'front-page.php' );
        } else {
            $home_id = $home->ID;
        }
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_id );
    }

    // Build / rebuild the primary nav menu every time so it always reflects current pages
    $menu_name  = 'Primary Navigation';
    $menu_obj   = wp_get_nav_menu_object( $menu_name );
    $menu_id    = $menu_obj ? $menu_obj->term_id : wp_create_nav_menu( $menu_name );

    // Wipe existing items so we don't accumulate duplicates on re-runs
    $existing_items = wp_get_nav_menu_items( $menu_id );
    if ( $existing_items ) {
        foreach ( $existing_items as $item ) {
            wp_delete_post( $item->ID, true );
        }
    }

    // Page links
    $nav_pages = array(
        array( 'title' => 'Home',               'slug' => 'home' ),
        array( 'title' => 'FlexPens',          'slug' => 'flexpens' ),
        array( 'title' => 'Dosage Calculator', 'slug' => 'calculator' ),
        array( 'title' => 'COA Reports',       'slug' => 'coa-reports' ),
        array( 'title' => 'FAQ',               'slug' => 'faq' ),
    );

    foreach ( $nav_pages as $item ) {
        $pg = get_page_by_path( $item['slug'] );
        if ( $pg ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => $item['title'],
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $pg->ID,
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ) );
        }
    }

    // Submit Inquiry CTA
    wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title'  => 'Submit Inquiry',
        'menu-item-url'    => home_url( '/contact/' ),
        'menu-item-type'   => 'custom',
        'menu-item-status' => 'publish',
    ) );

    // Always assign to the primary theme location
    $locations            = get_theme_mod( 'nav_menu_locations', array() );
    $locations['primary'] = $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );

    // Flush rewrite rules so new page slugs resolve
    flush_rewrite_rules();
}

/* =========================================================================
   SEED DEFAULT FAQ ITEMS
   Populates FAQ CPT with default Q&A content grouped by sections.
   ========================================================================= */
function vitalpep_seed_faqs() {
    $sections = array(
        'General' => array(
            array( 'q' => 'What is VitalPep Pro Pharmaceuticals?', 'a' => 'VitalPep Pro Pharmaceuticals is a Netherlands-based manufacturer and distributor of research-grade peptide FlexPen compounds. We specialize in pre-filled, precision-dosed FlexPen delivery systems manufactured under cGMP standards in our European facility.' ),
            array( 'q' => 'What is a FlexPen?', 'a' => 'A FlexPen is a pre-filled, precision-calibrated delivery device containing research-grade peptide compounds. Unlike traditional lyophilized vials requiring reconstitution, FlexPens are ready for immediate laboratory use, offering superior dosing accuracy and eliminating preparation variability.' ),
            array( 'q' => 'Are your products available for direct purchase?', 'a' => 'VitalPep Pro operates on an inquiry-based model. To acquire compounds, researchers submit a formal inquiry through our contact form. Our research liaison team reviews each request and responds with availability, specifications, and procurement details within 24-48 business hours.' ),
            array( 'q' => 'What compounds do you offer?', 'a' => 'We currently offer 7 FlexPen compounds: GHK-Cu, Retatrutide, Melanotan II, NAD+, Semaglutide, Tirzepatide, and BPC-157 + TB-500 Blend — spanning tissue regeneration, metabolic research, melanocortin studies, cellular energy, GLP-1/GIP receptor agonism, and tissue repair research. Each is pre-loaded in a 3ml disposable pen for single-use research protocols.' ),
        ),
        'Quality & Testing' => array(
            array( 'q' => 'What purity standards do your compounds meet?', 'a' => 'All VitalPep Pro FlexPen compounds meet a minimum 99%+ purity standard as verified by independent third-party HPLC analysis. Each batch also undergoes mass spectrometry identity confirmation, endotoxin screening, sterility testing, and stability assessment.' ),
            array( 'q' => 'Do you provide Certificates of Analysis (COAs)?', 'a' => 'Yes. Every production batch is accompanied by a comprehensive COA from independent, accredited third-party laboratories. COAs include HPLC purity results, mass spectrometry data, endotoxin levels, sterility assay results, and visual/pH assessments. These are accessible on our COA Reports page.' ),
            array( 'q' => 'What does cGMP certification mean?', 'a' => 'cGMP (current Good Manufacturing Practice) certification means our Netherlands facility operates under regulatory standards governing pharmaceutical manufacturing. This includes strict environmental controls, equipment validation, personnel training, batch documentation, quality control procedures, and traceability systems ensuring consistent product quality.' ),
            array( 'q' => 'How are your FlexPens stored and shipped?', 'a' => 'All VitalPep Pro FlexPen compounds are pre-constituted and require refrigerated storage at 2-8C (36-46F). These are not raw powders — they are ready-to-use, pre-loaded in a 3ml disposable pen. Each pen is single-use and should be discarded responsibly once the full 3ml has been administered. We offer cold-chain shipping with temperature-monitored packaging to maintain compound integrity during transit.' ),
        ),
        'Ordering & Shipping' => array(
            array( 'q' => 'How do I place an order?', 'a' => 'Submit a research inquiry through our Contact page, specifying the compounds, quantities, and any specific formulation requirements. Our research liaison team will review your request and respond with availability and procurement instructions within 24-48 business hours.' ),
            array( 'q' => 'Do you ship internationally?', 'a' => 'Yes. We ship globally from our Netherlands facility. We offer DDP (Delivered Duty Paid) shipping for select regions, meaning all customs duties and import fees are handled on your behalf. Cold-chain shipping is available to maintain FlexPen integrity during international transit.' ),
            array( 'q' => 'What are your shipping timeframes?', 'a' => 'Processing typically takes 24-48 hours after inquiry approval. Shipping times vary by destination: EU deliveries typically arrive within 2-4 business days, while international shipments may take 5-10 business days depending on region and customs processing.' ),
            array( 'q' => 'Do you offer bulk or institutional pricing?', 'a' => 'Yes. We provide volume-based pricing for research institutions, universities, and laboratories with ongoing compound requirements. Contact our team via the inquiry form with your institutional details and estimated quantities for a customized quotation.' ),
        ),
        'Compliance & Safety' => array(
            array( 'q' => 'Are these products for human use?', 'a' => 'No. All VitalPep Pro FlexPen compounds are manufactured, labeled, and distributed exclusively for legitimate laboratory research purposes. They are not approved for human consumption, therapeutic use, or clinical application. Proper laboratory handling protocols must be followed.' ),
            array( 'q' => 'What handling precautions are required?', 'a' => 'All FlexPen compounds should be handled in appropriate laboratory settings with standard safety equipment (gloves, lab coat, eye protection). Follow your institution\'s standard operating procedures for handling research peptides. Refer to the safety data sheet (SDS) included with each shipment.' ),
            array( 'q' => 'Do you verify research credentials?', 'a' => 'We reserve the right to request verification of research credentials, institutional affiliation, and intended use for all inquiries. This ensures our compounds are directed to legitimate research applications in compliance with applicable regulations.' ),
        ),
    );

    $order = 0;
    foreach ( $sections as $section_name => $faqs ) {
        // Create or get the FAQ section term
        $term = term_exists( $section_name, 'faq_section' );
        if ( ! $term ) {
            $term = wp_insert_term( $section_name, 'faq_section' );
        }
        $term_id = is_array( $term ) ? $term['term_id'] : $term;

        foreach ( $faqs as $faq ) {
            $order++;
            $post_id = wp_insert_post( array(
                'post_title'   => $faq['q'],
                'post_content' => $faq['a'],
                'post_type'    => 'vp_faq',
                'post_status'  => 'publish',
                'menu_order'   => $order,
            ) );
            if ( $post_id && ! is_wp_error( $post_id ) ) {
                wp_set_object_terms( $post_id, intval( $term_id ), 'faq_section' );
            }
        }
    }
}

add_action( 'after_switch_theme', function() {
    delete_option( 'vpp_pages_created' );
    delete_option( 'vpp_template_version' );
    vitalpep_create_pages();
    update_option( 'vpp_pages_created', '1' );
    update_option( 'vpp_template_version', '2' );

    // Seed default FAQ items if none exist
    $existing_faqs = get_posts( array( 'post_type' => 'vp_faq', 'posts_per_page' => 1 ) );
    if ( empty( $existing_faqs ) ) {
        vitalpep_seed_faqs();
    }
} );

// Rebuild nav menu whenever vpp_menu_version doesn't match (catches re-uploads without deactivation)
add_action( 'init', function() {
    if ( get_option( 'vpp_menu_version' ) !== '3' ) {
        $menu_name = 'Primary Navigation';
        $menu_obj  = wp_get_nav_menu_object( $menu_name );
        $menu_id   = $menu_obj ? $menu_obj->term_id : wp_create_nav_menu( $menu_name );

        // Wipe existing items
        $existing_items = wp_get_nav_menu_items( $menu_id );
        if ( $existing_items ) {
            foreach ( $existing_items as $item ) {
                wp_delete_post( $item->ID, true );
            }
        }

        // Page links
        $nav_pages = array(
            array( 'title' => 'Home',              'slug' => 'home' ),
            array( 'title' => 'FlexPens',          'slug' => 'flexpens' ),
            array( 'title' => 'Dosage Calculator', 'slug' => 'calculator' ),
            array( 'title' => 'COA Reports',       'slug' => 'coa-reports' ),
            array( 'title' => 'FAQ',               'slug' => 'faq' ),
        );
        foreach ( $nav_pages as $item ) {
            $pg = get_page_by_path( $item['slug'] );
            if ( $pg ) {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'     => $item['title'],
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $pg->ID,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                ) );
            }
        }
        // Submit Inquiry CTA
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'  => 'Submit Inquiry',
            'menu-item-url'    => home_url( '/contact/' ),
            'menu-item-type'   => 'custom',
            'menu-item-status' => 'publish',
        ) );

        // Assign to primary location
        $locations            = get_theme_mod( 'nav_menu_locations', array() );
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );

        update_option( 'vpp_menu_version', '3' );
    }
} );

// Re-run template assignment if template version flag is stale (catches re-uploads)
add_action( 'init', function() {
    if ( get_option( 'vpp_template_version' ) !== '2' ) {
        $map = array(
            'flexpens'    => 'page-flexpens.php',
            'coa-reports' => 'page-coa-reports.php',
            'contact'     => 'page-contact.php',
            'faq'         => 'page-faq.php',
        );
        foreach ( $map as $slug => $tpl ) {
            $pg = get_page_by_path( $slug );
            if ( $pg ) update_post_meta( $pg->ID, '_wp_page_template', $tpl );
        }
        update_option( 'vpp_template_version', '2' );
    }
} );

// Also run on init if pages haven't been created yet (catches re-uploads without deactivation)
add_action( 'init', function() {
    if ( ! get_option( 'vpp_pages_created' ) ) {
        vitalpep_create_pages();
        update_option( 'vpp_pages_created', '1' );
    }
} );

/* =========================================================================
   ADMIN: ONE-CLICK PAGE SETUP BUTTON
   Shown in wp-admin when pages are missing, lets admin trigger setup manually
   ========================================================================= */
add_action( 'admin_notices', function() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    // Handle the button click
    if ( isset( $_GET['vpp_setup_pages'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'vpp_setup_pages' ) ) {
        vitalpep_create_pages();
        update_option( 'vpp_pages_created', '1' );
        echo '<div class="notice notice-success is-dismissible"><p><strong>VitalPep Pro:</strong> Pages created and nav menu set up successfully. <a href="' . admin_url( 'edit.php?post_type=page' ) . '">View Pages &rarr;</a></p></div>';
        return;
    }

    // Check if FlexPens page exists
    $flexpens = get_page_by_path( 'flexpens' );
    if ( ! $flexpens ) {
        $url = wp_nonce_url( add_query_arg( 'vpp_setup_pages', '1' ), 'vpp_setup_pages' );
        echo '<div class="notice notice-warning"><p><strong>VitalPep Pro:</strong> Required pages (FlexPens, COA Reports, etc.) have not been created yet. <a href="' . esc_url( $url ) . '" class="button button-primary">Create Pages Now</a></p></div>';
    }
} );


/* =========================================================================
   COA CUSTOM POST TYPE
   ========================================================================= */

/* ── Register CPT: vp_coa ─────────────────────────────────────────────── */
function vitalpep_register_coa_post_type() {
    register_post_type( 'vp_coa', array(
        'labels' => array(
            'name'               => __( 'COAs', 'vitalpep-pro' ),
            'singular_name'      => __( 'Certificate of Analysis', 'vitalpep-pro' ),
            'add_new_item'       => __( 'Add New Certificate of Analysis', 'vitalpep-pro' ),
            'edit_item'          => __( 'Edit Certificate of Analysis', 'vitalpep-pro' ),
            'all_items'          => __( 'All Certificates of Analysis', 'vitalpep-pro' ),
            'search_items'       => __( 'Search COAs', 'vitalpep-pro' ),
            'not_found'          => __( 'No COAs found', 'vitalpep-pro' ),
            'menu_name'          => __( 'COA Reports', 'vitalpep-pro' ),
        ),
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-media-document',
        'supports'     => array( 'title', 'thumbnail' ),
        'has_archive'  => false,
        'rewrite'      => false,
    ) );
}
add_action( 'init', 'vitalpep_register_coa_post_type' );

/* ── Meta box ─────────────────────────────────────────────────────────── */
function vitalpep_coa_add_meta_boxes() {
    add_meta_box(
        'vpp_coa_details',
        __( 'COA Details', 'vitalpep-pro' ),
        'vitalpep_coa_meta_box_callback',
        'vp_coa',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'vitalpep_coa_add_meta_boxes' );

function vitalpep_coa_meta_box_callback( $post ) {
    wp_nonce_field( 'vitalpep_coa_save', 'vitalpep_coa_nonce' );

    $strength    = get_post_meta( $post->ID, '_vp_coa_strength',   true );
    $batch       = get_post_meta( $post->ID, '_vp_coa_batch',      true );
    $coa_date    = get_post_meta( $post->ID, '_vp_coa_date',       true );
    $file_url    = get_post_meta( $post->ID, '_vp_coa_file_url',   true );
    $ext_link    = get_post_meta( $post->ID, '_vp_coa_link',       true );
    $source_type = get_post_meta( $post->ID, '_vp_coa_file_type',  true ) ?: 'pdf';
    ?>
    <table class="form-table"><tbody>
        <tr>
            <th><label for="_vp_coa_strength"><?php esc_html_e( 'Strength *', 'vitalpep-pro' ); ?></label></th>
            <td><input type="text" id="_vp_coa_strength" name="_vp_coa_strength"
                       value="<?php echo esc_attr( $strength ); ?>"
                       placeholder="e.g. 100mg / 3ml" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="_vp_coa_batch"><?php esc_html_e( 'Batch Number', 'vitalpep-pro' ); ?></label></th>
            <td><input type="text" id="_vp_coa_batch" name="_vp_coa_batch"
                       value="<?php echo esc_attr( $batch ); ?>"
                       placeholder="e.g. NL-GHK-2026-01" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="_vp_coa_date"><?php esc_html_e( 'COA Date', 'vitalpep-pro' ); ?></label></th>
            <td><input type="date" id="_vp_coa_date" name="_vp_coa_date"
                       value="<?php echo esc_attr( $coa_date ); ?>"></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Source Type', 'vitalpep-pro' ); ?></th>
            <td>
                <label><input type="radio" name="_vp_coa_source_type" value="file"
                    <?php checked( $source_type, 'file' ); ?>> <?php esc_html_e( 'File (PDF/Image)', 'vitalpep-pro' ); ?></label>
                &nbsp;
                <label><input type="radio" name="_vp_coa_source_type" value="link"
                    <?php checked( $source_type, 'link' ); ?>> <?php esc_html_e( 'External Link', 'vitalpep-pro' ); ?></label>
            </td>
        </tr>
        <tr>
            <th><label for="_vp_coa_file_url"><?php esc_html_e( 'File URL', 'vitalpep-pro' ); ?></label></th>
            <td>
                <input type="text" id="_vp_coa_file_url" name="_vp_coa_file_url"
                       value="<?php echo esc_url( $file_url ); ?>" class="regular-text"
                       placeholder="Uploaded via Media Library or AJAX handler">
                <p class="description"><?php esc_html_e( 'URL of the uploaded PDF/image file.', 'vitalpep-pro' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="_vp_coa_link"><?php esc_html_e( 'External Link', 'vitalpep-pro' ); ?></label></th>
            <td>
                <input type="url" id="_vp_coa_link" name="_vp_coa_link"
                       value="<?php echo esc_url( $ext_link ); ?>" class="regular-text"
                       placeholder="https://lab-provider.com/coa.pdf">
            </td>
        </tr>
    </tbody></table>
    <?php
}

/* ── Save meta ────────────────────────────────────────────────────────── */
function vitalpep_coa_save_meta( $post_id ) {
    if ( ! isset( $_POST['vitalpep_coa_nonce'] ) ||
         ! wp_verify_nonce( $_POST['vitalpep_coa_nonce'], 'vitalpep_coa_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array( '_vp_coa_strength', '_vp_coa_batch', '_vp_coa_date' );
    foreach ( $text_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }

    if ( isset( $_POST['_vp_coa_file_url'] ) ) {
        update_post_meta( $post_id, '_vp_coa_file_url', esc_url_raw( $_POST['_vp_coa_file_url'] ) );
    }
    if ( isset( $_POST['_vp_coa_link'] ) ) {
        update_post_meta( $post_id, '_vp_coa_link', esc_url_raw( $_POST['_vp_coa_link'] ) );
    }

    $source_type = isset( $_POST['_vp_coa_source_type'] ) && $_POST['_vp_coa_source_type'] === 'link' ? 'link' : 'pdf';
    update_post_meta( $post_id, '_vp_coa_file_type', $source_type );
}
add_action( 'save_post_vp_coa', 'vitalpep_coa_save_meta' );

/* ── AJAX handler: vpp_add_coa (admin only) ───────────────────────────── */
function vitalpep_ajax_add_coa() {
    if ( ! is_user_logged_in() || ! current_user_can( 'administrator' ) ) {
        wp_send_json_error( array( 'message' => __( 'Unauthorized.', 'vitalpep-pro' ) ) );
    }

    if ( ! isset( $_POST['vpp_coa_nonce'] ) ||
         ! wp_verify_nonce( $_POST['vpp_coa_nonce'], 'vpp_add_coa_nonce' ) ) {
        wp_send_json_error( array( 'message' => __( 'Security check failed.', 'vitalpep-pro' ) ) );
    }

    $product_name = sanitize_text_field( $_POST['product_name'] ?? '' );
    $strength     = sanitize_text_field( $_POST['strength']     ?? '' );
    $batch        = sanitize_text_field( $_POST['batch']        ?? '' );
    $coa_date     = sanitize_text_field( $_POST['coa_date']     ?? '' );
    $coa_link     = esc_url_raw(         $_POST['coa_link']     ?? '' );
    $source_type  = isset( $_POST['source_type'] ) && $_POST['source_type'] === 'link' ? 'link' : 'file';

    if ( empty( $product_name ) ) {
        wp_send_json_error( array( 'message' => __( 'Product name is required.', 'vitalpep-pro' ) ) );
    }
    if ( empty( $strength ) ) {
        wp_send_json_error( array( 'message' => __( 'Strength is required.', 'vitalpep-pro' ) ) );
    }

    /* Handle file upload */
    $file_url  = '';
    $file_type = 'pdf';

    if ( $source_type === 'file' && ! empty( $_FILES['coa_file']['name'] ) ) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        $upload = wp_handle_upload( $_FILES['coa_file'], array( 'test_form' => false ) );
        if ( isset( $upload['error'] ) ) {
            wp_send_json_error( array( 'message' => $upload['error'] ) );
        }
        $file_url = $upload['url'];
        $mime     = $upload['type'] ?? '';
        $file_type = strpos( $mime, 'image/' ) === 0 ? 'image' : 'pdf';
    } elseif ( $source_type === 'link' && ! empty( $coa_link ) ) {
        $file_url  = $coa_link;
        $file_type = 'link';
    }

    /* Insert post */
    $post_id = wp_insert_post( array(
        'post_type'   => 'vp_coa',
        'post_title'  => $product_name,
        'post_status' => 'publish',
    ) );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( array( 'message' => $post_id->get_error_message() ) );
    }

    update_post_meta( $post_id, '_vp_coa_strength',  $strength );
    update_post_meta( $post_id, '_vp_coa_batch',     $batch );
    update_post_meta( $post_id, '_vp_coa_date',      $coa_date );
    update_post_meta( $post_id, '_vp_coa_file_url',  $file_url );
    update_post_meta( $post_id, '_vp_coa_link',      $file_type === 'link' ? $coa_link : '' );
    update_post_meta( $post_id, '_vp_coa_file_type', $file_type );

    wp_send_json_success( array(
        'id'       => $post_id,
        'product'  => $product_name,
        'strength' => $strength,
        'batch'    => $batch,
        'date'     => $coa_date,
        'url'      => $file_url ?: $coa_link,
        'type'     => $file_type,
        'message'  => __( 'COA added successfully.', 'vitalpep-pro' ),
    ) );
}
add_action( 'wp_ajax_vpp_add_coa', 'vitalpep_ajax_add_coa' );

/* ── Admin list columns for vp_coa ───────────────────────────────────── */
function vitalpep_coa_admin_columns( $columns ) {
    return array(
        'cb'       => $columns['cb'],
        'title'    => __( 'Product', 'vitalpep-pro' ),
        'strength' => __( 'Strength', 'vitalpep-pro' ),
        'batch'    => __( 'Batch', 'vitalpep-pro' ),
        'coa_date' => __( 'COA Date', 'vitalpep-pro' ),
        'file'     => __( 'File / Link', 'vitalpep-pro' ),
        'date'     => __( 'Added', 'vitalpep-pro' ),
    );
}
add_filter( 'manage_vp_coa_posts_columns', 'vitalpep_coa_admin_columns' );

function vitalpep_coa_admin_column_data( $column, $post_id ) {
    switch ( $column ) {
        case 'strength':
            echo esc_html( get_post_meta( $post_id, '_vp_coa_strength', true ) ?: '—' );
            break;
        case 'batch':
            echo esc_html( get_post_meta( $post_id, '_vp_coa_batch', true ) ?: '—' );
            break;
        case 'coa_date':
            $d = get_post_meta( $post_id, '_vp_coa_date', true );
            echo esc_html( $d ? date_i18n( get_option( 'date_format' ), strtotime( $d ) ) : '—' );
            break;
        case 'file':
            $type    = get_post_meta( $post_id, '_vp_coa_file_type', true );
            $url     = get_post_meta( $post_id, '_vp_coa_file_url',  true )
                    ?: get_post_meta( $post_id, '_vp_coa_link', true );
            if ( $url ) {
                printf( '<a href="%s" target="_blank" rel="noopener">%s</a>',
                    esc_url( $url ),
                    esc_html( strtoupper( $type ?: 'PDF' ) )
                );
            } else {
                echo '—';
            }
            break;
    }
}
add_action( 'manage_vp_coa_posts_custom_column', 'vitalpep_coa_admin_column_data', 10, 2 );

/* =========================================================================
   TEMPLATE ROUTING — Bulletproof fallback for FlexPens & COA pages.
   Ensures the correct template file loads even if _wp_page_template meta
   was wiped or wasn't saved correctly on this installation.
   ========================================================================= */
add_filter( 'template_include', function( $template ) {
    global $post;
    if ( ! $post || ! is_page() ) return $template;

    $map = array(
        'flexpens'    => 'page-flexpens.php',
        'coa-reports' => 'page-coa-reports.php',
        'contact'     => 'page-contact.php',
        'faq'         => 'page-faq.php',
    );

    if ( isset( $map[ $post->post_name ] ) ) {
        $path = get_template_directory() . '/' . $map[ $post->post_name ];
        if ( file_exists( $path ) ) return $path;
    }

    return $template;
}, 999 );

/* =========================================================================
   ADMIN: Auto-correct template meta whenever an admin visits the dashboard.
   Ensures the right template is always assigned even after re-uploads.
   ========================================================================= */
add_action( 'admin_init', function() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    $map = array(
        'flexpens'    => 'page-flexpens.php',
        'coa-reports' => 'page-coa-reports.php',
        'contact'     => 'page-contact.php',
        'faq'         => 'page-faq.php',
    );
    foreach ( $map as $slug => $tpl ) {
        $pg = get_page_by_path( $slug );
        if ( $pg && get_post_meta( $pg->ID, '_wp_page_template', true ) !== $tpl ) {
            update_post_meta( $pg->ID, '_wp_page_template', $tpl );
        }
    }
} );

// Customizer
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/footer-walker.php';

/* =========================================================================
   PAGE CACHE HEADERS
   Sends Cache-Control headers so WordPress Site Health detects caching.
   Only applies to logged-out front-end visitors.
   ========================================================================= */
add_action( 'send_headers', function() {
    if ( is_admin() || is_user_logged_in() ) {
        return;
    }
    // 1-hour browser cache, allow CDN/proxy caching
    header( 'Cache-Control: public, max-age=3600, s-maxage=3600, stale-while-revalidate=60' );
    header( 'Vary: Accept-Encoding' );
} );

/* =========================================================================
   REST API — ensure the context parameter is preserved
   Fixes "REST API did not process the context query parameter correctly"
   caused by aggressive query-string stripping on some hosts.
   ========================================================================= */
add_filter( 'rest_request_before_callbacks', function( $response, $handler, $request ) {
    // If context is missing, default to 'view' so core checks pass
    if ( ! $request->get_param( 'context' ) ) {
        $request->set_param( 'context', 'view' );
    }
    return $response;
}, 1, 3 );

// Ensure REST API rewrites are always registered
add_action( 'init', function() {
    if ( ! get_option( 'vpp_rest_flushed' ) ) {
        flush_rewrite_rules();
        update_option( 'vpp_rest_flushed', '1' );
    }
} );

/* =========================================================================
   VERIFY PAGE REWRITE RULE
   Maps /verify/{32-char-token}/ → the Verify page with vpp_token query var
   so the token travels as a clean URL path segment instead of ?t= query string.
   ========================================================================= */
add_action( 'init', function() {
    add_rewrite_rule(
        '^verify/([a-f0-9]{32})/?$',
        'index.php?pagename=verify&vpp_token=$matches[1]',
        'top'
    );
} );

add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'vpp_token';
    return $vars;
} );

add_action( 'admin_init', function() {
    // Force re-flush whenever this version changes so the verify rewrite rule activates
    if ( ! get_option( 'vpp_verify_rewrite_flushed_v2' ) ) {
        // Ensure permalinks are not set to Plain — Plain breaks rewrite rules
        if ( get_option( 'permalink_structure' ) === '' ) {
            update_option( 'permalink_structure', '/%postname%/' );
        }
        flush_rewrite_rules();
        update_option( 'vpp_verify_rewrite_flushed_v2', '1' );
    }
} );

/* =========================================================================
   OUTPUT CUSTOM BRAND COLORS AS CSS VARIABLES
   ========================================================================= */
add_action( 'wp_head', function() {
    $colors = array(
        '--vp-navy'         => get_theme_mod( 'vpp_color_navy', '#0a1628' ),
        '--vp-primary'      => get_theme_mod( 'vpp_color_primary', '#1a5276' ),
        '--vp-accent'       => get_theme_mod( 'vpp_color_accent', '#2e86c1' ),
        '--vp-accent-light' => get_theme_mod( 'vpp_color_accent_light', '#5dade2' ),
    );
    $css = ':root{';
    foreach ( $colors as $var => $val ) {
        $css .= esc_attr( $var ) . ':' . esc_attr( $val ) . ';';
    }
    $css .= '}';
    echo '<style id="vpp-custom-colors">' . $css . '</style>';
}, 50 );

/* =========================================================================
   FLEXPEN CPT — SEED DEFAULT POSTS ON FIRST ADMIN LOAD
   Creates all 7 default FlexPen entries if they don't already exist.
   Uses a transient so it only runs once per site install.
   ========================================================================= */
add_action( 'admin_init', function() {
    if ( get_transient( 'vpp_flexpens_seeded_v3' ) ) return;
    $uri = get_template_directory_uri();
    $defaults = array(
        array( 'title' => 'GHK-Cu', 'slug' => 'ghkcu-flexpen', 'order' => 1, 'meta' => array(
            '_vpp_fp_category' => 'Tissue Regeneration & Anti-Aging',
            '_vpp_fp_tagline'  => 'Glycine-Histidine-Lysine Copper Peptide · 33.33 mg/ml · 100mg / 3ml',
            '_vpp_fp_badge1'   => '100mg / 3ml', '_vpp_fp_badge2' => '99%+ Purity',
            '_vpp_fp_total'    => '100mg', '_vpp_fp_purity' => '99.2% HPLC',
            '_vpp_fp_storage'  => '2–8 °C · do not freeze', '_vpp_fp_batch' => 'NL-2026-A',
            '_vpp_fp_pdf'      => $uri . '/assets/pdfs/ghkcu-dosage-manual.pdf',
            '_vpp_fp_inquiry'  => 'GHK-Cu+FlexPen', '_vpp_fp_img_fallback' => 'flexpenspageimages/ghkpen.jpg',
            '_vpp_fp_verify_token' => 'b0bcd45bc5982e60f42c3adb107e6da1',
            '_vpp_fp_show_in_reel' => '1', '_vpp_fp_reel_extra' => 'cGMP Netherlands',
            '_vpp_fp_show_in_dosing' => '1', '_vpp_fp_show_in_calc' => '1',
            '_vpp_fp_calc_mg' => '100', '_vpp_fp_calc_ml' => '3', '_vpp_fp_calc_maxdose' => '5',
            '_vpp_fp_calc_unit' => 'mg', '_vpp_fp_calc_freq' => 'daily', '_vpp_fp_calc_color' => 'purple',
            '_vpp_fp_desc' => 'GHK-Cu is a naturally occurring copper peptide complex found in human plasma that plays a critical role in wound healing, tissue remodeling, and cellular repair. Originally isolated by Dr. Loren Pickart, plasma GHK-Cu levels decline sharply with age — making it one of the most studied peptides in regenerative and anti-aging research. Each FlexPen delivers a precision 100mg payload in 3ml of carrier solution, providing consistent, measurable dosing for research protocols.',
            '_vpp_fp_moa'  => 'GHK-Cu binds and transports copper ions into cells, modulating the expression of over 4,000 human genes. It activates collagen and elastin synthesis via TGF-β pathway stimulation, promotes angiogenesis through VEGF upregulation, and exerts antioxidant activity by activating superoxide dismutase. At the nuclear level, it acts as a gene-regulating signal that resets cells toward a healthier, more youthful expression profile.',
            '_vpp_fp_b1' => 'Wound healing & tissue repair mechanisms',
            '_vpp_fp_b2' => 'Collagen & elastin synthesis pathways',
            '_vpp_fp_b3' => 'Hair follicle cycle & growth studies',
            '_vpp_fp_b4' => 'Angiogenesis & VEGF pathway research',
            '_vpp_fp_b5' => 'Antioxidant & anti-inflammatory models',
            '_vpp_fp_b6' => 'Nerve tissue regeneration & neuroprotection',
        ) ),
        array( 'title' => 'Retatrutide', 'slug' => 'retatrutide-flexpen', 'order' => 2, 'meta' => array(
            '_vpp_fp_category' => 'Advanced Metabolic Research',
            '_vpp_fp_tagline'  => 'GIP / GLP-1 / Glucagon Triple Receptor Agonist · 10 mg/ml · 30mg / 3ml',
            '_vpp_fp_badge1'   => '30mg / 3ml', '_vpp_fp_badge2' => 'Triple Agonist',
            '_vpp_fp_total'    => '30mg', '_vpp_fp_purity' => '99.4% HPLC',
            '_vpp_fp_storage'  => '2–8 °C · do not freeze', '_vpp_fp_batch' => 'NL-2026-B',
            '_vpp_fp_pdf'      => $uri . '/assets/pdfs/retatrutide-dosage-manual.pdf',
            '_vpp_fp_inquiry'  => 'Retatrutide+FlexPen', '_vpp_fp_img_fallback' => 'flexpenspageimages/retapen.jpg',
            '_vpp_fp_verify_token' => 'd4bca322cd401614e471d97b07b8427a',
            '_vpp_fp_show_in_reel' => '1', '_vpp_fp_reel_extra' => 'Triple Agonist',
            '_vpp_fp_show_in_dosing' => '1', '_vpp_fp_show_in_calc' => '1',
            '_vpp_fp_calc_mg' => '30', '_vpp_fp_calc_ml' => '3', '_vpp_fp_calc_maxdose' => '12',
            '_vpp_fp_calc_unit' => 'mg', '_vpp_fp_calc_freq' => 'weekly', '_vpp_fp_calc_color' => 'blue',
            '_vpp_fp_desc' => 'Retatrutide (LY3437943) represents the cutting edge of metabolic research compounds — a novel triple agonist that simultaneously activates GIP, GLP-1, and glucagon receptors. This triple-action mechanism produces unmatched metabolic effects compared to single or dual agonists, making it the most studied next-generation compound in metabolic science. Each FlexPen delivers a precision 30mg payload for consistent, protocol-ready research dosing.',
            '_vpp_fp_moa'  => 'GIP receptor activation enhances insulin sensitivity and facilitates fat cell metabolism. GLP-1 receptor activation reduces appetite signaling, slows gastric emptying, and stimulates insulin secretion. Glucagon receptor activation increases hepatic glucose output, raises basal metabolic rate, and promotes lipolysis — creating a synergistic metabolic effect that exceeds dual-agonist approaches.',
            '_vpp_fp_b1' => 'Advanced obesity & body composition research',
            '_vpp_fp_b2' => 'Glucose homeostasis & insulin sensitivity',
            '_vpp_fp_b3' => 'Hepatic steatosis mechanism studies',
            '_vpp_fp_b4' => 'Cardiovascular metabolic risk research',
            '_vpp_fp_b5' => 'Energy expenditure pathway investigation',
            '_vpp_fp_b6' => 'Comparative studies vs. GLP-1 monotherapy',
        ) ),
        array( 'title' => 'Melanotan II', 'slug' => 'melanotan-flexpen', 'order' => 3, 'meta' => array(
            '_vpp_fp_category' => 'Melanocortin System Research',
            '_vpp_fp_tagline'  => 'Synthetic α-MSH Cyclic Lactam Analog · 3.33 mg/ml · 10mg / 3ml',
            '_vpp_fp_badge1'   => '10mg / 3ml', '_vpp_fp_badge2' => 'MC1R · MC4R',
            '_vpp_fp_total'    => '10mg', '_vpp_fp_purity' => '99.1% HPLC',
            '_vpp_fp_storage'  => '2–8 °C · do not freeze', '_vpp_fp_batch' => 'NL-2026-C',
            '_vpp_fp_pdf'      => $uri . '/assets/pdfs/melanotan2-dosage-manual.pdf',
            '_vpp_fp_inquiry'  => 'Melanotan+II+FlexPen', '_vpp_fp_img_fallback' => 'flexpenspageimages/mt2pen.jpg',
            '_vpp_fp_verify_token' => 'a94ebfa73ef1b50148b090c3bc2998fa',
            '_vpp_fp_show_in_reel' => '1', '_vpp_fp_reel_extra' => 'Melanocortin Agonist',
            '_vpp_fp_show_in_dosing' => '1', '_vpp_fp_show_in_calc' => '1',
            '_vpp_fp_calc_mg' => '10', '_vpp_fp_calc_ml' => '3', '_vpp_fp_calc_maxdose' => '1000',
            '_vpp_fp_calc_unit' => 'mcg', '_vpp_fp_calc_freq' => 'eod', '_vpp_fp_calc_color' => 'amber',
            '_vpp_fp_desc' => 'Melanotan II (MT-II) is a synthetic cyclic lactam analog of alpha-melanocyte-stimulating hormone (α-MSH), originally developed at the University of Arizona as part of research into photoprotection and tanning. As a non-selective melanocortin receptor agonist, MT-II provides unparalleled access to the melanocortin system for studying pigmentation, appetite regulation, sexual function, and immune modulation pathways in a single compound.',
            '_vpp_fp_moa'  => 'MT-II binds with high affinity to melanocortin receptors: MC1R in melanocytes drives eumelanin production and photoprotection; MC3R regulates energy homeostasis and immune function; MC4R activation controls appetite suppression, libido pathways, and thermogenesis; MC5R plays a role in exocrine gland function. This multi-receptor profile makes MT-II a uniquely versatile research tool across multiple biological systems.',
            '_vpp_fp_b1' => 'Melanogenesis & pigmentation pathway studies',
            '_vpp_fp_b2' => 'MC4R appetite regulation research',
            '_vpp_fp_b3' => 'Sexual function & libido pathway studies',
            '_vpp_fp_b4' => 'Photoprotection & UV response models',
            '_vpp_fp_b5' => 'Energy homeostasis & thermogenesis',
            '_vpp_fp_b6' => 'Immune modulation & anti-inflammatory research',
        ) ),
        array( 'title' => 'NAD+', 'slug' => 'nadplus-flexpen', 'order' => 4, 'meta' => array(
            '_vpp_fp_category' => 'Cellular Energy & Longevity Research',
            '_vpp_fp_tagline'  => 'Nicotinamide Adenine Dinucleotide · 166.67 mg/ml · 500mg / 3ml',
            '_vpp_fp_badge1'   => '500mg / 3ml', '_vpp_fp_badge2' => 'Sirtuin Activator',
            '_vpp_fp_total'    => '500mg', '_vpp_fp_purity' => '99.3% HPLC',
            '_vpp_fp_storage'  => '2–8 °C · do not freeze', '_vpp_fp_batch' => 'NL-2026-D',
            '_vpp_fp_pdf'      => $uri . '/assets/pdfs/nadplus-dosage-manual.pdf',
            '_vpp_fp_inquiry'  => 'NAD%2B+FlexPen', '_vpp_fp_img_fallback' => 'flexpenspageimages/nadpen.jpg',
            '_vpp_fp_verify_token' => 'fadfb75e87ea0f7d9350a4c63f553992',
            '_vpp_fp_show_in_reel' => '1', '_vpp_fp_reel_extra' => 'cGMP Netherlands',
            '_vpp_fp_show_in_dosing' => '1', '_vpp_fp_show_in_calc' => '1',
            '_vpp_fp_calc_mg' => '500', '_vpp_fp_calc_ml' => '3', '_vpp_fp_calc_maxdose' => '500',
            '_vpp_fp_calc_unit' => 'mg', '_vpp_fp_calc_freq' => 'daily', '_vpp_fp_calc_color' => 'green',
            '_vpp_fp_desc' => 'NAD+ (Nicotinamide Adenine Dinucleotide) is the essential coenzyme found at the center of cellular metabolism in every living cell. As a critical electron carrier in oxidative phosphorylation and a key substrate for longevity-regulating enzymes, NAD+ sits at the intersection of aging, energy production, and DNA repair research. At 500mg per 3ml cartridge, this FlexPen delivers the highest-concentration research payload in our entire lineup.',
            '_vpp_fp_moa'  => 'NAD+ serves as the primary substrate for sirtuins (SIRT1–7) — the master longevity deacetylases regulating gene expression, mitochondrial biogenesis, and stress resistance. It is required by PARP enzymes for DNA damage surveillance and repair. As an electron shuttle in the mitochondrial electron transport chain, NAD+ directly drives ATP synthesis. Age-related NAD+ depletion is mediated by CD38 and inflammatory SARP activity.',
            '_vpp_fp_b1' => 'Sirtuin pathway activation & longevity research',
            '_vpp_fp_b2' => 'DNA damage surveillance & repair (PARP)',
            '_vpp_fp_b3' => 'Mitochondrial function & biogenesis studies',
            '_vpp_fp_b4' => 'Neuroprotection & cognitive function models',
            '_vpp_fp_b5' => 'Muscle metabolism & exercise physiology',
            '_vpp_fp_b6' => 'Metabolic disease & aging pathway investigation',
        ) ),
        array( 'title' => 'Semaglutide', 'slug' => 'semaglutide-flexpen', 'order' => 5, 'meta' => array(
            '_vpp_fp_category' => 'GLP-1 Metabolic Research',
            '_vpp_fp_tagline'  => 'GLP-1 Receptor Agonist · 3.33 mg/ml · 10mg / 3ml',
            '_vpp_fp_badge1'   => '10mg / 3ml', '_vpp_fp_badge2' => 'GLP-1 Agonist',
            '_vpp_fp_total'    => '10mg', '_vpp_fp_purity' => '99.2% HPLC',
            '_vpp_fp_storage'  => '2–8 °C · do not freeze', '_vpp_fp_batch' => 'NL-2026-E',
            '_vpp_fp_pdf'      => $uri . '/assets/pdfs/semaglutide-dosage-manual.pdf',
            '_vpp_fp_inquiry'  => 'Semaglutide+FlexPen', '_vpp_fp_img_fallback' => 'flexpenspageimages/semapen.jpg',
            '_vpp_fp_verify_token' => 'b7db409860667801b04ac0f4f257fe4b',
            '_vpp_fp_show_in_reel' => '1', '_vpp_fp_reel_extra' => 'GLP-1 Agonist',
            '_vpp_fp_show_in_dosing' => '1', '_vpp_fp_show_in_calc' => '1',
            '_vpp_fp_calc_mg' => '10', '_vpp_fp_calc_ml' => '3', '_vpp_fp_calc_maxdose' => '2',
            '_vpp_fp_calc_unit' => 'mg', '_vpp_fp_calc_freq' => 'weekly', '_vpp_fp_calc_color' => 'teal',
            '_vpp_fp_desc' => 'Semaglutide is a glucagon-like peptide-1 (GLP-1) receptor agonist developed as a once-weekly research compound for metabolic and weight management studies. As a long-acting GLP-1 analog with 94% homology to native GLP-1, semaglutide provides sustained receptor activation that has made it one of the most studied metabolic compounds of the past decade. Each FlexPen delivers 10mg in 3ml for precise weekly dosing protocols.',
            '_vpp_fp_moa'  => 'Semaglutide binds and activates GLP-1 receptors in the pancreas, hypothalamus, and gut. Pancreatic activation stimulates glucose-dependent insulin secretion and suppresses glucagon release. Hypothalamic activation reduces appetite and caloric intake. Gastric effects slow emptying and improve postprandial glucose control. Its fatty acid side chain enables albumin binding, extending half-life to approximately 7 days for once-weekly administration.',
            '_vpp_fp_b1' => 'GLP-1 receptor signaling & pancreatic beta-cell studies',
            '_vpp_fp_b2' => 'Appetite regulation & hypothalamic pathway research',
            '_vpp_fp_b3' => 'Weight management & adipose tissue investigation',
            '_vpp_fp_b4' => 'Glucose homeostasis & insulin secretion models',
            '_vpp_fp_b5' => 'Cardiovascular risk & atherosclerosis research',
            '_vpp_fp_b6' => 'Gastric motility & gut hormone interaction studies',
        ) ),
        array( 'title' => 'Tirzepatide', 'slug' => 'tirzepatide-flexpen', 'order' => 6, 'meta' => array(
            '_vpp_fp_category' => 'Dual GIP/GLP-1 Metabolic Research',
            '_vpp_fp_tagline'  => 'GIP / GLP-1 Dual Receptor Agonist · 10 mg/ml · 30mg / 3ml',
            '_vpp_fp_badge1'   => '30mg / 3ml', '_vpp_fp_badge2' => 'Dual Agonist',
            '_vpp_fp_total'    => '30mg', '_vpp_fp_purity' => '99.1% HPLC',
            '_vpp_fp_storage'  => '2–8 °C · do not freeze', '_vpp_fp_batch' => 'NL-2026-F',
            '_vpp_fp_pdf'      => $uri . '/assets/pdfs/tirzepatide-dosage-manual.pdf',
            '_vpp_fp_inquiry'  => 'Tirzepatide+FlexPen', '_vpp_fp_img_fallback' => 'flexpenspageimages/tirzpen.jpg',
            '_vpp_fp_verify_token' => '9ba683c6f0023e4fb45bfc15000ff030',
            '_vpp_fp_show_in_reel' => '1', '_vpp_fp_reel_extra' => 'Dual GIP/GLP-1',
            '_vpp_fp_show_in_dosing' => '1', '_vpp_fp_show_in_calc' => '1',
            '_vpp_fp_calc_mg' => '30', '_vpp_fp_calc_ml' => '3', '_vpp_fp_calc_maxdose' => '15',
            '_vpp_fp_calc_unit' => 'mg', '_vpp_fp_calc_freq' => 'weekly', '_vpp_fp_calc_color' => 'rose',
            '_vpp_fp_desc' => 'Tirzepatide is a novel dual glucose-dependent insulinotropic polypeptide (GIP) and GLP-1 receptor agonist — the first in a new class of twincretin compounds. By simultaneously activating both incretin receptors, tirzepatide produces metabolic effects that consistently exceed those of GLP-1 monotherapy in clinical research. Each FlexPen delivers 30mg in 3ml for precise once-weekly dosing protocols.',
            '_vpp_fp_moa'  => 'Tirzepatide activates both GIP and GLP-1 receptors with balanced affinity. GIP receptor activation in adipose tissue enhances insulin-stimulated glucose uptake and modulates fat storage; in the pancreas it potentiates insulin secretion. GLP-1 receptor activation suppresses glucagon, slows gastric emptying, and reduces appetite. The combination produces synergistic effects on body weight, glucose control, and lipid metabolism that neither receptor alone can achieve.',
            '_vpp_fp_b1' => 'Dual incretin receptor signaling research',
            '_vpp_fp_b2' => 'GIP receptor biology & adipose tissue studies',
            '_vpp_fp_b3' => 'Superior weight loss vs. GLP-1 monotherapy models',
            '_vpp_fp_b4' => 'Insulin sensitivity & glucose metabolism research',
            '_vpp_fp_b5' => 'Cardiovascular & lipid metabolism investigation',
            '_vpp_fp_b6' => 'Twincretin mechanism & synergy studies',
        ) ),
        array( 'title' => 'BPC-157 + TB-500 Blend', 'slug' => 'bpc157-tb500-flexpen', 'order' => 7, 'meta' => array(
            '_vpp_fp_category' => 'Tissue Repair & Regeneration',
            '_vpp_fp_tagline'  => 'BPC-157 10mg + TB-500 10mg Synergistic Blend · 6.67 mg/ml · 20mg total / 3ml',
            '_vpp_fp_badge1'   => '20mg / 3ml', '_vpp_fp_badge2' => 'Dual Peptide Blend',
            '_vpp_fp_total'    => '20mg (10mg + 10mg)', '_vpp_fp_purity' => '99.0% HPLC',
            '_vpp_fp_storage'  => '2–8 °C · do not freeze', '_vpp_fp_batch' => 'NL-2026-G',
            '_vpp_fp_pdf'      => $uri . '/assets/pdfs/bpc157-tb500-dosage-manual.pdf',
            '_vpp_fp_inquiry'  => 'BPC-157+TB-500+Blend+FlexPen', '_vpp_fp_img_fallback' => 'flexpenspageimages/bpc157tb500pen.jpg',
            '_vpp_fp_verify_token' => '01cebed97182cb296830bc314a63e0d8',
            '_vpp_fp_show_in_reel' => '1', '_vpp_fp_reel_extra' => 'Dual Peptide Synergy',
            '_vpp_fp_show_in_dosing' => '1', '_vpp_fp_show_in_calc' => '1',
            '_vpp_fp_calc_mg' => '20', '_vpp_fp_calc_ml' => '3', '_vpp_fp_calc_maxdose' => '750',
            '_vpp_fp_calc_unit' => 'mcg', '_vpp_fp_calc_freq' => 'daily', '_vpp_fp_calc_color' => 'green',
            '_vpp_fp_desc' => 'The BPC-157 + TB-500 Blend combines two of the most studied tissue-repair peptides into a single synergistic FlexPen formulation. BPC-157 (Body Protection Compound-157) is a 15-amino-acid gastric pentadecapeptide that accelerates wound healing, tendon repair, and gut mucosal recovery. TB-500 (Thymosin Beta-4 fragment) is a 43-amino-acid peptide that promotes cell migration, angiogenesis, and anti-inflammatory signaling. Together, these peptides target overlapping but complementary repair pathways, delivering a combined 20mg payload (10mg each) in 3ml of carrier solution.',
            '_vpp_fp_moa'  => 'BPC-157 upregulates growth hormone receptors, stimulates nitric oxide synthesis, and activates the FAK-paxillin pathway to accelerate tendon-to-bone healing and angiogenesis. It also modulates the dopaminergic and serotonergic systems for neuroprotective effects. TB-500 sequesters G-actin monomers to promote actin polymerization and cell migration at injury sites. It reduces NF-κB-mediated inflammation and upregulates anti-inflammatory cytokines. The combination produces synergistic tissue repair by simultaneously promoting vascularization (BPC-157) and cellular migration to wound sites (TB-500).',
            '_vpp_fp_b1' => 'Tendon, ligament & joint repair research',
            '_vpp_fp_b2' => 'Wound healing & angiogenesis studies',
            '_vpp_fp_b3' => 'Gut mucosal integrity & GI repair models',
            '_vpp_fp_b4' => 'Anti-inflammatory & NF-κB pathway research',
            '_vpp_fp_b5' => 'Muscle tissue regeneration & fibrosis studies',
            '_vpp_fp_b6' => 'Neuroprotection & nerve injury repair models',
        ) ),
    );
    foreach ( $defaults as $pen ) {
        $existing = get_posts( array(
            'post_type'   => 'vp_flexpen',
            'name'        => $pen['slug'],
            'post_status' => 'publish',
            'numberposts' => 1,
        ) );
        if ( ! empty( $existing ) ) continue;
        $post_id = wp_insert_post( array(
            'post_type'   => 'vp_flexpen',
            'post_title'  => $pen['title'],
            'post_name'   => $pen['slug'],
            'post_status' => 'publish',
            'menu_order'  => $pen['order'],
        ) );
        if ( is_wp_error( $post_id ) ) continue;
        foreach ( $pen['meta'] as $key => $value ) {
            update_post_meta( $post_id, $key, $value );
        }
    }
    set_transient( 'vpp_flexpens_seeded_v3', true, YEAR_IN_SECONDS );
} );

/* =========================================================================
   FLEXPEN VERIFICATION TOKENS — ensure all existing pens have their token
   Runs once on admin_init; safe to re-run (add_post_meta with unique=true).
   ========================================================================= */
add_action( 'admin_init', function() {
    if ( get_transient( 'vpp_tokens_applied_v1' ) ) return;
    $token_map = array(
        'ghkcu-flexpen'        => 'b0bcd45bc5982e60f42c3adb107e6da1',
        'retatrutide-flexpen'  => 'd4bca322cd401614e471d97b07b8427a',
        'melanotan-flexpen'    => 'a94ebfa73ef1b50148b090c3bc2998fa',
        'nadplus-flexpen'      => 'fadfb75e87ea0f7d9350a4c63f553992',
        'semaglutide-flexpen'  => 'b7db409860667801b04ac0f4f257fe4b',
        'tirzepatide-flexpen'  => '9ba683c6f0023e4fb45bfc15000ff030',
        'bpc157-tb500-flexpen' => '01cebed97182cb296830bc314a63e0d8',
    );
    foreach ( $token_map as $slug => $token ) {
        $posts = get_posts( array(
            'post_type'   => 'vp_flexpen',
            'name'        => $slug,
            'post_status' => 'publish',
            'numberposts' => 1,
        ) );
        if ( empty( $posts ) ) continue;
        $post_id = $posts[0]->ID;
        // Only set if not already present (preserves manually overridden tokens)
        if ( ! get_post_meta( $post_id, '_vpp_fp_verify_token', true ) ) {
            update_post_meta( $post_id, '_vpp_fp_verify_token', $token );
        }
    }
    set_transient( 'vpp_tokens_applied_v1', true, YEAR_IN_SECONDS );
} );

/* =========================================================================
   FLEXPEN CAROUSEL IMAGES — ensure all existing pens have carousel image set
   Runs once on admin_init so the homepage hero shows pen photos out of the box.
   ========================================================================= */
add_action( 'admin_init', function() {
    if ( get_transient( 'vpp_carousel_applied_v1' ) ) return;
    $uri = get_template_directory_uri();
    $carousel_map = array(
        'ghkcu-flexpen'        => $uri . '/assets/images/flexpenspageimages/ghkpen.jpg',
        'retatrutide-flexpen'  => $uri . '/assets/images/flexpenspageimages/retapen.jpg',
        'melanotan-flexpen'    => $uri . '/assets/images/flexpenspageimages/mt2pen.jpg',
        'nadplus-flexpen'      => $uri . '/assets/images/flexpenspageimages/nadpen.jpg',
        'semaglutide-flexpen'  => $uri . '/assets/images/flexpenspageimages/semapen.jpg',
        'tirzepatide-flexpen'  => $uri . '/assets/images/flexpenspageimages/tirzpen.jpg',
        'bpc157-tb500-flexpen' => $uri . '/assets/images/flexpenspageimages/bpc157tb500pen.jpg',
    );
    foreach ( $carousel_map as $slug => $img_url ) {
        $posts = get_posts( array(
            'post_type'   => 'vp_flexpen',
            'name'        => $slug,
            'post_status' => 'publish',
            'numberposts' => 1,
        ) );
        if ( empty( $posts ) ) continue;
        $post_id = $posts[0]->ID;
        if ( ! get_post_meta( $post_id, '_vpp_fp_img_carousel', true ) ) {
            update_post_meta( $post_id, '_vpp_fp_img_carousel', $img_url );
        }
    }
    set_transient( 'vpp_carousel_applied_v1', true, YEAR_IN_SECONDS );
} );

/* =========================================================================
   FLEXPEN CPT — ADMIN LIST COLUMNS
   Adds Image, Showcase, Calculator, and Dosing PDF columns to the list view.
   ========================================================================= */
add_filter( 'manage_vp_flexpen_posts_columns', function( $cols ) {
    $new = array();
    foreach ( $cols as $k => $v ) {
        $new[ $k ] = $v;
        if ( $k === 'title' ) {
            $new['vpp_thumb']  = 'Image';
            $new['vpp_reel']   = 'Showcase';
            $new['vpp_calc']   = 'Calculator';
            $new['vpp_dosing'] = 'Dosing PDF';
        }
    }
    return $new;
} );

add_action( 'manage_vp_flexpen_posts_custom_column', function( $col, $post_id ) {
    $tick  = '<span style="color:#27ae60;font-size:18px;">✓</span>';
    $cross = '<span style="color:#bbb;font-size:16px;">–</span>';
    switch ( $col ) {
        case 'vpp_thumb':
            $thumb = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
            if ( $thumb ) {
                echo '<img src="' . esc_url( $thumb ) . '" style="width:48px;height:48px;object-fit:cover;border-radius:4px;">';
            } else {
                $fallback = get_post_meta( $post_id, '_vpp_fp_img_fallback', true );
                if ( $fallback ) {
                    $url = get_template_directory_uri() . '/assets/images/' . $fallback;
                    echo '<img src="' . esc_url( $url ) . '" style="width:48px;height:48px;object-fit:cover;border-radius:4px;">';
                } else {
                    echo '<span style="color:#bbb;font-size:12px;">No image</span>';
                }
            }
            break;
        case 'vpp_reel':   echo get_post_meta( $post_id, '_vpp_fp_show_in_reel',   true ) === '1' ? $tick : $cross; break;
        case 'vpp_calc':   echo get_post_meta( $post_id, '_vpp_fp_show_in_calc',   true ) === '1' ? $tick : $cross; break;
        case 'vpp_dosing': echo get_post_meta( $post_id, '_vpp_fp_show_in_dosing', true ) === '1' ? $tick : $cross; break;
    }
}, 10, 2 );

/* =========================================================================
   ADMIN USAGE TUTORIAL PAGE
   Comprehensive step-by-step instructions for every feature.
   ========================================================================= */
add_action( 'admin_menu', function() {
    add_menu_page(
        'Site Tutorial',
        'Site Tutorial',
        'edit_posts',
        'vpp-tutorial',
        'vitalpep_tutorial_page',
        'dashicons-welcome-learn-more',
        3
    );
} );

function vitalpep_tutorial_page() {
    $c   = admin_url( 'customize.php' );
    $m   = admin_url( 'nav-menus.php' );
    $fp  = admin_url( 'edit.php?post_type=vp_flexpen' );
    $faq = admin_url( 'edit.php?post_type=vp_faq' );
    $pg  = admin_url( 'edit.php?post_type=page' );
    ?>
    <style>
        .vpp-tut{max-width:960px;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif}
        .vpp-tut h1{font-size:28px;margin-bottom:4px}
        .vpp-tut .vpp-tut-lead{font-size:15px;color:#555;margin-bottom:24px}
        .vpp-tut-toc{background:#f0f6ff;border:1px solid #c3dafe;border-radius:10px;padding:24px 28px;margin-bottom:32px}
        .vpp-tut-toc h2{margin:0 0 12px;font-size:16px;color:#1e40af}
        .vpp-tut-toc ol{margin:0;padding-left:20px;columns:2;column-gap:32px}
        .vpp-tut-toc li{padding:3px 0;font-size:14px}
        .vpp-tut-toc a{text-decoration:none;color:#2563eb}
        .vpp-tut-toc a:hover{text-decoration:underline}
        .vpp-section{background:#fff;border:1px solid #e2e8f0;border-radius:10px;padding:28px 32px;margin-bottom:24px}
        .vpp-section h2{font-size:20px;margin:0 0 6px;padding-bottom:10px;border-bottom:2px solid #e2e8f0;display:flex;align-items:center;gap:10px}
        .vpp-section h3{font-size:15px;font-weight:700;color:#1e40af;margin:20px 0 8px;padding:0}
        .vpp-section p,.vpp-section li{font-size:14px;line-height:1.7;color:#374151}
        .vpp-section ol,.vpp-section ul{padding-left:22px;margin:8px 0 16px}
        .vpp-section ul{list-style:disc}
        .vpp-section ol{list-style:decimal}
        .vpp-section li{margin-bottom:6px}
        .vpp-section code{background:#f1f5f9;padding:2px 7px;border-radius:4px;font-size:13px;color:#7c3aed}
        .vpp-btn{display:inline-flex;align-items:center;gap:6px;background:#2563eb;color:#fff;text-decoration:none;padding:8px 18px;border-radius:6px;font-size:13px;font-weight:600;margin:4px 4px 4px 0}
        .vpp-btn:hover{background:#1d4ed8;color:#fff}
        .vpp-btn-secondary{background:#f1f5f9;color:#374151;border:1px solid #e2e8f0}
        .vpp-btn-secondary:hover{background:#e2e8f0;color:#374151}
        .vpp-tip{background:#fef3c7;border-left:4px solid #f59e0b;padding:12px 16px;border-radius:0 8px 8px 0;margin:16px 0;font-size:13px;color:#92400e}
        .vpp-tip strong{color:#78350f}
        .vpp-map{display:grid;grid-template-columns:1fr 1fr;gap:2px;background:#e2e8f0;border-radius:8px;overflow:hidden;margin:12px 0}
        .vpp-map div{background:#fff;padding:10px 14px;font-size:13px}
        .vpp-map div:nth-child(odd){font-weight:600;color:#1e40af}
        .vpp-checklist{margin:16px 0}
        .vpp-checklist label{display:block;padding:8px 12px;font-size:14px;cursor:pointer;border-radius:6px}
        .vpp-checklist label:hover{background:#f8fafc}
        .vpp-checklist input{margin-right:10px;accent-color:#2563eb}
        .vpp-top3{background:linear-gradient(135deg,#0f172a 0%,#1e3a5f 100%);border-radius:12px;padding:32px 36px;margin-bottom:32px;color:#fff}
        .vpp-top3 h2{color:#fff;font-size:22px;margin:0 0 6px;display:flex;align-items:center;gap:10px}
        .vpp-top3 .vpp-top3-sub{color:#94a3b8;font-size:14px;margin:0 0 24px}
        .vpp-top3-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
        .vpp-top3-card{background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:10px;padding:20px}
        .vpp-top3-card__num{font-size:11px;font-weight:700;letter-spacing:.08em;color:#60a5fa;text-transform:uppercase;margin-bottom:8px}
        .vpp-top3-card__title{font-size:15px;font-weight:700;color:#f1f5f9;margin-bottom:8px}
        .vpp-top3-card__body{font-size:13px;color:#94a3b8;line-height:1.6;margin:0}
        .vpp-top3-card__link{display:inline-block;margin-top:12px;font-size:12px;font-weight:600;color:#60a5fa;text-decoration:none}
        .vpp-top3-card__link:hover{color:#93c5fd;text-decoration:underline}
    </style>

    <div class="wrap vpp-tut">
        <h1>VitalPep Pro — Complete Usage Tutorial</h1>
        <p class="vpp-tut-lead">Step-by-step instructions for managing every part of your website. No coding required.</p>

        <!-- TOP 3 MOST IMPORTANT THINGS -->
        <div class="vpp-top3">
            <h2>⚡ Top 3 Most Important Things to Know</h2>
            <p class="vpp-top3-sub">These three workflows control the majority of what visitors see on your site.</p>
            <div class="vpp-top3-cards">
                <div class="vpp-top3-card">
                    <div class="vpp-top3-card__num">Most Important #1</div>
                    <div class="vpp-top3-card__title">FlexPen Posts Drive Everything</div>
                    <p class="vpp-top3-card__body">Every FlexPen post controls <strong style="color:#f1f5f9">seven things at once</strong>: the FlexPens catalog page, the Homepage Showcase, the Homepage Dosing PDF section, the Dosage Calculator, the contact form dropdown, the COA report links, and the page sticky nav. One post = every section updates automatically. You never edit multiple places.</p>
                    <a href="<?php echo esc_url( admin_url('post-new.php?post_type=vp_flexpen') ); ?>" class="vpp-top3-card__link">→ Add New FlexPen</a>
                </div>
                <div class="vpp-top3-card">
                    <div class="vpp-top3-card__num">Most Important #2</div>
                    <div class="vpp-top3-card__title">Three Checkboxes — Three Sections</div>
                    <p class="vpp-top3-card__body">Inside each FlexPen post there are three checkboxes: <strong style="color:#f1f5f9">Show in Showcase</strong> (homepage carousel), <strong style="color:#f1f5f9">Show in Dosing PDF section</strong> (homepage PDF cards), and <strong style="color:#f1f5f9">Show in Calculator</strong> (dosage calculator compound cards). Tick a box → appears. Untick → disappears. Drag rows in the list to reorder. No code needed anywhere.</p>
                    <a href="<?php echo esc_url( $fp ); ?>" class="vpp-top3-card__link">→ Manage FlexPens</a>
                </div>
                <div class="vpp-top3-card">
                    <div class="vpp-top3-card__num">Most Important #3</div>
                    <div class="vpp-top3-card__title">The Customizer Controls All Text & Colors</div>
                    <p class="vpp-top3-card__body">Every headline, subtitle, button label, trust badge, stat number, disclaimer, and brand color on the entire site is editable in <strong style="color:#f1f5f9">Appearance → Customize → VitalPep Pro Theme</strong>. If you can see text on the site, you can change it there without touching code. This covers 20+ sections across all pages.</p>
                    <a href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="vpp-top3-card__link">→ Open Customizer</a>
                </div>
            </div>
        </div>

        <!-- TABLE OF CONTENTS -->
        <div class="vpp-tut-toc">
            <h2>Table of Contents</h2>
            <ol>
                <li><a href="#sec-quickstart">Quick-Start Setup Checklist</a></li>
                <li><a href="#sec-logo">Changing Your Logo &amp; Site Title</a></li>
                <li><a href="#sec-colors">Customizing Brand Colors</a></li>
                <li><a href="#sec-hero">Editing the Homepage Hero</a></li>
                <li><a href="#sec-trustbar">Editing the Trust Bar</a></li>
                <li><a href="#sec-transparency">Editing Protocol / Transparency Cards</a></li>
                <li><a href="#sec-about">Editing the About Preview Section</a></li>
                <li><a href="#sec-stats">Editing Stats &amp; Numbers</a></li>
                <li><a href="#sec-products">Managing FlexPen Products</a></li>
                <li><a href="#sec-showcase">Homepage Research FlexPen Showcase</a></li>
                <li><a href="#sec-flexpens-page">Editing the FlexPens Detail Page</a></li>
                <li><a href="#sec-faq">Managing FAQ Items</a></li>
                <li><a href="#sec-calculator">The Dosage Calculator</a></li>
                <li><a href="#sec-contact">Editing the Contact / Inquiry Page</a></li>
                <li><a href="#sec-coa">Managing COA Reports</a></li>
                <li><a href="#sec-menus">Setting Up Navigation Menus</a></li>
                <li><a href="#sec-footer">Customizing the Footer</a></li>
                <li><a href="#sec-social">Adding Social Media Links</a></li>
                <li><a href="#sec-agegate">Configuring the Age Gate</a></li>
                <li><a href="#sec-pages">Managing Pages &amp; Templates</a></li>
                <li><a href="#sec-dosing">Updating Dosing Manual PDFs</a></li>
                <li><a href="#sec-images">Replacing Product Images</a></li>
                <li><a href="#sec-inquiry">Viewing Submitted Inquiries</a></li>
                <li><a href="#sec-reference">Quick Reference Map</a></li>
            </ol>
        </div>

        <!-- 1. QUICK START -->
        <div class="vpp-section" id="sec-quickstart">
            <h2>1. Quick-Start Setup Checklist</h2>
            <p>Follow these steps in order after installing the theme for the first time:</p>
            <div class="vpp-checklist">
                <label><input type="checkbox"> Upload your logo at <strong>Appearance &rarr; Customize &rarr; Site Identity</strong></label>
                <label><input type="checkbox"> Set your 6 brand colours at <strong>Customize &rarr; Brand Colors</strong></label>
                <label><input type="checkbox"> Edit the hero headline, subtitle &amp; buttons at <strong>Customize &rarr; Hero Section</strong></label>
                <label><input type="checkbox"> Go to <strong>FlexPens</strong> in the sidebar — 6 default compounds are auto-created on first admin visit</label>
                <label><input type="checkbox"> Review each FlexPen post — verify checkboxes (Showcase, Dosing PDF, Calculator) are ticked correctly</label>
                <label><input type="checkbox"> Create 3 footer menus at <strong>Appearance &rarr; Menus</strong> (Resources, Company, Legal)</label>
                <label><input type="checkbox"> Add your social media URLs at <strong>Customize &rarr; Social Media Links</strong></label>
                <label><input type="checkbox"> Review the default FAQ items at <strong>FAQ Items</strong> in the sidebar</label>
                <label><input type="checkbox"> Update contact page text at <strong>Customize &rarr; Contact / Inquiry Page</strong></label>
                <label><input type="checkbox"> Configure the age gate at <strong>Customize &rarr; Age Gate</strong></label>
                <label><input type="checkbox"> Upload your dosage manual PDFs via <strong>Media &rarr; Add New</strong></label>
            </div>
            <a href="<?php echo esc_url( $c ); ?>" class="vpp-btn">Open Customizer</a>
        </div>

        <!-- 2. LOGO -->
        <div class="vpp-section" id="sec-logo">
            <h2>2. Changing Your Logo &amp; Site Title</h2>
            <ol>
                <li>Go to <strong>Appearance &rarr; Customize</strong>.</li>
                <li>Click <strong>Site Identity</strong> in the left panel.</li>
                <li>Click <strong>Select logo</strong> and upload your logo image (recommended: PNG with transparent background, at least 200px wide).</li>
                <li>Optionally change the <strong>Site Title</strong> and <strong>Tagline</strong> fields.</li>
                <li>Click <strong>Publish</strong> at the top to save.</li>
            </ol>
            <div class="vpp-tip"><strong>Tip:</strong> The logo appears in the header navigation bar and scales automatically on mobile. Use a horizontal/landscape logo for best results.</div>
        </div>

        <!-- 3. COLORS -->
        <div class="vpp-section" id="sec-colors">
            <h2>3. Customizing Brand Colors</h2>
            <ol>
                <li>Go to <strong>Appearance &rarr; Customize &rarr; VitalPep Pro Theme &rarr; Brand Colors</strong>.</li>
                <li>You will see 6 color pickers:</li>
            </ol>
            <div class="vpp-map">
                <div>Dark Background</div><div>The main dark navy used for dark sections and page backgrounds</div>
                <div>Primary Blue</div><div>Used for links, borders, and primary UI elements</div>
                <div>Accent Blue</div><div>Bright highlight colour for buttons and interactive elements</div>
                <div>Accent Light</div><div>Lighter version used for badges and subtle highlights</div>
                <div>Gradient Start (Purple)</div><div>Starting colour for gradient text and decorative elements</div>
                <div>Gradient End (Blue)</div><div>Ending colour for gradient effects</div>
            </div>
            <ol start="3">
                <li>Click any colour swatch to open the picker. Type a hex code directly or use the visual picker.</li>
                <li>The preview on the right updates in real time.</li>
                <li>Click <strong>Publish</strong> to save your changes.</li>
            </ol>
            <div class="vpp-tip"><strong>Tip:</strong> To match your existing brand, paste your exact hex colour codes (e.g. <code>#2e86c1</code>) into each field.</div>
        </div>

        <!-- 4. HERO -->
        <div class="vpp-section" id="sec-hero">
            <h2>4. Editing the Homepage Hero</h2>
            <p>The hero is the large banner at the top of your homepage.</p>
            <ol>
                <li>Go to <strong>Appearance &rarr; Customize &rarr; VitalPep Pro Theme &rarr; Hero Section</strong>.</li>
                <li>You can edit the following fields:</li>
            </ol>
            <div class="vpp-map">
                <div>Hero Badge</div><div>Small label above the headline (e.g. "Netherlands cGMP Laboratory")</div>
                <div>Headline Line 1</div><div>First word/line of the large headline</div>
                <div>Headline Line 2</div><div>The gradient-coloured word (appears in purple-blue gradient)</div>
                <div>Headline Line 3</div><div>Third word/line of the headline</div>
                <div>Hero Subtitle</div><div>The paragraph of text below the headline</div>
                <div>Primary Button</div><div>Text on the main CTA button (e.g. "Explore Catalog")</div>
                <div>Secondary Button</div><div>Text on the outline button (e.g. "View Lab Reports")</div>
                <div>Chips 1-4</div><div>The four floating labels around the hero image</div>
            </div>
            <ol start="3">
                <li>Edit any field and see the live preview on the right.</li>
                <li>Click <strong>Publish</strong> to save.</li>
            </ol>
        </div>

        <!-- 5. TRUST BAR -->
        <div class="vpp-section" id="sec-trustbar">
            <h2>5. Editing the Trust Bar</h2>
            <p>The trust bar shows four icon+text blocks just below the hero section on the homepage.</p>
            <ol>
                <li>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; Trust Bar (Front Page)</strong>.</li>
                <li>Each of the 4 items has a <strong>Title</strong> (bold text) and <strong>Subtitle</strong> (smaller text below it).</li>
                <li>Edit any value and click <strong>Publish</strong>.</li>
            </ol>
            <div class="vpp-tip"><strong>Tip:</strong> Keep these short and impactful &mdash; they build immediate trust with visitors (e.g. "99%+ Purity", "cGMP Certified").</div>
        </div>

        <!-- 6. TRANSPARENCY -->
        <div class="vpp-section" id="sec-transparency">
            <h2>6. Editing Protocol / Transparency Cards</h2>
            <p>The "Committed to Transparency" section shows four protocol cards on the homepage.</p>
            <ol>
                <li>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; Transparency Section (Front Page)</strong>.</li>
                <li>Edit the <strong>Section Label</strong>, <strong>Title</strong>, <strong>Highlight Word</strong>, and <strong>Subtitle</strong>.</li>
                <li>For each of the 4 cards, edit the <strong>Number Label</strong> (e.g. "Protocol 01"), <strong>Title</strong>, and <strong>Description</strong>.</li>
                <li>Click <strong>Publish</strong> to save.</li>
            </ol>
        </div>

        <!-- 7. ABOUT -->
        <div class="vpp-section" id="sec-about">
            <h2>7. Editing the About Preview Section</h2>
            <p>This is the "The VitalPep Standard" section with text on the right and a facility image placeholder on the left.</p>
            <ol>
                <li>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; About Preview (Front Page)</strong>.</li>
                <li>Edit the section label, title, highlight text, description paragraphs, and the image placeholder text.</li>
                <li>Edit the three stat boxes (value + label for each).</li>
                <li>Click <strong>Publish</strong> to save.</li>
            </ol>
            <div class="vpp-tip"><strong>Tip:</strong> Use <code>\n\n</code> (two line breaks) in the description to create separate paragraphs.</div>
        </div>

        <!-- 8. STATS -->
        <div class="vpp-section" id="sec-stats">
            <h2>8. Editing Stats &amp; Numbers</h2>
            <ol>
                <li>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; Stats / Trust Bar</strong>.</li>
                <li>Edit the section heading fields (Label, Title, Subtitle).</li>
                <li>For each of the 4 stats, change the <strong>Value</strong> (the big number, e.g. "99%+") and the <strong>Label</strong> (the description below it).</li>
                <li>Click <strong>Publish</strong>.</li>
            </ol>
        </div>

        <!-- 9. FLEXPEN PRODUCTS -->
        <div class="vpp-section" id="sec-products">
            <h2>9. Managing FlexPen Products</h2>
            <p>FlexPen posts are the backbone of the site. <strong>One post controls seven things at once: the FlexPens catalog page, the Homepage Showcase, the Homepage Dosing PDF section, the Dosage Calculator, the contact form dropdown, COA report links, and the catalog sticky navigation.</strong> The admin list view shows an image thumbnail and ✓/– status for all three checkboxes so you can see everything at a glance.</p>
            <h3>Adding a New FlexPen Product</h3>
            <ol>
                <li>Go to <strong><a href="<?php echo esc_url( $fp ); ?>">FlexPens &rarr; Add New</a></strong> in the sidebar.</li>
                <li>Enter the <strong>product name</strong> as the post title (e.g. "BPC-157 FlexPen").</li>
                <li>Scroll down to the <strong>FlexPen Page Content</strong> meta box. Fill in all the fields:</li>
            </ol>
            <h3>📋 Product Basics</h3>
            <div class="vpp-map">
                <div>Research Category</div><div>Short category label (e.g. "Tissue Regeneration &amp; Anti-Aging") — shown as a subtitle on the catalog</div>
                <div>Tagline / Formula</div><div>Chemical name or formula line (e.g. "GLP-1 Receptor Agonist · MW ~4,113.6 Da")</div>
                <div>Badge 1</div><div>Primary product badge (e.g. "10mg / 3ml") — shown in the image overlay and spec strip</div>
                <div>Badge 2</div><div>Secondary badge (e.g. "99%+ Purity" or "Triple Agonist") — shown on the catalog card</div>
            </div>
            <h3>📝 Content</h3>
            <div class="vpp-map">
                <div>Description</div><div>Full product description paragraph — appears on the FlexPens catalog page section</div>
                <div>Mechanism of Action</div><div>How the compound works — shown in the "How it Works" subsection</div>
            </div>
            <h3>✅ Benefits (up to 6)</h3>
            <p style="font-size:14px;color:#374151">Six short bullet points listing research applications (e.g. "Wound healing &amp; tissue repair mechanisms"). Each appears as a tick-box item on the catalog card.</p>
            <h3>📊 Specs Row</h3>
            <div class="vpp-map">
                <div>Total Content</div><div>e.g. "100mg" — shown in the pen specs strip</div>
                <div>Purity</div><div>e.g. "99.2% HPLC" — first green badge in the Homepage Showcase</div>
                <div>Storage</div><div>e.g. "2–8 °C · do not freeze" — amber badge in the Showcase</div>
                <div>Batch</div><div>e.g. "NL-2026-A" — purple badge in the Showcase</div>
            </div>
            <h3>🔗 Links</h3>
            <div class="vpp-map">
                <div>Dosage Manual PDF</div><div>Click <strong>Upload PDF</strong> to open the media library and select or upload a file — the URL fills in automatically. Or paste a direct URL. Click <strong>✕ Remove</strong> to clear.</div>
                <div>Inquiry Product Name</div><div>URL-safe product name that pre-fills the contact form dropdown (e.g. "BPC-157+FlexPen")</div>
            </div>
            <h3>🏠 Homepage Showcase <em style="font-weight:400;color:#2563eb">(key custom feature)</em></h3>
            <div class="vpp-map">
                <div>Show in Showcase</div><div>Tick this box to include this pen in the scrolling "Research FlexPen Showcase" on the homepage. Untick to hide it. No code needed.</div>
                <div>Extra Spec Badge</div><div>5th green badge text in the showcase (e.g. "cGMP Netherlands", "Phase 3 Validated", "Pharmaceutical Grade")</div>
            </div>
            <div class="vpp-tip"><strong>Showcase order:</strong> Display order follows the drag-to-sort <strong>Order</strong> column in the FlexPens list view. Drag rows up or down to change which pen appears first in the homepage carousel.</div>
            <h3>📄 Homepage Dosing PDF Section</h3>
            <div class="vpp-map">
                <div>Show in Dosing PDF Section</div><div>Tick to include this pen's PDF card in the "Need Dosing Information?" section on the homepage. Requires a Dosage Manual PDF URL to be set above.</div>
            </div>
            <h3>🧮 Dosage Calculator</h3>
            <div class="vpp-map">
                <div>Show in Calculator</div><div>Tick to add this compound as a card in the /calculator/ page</div>
                <div>Total mg in Pen</div><div>e.g. "30" for 30mg — used to calculate concentration and dose volumes</div>
                <div>Total ml in Pen</div><div>e.g. "3" — almost always 3 for standard FlexPens</div>
                <div>Max Dose</div><div>Maximum single dose value — sets the slider ceiling (in whatever unit is selected below)</div>
                <div>Dose Unit</div><div>mg or mcg — determines how the slider and results are labelled</div>
                <div>Default Frequency</div><div>Which frequency tab is pre-selected when this compound is chosen: daily, every other day, or weekly</div>
                <div>Card Color</div><div>Accent color for the compound card: purple, blue, amber, green, teal, or rose</div>
            </div>
            <h3>🎨 Layout (for FlexPens Catalog Page)</h3>
            <div class="vpp-map">
                <div>Section Style</div><div>Auto (alternates dark/light/mid), or lock a specific style: Dark navy, Light white, or Mid deep-navy</div>
                <div>Image Side</div><div>Auto (alternates left/right), or lock to Image Left or Image Right for this product's section</div>
                <div>Image Fallback Filename</div><div>If no Featured Image is set, the catalog page looks for this filename in the theme's assets/images/ folder (e.g. "ghkcu-flexpen.jpg"). Useful for theme-bundled images.</div>
            </div>
            <ol start="4">
                <li>Set a <strong>Featured Image</strong> in the right sidebar — this is the pen photo used on both the catalog page and the Homepage Showcase.</li>
                <li>Click <strong>Publish</strong>. The product immediately appears on the FlexPens catalog, in the contact form dropdown, and wherever its checkboxes are ticked.</li>
            </ol>
            <h3>Editing Existing Products</h3>
            <ol>
                <li>Go to <strong><a href="<?php echo esc_url( $fp ); ?>">FlexPens &rarr; All FlexPens</a></strong>.</li>
                <li>Click any product title to edit it. Update any field and click <strong>Update</strong>.</li>
            </ol>
            <a href="<?php echo esc_url( admin_url('post-new.php?post_type=vp_flexpen') ); ?>" class="vpp-btn">Add New FlexPen</a>
            <a href="<?php echo esc_url( $fp ); ?>" class="vpp-btn vpp-btn-secondary">View All FlexPens</a>
        </div>

        <!-- 10. HOMEPAGE SHOWCASE -->
        <div class="vpp-section" id="sec-showcase">
            <h2>10. Homepage Research FlexPen Showcase <em style="font-size:14px;font-weight:400;color:#2563eb">(custom feature)</em></h2>
            <p>The scrolling "Research FlexPen Showcase" section on the homepage is a fully custom-built interactive carousel. Each slide shows a pen image, research category, description, 5 spec badges, and action buttons. <strong>It is entirely driven by the FlexPen posts — no code required.</strong></p>
            <h3>To add a pen to the showcase:</h3>
            <ol>
                <li>Go to <strong><a href="<?php echo esc_url( $fp ); ?>">FlexPens</a></strong> and open (or create) the FlexPen you want to show.</li>
                <li>Scroll to <strong>Homepage Showcase</strong> in the meta box.</li>
                <li>Tick <strong>"Show this FlexPen in the homepage Research FlexPen Showcase"</strong>.</li>
                <li>Fill in <strong>Extra Spec Badge</strong> (the 5th green badge — e.g. "cGMP Netherlands").</li>
                <li>Click <strong>Publish</strong> / <strong>Update</strong>. The pen appears in the showcase immediately.</li>
            </ol>
            <h3>To reorder pens in the showcase:</h3>
            <ol>
                <li>Go to <strong><a href="<?php echo esc_url( $fp ); ?>">FlexPens &rarr; All FlexPens</a></strong>.</li>
                <li>Drag the rows up or down using the Order column handle. The showcase follows this order automatically.</li>
            </ol>
            <h3>What each showcase slide pulls from the FlexPen post:</h3>
            <div class="vpp-map">
                <div>Slide number (01, 02…)</div><div>Auto-assigned based on display order — never needs editing</div>
                <div>Category label</div><div>Research Category field</div>
                <div>Product name</div><div>Post title</div>
                <div>Formula line</div><div>Tagline / Formula field</div>
                <div>Pen photo</div><div>Featured Image — if no image is set, an auto-generated label card is shown instead</div>
                <div>Description</div><div>Description field</div>
                <div>Spec badge 1 (green — purity)</div><div>Purity field</div>
                <div>Spec badge 2 (blue — dose)</div><div>Badge 1 field</div>
                <div>Spec badge 3 (amber — storage)</div><div>Storage field</div>
                <div>Spec badge 4 (purple — batch)</div><div>Batch field</div>
                <div>Spec badge 5 (green — extra)</div><div>Extra Spec Badge field (Homepage Showcase section)</div>
                <div>PDF download button</div><div>Dosage Manual PDF URL field</div>
                <div>Request Inquiry button</div><div>Inquiry Product Name field (pre-fills contact form)</div>
            </div>
            <div class="vpp-tip"><strong>Counter and dots</strong> update automatically — if you have 6 pens checked, the counter shows "01 / 06" and 6 navigation dots appear. You never have to update these manually.</div>
        </div>

        <!-- 11. FLEXPENS PAGE -->
        <div class="vpp-section" id="sec-flexpens-page">
            <h2>11. Editing the FlexPens Catalog Page <em style="font-size:14px;font-weight:400;color:#2563eb">(fully no-code)</em></h2>
            <p>The <code>/flexpens/</code> page shows a detailed full-page section for every published FlexPen post. <strong>It is 100% driven by the FlexPen CPT — no code changes required to add, remove, or reorder products.</strong></p>
            <h3>To add a new product to the catalog:</h3>
            <p>Simply create a new FlexPen post and publish it. It appears automatically on the catalog page — no code edits needed.</p>
            <h3>Page heading &amp; CTA banner text:</h3>
            <ol>
                <li>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; FlexPens Page</strong>.</li>
                <li>Edit the <strong>hero badge, title, subtitle</strong>, and <strong>CTA banner</strong> (the "Order Now" strip).</li>
                <li>Click <strong>Publish</strong>.</li>
            </ol>
            <h3>Product section content:</h3>
            <p>All fields — name, category, description, mechanism of action, benefits, specs, image, PDF link, inquiry button — come directly from the FlexPen post. Edit the post to update the catalog page.</p>
            <div class="vpp-map">
                <div>Sticky nav links</div><div>Auto-generated from all published FlexPen posts — always stays in sync</div>
                <div>Section order</div><div>Follows the drag-to-sort Order column in the FlexPens list view</div>
                <div>Dark / light / mid alternation</div><div>Automatic — first is dark, second is light, third is mid, repeating. Override per-product with the Section Style field.</div>
                <div>Image left / right alternation</div><div>Automatic — first is left, second is right, etc. Override per-product with Image Side field.</div>
                <div>Product image</div><div>Featured Image from the post, falling back to Image Fallback Filename if no Featured Image is set</div>
            </div>
        </div>

        <!-- 12. FAQ -->
        <div class="vpp-section" id="sec-faq">
            <h2>12. Managing FAQ Items</h2>
            <h3>Adding a New FAQ</h3>
            <ol>
                <li>Go to <strong><a href="<?php echo esc_url( admin_url('post-new.php?post_type=vp_faq') ); ?>">FAQ Items &rarr; Add New</a></strong>.</li>
                <li>Type the <strong>question</strong> in the Title field.</li>
                <li>Type the <strong>answer</strong> in the main Content editor (you can use bold, links, lists, etc.).</li>
                <li>In the right sidebar, assign an <strong>FAQ Section</strong> (e.g. "General", "Quality &amp; Testing", "Ordering &amp; Shipping", "Compliance &amp; Safety"). Click "+ Add New FAQ Section" to create a new category.</li>
                <li>Under <strong>Page Attributes &rarr; Order</strong>, set a number to control the display order (lower numbers appear first).</li>
                <li>Click <strong>Publish</strong>.</li>
            </ol>
            <h3>Editing or Deleting FAQs</h3>
            <ol>
                <li>Go to <strong><a href="<?php echo esc_url( $faq ); ?>">FAQ Items &rarr; All FAQ Items</a></strong>.</li>
                <li>Click a title to edit, or hover and click <strong>Trash</strong> to delete.</li>
            </ol>
            <h3>Reordering FAQs</h3>
            <p>Edit each FAQ and change the <strong>Order</strong> number under Page Attributes. FAQs with lower numbers appear first within their section.</p>
            <h3>Editing FAQ Page Headings</h3>
            <p>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; FAQ Page</strong> to edit the page hero title, subtitle, and CTA button text.</p>
            <a href="<?php echo esc_url( admin_url('post-new.php?post_type=vp_faq') ); ?>" class="vpp-btn">Add New FAQ</a>
            <a href="<?php echo esc_url( $faq ); ?>" class="vpp-btn vpp-btn-secondary">View All FAQs</a>
        </div>

        <!-- 13. CALCULATOR -->
        <div class="vpp-section" id="sec-calculator">
            <h2>13. The Dosage Calculator <em style="font-size:14px;font-weight:400;color:#2563eb">(fully no-code)</em></h2>
            <p>The <code>/calculator/</code> page is a fully custom interactive dosage tool. A visitor selects a compound, sets their target dose, chooses a frequency (daily / EOD / weekly), and the calculator instantly shows the exact dial units and volume to inject, plus how many doses remain in the pen. It handles both mg and mcg compounds automatically.</p>
            <p><strong>The compound cards are now fully driven by FlexPen posts — no code editing required.</strong> Any FlexPen post with the <strong>Show in Calculator</strong> checkbox ticked automatically appears as a card on the calculator page.</p>
            <h3>To add a compound to the calculator:</h3>
            <ol>
                <li>Go to <strong><a href="<?php echo esc_url( $fp ); ?>">FlexPens</a></strong> and open the FlexPen post you want to add.</li>
                <li>Scroll to the <strong>🧮 Dosage Calculator</strong> section in the meta box.</li>
                <li>Tick <strong>"Show this FlexPen in the Dosage Calculator"</strong>.</li>
                <li>Fill in the calculator fields:</li>
            </ol>
            <div class="vpp-map">
                <div>Total mg in Pen</div><div>e.g. 30 — total milligrams in the cartridge (used to calculate concentration)</div>
                <div>Total ml in Pen</div><div>Almost always 3 for standard FlexPens</div>
                <div>Max Dose</div><div>The slider ceiling — e.g. "2" for Semaglutide (2mg max), "1000" for Melanotan II (1000mcg max)</div>
                <div>Dose Unit</div><div>mg or mcg</div>
                <div>Default Frequency</div><div>daily, every other day, or weekly — which tab is pre-selected for this compound</div>
                <div>Card Color</div><div>purple, blue, amber, green, teal, or rose</div>
            </div>
            <ol start="5">
                <li>Click <strong>Update</strong>. The compound card appears on the calculator immediately.</li>
            </ol>
            <h3>To remove a compound from the calculator:</h3>
            <p>Open the FlexPen post, untick <strong>Show in Calculator</strong>, and click Update.</p>
            <h3>To reorder compounds:</h3>
            <p>Drag the rows in the <strong>FlexPens</strong> list view. The calculator cards follow the same order.</p>
            <h3>Editing page text (header, subtitle, CTA):</h3>
            <ol>
                <li>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; Dosage Calculator Page</strong>.</li>
                <li>Edit the <strong>Header Badge</strong>, <strong>Title Part 1 &amp; 2</strong>, <strong>Subtitle</strong>, and the <strong>CTA box</strong> text at the bottom.</li>
                <li>Click <strong>Publish</strong>.</li>
            </ol>
            <h3>What each compound card displays:</h3>
            <div class="vpp-map">
                <div>Compound name</div><div>Post title</div>
                <div>Concentration (mg/ml)</div><div>Calculated from Total mg ÷ Total ml</div>
                <div>Card color</div><div>Card Color field</div>
                <div>Slider max</div><div>Max Dose field (in whatever unit is selected)</div>
                <div>Pre-selected frequency</div><div>Default Frequency field</div>
                <div>Pre-selected unit (mg/mcg)</div><div>Dose Unit field</div>
            </div>
            <a href="<?php echo esc_url( $fp ); ?>" class="vpp-btn">Manage FlexPens</a>
        </div>

        <!-- 14. CONTACT -->
        <div class="vpp-section" id="sec-contact">
            <h2>14. Editing the Contact / Inquiry Page</h2>
            <ol>
                <li>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; Contact / Inquiry Page</strong>.</li>
                <li>You can edit all of the following:</li>
            </ol>
            <div class="vpp-map">
                <div>Hero Badge Label</div><div>"Research Inquiries" text above the title</div>
                <div>Hero Title</div><div>Main page heading</div>
                <div>Hero Subtitle</div><div>Description paragraph below the heading</div>
                <div>Sidebar Title</div><div>"How to Reach Us" heading</div>
                <div>Sidebar Description</div><div>The paragraph explaining the inquiry model</div>
                <div>Methods 1-3</div><div>Title and description for each contact method card</div>
                <div>Important Notice</div><div>The notice box about research-only use</div>
                <div>Form Card Title &amp; Subtitle</div><div>Headings inside the form card</div>
                <div>Submit Button Text</div><div>Text on the submit button</div>
                <div>Form Disclaimer</div><div>Small print below the form</div>
                <div>Success Title &amp; Message</div><div>What users see after submitting</div>
            </div>
            <ol start="3">
                <li>Click <strong>Publish</strong> to save.</li>
            </ol>
            <div class="vpp-tip"><strong>Product dropdown:</strong> The "Select a FlexPen" dropdown in the inquiry form is automatically populated from all published FlexPen posts. When you add a new FlexPen post and publish it, it immediately appears in the form dropdown — no extra steps needed.</div>
        </div>

        <!-- 15. COA -->
        <div class="vpp-section" id="sec-coa">
            <h2>15. Managing COA Reports <em style="font-size:14px;font-weight:400;color:#2563eb">(custom feature)</em></h2>
            <p>COA (Certificate of Analysis) reports are managed through a dedicated custom post type. Each entry links a batch report to a compound.</p>
            <h3>Adding a COA report:</h3>
            <ol>
                <li>Go to <strong>COA Reports &rarr; Add New</strong> in the sidebar.</li>
                <li>Enter the compound name as the title.</li>
                <li>Fill in the meta fields: <strong>Batch Number</strong>, <strong>Test Date</strong>, <strong>Strength / Concentration</strong>.</li>
                <li>For the report file, either: upload a PDF via <strong>Media &rarr; Add New</strong> and paste the URL into <strong>PDF/File URL</strong>, or paste a direct external link into <strong>External Link</strong>.</li>
                <li>Click <strong>Publish</strong>. The report appears on the <code>/coa-reports/</code> page automatically.</li>
            </ol>
            <h3>Editing COA page text:</h3>
            <p>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; COA Reports Page</strong> to edit the hero badge, title, subtitle, and trust items shown above the report list.</p>
        </div>

        <!-- 16. MENUS -->
        <div class="vpp-section" id="sec-menus">
            <h2>16. Setting Up Navigation Menus</h2>
            <p>Your site has <strong>4 menu locations</strong> you can customize:</p>
            <h3>Creating a Menu</h3>
            <ol>
                <li>Go to <strong><a href="<?php echo esc_url( $m ); ?>">Appearance &rarr; Menus</a></strong>.</li>
                <li>Click <strong>"create a new menu"</strong> and give it a name (e.g. "Header Menu").</li>
                <li>On the left, check the pages you want to add, then click <strong>Add to Menu</strong>.</li>
                <li>Drag and drop items to reorder them.</li>
                <li>Under <strong>Menu Settings</strong> at the bottom, check the <strong>Display location</strong> box for where this menu should appear.</li>
                <li>Click <strong>Save Menu</strong>.</li>
            </ol>
            <h3>Menu Locations</h3>
            <div class="vpp-map">
                <div>Primary Navigation</div><div>The main header menu across the top of every page</div>
                <div>Footer &mdash; Resources</div><div>Left column in the footer (e.g. FlexPen Catalog, COA Reports, FAQ)</div>
                <div>Footer &mdash; Company</div><div>Middle column in the footer (e.g. About Us, Contact)</div>
                <div>Footer &mdash; Legal</div><div>Right column in the footer (e.g. Privacy Policy, Terms)</div>
            </div>
            <ol start="7">
                <li>To assign menus to locations, click the <strong>Manage Locations</strong> tab and use the dropdowns.</li>
            </ol>
            <div class="vpp-tip"><strong>Tip:</strong> If you don&rsquo;t assign a footer menu, sensible default links will show automatically.</div>
            <a href="<?php echo esc_url( $m ); ?>" class="vpp-btn">Manage Menus</a>
        </div>

        <!-- 17. FOOTER -->
        <div class="vpp-section" id="sec-footer">
            <h2>17. Customizing the Footer</h2>
            <ol>
                <li><strong>Brand Text:</strong> Go to <strong>Customize &rarr; General &amp; Branding</strong> and edit the <em>Footer Brand Text</em> field.</li>
                <li><strong>Copyright:</strong> Same section, edit the <em>Footer Copyright Text</em> field.</li>
                <li><strong>Compliance Badges:</strong> Same section &mdash; edit the three disclaimer texts (Research, Handling, COA).</li>
                <li><strong>Bottom Badges:</strong> Go to <strong>Customize &rarr; Footer Badges</strong> to edit the three small badges (e.g. "SSL Encrypted", "cGMP Certified", "EU Manufactured").</li>
                <li><strong>Footer Links:</strong> See step 15 above for setting up footer menus.</li>
            </ol>
        </div>

        <!-- 18. SOCIAL -->
        <div class="vpp-section" id="sec-social">
            <h2>18. Adding Social Media Links</h2>
            <ol>
                <li>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; Social Media Links</strong>.</li>
                <li>Paste the full URL for each platform you want to show:</li>
            </ol>
            <ul>
                <li><strong>Instagram</strong> &mdash; e.g. <code>https://instagram.com/yourprofile</code></li>
                <li><strong>X / Twitter</strong> &mdash; e.g. <code>https://x.com/yourprofile</code></li>
                <li><strong>LinkedIn</strong> &mdash; e.g. <code>https://linkedin.com/company/yourcompany</code></li>
                <li><strong>Facebook</strong> &mdash; e.g. <code>https://facebook.com/yourpage</code></li>
                <li><strong>Telegram</strong> &mdash; e.g. <code>https://t.me/yourchannel</code></li>
                <li><strong>Email</strong> &mdash; just the email address (e.g. <code>info@yoursite.com</code>)</li>
            </ul>
            <ol start="3">
                <li>Leave any field <strong>blank</strong> to hide that icon.</li>
                <li>Icons appear automatically in the footer when a URL is provided.</li>
                <li>Click <strong>Publish</strong>.</li>
            </ol>
        </div>

        <!-- 19. AGE GATE -->
        <div class="vpp-section" id="sec-agegate">
            <h2>19. Configuring the Age Gate <em style="font-size:14px;font-weight:400;color:#2563eb">(custom feature)</em></h2>
            <p>The age verification popup appears the first time a visitor enters the site.</p>
            <ol>
                <li>Go to <strong>Customize &rarr; VitalPep Pro Theme &rarr; Age Gate</strong>.</li>
                <li>Edit the badge text, title parts, subtitle, button text, date-of-birth label, and disclaimer.</li>
                <li>Click <strong>Publish</strong>.</li>
            </ol>
            <div class="vpp-tip"><strong>How it works:</strong> Visitors must enter their date of birth. If they are 21+, they are allowed in and the gate doesn&rsquo;t show again during that browser session. Under 21 sees an error message.</div>
        </div>

        <!-- 20. PAGES -->
        <div class="vpp-section" id="sec-pages">
            <h2>20. Managing Pages &amp; Templates</h2>
            <p>Your site includes these pages, each with a specialized template:</p>
            <div class="vpp-map">
                <div>Home (Front Page)</div><div>Set as the static front page &mdash; uses the front-page template automatically</div>
                <div>/flexpens/</div><div>Template: <code>FlexPens</code> &mdash; the detailed product catalog</div>
                <div>/calculator/</div><div>Template: <code>Dosage Calculator</code> &mdash; interactive pen calculator</div>
                <div>/coa-reports/</div><div>Template: <code>COA Reports</code> &mdash; certificates of analysis</div>
                <div>/faq/</div><div>Template: <code>FAQ Page</code> &mdash; pulls from FAQ Items CPT</div>
                <div>/contact/</div><div>Template: <code>Contact / Inquiry Page</code> &mdash; inquiry form</div>
            </div>
            <h3>Creating a New Page</h3>
            <ol>
                <li>Go to <strong><a href="<?php echo esc_url( admin_url('post-new.php?post_type=page') ); ?>">Pages &rarr; Add New</a></strong>.</li>
                <li>Enter a title and content.</li>
                <li>In the right sidebar under <strong>Page Attributes</strong>, select a <strong>Template</strong> if you want to use one of the built-in layouts.</li>
                <li>Click <strong>Publish</strong>.</li>
            </ol>
            <div class="vpp-tip"><strong>Tip:</strong> After creating a new page, add it to your navigation menu (step 15) so visitors can find it.</div>
        </div>

        <!-- 21. DOSING PDFs -->
        <div class="vpp-section" id="sec-dosing">
            <h2>21. Updating Dosing Manual PDFs &amp; the Homepage Dosing Section</h2>
            <p>Each FlexPen has a downloadable dosage manual PDF. These appear in the Homepage Showcase, the FlexPens catalog page, and the "Need Dosing Information?" section on the homepage. <strong>All three locations are driven by the FlexPen post — no code required.</strong></p>
            <h3>To show a PDF card in the Homepage Dosing section:</h3>
            <ol>
                <li>Open the FlexPen post.</li>
                <li>Scroll to <strong>📄 Homepage Dosing PDF Section</strong> in the meta box and tick <strong>"Show in Homepage Dosing PDF Section"</strong>.</li>
                <li>Make sure the <strong>Dosage Manual PDF URL</strong> is filled in (see below). Posts without a PDF URL are skipped.</li>
                <li>Click <strong>Update</strong>. The card appears in the dosing section immediately.</li>
            </ol>
            <h3>Uploading and linking a PDF (easiest way):</h3>
            <ol>
                <li>Open the FlexPen post.</li>
                <li>Scroll to <strong>🔗 Links &rarr; Dosage Manual PDF</strong>.</li>
                <li>Click the <strong>Upload PDF</strong> button — the WordPress media library opens showing only PDFs.</li>
                <li>Either select an already-uploaded PDF, or drag-and-drop a new one to upload it.</li>
                <li>Click <strong>Use this file</strong>. The URL fills in automatically and a preview link appears below the field.</li>
                <li>Click <strong>Update</strong>. The PDF button updates everywhere it appears — Showcase, catalog page, and dosing section.</li>
            </ol>
            <div class="vpp-tip"><strong>Already have a URL?</strong> You can also paste a direct URL straight into the field — no need to use the upload button. The filename preview updates as you type.</div>
            <div class="vpp-tip"><strong>Pre-built PDFs:</strong> Your site includes professionally designed dosage manual PDFs for all six current compounds (GHK-Cu, Retatrutide, Melanotan II, NAD+, Semaglutide, Tirzepatide). They are stored at <code>wp-content/themes/vitalpep-pro/assets/pdfs/</code>. The theme PDFs include exact dosing tables, pen operating instructions, storage requirements, mechanism of action, and research references — matching the same visual branding as the rest of the site.</div>
        </div>

        <!-- 22. IMAGES -->
        <div class="vpp-section" id="sec-images">
            <h2>22. Replacing Product Images</h2>
            <h3>For FlexPen posts (recommended)</h3>
            <ol>
                <li>Open the FlexPen post you want to update.</li>
                <li>In the right sidebar, click <strong>Set Featured Image</strong>.</li>
                <li>Upload or select your product photo and click <strong>Set featured image</strong>.</li>
                <li>Click <strong>Update</strong>. The new image appears in the FlexPens catalog and Homepage Showcase.</li>
            </ol>
            <div class="vpp-tip"><strong>No image set?</strong> If a FlexPen post has no Featured Image, the Homepage Showcase automatically falls back to a styled label card showing the pen name, dose, storage, and expiry — so the Showcase always looks complete even without a photo.</div>
            <h3>Image Fallback for the Catalog Page</h3>
            <p>If a FlexPen post has no Featured Image, you can point the catalog page to a theme-bundled image instead of leaving it blank.</p>
            <ol>
                <li>Open the FlexPen post.</li>
                <li>Scroll to <strong>📋 Product Basics</strong> in the meta box.</li>
                <li>Find <strong>Image Fallback Filename</strong> and enter the filename of the image in the theme's assets/images/ folder (e.g. <code>ghkcu-flexpen.jpg</code>).</li>
                <li>Click <strong>Update</strong>. The catalog page now uses that image if no Featured Image is set.</li>
            </ol>
            <h3>For the hero pen image and other theme images:</h3>
            <ol>
                <li>The hero rotating pen, hero background, and other decorative images are stored in the theme at <code>wp-content/themes/vitalpep-pro/assets/images/</code>.</li>
                <li>Upload replacements via FTP or File Manager, using the exact same filenames.</li>
            </ol>
        </div>

        <!-- 23. INQUIRIES -->
        <div class="vpp-section" id="sec-inquiry">
            <h2>23. Viewing Submitted Inquiries <em style="font-size:14px;font-weight:400;color:#2563eb">(custom feature)</em></h2>
            <p>The inquiry form on the Contact page is a fully custom-built system. When a visitor submits it, two things happen automatically:</p>
            <ol>
                <li>A notification email is sent to the site admin address (set at <strong>Settings &rarr; General &rarr; Administration Email Address</strong>).</li>
                <li>The submission is saved as a private post in the <strong>Inquiries</strong> section of the admin — so you have a searchable log of every inquiry even if an email is missed.</li>
            </ol>
            <h3>Viewing saved inquiries:</h3>
            <ol>
                <li>Go to <strong>Inquiries</strong> in the sidebar (or <strong>Posts &rarr; Inquiries</strong>).</li>
                <li>Click any entry to view the full submission: name, email, organization, product of interest, quantity, and message.</li>
            </ol>
            <h3>The form captures:</h3>
            <div class="vpp-map">
                <div>Full Name</div><div>Required</div>
                <div>Email Address</div><div>Required</div>
                <div>Organization / Institution</div><div>Optional</div>
                <div>Product of Interest</div><div>Dropdown — populated from all published FlexPen posts automatically</div>
                <div>Quantity / Volume</div><div>Optional</div>
                <div>Research Purpose / Message</div><div>Text area</div>
            </div>
        </div>

        <!-- 24. QUICK REFERENCE -->
        <div class="vpp-section" id="sec-reference">
            <h2>24. Quick Reference Map</h2>
            <p>Every editable area on the site and exactly where to find it:</p>
            <h3>Custom Post Types (sidebar menu)</h3>
            <div class="vpp-map">
                <div>FlexPen Products</div><div>Sidebar → FlexPens — controls catalog page, homepage showcase, dosing PDF section, dosage calculator, contact dropdown, and sticky nav. Admin list shows image + ✓/– status for all 3 checkboxes.</div>
                <div>Homepage Showcase</div><div>Edit any FlexPen → tick "Show in Showcase" + set Extra Spec Badge. Drag rows to reorder.</div>
                <div>Homepage Dosing PDF Section</div><div>Edit any FlexPen → tick "Show in Homepage Dosing PDF Section". PDF URL must be set.</div>
                <div>Dosage Calculator</div><div>Edit any FlexPen → tick "Show in Calculator" + fill in calculator fields (mg, ml, max dose, unit, frequency, color).</div>
                <div>FAQ Items</div><div>Sidebar → FAQ Items — add questions/answers, assign to sections, set display order</div>
                <div>COA Reports</div><div>Sidebar → COA Reports — add batch reports with PDF links</div>
                <div>Inquiries (submitted forms)</div><div>Sidebar → Inquiries — view every contact form submission</div>
            </div>
            <h3>Customizer (Appearance → Customize → VitalPep Pro Theme)</h3>
            <div class="vpp-map">
                <div>Logo &amp; Site Title</div><div>Customize → Site Identity</div>
                <div>Brand Colours (6 pickers)</div><div>Customize → Brand Colors</div>
                <div>Hero Section (headline, buttons, chips)</div><div>Customize → Hero Section</div>
                <div>Trust Bar (4 items)</div><div>Customize → Trust Bar (Front Page)</div>
                <div>Transparency / Protocol Cards (4)</div><div>Customize → Transparency Section</div>
                <div>About Preview (text + 3 stat boxes)</div><div>Customize → About Preview</div>
                <div>Stats / Numbers (4 items)</div><div>Customize → Stats / Trust Bar</div>
                <div>Product Reel heading &amp; subtitle</div><div>Customize → Product Reel</div>
                <div>Dosing Info Section heading &amp; subtitle</div><div>Customize → Dosing Info Section (cards themselves are driven by FlexPen posts — see above)</div>
                <div>Homepage FAQ (5 items)</div><div>Customize → FAQ</div>
                <div>Homepage Inquiry CTA text</div><div>Customize → Inquiry Section</div>
                <div>FlexPens Catalog Page (hero + CTA)</div><div>Customize → FlexPens Page</div>
                <div>FAQ Page (hero / CTA text)</div><div>Customize → FAQ Page</div>
                <div>Dosage Calculator Page (header/CTA)</div><div>Customize → Dosage Calculator Page</div>
                <div>Contact Page (all text + form labels)</div><div>Customize → Contact / Inquiry Page</div>
                <div>COA Reports Page (hero text)</div><div>Customize → COA Reports Page</div>
                <div>Age Gate popup (all text)</div><div>Customize → Age Gate</div>
                <div>Social Media Links (6 platforms)</div><div>Customize → Social Media Links</div>
                <div>Footer Brand Text &amp; Copyright</div><div>Customize → General &amp; Branding</div>
                <div>Footer Badges (3 compliance labels)</div><div>Customize → Footer Badges</div>
            </div>
            <h3>Appearance menu</h3>
            <div class="vpp-map">
                <div>Header Navigation Menu</div><div>Appearance → Menus → Primary Navigation</div>
                <div>Footer — Resources column</div><div>Appearance → Menus → Footer Resources</div>
                <div>Footer — Company column</div><div>Appearance → Menus → Footer Company</div>
                <div>Footer — Legal column</div><div>Appearance → Menus → Footer Legal</div>
            </div>
            <h3>Custom features summary</h3>
            <div class="vpp-map">
                <div>Homepage Showcase carousel</div><div>No-code — controlled by "Show in Showcase" checkbox on FlexPen post. Drag rows to reorder.</div>
                <div>Homepage Dosing PDF section</div><div>No-code — controlled by "Show in Dosing PDF Section" checkbox on FlexPen post. PDF URL must be set.</div>
                <div>Dosage Calculator</div><div>No-code — controlled by "Show in Calculator" checkbox + calculator fields on FlexPen post. 6 compounds pre-configured.</div>
                <div>FlexPens catalog page</div><div>No-code — shows every published FlexPen post automatically. Fully dynamic: nav, sections, order, images.</div>
                <div>FlexPen admin list columns</div><div>Image thumbnail + ✓/– status for Showcase, Calculator, and Dosing columns — see all settings at a glance</div>
                <div>Auto-seeded default posts</div><div>On first admin visit, 6 FlexPen posts (GHK-Cu, Retatrutide, Melanotan II, NAD+, Semaglutide, Tirzepatide) are created with all content pre-filled</div>
                <div>Age verification gate</div><div>Custom DOB popup — session-based, 21+ requirement, all text editable via Customizer</div>
                <div>Inquiry form + log</div><div>Custom form — emails admin AND saves submission to Inquiries CPT for a permanent log</div>
                <div>COA system</div><div>Custom post type — each batch report is a post with compound, batch, date, and PDF link</div>
                <div>Dosage manual PDFs</div><div>6 branded PDFs included — dosing tables, pen instructions, storage, MOA, references per compound</div>
                <div>FlexPen CPT meta box</div><div>20+ fields per product — category, formula, specs, benefits, PDF, inquiry name, layout, image side, image fallback, 3 section checkboxes, 6 calculator fields</div>
            </div>
        </div>

        <!-- FOOTER -->
        <div style="text-align:center;padding:32px 0 16px;color:#94a3b8;font-size:13px;">
            VitalPep Pro Theme &mdash; Built for easy customization without code.
        </div>
    </div>
    <?php
}
