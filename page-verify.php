<?php
/*
 * Template Name: Verify
 * Template Post Type: page
 */

// Look up FlexPen by verification token
$token    = isset( $_GET['t'] ) ? sanitize_text_field( $_GET['t'] ) : '';
$verified = false;
$pen_post = null;

if ( $token ) {
    $results = get_posts( array(
        'post_type'      => 'vp_flexpen',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'meta_query'     => array( array(
            'key'     => '_vpp_fp_verify_token',
            'value'   => $token,
            'compare' => '=',
        ) ),
    ) );
    if ( ! empty( $results ) ) {
        $pen_post = $results[0];
        $verified = true;
    }
}

get_header();
$g = $pen_post ? function( $k ) use ( $pen_post ) { return get_post_meta( $pen_post->ID, $k, true ); } : null;
?>

<style>
.vfy-wrap{min-height:100vh;background:linear-gradient(135deg,#060c18 0%,#0a1628 60%,#071020 100%);display:flex;align-items:center;justify-content:center;padding:40px 20px}
.vfy-card{background:rgba(255,255,255,.04);border:1px solid rgba(93,173,226,.15);border-radius:20px;max-width:560px;width:100%;padding:48px 44px;text-align:center;position:relative;overflow:hidden}
.vfy-card::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 0%,rgba(93,173,226,.07),transparent 65%);pointer-events:none}

/* VERIFIED state */
.vfy-badge{display:inline-flex;align-items:center;gap:10px;padding:10px 22px;border-radius:999px;font-size:.78rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:28px}
.vfy-badge--ok{background:rgba(39,174,96,.12);border:1px solid rgba(39,174,96,.3);color:#27ae60}
.vfy-badge--fail{background:rgba(220,38,38,.1);border:1px solid rgba(220,38,38,.25);color:#ef4444}
.vfy-badge svg{flex-shrink:0}

.vfy-icon{width:72px;height:72px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px}
.vfy-icon--ok{background:rgba(39,174,96,.12);border:2px solid rgba(39,174,96,.25)}
.vfy-icon--fail{background:rgba(220,38,38,.08);border:2px solid rgba(220,38,38,.2)}

.vfy-title{font-size:1.7rem;font-weight:800;margin:0 0 6px;color:#fff}
.vfy-title--ok span{color:#27ae60}
.vfy-title--fail span{color:#ef4444}
.vfy-sub{font-size:.92rem;color:rgba(255,255,255,.55);margin:0 0 32px;line-height:1.6}

.vfy-divider{height:1px;background:rgba(93,173,226,.1);margin:28px 0}

/* Product details */
.vfy-product{display:flex;align-items:center;gap:20px;text-align:left;background:rgba(93,173,226,.04);border:1px solid rgba(93,173,226,.1);border-radius:12px;padding:18px 20px;margin-bottom:24px}
.vfy-product__img{width:72px;height:72px;border-radius:8px;object-fit:contain;flex-shrink:0;background:rgba(255,255,255,.03)}
.vfy-product__name{font-size:1.15rem;font-weight:700;color:#fff;margin:0 0 4px}
.vfy-product__cat{font-size:.75rem;color:#5dade2;letter-spacing:.08em;text-transform:uppercase;font-weight:600;margin:0 0 8px}
.vfy-product__meta{display:flex;flex-wrap:wrap;gap:6px;margin:0}
.vfy-meta-chip{font-size:.72rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.08);color:rgba(255,255,255,.6);padding:3px 10px;border-radius:20px}

.vfy-specs{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:24px;text-align:left}
.vfy-spec{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:10px;padding:12px 14px}
.vfy-spec__label{font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.35);margin-bottom:4px}
.vfy-spec__val{font-size:.9rem;font-weight:600;color:#fff}

.vfy-seal{display:flex;align-items:center;justify-content:center;gap:8px;font-size:.75rem;color:rgba(255,255,255,.35);margin-top:24px}
.vfy-seal svg{color:rgba(255,255,255,.25)}

.vfy-brand{display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:32px}
.vfy-brand__name{font-size:1rem;font-weight:700;color:#fff;letter-spacing:.04em}
.vfy-brand__tag{font-size:.7rem;color:#5dade2;letter-spacing:.12em;text-transform:uppercase}

/* INVALID state message */
.vfy-invalid-msg{color:rgba(255,255,255,.55);font-size:.9rem;line-height:1.7;margin-bottom:24px}
.vfy-btn{display:inline-flex;align-items:center;gap:8px;background:#1a5276;color:#fff;padding:12px 28px;border-radius:999px;text-decoration:none;font-size:.88rem;font-weight:600;transition:background .2s}
.vfy-btn:hover{background:#2980b9;color:#fff}
</style>

<div class="vfy-wrap">
    <div class="vfy-card">

        <!-- Brand header -->
        <div class="vfy-brand">
            <svg width="24" height="24" fill="none" stroke="#5dade2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            <div>
                <div class="vfy-brand__name">VitalPep Pro™</div>
                <div class="vfy-brand__tag">Product Verification</div>
            </div>
        </div>

        <?php if ( $verified && $pen_post ) : ?>

            <!-- VERIFIED -->
            <div class="vfy-icon vfy-icon--ok">
                <svg width="36" height="36" fill="none" stroke="#27ae60" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>

            <div class="vfy-badge vfy-badge--ok">
                <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Authenticity Verified
            </div>

            <h1 class="vfy-title vfy-title--ok"><span>Genuine</span> VitalPep Pro Product</h1>
            <p class="vfy-sub">This FlexPen has been verified as an authentic VitalPep Pro product manufactured under cGMP standards at our Netherlands facility.</p>

            <div class="vfy-divider"></div>

            <!-- Product card -->
            <div class="vfy-product">
                <?php
                $img = $g('_vpp_fp_img_catalog') ?: get_the_post_thumbnail_url( $pen_post->ID, 'thumbnail' );
                if ( ! $img && $g('_vpp_fp_img_fallback') )
                    $img = get_template_directory_uri() . '/assets/images/' . $g('_vpp_fp_img_fallback');
                ?>
                <?php if ( $img ) : ?>
                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr( get_the_title($pen_post) ); ?>" class="vfy-product__img">
                <?php endif; ?>
                <div>
                    <?php if ( $g('_vpp_fp_category') ) : ?>
                    <div class="vfy-product__cat"><?php echo esc_html( $g('_vpp_fp_category') ); ?></div>
                    <?php endif; ?>
                    <div class="vfy-product__name"><?php echo esc_html( get_the_title($pen_post) ); ?> FlexPen</div>
                    <div class="vfy-product__meta">
                        <?php if ( $g('_vpp_fp_total') )   : ?><span class="vfy-meta-chip"><?php echo esc_html( $g('_vpp_fp_total') ); ?></span><?php endif; ?>
                        <?php if ( $g('_vpp_fp_purity') )  : ?><span class="vfy-meta-chip"><?php echo esc_html( $g('_vpp_fp_purity') ); ?></span><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Spec grid -->
            <div class="vfy-specs">
                <div class="vfy-spec">
                    <div class="vfy-spec__label">Batch Number</div>
                    <div class="vfy-spec__val"><?php echo esc_html( $g('_vpp_fp_batch') ?: '—' ); ?></div>
                </div>
                <div class="vfy-spec">
                    <div class="vfy-spec__label">Purity</div>
                    <div class="vfy-spec__val"><?php echo esc_html( $g('_vpp_fp_purity') ?: '99%+' ); ?></div>
                </div>
                <div class="vfy-spec">
                    <div class="vfy-spec__label">Storage</div>
                    <div class="vfy-spec__val"><?php echo esc_html( $g('_vpp_fp_storage') ?: '2–8°C' ); ?></div>
                </div>
                <div class="vfy-spec">
                    <div class="vfy-spec__label">Origin</div>
                    <div class="vfy-spec__val">Netherlands cGMP</div>
                </div>
            </div>

            <a href="<?php echo esc_url( home_url('/flexpens/') ); ?>" class="vfy-btn">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                View Full Product Details
            </a>

        <?php else : ?>

            <!-- INVALID / NOT FOUND -->
            <div class="vfy-icon vfy-icon--fail">
                <svg width="36" height="36" fill="none" stroke="#ef4444" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>

            <div class="vfy-badge vfy-badge--fail">
                <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01M12 2a10 10 0 100 20A10 10 0 0012 2z"/></svg>
                Verification Failed
            </div>

            <h1 class="vfy-title vfy-title--fail">Could Not <span>Verify</span> Product</h1>
            <p class="vfy-invalid-msg">
                <?php if ( $token ) : ?>
                This verification code was not found in our system. This may indicate a counterfeit product or a damaged QR code.<br><br>
                If you believe this is an error, please contact us with your batch number.
                <?php else : ?>
                No verification code was provided. Please scan the QR code on your VitalPep Pro FlexPen label to verify authenticity.
                <?php endif; ?>
            </p>

            <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="vfy-btn">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Contact Support
            </a>

        <?php endif; ?>

        <div class="vfy-seal">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            VitalPep Pro Pharmaceuticals B.V. · Netherlands · cGMP Certified
        </div>

    </div>
</div>

<?php get_footer(); ?>
