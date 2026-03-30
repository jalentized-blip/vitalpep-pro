<?php
/*
 * Template Name: FlexPens
 * Template Post Type: page
 */
$img = get_template_directory_uri() . '/assets/images/';
$pdf = get_template_directory_uri() . '/assets/pdfs/';
$chk = '<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
$all_fps     = get_posts( array(
    'post_type'      => 'vp_flexpen',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
) );
$fp_styles   = array( 'dark', 'light', 'mid' );
$fp_reverses = array( false, true, false, true );

get_header(); ?>

<style>
.fp-hero{background:linear-gradient(135deg,#0a0f1e 0%,#0d1b3e 50%,#0a1628 100%);padding:100px 0 80px;text-align:center;position:relative;overflow:hidden}
.fp-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 60% 40%,rgba(93,173,226,.08) 0%,transparent 70%)}
.fp-hero__label{display:inline-flex;align-items:center;gap:6px;background:rgba(93,173,226,.12);border:1px solid rgba(93,173,226,.25);color:#5dade2;padding:6px 14px;border-radius:20px;font-size:.72rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;margin-bottom:24px}
.fp-hero__title{font-size:clamp(2rem,5vw,3.5rem);font-weight:800;color:#fff;line-height:1.15;margin:0 0 20px}
.fp-hero__title span{color:#5dade2}
.fp-hero__sub{font-size:1.05rem;color:rgba(255,255,255,.65);max-width:620px;margin:0 auto 36px;line-height:1.7}
.fp-hero__trust{display:flex;flex-wrap:wrap;justify-content:center;gap:20px}
.fp-hero__trust-item{display:flex;align-items:center;gap:6px;color:rgba(255,255,255,.55);font-size:.8rem}
.fp-hero__trust-item svg{color:#5dade2;flex-shrink:0}

.fp-nav{background:#0d1b3e;border-bottom:1px solid rgba(93,173,226,.15);position:sticky;top:70px;z-index:100}
.fp-nav__inner{display:flex;justify-content:center;flex-wrap:wrap;gap:0}
.fp-nav__link{padding:14px 22px;color:rgba(255,255,255,.5);font-size:.82rem;font-weight:600;letter-spacing:.04em;text-decoration:none;display:flex;align-items:center;gap:7px;border-bottom:2px solid transparent;transition:all .2s}
.fp-nav__link:hover,.fp-nav__link.active{color:#5dade2;border-bottom-color:#5dade2}
.fp-nav__dot{width:6px;height:6px;border-radius:50%;background:currentColor;opacity:.4}
.fp-nav__link.active .fp-nav__dot{opacity:1}

.fp-product{padding:90px 0;position:relative;overflow:hidden}
.fp-product--dark{background:linear-gradient(135deg,#0a0f1e,#0d1b3e)}
.fp-product--light{background:#f8fafd}
.fp-product--mid{background:linear-gradient(135deg,#0f1c35,#152645)}
.fp-product__accent{position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(93,173,226,.3),transparent)}
.fp-product__grid{display:grid;grid-template-columns:1fr 1fr;gap:70px;align-items:center}
.fp-product__grid--reverse{direction:rtl}
.fp-product__grid--reverse>*{direction:ltr}
.fp-product__img-wrap{position:relative;display:flex;align-items:center;justify-content:center;padding:40px}
.fp-product__img-bg{position:absolute;width:280px;height:280px;border-radius:50%;background:radial-gradient(circle,rgba(93,173,226,.12),transparent 70%)}
.fp-product__img-ring{position:absolute;border-radius:50%;border:1px solid rgba(93,173,226,.12);animation:fpRing 6s linear infinite}
.fp-product__img-ring:nth-child(2){width:260px;height:260px}
.fp-product__img-ring:nth-child(3){width:340px;height:340px;animation-direction:reverse;animation-duration:9s}
.fp-product--light .fp-product__img-ring{border-color:rgba(13,27,62,.08)}
@keyframes fpRing{to{transform:rotate(360deg)}}
.fp-product__img{position:relative;z-index:1;max-height:340px;width:auto;filter:drop-shadow(0 20px 50px rgba(0,0,0,.4))}
.fp-product--light .fp-product__img{filter:drop-shadow(0 20px 40px rgba(13,27,62,.15))}
.fp-product__badge-strip{position:absolute;bottom:10px;left:50%;transform:translateX(-50%);display:flex;gap:8px;white-space:nowrap}
.fp-badge{padding:4px 10px;border-radius:12px;font-size:.7rem;font-weight:700;letter-spacing:.05em}
.fp-badge--blue{background:rgba(93,173,226,.2);color:#5dade2;border:1px solid rgba(93,173,226,.3)}
.fp-badge--green{background:rgba(39,174,96,.2);color:#27ae60;border:1px solid rgba(39,174,96,.3)}
.fp-product--light .fp-badge--blue{background:rgba(13,27,62,.08);color:#0d1b3e;border-color:rgba(13,27,62,.15)}
.fp-product--light .fp-badge--green{background:rgba(39,174,96,.1);color:#1e8449;border-color:rgba(39,174,96,.2)}

.fp-product__cat{font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#5dade2;margin-bottom:10px}
.fp-product--light .fp-product__cat{color:#2980b9}
.fp-product__name{font-size:2.4rem;font-weight:800;color:#fff;margin:0 0 6px;line-height:1.1}
.fp-product--light .fp-product__name{color:#0d1b3e}
.fp-product__name span{color:#5dade2}
.fp-product--light .fp-product__name span{color:#2980b9}
.fp-product__tagline{font-size:.85rem;color:rgba(93,173,226,.8);margin-bottom:20px;font-family:monospace}
.fp-product--light .fp-product__tagline{color:#5d8aa8}
.fp-product__desc{color:rgba(255,255,255,.7);line-height:1.75;margin-bottom:24px;font-size:.95rem}
.fp-product--light .fp-product__desc{color:#374151}

.fp-mechanism{background:rgba(93,173,226,.06);border:1px solid rgba(93,173,226,.15);border-radius:10px;padding:18px 20px;margin-bottom:24px}
.fp-product--light .fp-mechanism{background:#f0f6ff;border-color:#d0e4f5}
.fp-mechanism__title{display:flex;align-items:center;gap:6px;font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#5dade2;margin-bottom:10px}
.fp-product--light .fp-mechanism__title{color:#2980b9}
.fp-mechanism__text{color:rgba(255,255,255,.65);font-size:.88rem;line-height:1.7;margin:0}
.fp-product--light .fp-mechanism__text{color:#4b5563}

.fp-benefits{list-style:none;padding:0;margin:0 0 24px;display:grid;grid-template-columns:1fr 1fr;gap:8px}
.fp-benefits li{display:flex;align-items:flex-start;gap:8px;color:rgba(255,255,255,.7);font-size:.85rem;line-height:1.4}
.fp-product--light .fp-benefits li{color:#374151}
.fp-benefits svg{color:#27ae60;flex-shrink:0;margin-top:1px}

.fp-specs{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:28px;padding:16px;background:rgba(255,255,255,.04);border-radius:10px;border:1px solid rgba(255,255,255,.06)}
.fp-product--light .fp-specs{background:#f0f4f8;border-color:#e2e8f0}
.fp-spec{text-align:center}
.fp-spec__val{font-size:1.1rem;font-weight:800;color:#fff;margin-bottom:3px}
.fp-product--light .fp-spec__val{color:#0d1b3e}
.fp-spec__label{font-size:.68rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4)}
.fp-product--light .fp-spec__label{color:#6b7280}

.fp-cta-row{display:flex;gap:12px;flex-wrap:wrap}

.fp-cta-banner{background:linear-gradient(135deg,#0d1b3e,#1a3a6e);padding:80px 0;text-align:center;border-top:1px solid rgba(93,173,226,.15)}
.fp-cta-banner__title{font-size:2rem;font-weight:800;color:#fff;margin:0 0 14px}
.fp-cta-banner__sub{color:rgba(255,255,255,.65);max-width:540px;margin:0 auto 32px;line-height:1.7}

@media(max-width:900px){
    .fp-product__grid{grid-template-columns:1fr;gap:40px}
    .fp-product__grid--reverse{direction:ltr}
    .fp-benefits{grid-template-columns:1fr}
    .fp-specs{grid-template-columns:repeat(2,1fr)}
    .fp-hero__title{font-size:2rem}
}
@media(max-width:600px){
    .fp-nav__link{padding:12px 14px;font-size:.75rem}
    .fp-cta-row{flex-direction:column}
    .fp-specs{grid-template-columns:repeat(2,1fr)}
}
</style>

<!-- ── HERO ─────────────────────────────────────────────────────────────── -->
<section class="fp-hero">
    <div class="container">
        <div class="fp-hero__label">
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            <?php echo vpp_text( 'vpp_fp_hero_badge', 'Netherlands cGMP Facility · Batch NL-2026' ); ?>
        </div>
        <h1 class="fp-hero__title"><?php echo vpp_text( 'vpp_fp_hero_title_1', 'Seven' ); ?> <span><?php echo vpp_text( 'vpp_fp_hero_title_highlight', 'Precision Compounds.' ); ?></span><br><?php echo vpp_text( 'vpp_fp_hero_title_2', 'One Delivery System.' ); ?></h1>
        <p class="fp-hero__sub"><?php echo vpp_textarea( 'vpp_fp_hero_subtitle', 'Each VitalPep Pro FlexPen delivers a rigorously tested research compound in a precision-engineered 3ml reusable pen — manufactured to pharmaceutical standards and independently verified for purity.' ); ?></p>
        <div class="fp-hero__trust">
            <div class="fp-hero__trust-item"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg> 99%+ Purity Guaranteed</div>
            <div class="fp-hero__trust-item"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg> 3rd-Party COA Per Batch</div>
            <div class="fp-hero__trust-item"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> EU Manufactured</div>
            <div class="fp-hero__trust-item"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg> Cold-Chain Verified</div>
        </div>
    </div>
</section>

<!-- ── STICKY NAV ─────────────────────────────────────────────────────── -->
<nav class="fp-nav" id="fpNav">
    <div class="fp-nav__inner">
        <?php foreach ( $all_fps as $i => $efp ) : ?>
        <a href="#<?php echo esc_attr( $efp->post_name ); ?>" class="fp-nav__link<?php echo $i === 0 ? ' active' : ''; ?>" data-target="<?php echo esc_attr( $efp->post_name ); ?>"><span class="fp-nav__dot"></span><?php echo esc_html( get_the_title( $efp->ID ) ); ?></a>
        <?php endforeach; ?>
    </div>
</nav>

<?php foreach ( $all_fps as $idx => $efp ) :
    $em       = function( $k ) use ( $efp ) { return get_post_meta( $efp->ID, $k, true ); };
    $lo       = $em( '_vpp_fp_layout' );
    $style    = $lo ?: $fp_styles[ $idx % 3 ];
    $rev_meta = $em( '_vpp_fp_reverse' );
    $reverse  = $rev_meta ? ( $rev_meta === 'reverse' ) : (bool)$fp_reverses[ $idx % 4 ];
    /* Priority: dedicated catalog image → Featured Image → legacy fallback */
    $img_url  = $em( '_vpp_fp_img_catalog' );
    if ( ! $img_url ) $img_url = get_the_post_thumbnail_url( $efp->ID, 'large' );
    if ( ! $img_url && $em('_vpp_fp_img_fallback') ) {
        $img_url = get_template_directory_uri() . '/assets/images/' . $em('_vpp_fp_img_fallback');
    }
    $benefits = array_filter( array_map( function($i) use ($em) { return $em("_vpp_fp_b{$i}"); }, range(1,6) ) );
    $total    = $em('_vpp_fp_total')   ?: '–';
    $purity   = $em('_vpp_fp_purity')  ?: '99%+';
    $storage  = $em('_vpp_fp_storage') ?: '2–8°C (36–46°F)';
    $pdf_url  = $em('_vpp_fp_pdf');
    $inq_slug = $em('_vpp_fp_inquiry') ?: urlencode( get_the_title( $efp->ID ) );
    $badge1   = $em('_vpp_fp_badge1');
    $badge2   = $em('_vpp_fp_badge2');
    $moa      = $em('_vpp_fp_moa');
?>
<!-- ── <?php echo esc_html( get_the_title( $efp->ID ) ); ?> ─────────────────────────────────────────────────────────── -->
<section class="fp-product fp-product--<?php echo esc_attr($style); ?>" id="<?php echo esc_attr($efp->post_name); ?>">
    <div class="fp-product__accent"></div>
    <div class="container">
        <div class="fp-product__grid<?php echo $reverse ? ' fp-product__grid--reverse' : ''; ?>">
            <div class="fp-product__visual">
                <div class="fp-product__img-wrap">
                    <div class="fp-product__img-bg"></div>
                    <div class="fp-product__img-ring"></div>
                    <div class="fp-product__img-ring"></div>
                    <?php if ( $img_url ) : ?>
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr( get_the_title( $efp->ID ) ); ?>" class="fp-product__img">
                    <?php endif; ?>
                    <?php if ( $badge1 || $badge2 ) : ?>
                    <div class="fp-product__badge-strip">
                        <?php if($badge1): ?><span class="fp-badge fp-badge--blue"><?php echo esc_html($badge1); ?></span><?php endif; ?>
                        <?php if($badge2): ?><span class="fp-badge fp-badge--green"><?php echo esc_html($badge2); ?></span><?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <?php if($em('_vpp_fp_category')): ?><div class="fp-product__cat"><?php echo esc_html($em('_vpp_fp_category')); ?></div><?php endif; ?>
                <h2 class="fp-product__name"><?php echo esc_html( get_the_title( $efp->ID ) ); ?> <span>FlexPen</span></h2>
                <?php if($em('_vpp_fp_tagline')): ?><p class="fp-product__tagline"><?php echo esc_html($em('_vpp_fp_tagline')); ?></p><?php endif; ?>
                <?php if($em('_vpp_fp_desc')): ?><p class="fp-product__desc"><?php echo esc_html($em('_vpp_fp_desc')); ?></p><?php endif; ?>
                <?php if($moa): ?>
                <div class="fp-mechanism">
                    <div class="fp-mechanism__title"><svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>Mechanism of Action</div>
                    <p class="fp-mechanism__text"><?php echo esc_html($moa); ?></p>
                </div>
                <?php endif; ?>
                <?php if($benefits): ?>
                <ul class="fp-benefits">
                    <?php foreach($benefits as $b): ?><li><?php echo $chk; ?><span><?php echo esc_html($b); ?></span></li><?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <div class="fp-specs">
                    <div class="fp-spec"><div class="fp-spec__val"><?php echo esc_html($total); ?></div><div class="fp-spec__label">Total Content</div></div>
                    <div class="fp-spec"><div class="fp-spec__val">3ml</div><div class="fp-spec__label">Volume</div></div>
                    <div class="fp-spec"><div class="fp-spec__val"><?php echo esc_html($purity); ?></div><div class="fp-spec__label">Purity</div></div>
                    <div class="fp-spec"><div class="fp-spec__val"><?php echo esc_html($storage); ?></div><div class="fp-spec__label">Storage</div></div>
                    <div class="fp-disposal-notice"><span class="fp-disposal-notice__icon">&#9432;</span><span class="fp-disposal-notice__text"><strong>Disposal Notice:</strong> This is a single-use disposable pen. Once all 3 ml of solution has been administered, the device must be discarded responsibly in accordance with applicable biological waste disposal regulations. Do not reuse, refill, or share this device.</span></div>
                </div>
                <div class="fp-cta-row">
                    <?php if($pdf_url): ?>
                    <a href="<?php echo esc_url($pdf_url); ?>" class="btn btn--outline" target="_blank" rel="noopener"><svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Dosage Manual PDF</a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(home_url('/contact/?product='.$inq_slug)); ?>" class="btn btn--primary"><svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>Request Inquiry</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endforeach; ?>


<!-- ── BOTTOM CTA ─────────────────────────────────────────────────────── -->
<section class="fp-cta-banner">
    <div class="container">
        <h2 class="fp-cta-banner__title">Ready to Order Your Research FlexPens?</h2>
        <p class="fp-cta-banner__sub">Our research liaison team handles all inquiries personally. Expect a response within 24&#8211;48 business hours with full pricing, availability, and COA documentation.</p>
        <div class="fp-cta-row" style="justify-content:center">
            <a href="<?php echo esc_url(home_url('/contact/'));?>" class="btn btn--primary btn--lg"><svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>Submit a Research Inquiry</a>
            <a href="<?php echo esc_url(home_url('/'));?>" class="btn btn--outline btn--lg"><svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Back to Home</a>
        </div>
    </div>
</section>

<script>
(function(){
    var nav=document.getElementById('fpNav');if(!nav)return;
    var links=nav.querySelectorAll('.fp-nav__link'),sections=[];
    links.forEach(function(l){var el=document.getElementById(l.getAttribute('data-target'));if(el)sections.push({l:l,el:el});});
    window.addEventListener('scroll',function(){
        var y=window.scrollY||window.pageYOffset,a=sections[0];
        sections.forEach(function(s){if(y>=s.el.offsetTop-140)a=s;});
        links.forEach(function(l){l.classList.remove('active');});
        if(a)a.l.classList.add('active');
    },{passive:true});
    links.forEach(function(l){l.addEventListener('click',function(e){
        e.preventDefault();var el=document.getElementById(l.getAttribute('data-target'));
        if(el)window.scrollTo({top:el.offsetTop-80,behavior:'smooth'});
    });});
})();
</script>

<?php get_footer(); ?>
