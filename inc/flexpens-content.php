<?php
/**
 * FlexPens page content — loaded via [vpp_flexpens] shortcode.
 * No get_header() / get_footer() — rendered inside the_content().
 *
 * @package VitalPep_Pro
 */

$img_base = get_template_directory_uri() . '/assets/images/';
$pdf_base = get_template_directory_uri() . '/assets/pdfs/';
$check    = '<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';

$products = array(

    array(
        'id'      => 'ghkcu',
        'name'    => 'GHK-Cu',
        'cat'     => 'Tissue Regeneration &amp; Anti-Aging',
        'tagline' => 'Glycine-Histidine-Lysine Copper Peptide &middot; 33.33&nbsp;mg/ml',
        'total'   => '100mg',
        'img'     => 'ghkcu-flexpen.jpg',
        'badge1'  => '100mg / 3ml',
        'badge2'  => '99%+ Purity',
        'pdf'     => 'ghkcu-dosage-manual.pdf',
        'section' => 'dark',
        'reverse' => false,
        'desc'    => 'GHK-Cu is a naturally occurring copper peptide complex found in human plasma that plays a critical role in wound healing, tissue remodeling, and cellular repair. Originally isolated by Dr. Loren Pickart, plasma GHK-Cu levels decline sharply with age — making it one of the most studied peptides in regenerative and anti-aging research. Each FlexPen delivers a precision 100mg payload in 3ml of carrier solution.',
        'moa'     => 'GHK-Cu binds and transports copper ions into cells, modulating the expression of over 4,000 human genes. It activates collagen and elastin synthesis via TGF-β pathway stimulation, promotes angiogenesis through VEGF upregulation, and exerts antioxidant activity by activating superoxide dismutase.',
        'benefits' => array(
            'Wound healing &amp; tissue repair mechanisms',
            'Collagen &amp; elastin synthesis pathways',
            'Hair follicle cycle &amp; growth studies',
            'Angiogenesis &amp; VEGF pathway research',
            'Antioxidant &amp; anti-inflammatory models',
            'Nerve tissue regeneration &amp; neuroprotection',
        ),
    ),

    array(
        'id'      => 'retatrutide',
        'name'    => 'Retatrutide',
        'cat'     => 'Advanced Metabolic Research',
        'tagline' => 'GIP / GLP-1 / Glucagon Triple Receptor Agonist &middot; 10&nbsp;mg/ml',
        'total'   => '30mg',
        'img'     => 'retatrutide-flexpen.jpg',
        'badge1'  => '30mg / 3ml',
        'badge2'  => 'Triple Agonist',
        'pdf'     => 'retatrutide-dosage-manual.pdf',
        'section' => 'light',
        'reverse' => true,
        'desc'    => 'Retatrutide (LY3437943) is a novel triple agonist simultaneously activating GIP, GLP-1, and glucagon receptors. This triple-action mechanism produces unmatched metabolic effects compared to single or dual agonists, making it the most studied next-generation compound in metabolic science.',
        'moa'     => 'GIP receptor activation enhances insulin sensitivity; GLP-1 receptor activation reduces appetite signaling and stimulates insulin secretion; Glucagon receptor activation increases hepatic glucose output and promotes lipolysis — creating a synergistic metabolic effect that exceeds dual-agonist approaches.',
        'benefits' => array(
            'Advanced obesity &amp; body composition research',
            'Glucose homeostasis &amp; insulin sensitivity',
            'Hepatic steatosis mechanism studies',
            'Cardiovascular metabolic risk research',
            'Energy expenditure pathway investigation',
            'Comparative studies vs. GLP-1 monotherapy',
        ),
    ),

    array(
        'id'      => 'melanotan',
        'name'    => 'Melanotan II',
        'cat'     => 'Melanocortin System Research',
        'tagline' => 'Synthetic &alpha;-MSH Cyclic Lactam Analog &middot; 3.33&nbsp;mg/ml',
        'total'   => '10mg',
        'img'     => 'melanotan2-flexpen.jpg',
        'badge1'  => '10mg / 3ml',
        'badge2'  => 'MC1R &middot; MC4R',
        'pdf'     => 'melanotan2-dosage-manual.pdf',
        'section' => 'mid',
        'reverse' => false,
        'desc'    => 'Melanotan II (MT-II) is a synthetic cyclic lactam analog of alpha-melanocyte-stimulating hormone (α-MSH), originally developed at the University of Arizona. As a non-selective melanocortin receptor agonist, MT-II provides unparalleled access to the melanocortin system for studying pigmentation, appetite regulation, and immune modulation.',
        'moa'     => 'MT-II binds with high affinity to melanocortin receptors: MC1R drives eumelanin production; MC3R regulates energy homeostasis; MC4R controls appetite suppression and thermogenesis; MC5R plays a role in exocrine gland function — making MT-II a versatile research tool across multiple systems.',
        'benefits' => array(
            'Melanogenesis &amp; pigmentation pathway studies',
            'MC4R appetite regulation research',
            'Sexual function &amp; libido pathway studies',
            'Photoprotection &amp; UV response models',
            'Energy homeostasis &amp; thermogenesis',
            'Immune modulation &amp; anti-inflammatory research',
        ),
    ),

    array(
        'id'      => 'nadplus',
        'name'    => 'NAD+',
        'cat'     => 'Cellular Energy &amp; Longevity Research',
        'tagline' => 'Nicotinamide Adenine Dinucleotide &middot; 166.67&nbsp;mg/ml',
        'total'   => '500mg',
        'img'     => 'nadplus-flexpen.jpg',
        'badge1'  => '500mg / 3ml',
        'badge2'  => 'Sirtuin Activator',
        'pdf'     => 'nadplus-dosage-manual.pdf',
        'section' => 'light',
        'reverse' => true,
        'desc'    => 'NAD+ (Nicotinamide Adenine Dinucleotide) is the essential coenzyme at the center of cellular metabolism in every living cell. As a critical electron carrier in oxidative phosphorylation and key substrate for longevity-regulating enzymes, NAD+ sits at the intersection of aging, energy production, and DNA repair research.',
        'moa'     => 'NAD+ is the primary substrate for sirtuins (SIRT1–7) — master longevity deacetylases regulating gene expression, mitochondrial biogenesis, and stress resistance. It is also required by PARP enzymes for DNA repair and serves as an electron shuttle in the mitochondrial electron transport chain.',
        'benefits' => array(
            'Sirtuin pathway activation &amp; longevity research',
            'DNA damage surveillance &amp; repair (PARP)',
            'Mitochondrial function &amp; biogenesis studies',
            'Neuroprotection &amp; cognitive function models',
            'Muscle metabolism &amp; exercise physiology',
            'Metabolic disease &amp; aging pathway investigation',
        ),
    ),
);
?>

<section class="fp-hero">
    <div class="container">
        <div class="fp-hero__label">
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            Netherlands cGMP Facility &middot; Batch NL-2026
        </div>
        <h1 class="fp-hero__title">Four <span>Precision Compounds.</span><br>One Delivery System.</h1>
        <p class="fp-hero__sub">Each VitalPep Pro FlexPen delivers a rigorously tested research compound in a precision-engineered 3ml reusable pen — manufactured to pharmaceutical standards and independently verified for purity.</p>
        <div class="fp-hero__trust">
            <div class="fp-hero__trust-item"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>99%+ Purity Guaranteed</div>
            <div class="fp-hero__trust-item"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>3rd Party COA Per Batch</div>
            <div class="fp-hero__trust-item"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>EU Manufactured</div>
            <div class="fp-hero__trust-item"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>Cold-Chain Verified</div>
        </div>
    </div>
</section>

<nav class="fp-nav" id="fpNav">
    <div class="fp-nav__inner">
        <?php foreach ( $products as $i => $p ) : ?>
        <a href="#<?php echo esc_attr( $p['id'] ); ?>" class="fp-nav__link<?php echo $i === 0 ? ' active' : ''; ?>" data-target="<?php echo esc_attr( $p['id'] ); ?>">
            <span class="fp-nav__dot"></span><?php echo esc_html( $p['name'] ); ?> FlexPen
        </a>
        <?php endforeach; ?>
    </div>
</nav>

<?php foreach ( $products as $p ) : ?>
<section class="fp-product fp-product--<?php echo esc_attr( $p['section'] ); ?>" id="<?php echo esc_attr( $p['id'] ); ?>">
    <div class="fp-product__accent"></div>
    <div class="container">
        <div class="fp-product__grid<?php echo $p['reverse'] ? ' fp-product__grid--reverse' : ''; ?>">

            <div class="fp-product__visual fp-animate">
                <div class="fp-product__img-wrap">
                    <div class="fp-product__img-bg"></div>
                    <div class="fp-product__img-ring"></div>
                    <div class="fp-product__img-ring"></div>
                    <img src="<?php echo esc_url( $img_base . $p['img'] ); ?>" alt="<?php echo esc_attr( $p['name'] . ' FlexPen' ); ?>" class="fp-product__img">
                    <div class="fp-product__badge-strip">
                        <span class="fp-badge fp-badge--blue"><?php echo $p['badge1']; ?></span>
                        <span class="fp-badge fp-badge--green"><?php echo $p['badge2']; ?></span>
                    </div>
                </div>
            </div>

            <div class="fp-animate fp-animate--delay1">
                <div class="fp-product__cat"><?php echo $p['cat']; ?></div>
                <h2 class="fp-product__name"><?php echo esc_html( $p['name'] ); ?> <span>FlexPen</span></h2>
                <p class="fp-product__tagline"><?php echo $p['tagline']; ?></p>
                <p class="fp-product__desc"><?php echo esc_html( $p['desc'] ); ?></p>

                <div class="fp-mechanism">
                    <div class="fp-mechanism__title">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Mechanism of Action
                    </div>
                    <p class="fp-mechanism__text"><?php echo esc_html( $p['moa'] ); ?></p>
                </div>

                <ul class="fp-benefits">
                    <?php foreach ( $p['benefits'] as $b ) : ?>
                    <li><?php echo $check; ?><span><?php echo $b; ?></span></li>
                    <?php endforeach; ?>
                </ul>

                <div class="fp-specs">
                    <div class="fp-spec"><div class="fp-spec__val"><?php echo esc_html( $p['total'] ); ?></div><div class="fp-spec__label">Total Content</div></div>
                    <div class="fp-spec"><div class="fp-spec__val">3ml</div><div class="fp-spec__label">Volume</div></div>
                    <div class="fp-spec"><div class="fp-spec__val">99%+</div><div class="fp-spec__label">Purity</div></div>
                    <div class="fp-spec"><div class="fp-spec__val">2&ndash;8&deg;C <span style="font-size:0.7em;opacity:0.75;">(36&ndash;46&deg;F)</span></div><div class="fp-spec__label">Storage</div></div>
                    <div class="fp-disposal-notice"><span class="fp-disposal-notice__icon">&#9432;</span><span class="fp-disposal-notice__text"><strong>Disposal Notice:</strong> This is a single-use disposable pen. Once all 3 ml of solution has been administered, the device must be discarded responsibly in accordance with applicable biological waste disposal regulations. Do not reuse, refill, or share this device.</span></div>
                </div>

                <div class="fp-cta-row">
                    <a href="<?php echo esc_url( $pdf_base . $p['pdf'] ); ?>" class="btn btn--outline" target="_blank" rel="noopener">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Dosage Manual PDF
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/?product=' . urlencode( $p['name'] . ' FlexPen' ) ) ); ?>" class="btn btn--primary">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        Request Inquiry
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<?php endforeach; ?>

<section class="fp-cta-banner">
    <div class="container">
        <h2 class="fp-cta-banner__title">Ready to Order Your Research FlexPens?</h2>
        <p class="fp-cta-banner__sub">Our research liaison team handles all inquiries personally. Expect a response within 24&#8211;48 business hours with full pricing, availability, and COA documentation.</p>
        <div class="fp-cta-row">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--white btn--lg">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Submit a Research Inquiry
            </a>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--ghost-white btn--lg">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Back to Home
            </a>
        </div>
    </div>
</section>

<script>
(function(){
    var nav=document.getElementById('fpNav');
    if(!nav)return;
    var links=nav.querySelectorAll('.fp-nav__link');
    var sections=[];
    links.forEach(function(l){var el=document.getElementById(l.getAttribute('data-target'));if(el)sections.push({link:l,el:el});});
    function update(){
        var y=window.scrollY||window.pageYOffset,active=sections[0];
        sections.forEach(function(s){if(y>=s.el.offsetTop-120)active=s;});
        links.forEach(function(l){l.classList.remove('active');});
        if(active)active.link.classList.add('active');
    }
    window.addEventListener('scroll',update,{passive:true});
    links.forEach(function(l){
        l.addEventListener('click',function(e){
            e.preventDefault();
            var el=document.getElementById(l.getAttribute('data-target'));
            if(el)window.scrollTo({top:el.offsetTop-80,behavior:'smooth'});
        });
    });
})();
</script>
