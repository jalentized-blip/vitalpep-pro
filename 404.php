<?php
/**
 * 404 Page Template
 *
 * @package VitalPep_Pro
 */

get_header();
?>

<section class="page-hero">
    <div class="hex-overlay"></div>
    <div class="container">
        <h1 class="page-hero__title">404 &mdash; Page Not Found</h1>
        <p class="page-hero__subtitle">The compound you're looking for doesn't exist in our repository.</p>
    </div>
</section>

<section class="section section--light">
    <div class="container" style="text-align: center; padding: 80px 0;">
        <svg width="80" height="80" fill="none" stroke="var(--vp-gray-300)" viewBox="0 0 24 24" style="margin: 0 auto 24px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
        <h2 style="font-size: 1.5rem; color: var(--vp-gray-700); margin-bottom: 16px;">Compound Not Found</h2>
        <p style="color: var(--vp-gray-500); max-width: 400px; margin: 0 auto 32px;">The page you are looking for may have been moved, removed, or is temporarily unavailable.</p>
        <div style="display: flex; gap: 16px; justify-content: center;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                Return Home
            </a>
            <a href="<?php echo esc_url( home_url( '/flexpens/' ) ); ?>" class="btn btn--outline">
                Browse FlexPens
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
