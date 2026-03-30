</main><!-- #main-content -->

<!-- Site Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer__grid">
            <!-- Brand Column -->
            <div class="footer__brand">
                <div class="footer__logo">
                    <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 8C13 8 16.5 12 18 15.5C19.5 19 23 23 23 23" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M23 8C23 8 19.5 12 18 15.5C16.5 19 13 23 13 23" stroke="#5dade2" stroke-width="2" stroke-linecap="round"/>
                        <line x1="12" y1="12" x2="24" y2="12" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" opacity="0.4"/>
                        <line x1="11.5" y1="15.5" x2="24.5" y2="15.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" opacity="0.4"/>
                        <line x1="11.5" y1="19" x2="24.5" y2="19" stroke="#5dade2" stroke-width="1.2" stroke-linecap="round" opacity="0.4"/>
                        <circle cx="18" cy="28" r="2" fill="#5dade2" opacity="0.4"/>
                    </svg>
                    <span class="footer__logo-text">VitalPep Pro</span>
                </div>
                <p class="footer__brand-text">
                    <?php echo vpp_textarea( 'vpp_footer_brand_text', 'Precision-engineered FlexPen research compounds manufactured in the Netherlands. Committed to analytical purity and compliance excellence for research institutions worldwide.' ); ?>
                </p>

                <!-- Social Media Icons -->
                <?php
                $socials = array(
                    'vpp_social_instagram' => array( 'label' => 'Instagram', 'svg' => '<svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>' ),
                    'vpp_social_twitter'   => array( 'label' => 'X / Twitter', 'svg' => '<svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>' ),
                    'vpp_social_linkedin'  => array( 'label' => 'LinkedIn', 'svg' => '<svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>' ),
                    'vpp_social_facebook'  => array( 'label' => 'Facebook', 'svg' => '<svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>' ),
                    'vpp_social_telegram'  => array( 'label' => 'Telegram', 'svg' => '<svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 000 12a12 12 0 0012 12 12 12 0 0012-12A12 12 0 0012 0a12 12 0 00-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 01.171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.479.33-.913.492-1.302.48-.428-.012-1.252-.242-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>' ),
                    'vpp_social_email'     => array( 'label' => 'Email', 'svg' => '<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>' ),
                );
                $has_social = false;
                foreach ( $socials as $key => $s ) {
                    if ( get_theme_mod( $key ) ) { $has_social = true; break; }
                }
                if ( $has_social ) : ?>
                <div class="footer__social" style="display:flex;gap:12px;margin-top:20px;">
                    <?php foreach ( $socials as $key => $s ) :
                        $url = get_theme_mod( $key );
                        if ( ! $url ) continue;
                        $href = ( $key === 'vpp_social_email' ) ? 'mailto:' . esc_attr( $url ) : esc_url( $url );
                    ?>
                    <a href="<?php echo $href; ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $s['label'] ); ?>" style="color:var(--vp-gray-400);transition:color 0.2s;" onmouseover="this.style.color='var(--vp-accent-light)'" onmouseout="this.style.color='var(--vp-gray-400)'"><?php echo $s['svg']; ?></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Compliance Block -->
                <div class="footer__compliance">
                    <div class="footer__compliance-title">Regulatory Compliance</div>
                    <div class="footer__compliance-items">
                        <div class="footer__compliance-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span><?php echo vpp_text( 'vpp_research_disclaimer', 'For laboratory research use only' ); ?></span>
                        </div>
                        <div class="footer__compliance-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                            <span><?php echo vpp_text( 'vpp_handling_disclaimer', 'Proper handling protocols required' ); ?></span>
                        </div>
                        <div class="footer__compliance-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span><?php echo vpp_text( 'vpp_coa_disclaimer', 'COA documentation available per batch' ); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Nav: Resources -->
            <div>
                <h4 class="footer__column-title">Research Resources</h4>
                <?php
                if ( has_nav_menu( 'footer_resources' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer_resources',
                        'container'      => false,
                        'items_wrap'     => '<div class="footer__links">%3$s</div>',
                        'depth'          => 1,
                        'link_before'    => '',
                        'link_after'     => '',
                        'walker'         => new VPP_Footer_Walker(),
                    ) );
                } else { ?>
                <div class="footer__links">
                    <a href="<?php echo esc_url( home_url( '/flexpens/' ) ); ?>" class="footer__link">FlexPen Catalog</a>
                    <a href="<?php echo esc_url( home_url( '/coa-reports/' ) ); ?>" class="footer__link">COA Lab Reports</a>
                    <a href="<?php echo esc_url( home_url( '/calculator/' ) ); ?>" class="footer__link">Dosage Calculator</a>
                    <a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" class="footer__link">FAQ</a>
                </div>
                <?php } ?>
            </div>

            <!-- Footer Nav: Company -->
            <div>
                <h4 class="footer__column-title">Company</h4>
                <?php
                if ( has_nav_menu( 'footer_company' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer_company',
                        'container'      => false,
                        'items_wrap'     => '<div class="footer__links">%3$s</div>',
                        'depth'          => 1,
                        'walker'         => new VPP_Footer_Walker(),
                    ) );
                } else { ?>
                <div class="footer__links">
                    <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="footer__link">About Us</a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="footer__link">Contact</a>
                </div>
                <?php } ?>
            </div>

            <!-- Footer Nav: Legal -->
            <div>
                <h4 class="footer__column-title">Legal</h4>
                <?php
                if ( has_nav_menu( 'footer_legal' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer_legal',
                        'container'      => false,
                        'items_wrap'     => '<div class="footer__links">%3$s</div>',
                        'depth'          => 1,
                        'walker'         => new VPP_Footer_Walker(),
                    ) );
                } else { ?>
                <div class="footer__links">
                    <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="footer__link">Privacy Policy</a>
                    <a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>" class="footer__link">Terms &amp; Conditions</a>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer__bottom">
            <span class="footer__copyright">&copy; <?php echo date( 'Y' ); ?> <?php echo vpp_text( 'vpp_footer_copyright', 'VitalPep Pro Pharmaceuticals B.V. — The Netherlands' ); ?></span>
            <div class="footer__badges">
                <span class="footer__badge">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <?php echo vpp_text( 'vpp_footer_badge_1', 'SSL Encrypted' ); ?>
                </span>
                <span class="footer__badge">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <?php echo vpp_text( 'vpp_footer_badge_2', 'cGMP Certified' ); ?>
                </span>
                <span class="footer__badge">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <?php echo vpp_text( 'vpp_footer_badge_3', 'EU Manufactured' ); ?>
                </span>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
(function () {
    var gate = document.getElementById('ageGate');
    if (!gate) return;
    if (sessionStorage.getItem('vpp_age_ok') === '1') { gate.classList.add('hidden'); return; }
    var daySelect = document.getElementById('ag-day');
    for (var d = 1; d <= 31; d++) { var o = document.createElement('option'); o.value = d; o.textContent = d; daySelect.appendChild(o); }
    var yearSelect = document.getElementById('ag-year');
    var cy = new Date().getFullYear();
    for (var y = cy; y >= cy - 100; y--) { var o2 = document.createElement('option'); o2.value = y; o2.textContent = y; yearSelect.appendChild(o2); }
    document.getElementById('ag-submit').addEventListener('click', function () {
        var month = parseInt(document.getElementById('ag-month').value, 10);
        var day   = parseInt(document.getElementById('ag-day').value, 10);
        var year  = parseInt(document.getElementById('ag-year').value, 10);
        var errEl = document.getElementById('ag-error');
        var errMsg = document.getElementById('ag-error-msg');
        if (!month || !day || !year) { errMsg.textContent = 'Please select your complete date of birth.'; errEl.classList.add('visible'); return; }
        var dob = new Date(year, month - 1, day);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) age--;
        if (isNaN(age) || age < 0 || year < 1900) { errMsg.textContent = 'Please enter a valid date of birth.'; errEl.classList.add('visible'); return; }
        if (age < 21) { errMsg.textContent = 'You must be 21 or older to access this site.'; errEl.classList.add('visible'); return; }
        sessionStorage.setItem('vpp_age_ok', '1');
        gate.style.transition = 'opacity 0.5s ease';
        gate.style.opacity = '0';
        setTimeout(function () { gate.classList.add('hidden'); }, 500);
    });
})();
</script>
</body>
</html>
