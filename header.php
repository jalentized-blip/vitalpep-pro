<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="VitalPep Pro Pharmaceuticals - Precision-engineered FlexPen research compounds manufactured in the Netherlands. cGMP certified, third-party lab tested.">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Age Gate -->
<div id="ageGate">
    <div class="age-gate__card">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/vpp-logo.png' ); ?>" alt="VitalPep Pro" class="age-gate__logo">
        <div class="age-gate__badge">
            <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            <?php echo vpp_text( 'vpp_age_gate_badge', 'Age Verification Required' ); ?>
        </div>
        <h2 class="age-gate__title"><?php echo vpp_text( 'vpp_age_gate_title_1', 'You Must Be' ); ?> <span><?php echo vpp_text( 'vpp_age_gate_title_highlight', '21+' ); ?></span><br><?php echo vpp_text( 'vpp_age_gate_title_2', 'To Enter' ); ?></h2>
        <p class="age-gate__sub"><?php echo vpp_textarea( 'vpp_age_gate_subtitle', 'VitalPep Pro research compounds are intended exclusively for adults aged 21 and older. Please confirm your date of birth to proceed.' ); ?></p>
        <div class="age-gate__divider"></div>
        <div class="age-gate__dob-label"><?php echo vpp_text( 'vpp_age_gate_dob_label', 'Date of Birth' ); ?></div>
        <div class="age-gate__dob-row">
            <select class="age-gate__select" id="ag-month" aria-label="Month">
                <option value="">Month</option>
                <option value="1">January</option><option value="2">February</option><option value="3">March</option>
                <option value="4">April</option><option value="5">May</option><option value="6">June</option>
                <option value="7">July</option><option value="8">August</option><option value="9">September</option>
                <option value="10">October</option><option value="11">November</option><option value="12">December</option>
            </select>
            <select class="age-gate__select" id="ag-day" aria-label="Day">
                <option value="">Day</option>
            </select>
            <select class="age-gate__select" id="ag-year" aria-label="Year">
                <option value="">Year</option>
            </select>
        </div>
        <div class="age-gate__error" id="ag-error">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span id="ag-error-msg">You must be 21 or older to access this site.</span>
        </div>
        <button class="age-gate__btn" id="ag-submit"><?php echo vpp_text( 'vpp_age_gate_btn', 'Verify Age & Enter' ); ?></button>
        <p class="age-gate__disclaimer"><?php echo vpp_textarea( 'vpp_age_gate_disclaimer', 'By entering this site you agree that you are 21 years of age or older and that research compounds are for laboratory use only. This site does not sell products for human consumption.' ); ?></p>
    </div>
</div>

<!-- Site Header -->
<header class="site-header" id="siteHeader">
    <div class="header-inner">
        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="VitalPep Pro Home">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/vpp-logo.png' ); ?>" alt="VitalPep Pro" class="site-logo__img">
        </a>

        <!-- Navigation -->
        <nav class="main-nav" id="mainNav" aria-label="Primary Navigation">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new VitalPep_Nav_Walker(),
                ) );
            } else {
                // Fallback navigation
                ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="main-nav__link main-nav__link--active">Home</a>
                <a href="<?php echo esc_url( home_url( '/flexpens/' ) ); ?>" class="main-nav__link">FlexPens</a>
                <a href="<?php echo esc_url( home_url( '/coa-reports/' ) ); ?>" class="main-nav__link">COA Reports</a>
                <a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" class="main-nav__link">FAQ</a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="main-nav__link main-nav__link--cta">Submit Inquiry</a>
                <?php
            }
            ?>
        </nav>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle Navigation" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<main id="main-content">
