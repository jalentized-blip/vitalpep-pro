<?php
/**
 * Template Name: COA Reports
 *
 * Displays the full Certificate of Analysis directory with
 * filter pills, COA card grid and (admin-only) slide-in panel.
 *
 * @package VitalPep_Pro
 */

get_header();

/* ── Product colour map ─────────────────────────────────── */
$product_colors = [
    'ghkcu'      => '#a78bfa',
    'retatrutide'=> '#f59e0b',
    'melanotan'  => '#10b981',
    'nadplus'    => '#3b82f6',
];

/* ── File-type badge colours ────────────────────────────── */
$type_colors = [
    'pdf'   => '#2e86c1',
    'image' => '#10b981',
    'link'  => '#a78bfa',
];

/* ── Helper: slugify product name ───────────────────────── */
function vpp_coa_product_slug( $name ) {
    $map = [
        'GHK-Cu FlexPen'       => 'ghkcu',
        'Retatrutide FlexPen'  => 'retatrutide',
        'Melanotan II FlexPen' => 'melanotan',
        'NAD+ FlexPen'         => 'nadplus',
    ];
    return $map[ $name ] ?? sanitize_title( $name );
}

/* ── Query vp_coa CPT ───────────────────────────────────── */
$coa_query = new WP_Query( [
    'post_type'      => 'vp_coa',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
] );

$is_admin = current_user_can( 'administrator' );
?>

<!-- ============================================
     COA HERO
     ============================================ -->
<section class="coa-hero">
    <div class="container">
        <div class="coa-hero__label">
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <?php echo vpp_text( 'vpp_coa_hero_badge', 'Lab Documentation' ); ?>
        </div>
        <h1 class="coa-hero__title"><?php echo vpp_text( 'vpp_coa_hero_title', 'Certificates of' ); ?> <span class="coa-hero__title-gradient"><?php echo vpp_text( 'vpp_coa_hero_title_highlight', 'Analysis' ); ?></span></h1>
        <p class="coa-hero__sub"><?php echo vpp_textarea( 'vpp_coa_hero_subtitle', 'Independent third-party verification for every batch. All COAs are HPLC tested, mass spectrometry confirmed, and issued by accredited EU laboratories.' ); ?></p>
        <div class="coa-hero__trust">
            <div class="coa-hero__trust-item">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <?php echo vpp_text( 'vpp_coa_trust_1', 'HPLC Tested' ); ?>
            </div>
            <div class="coa-hero__trust-item">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                <?php echo vpp_text( 'vpp_coa_trust_2', 'Mass Spec Confirmed' ); ?>
            </div>
            <div class="coa-hero__trust-item">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <?php echo vpp_text( 'vpp_coa_trust_3', 'Third-Party Verified' ); ?>
            </div>
            <div class="coa-hero__trust-item">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                <?php echo vpp_text( 'vpp_coa_trust_4', 'Batch Traceable' ); ?>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     FILTER BAR + GRID
     ============================================ -->
<section class="coa-section">
    <div class="container">

        <div class="coa-filter-bar" id="coaFilterBar">
            <button class="coa-filter-pill coa-filter-pill--active" data-filter="all"><?php esc_html_e( 'All Batches', 'vitalpep-pro' ); ?></button>
            <button class="coa-filter-pill" data-filter="ghkcu">GHK-Cu</button>
            <button class="coa-filter-pill" data-filter="retatrutide">Retatrutide</button>
            <button class="coa-filter-pill" data-filter="melanotan">Melanotan II</button>
            <button class="coa-filter-pill" data-filter="nadplus">NAD+</button>
        </div>

        <?php if ( $coa_query->have_posts() ) : ?>

        <div class="coa-grid" id="coaGrid">

            <?php while ( $coa_query->have_posts() ) : $coa_query->the_post();
                $post_id   = get_the_ID();
                $product   = get_the_title();
                $strength  = get_post_meta( $post_id, '_vp_coa_strength',  true );
                $batch     = get_post_meta( $post_id, '_vp_coa_batch',     true );
                $coa_date  = get_post_meta( $post_id, '_vp_coa_date',      true );
                $file_url  = get_post_meta( $post_id, '_vp_coa_file_url',  true );
                $ext_link  = get_post_meta( $post_id, '_vp_coa_link',      true );
                $file_type = get_post_meta( $post_id, '_vp_coa_file_type', true ) ?: 'pdf';
                $slug      = vpp_coa_product_slug( $product );
                $url       = $file_url ?: $ext_link ?: '#';

                $type_color = $type_colors[ $file_type ] ?? '#2e86c1';
                $dot_color  = $product_colors[ $slug ] ?? '#8a95a3';

                $date_formatted = $coa_date ? date_i18n( get_option('date_format'), strtotime( $coa_date ) ) : '';
                $type_label     = strtoupper( $file_type );
                $btn_label      = $file_type === 'link' ? __('View Report','vitalpep-pro') : __('Download COA','vitalpep-pro');
            ?>

            <div class="coa-card" data-slug="<?php echo esc_attr( $slug ); ?>">
                <div class="coa-card__header">
                    <span class="coa-card__type-badge"
                          style="background:<?php echo esc_attr($type_color); ?>22; color:<?php echo esc_attr($type_color); ?>; border-color:<?php echo esc_attr($type_color); ?>44;">
                        <?php echo esc_html( $type_label ); ?>
                    </span>
                    <span class="coa-card__dot" style="background:<?php echo esc_attr($dot_color); ?>;"></span>
                </div>
                <div class="coa-card__body">
                    <div class="coa-card__product"><?php echo esc_html( $product ); ?></div>
                    <?php if ( $strength ) : ?>
                    <span class="coa-card__strength"><?php echo esc_html( $strength ); ?></span>
                    <?php endif; ?>
                    <?php if ( $batch ) : ?>
                    <div class="coa-card__meta-row">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <?php esc_html_e( 'Batch:', 'vitalpep-pro' ); ?>
                        <span class="coa-card__batch-val"><?php echo esc_html( $batch ); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ( $date_formatted ) : ?>
                    <div class="coa-card__meta-row">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <?php echo esc_html( $date_formatted ); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="coa-card__footer">
                    <a href="<?php echo esc_url( $url ); ?>"
                       class="coa-card__btn"
                       <?php echo $url !== '#' ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                        <?php if ( $file_type === 'link' ) : ?>
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <?php else : ?>
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <?php endif; ?>
                        <?php echo esc_html( $btn_label ); ?>
                    </a>
                </div>
            </div>

            <?php endwhile; wp_reset_postdata(); ?>

        </div><!-- /.coa-grid -->

        <?php else : ?>

        <div class="coa-empty-state" id="coaEmpty">
            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="opacity:0.3; margin-bottom:16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <p><?php esc_html_e( 'No certificates uploaded yet.', 'vitalpep-pro' ); ?></p>
        </div>

        <?php endif; ?>

    </div>
</section>

<?php if ( $is_admin ) : ?>

<!-- ============================================
     ADMIN FAB + PANEL (administrators only)
     ============================================ -->
<div class="coa-admin-overlay" id="coaAdminOverlay"></div>

<button class="coa-admin-fab visible" id="coaAdminFab" aria-label="<?php esc_attr_e( 'Admin: Add COA', 'vitalpep-pro' ); ?>">
    <span class="coa-admin-fab__icon">+</span>
    <span class="coa-admin-fab__label"><?php esc_html_e( 'Admin', 'vitalpep-pro' ); ?></span>
</button>

<aside class="coa-admin-panel" id="coaAdminPanel" role="dialog" aria-modal="true"
       aria-label="<?php esc_attr_e( 'Add COA Entry', 'vitalpep-pro' ); ?>">
    <div class="coa-admin-header">
        <h2 class="coa-admin-header__title">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <?php esc_html_e( 'Add COA Entry', 'vitalpep-pro' ); ?>
        </h2>
        <button class="coa-admin-header__close" id="coaAdminClose" aria-label="<?php esc_attr_e( 'Close panel', 'vitalpep-pro' ); ?>">&times;</button>
    </div>

    <form class="coa-admin-form" id="coaAdminForm"
          method="POST"
          action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>"
          enctype="multipart/form-data">

        <?php wp_nonce_field( 'vpp_add_coa_nonce', 'vpp_coa_nonce' ); ?>
        <input type="hidden" name="action" value="vpp_add_coa">

        <div class="coa-admin-form__group">
            <label class="coa-admin-form__label" for="coaProductSelect">
                <?php esc_html_e( 'Product Name', 'vitalpep-pro' ); ?>
                <span class="coa-admin-form__req">*</span>
            </label>
            <select class="coa-admin-form__input" id="coaProductSelect" name="product_name">
                <option value=""><?php esc_html_e( 'Select a product…', 'vitalpep-pro' ); ?></option>
                <option value="GHK-Cu FlexPen"       data-slug="ghkcu">GHK-Cu FlexPen</option>
                <option value="Retatrutide FlexPen"  data-slug="retatrutide">Retatrutide FlexPen</option>
                <option value="Melanotan II FlexPen" data-slug="melanotan">Melanotan II FlexPen</option>
                <option value="NAD+ FlexPen"         data-slug="nadplus">NAD+ FlexPen</option>
                <option value="custom"><?php esc_html_e( 'Custom…', 'vitalpep-pro' ); ?></option>
            </select>
            <div class="coa-admin-form__custom-wrap" id="coaCustomWrap" style="display:none;">
                <input type="text" class="coa-admin-form__input" id="coaCustomProduct" name="custom_product"
                       placeholder="<?php esc_attr_e( 'Enter product name', 'vitalpep-pro' ); ?>">
            </div>
        </div>

        <div class="coa-admin-form__group">
            <label class="coa-admin-form__label" for="coaStrength">
                <?php esc_html_e( 'Strength', 'vitalpep-pro' ); ?>
                <span class="coa-admin-form__req">*</span>
            </label>
            <input type="text" class="coa-admin-form__input" id="coaStrength" name="strength"
                   placeholder="<?php esc_attr_e( 'e.g. 100mg / 3ml', 'vitalpep-pro' ); ?>" required>
        </div>

        <div class="coa-admin-form__group">
            <label class="coa-admin-form__label" for="coaBatch">
                <?php esc_html_e( 'Batch Number', 'vitalpep-pro' ); ?>
                <span class="coa-admin-form__optional">(<?php esc_html_e( 'optional', 'vitalpep-pro' ); ?>)</span>
            </label>
            <input type="text" class="coa-admin-form__input" id="coaBatch" name="batch"
                   placeholder="<?php esc_attr_e( 'e.g. NL-GHK-2026-01', 'vitalpep-pro' ); ?>">
        </div>

        <div class="coa-admin-form__group">
            <label class="coa-admin-form__label" for="coaDate">
                <?php esc_html_e( 'COA Date', 'vitalpep-pro' ); ?>
                <span class="coa-admin-form__optional">(<?php esc_html_e( 'optional', 'vitalpep-pro' ); ?>)</span>
            </label>
            <input type="date" class="coa-admin-form__input" id="coaDate" name="coa_date">
        </div>

        <div class="coa-admin-form__group">
            <label class="coa-admin-form__label"><?php esc_html_e( 'Source', 'vitalpep-pro' ); ?></label>
            <input type="hidden" name="source_type" id="coaSourceType" value="file">
            <div class="coa-source-toggle" id="coaSourceToggle">
                <button type="button" class="coa-source-toggle__btn coa-source-toggle__btn--active" data-source="file">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <?php esc_html_e( 'Upload File', 'vitalpep-pro' ); ?>
                </button>
                <button type="button" class="coa-source-toggle__btn" data-source="link">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    <?php esc_html_e( 'Add Link', 'vitalpep-pro' ); ?>
                </button>
            </div>
            <div id="coaFileWrap">
                <input type="file" class="coa-admin-form__file" id="coaFile" name="coa_file" accept=".pdf,image/*">
                <label class="coa-admin-form__file-label" for="coaFile">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span id="coaFileName"><?php esc_html_e( 'Choose PDF or image…', 'vitalpep-pro' ); ?></span>
                </label>
            </div>
            <div id="coaLinkWrap" style="display:none;">
                <input type="url" class="coa-admin-form__input" id="coaLink" name="coa_link"
                       placeholder="https://lab-reports.example.com/coa-file.pdf">
            </div>
        </div>

        <div class="coa-admin-form__error" id="coaFormError" style="display:none;"></div>

        <button type="submit" class="coa-admin-form__submit">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <?php esc_html_e( 'Add COA to Directory', 'vitalpep-pro' ); ?>
        </button>
    </form>
</aside>

<div class="coa-toast" id="coaToast" role="status" aria-live="polite">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span id="coaToastMsg"><?php esc_html_e( 'COA added successfully.', 'vitalpep-pro' ); ?></span>
</div>

<?php endif; // is_admin ?>

<script>
(function () {
    'use strict';

    /* ── Filter pills ─────────────────────────────────────── */
    var filterBar = document.getElementById('coaFilterBar');
    var grid      = document.getElementById('coaGrid');

    if (filterBar && grid) {
        filterBar.addEventListener('click', function (e) {
            var pill = e.target.closest('.coa-filter-pill');
            if (!pill) return;
            filterBar.querySelectorAll('.coa-filter-pill').forEach(function (p) {
                p.classList.remove('coa-filter-pill--active');
            });
            pill.classList.add('coa-filter-pill--active');
            var filter = pill.getAttribute('data-filter') || 'all';
            var cards  = grid.querySelectorAll('.coa-card');
            var visible = 0;
            cards.forEach(function (card) {
                var match = filter === 'all' || card.getAttribute('data-slug') === filter;
                card.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            var empty = document.getElementById('coaEmpty');
            if (empty) empty.style.display = visible === 0 ? 'flex' : 'none';
        });
    }

    <?php if ( $is_admin ) : ?>

    /* ── Admin panel controls ─────────────────────────────── */
    var fab      = document.getElementById('coaAdminFab');
    var panel    = document.getElementById('coaAdminPanel');
    var overlay  = document.getElementById('coaAdminOverlay');
    var closeBtn = document.getElementById('coaAdminClose');

    function openPanel()  { panel.classList.add('open');    overlay.classList.add('visible');    document.body.style.overflow = 'hidden'; }
    function closePanel() { panel.classList.remove('open'); overlay.classList.remove('visible'); document.body.style.overflow = ''; }

    if (fab)     fab.addEventListener('click', openPanel);
    if (closeBtn) closeBtn.addEventListener('click', closePanel);
    if (overlay) overlay.addEventListener('click', closePanel);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closePanel(); });

    /* Source toggle */
    var sourceToggle  = document.getElementById('coaSourceToggle');
    var fileWrap      = document.getElementById('coaFileWrap');
    var linkWrap      = document.getElementById('coaLinkWrap');
    var sourceTypeInput = document.getElementById('coaSourceType');

    if (sourceToggle) {
        sourceToggle.addEventListener('click', function (e) {
            var btn = e.target.closest('.coa-source-toggle__btn');
            if (!btn) return;
            sourceToggle.querySelectorAll('.coa-source-toggle__btn').forEach(function (b) {
                b.classList.remove('coa-source-toggle__btn--active');
            });
            btn.classList.add('coa-source-toggle__btn--active');
            var src = btn.getAttribute('data-source');
            if (sourceTypeInput) sourceTypeInput.value = src;
            fileWrap.style.display = src === 'file' ? '' : 'none';
            linkWrap.style.display = src === 'link' ? '' : 'none';
        });
    }

    /* File label */
    var fileInput  = document.getElementById('coaFile');
    var fileNameEl = document.getElementById('coaFileName');
    if (fileInput && fileNameEl) {
        fileInput.addEventListener('change', function () {
            fileNameEl.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : '<?php echo esc_js( __('Choose PDF or image…','vitalpep-pro') ); ?>';
        });
    }

    /* Custom product toggle */
    var productSelect = document.getElementById('coaProductSelect');
    var customWrap    = document.getElementById('coaCustomWrap');
    if (productSelect && customWrap) {
        productSelect.addEventListener('change', function () {
            customWrap.style.display = productSelect.value === 'custom' ? '' : 'none';
        });
    }

    /* AJAX form submit */
    var form      = document.getElementById('coaAdminForm');
    var formError = document.getElementById('coaFormError');
    var toast     = document.getElementById('coaToast');
    var toastMsg  = document.getElementById('coaToastMsg');
    var toastTimer;

    function showToast(msg) {
        if (!toast) return;
        if (toastMsg) toastMsg.textContent = msg;
        toast.classList.add('visible');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { toast.classList.remove('visible'); }, 3500);
    }

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (formError) { formError.style.display = 'none'; formError.textContent = ''; }

            var data = new FormData(form);

            /* Resolve custom product name */
            if (data.get('product_name') === 'custom') {
                var cp = (data.get('custom_product') || '').trim();
                if (!cp) { showFormError('<?php echo esc_js(__('Please enter a product name.','vitalpep-pro')); ?>'); return; }
                data.set('product_name', cp);
            }
            if (!data.get('product_name')) { showFormError('<?php echo esc_js(__('Please select a product name.','vitalpep-pro')); ?>'); return; }
            if (!(data.get('strength') || '').trim()) { showFormError('<?php echo esc_js(__('Strength is required.','vitalpep-pro')); ?>'); return; }

            var submitBtn = form.querySelector('.coa-admin-form__submit');
            if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = '<?php echo esc_js(__('Saving…','vitalpep-pro')); ?>'; }

            fetch(form.getAttribute('action'), { method:'POST', body: data, credentials:'same-origin' })
                .then(function (r) { return r.json(); })
                .then(function (res) {
                    if (submitBtn) { submitBtn.disabled = false; submitBtn.innerHTML = '<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg><?php echo esc_js(__('Add COA to Directory','vitalpep-pro')); ?>'; }
                    if (!res.success) { showFormError(res.data && res.data.message ? res.data.message : '<?php echo esc_js(__('An error occurred.','vitalpep-pro')); ?>'); return; }
                    closePanel();
                    form.reset();
                    if (fileNameEl) fileNameEl.textContent = '<?php echo esc_js(__('Choose PDF or image…','vitalpep-pro')); ?>';
                    if (customWrap) customWrap.style.display = 'none';
                    showToast('<?php echo esc_js(__('COA added successfully. Reload to see it.','vitalpep-pro')); ?>');
                })
                .catch(function () {
                    if (submitBtn) { submitBtn.disabled = false; }
                    showFormError('<?php echo esc_js(__('Network error. Please try again.','vitalpep-pro')); ?>');
                });
        });
    }

    function showFormError(msg) {
        if (formError) { formError.textContent = msg; formError.style.display = 'flex'; }
    }

    <?php endif; // is_admin ?>

})();
</script>

<?php get_footer(); ?>
