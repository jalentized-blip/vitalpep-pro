<?php
/*
 * Template Name: Dosage Calculator
 * Template Post Type: page
 */
get_header();
$pen_img = esc_url( get_template_directory_uri() . '/assets/images/dialpenforcalculator.png' );
?>

<style>
/* =====================================================================
   DOSAGE CALCULATOR PAGE
   ===================================================================== */
.calc-page {
    min-height: 100vh;
    background: var(--vp-navy);
    padding: 60px 0 100px;
    position: relative;
    overflow: hidden;
}
.calc-page::before {
    content: '';
    position: absolute;
    top: -200px; right: -200px;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(139,92,246,0.12) 0%, transparent 70%);
    pointer-events: none;
}
.calc-page::after {
    content: '';
    position: absolute;
    bottom: -200px; left: -200px;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%);
    pointer-events: none;
}

/* --- Page header --- */
.calc-header {
    text-align: center;
    margin-bottom: 56px;
}
.calc-header__badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(139,92,246,0.15);
    border: 1px solid rgba(139,92,246,0.35);
    border-radius: 100px;
    padding: 6px 18px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--vp-accent-light);
    margin-bottom: 20px;
}
.calc-header__title {
    font-size: clamp(2rem, 4vw, 3.2rem);
    font-weight: 800;
    color: var(--vp-white);
    line-height: 1.1;
    margin-bottom: 16px;
}
.calc-header__title span {
    background: linear-gradient(135deg, #a78bfa 0%, #60a5fa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.calc-header__sub {
    color: var(--vp-gray-400);
    font-size: 1rem;
    max-width: 520px;
    margin: 0 auto;
    line-height: 1.6;
}

/* --- Main grid --- */
/* Two-column: pen left (~60%), controls right (~40%) */
.calc-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 48px;
    align-items: start;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

/* --- Pen column --- */
.calc-pen-col {
    position: sticky;
    top: 100px;
}
.calc-pen-stage {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 24px 12px 16px;
}
.calc-pen-glow {
    position: absolute;
    inset: 0;
    border-radius: 32px;
    background: radial-gradient(ellipse at 50% 50%, rgba(139,92,246,0.15) 0%, transparent 70%);
    pointer-events: none;
}
.calc-pen-img-wrap {
    position: relative;
    display: block;
    width: 100%;
    filter: drop-shadow(0 20px 40px rgba(0,0,0,0.55));
    transition: transform 0.4s ease;
}
.calc-pen-img-wrap:hover {
    transform: scale(1.01);
}

/* Canvas fills pen column width */
#penCanvas {
    width: 100%;
    display: block;
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
}

/* --- Controls column --- */
.calc-panel {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

/* --- Pen info strip --- */
.calc-pen-info {
    display: flex;
    justify-content: center;
    gap: 24px;
    margin-top: 24px;
}
.calc-pen-info__item {
    text-align: center;
}
.calc-pen-info__val {
    display: block;
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--vp-white);
}
.calc-pen-info__key {
    display: block;
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--vp-gray-400);
    margin-top: 2px;
}

/* Product selector */
.calc-section-label {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--vp-accent-light);
    margin-bottom: 12px;
}
.calc-products {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.calc-product-card {
    background: rgba(255,255,255,0.04);
    border: 2px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 14px 16px;
    cursor: pointer;
    transition: all 0.2s;
    position: relative;
    overflow: hidden;
}
.calc-product-card::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 0.2s;
    border-radius: 12px;
}
.calc-product-card[data-color="purple"]::before { background: linear-gradient(135deg, rgba(139,92,246,0.15), transparent); }
.calc-product-card[data-color="blue"]::before   { background: linear-gradient(135deg, rgba(59,130,246,0.15), transparent); }
.calc-product-card[data-color="amber"]::before  { background: linear-gradient(135deg, rgba(245,158,11,0.15), transparent); }
.calc-product-card[data-color="green"]::before  { background: linear-gradient(135deg, rgba(16,185,129,0.15), transparent); }
.calc-product-card[data-color="teal"]::before   { background: linear-gradient(135deg, rgba(20,184,166,0.15), transparent); }
.calc-product-card[data-color="rose"]::before   { background: linear-gradient(135deg, rgba(244,63,94,0.15), transparent); }
.calc-product-card:hover,
.calc-product-card.selected {
    border-color: transparent;
    transform: translateY(-2px);
}
.calc-product-card:hover::before,
.calc-product-card.selected::before { opacity: 1; }
.calc-product-card[data-color="purple"]:hover,
.calc-product-card[data-color="purple"].selected { border-color: rgba(139,92,246,0.6); box-shadow: 0 0 20px rgba(139,92,246,0.2); }
.calc-product-card[data-color="blue"]:hover,
.calc-product-card[data-color="blue"].selected   { border-color: rgba(59,130,246,0.6);  box-shadow: 0 0 20px rgba(59,130,246,0.2); }
.calc-product-card[data-color="amber"]:hover,
.calc-product-card[data-color="amber"].selected  { border-color: rgba(245,158,11,0.6);  box-shadow: 0 0 20px rgba(245,158,11,0.2); }
.calc-product-card[data-color="green"]:hover,
.calc-product-card[data-color="green"].selected  { border-color: rgba(16,185,129,0.6);  box-shadow: 0 0 20px rgba(16,185,129,0.2); }
.calc-product-card[data-color="teal"]:hover,
.calc-product-card[data-color="teal"].selected   { border-color: rgba(20,184,166,0.6);  box-shadow: 0 0 20px rgba(20,184,166,0.2); }
.calc-product-card[data-color="rose"]:hover,
.calc-product-card[data-color="rose"].selected   { border-color: rgba(244,63,94,0.6);   box-shadow: 0 0 20px rgba(244,63,94,0.2);  }
.calc-product-card__dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
    vertical-align: middle;
}
.calc-product-card[data-color="purple"] .calc-product-card__dot { background: #8b5cf6; }
.calc-product-card[data-color="blue"]   .calc-product-card__dot { background: #3b82f6; }
.calc-product-card[data-color="amber"]  .calc-product-card__dot { background: #f59e0b; }
.calc-product-card[data-color="green"]  .calc-product-card__dot { background: #10b981; }
.calc-product-card[data-color="teal"]   .calc-product-card__dot { background: #14b8a6; }
.calc-product-card[data-color="rose"]   .calc-product-card__dot { background: #f43f5e; }
.calc-product-card__name {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--vp-white);
}
.calc-product-card__conc {
    font-size: 0.72rem;
    color: var(--vp-gray-400);
    margin-top: 4px;
    display: block;
}
.calc-product-card__check {
    position: absolute;
    top: 10px; right: 10px;
    width: 20px; height: 20px;
    border-radius: 50%;
    background: #8b5cf6;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transform: scale(0.5);
    transition: all 0.2s;
}
.calc-product-card.selected .calc-product-card__check { opacity: 1; transform: scale(1); }
.calc-product-card__check svg { width: 11px; height: 11px; }

/* Input row */
.calc-input-block {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 20px 24px;
}
.calc-input-row {
    display: flex;
    gap: 12px;
    align-items: stretch;
}
.calc-input-wrap {
    flex: 1;
    position: relative;
}
.calc-input-wrap label {
    display: block;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--vp-gray-400);
    margin-bottom: 8px;
}
.calc-input {
    width: 100%;
    background: rgba(255,255,255,0.06);
    border: 1.5px solid rgba(255,255,255,0.12);
    border-radius: 10px;
    padding: 14px 16px;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--vp-white);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    -moz-appearance: textfield;
    box-sizing: border-box;
}
.calc-input::-webkit-outer-spin-button,
.calc-input::-webkit-inner-spin-button { -webkit-appearance: none; }
.calc-input:focus {
    border-color: rgba(139,92,246,0.7);
    box-shadow: 0 0 0 3px rgba(139,92,246,0.15);
}
.calc-unit-toggle {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}
.calc-unit-toggle label {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--vp-gray-400);
    margin-bottom: 8px;
    display: block;
}
.calc-toggle-btns {
    display: flex;
    background: rgba(255,255,255,0.06);
    border: 1.5px solid rgba(255,255,255,0.12);
    border-radius: 10px;
    overflow: hidden;
    height: 52px;
}
.calc-toggle-btn {
    flex: 1;
    background: none;
    border: none;
    color: var(--vp-gray-400);
    font-size: 0.85rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    padding: 0 14px;
}
.calc-toggle-btn.active {
    background: rgba(139,92,246,0.3);
    color: #c4b5fd;
}

/* Results card */
.calc-results {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 24px;
    opacity: 0;
    transform: translateY(12px);
    transition: all 0.35s ease;
    pointer-events: none;
}
.calc-results.visible {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

/* Big units display */
.calc-units-display {
    display: flex;
    align-items: baseline;
    gap: 12px;
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}
.calc-units-display__num {
    font-size: clamp(2.5rem, 8vw, 4rem);
    font-weight: 900;
    font-family: 'Courier New', monospace;
    line-height: 1;
    background: linear-gradient(135deg, #a78bfa, #60a5fa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    min-width: 0;
}
.calc-units-display__label {
    font-size: 1rem;
    font-weight: 600;
    color: var(--vp-gray-400);
    line-height: 1.3;
}
.calc-units-display__label strong {
    display: block;
    font-size: 1.3rem;
    color: var(--vp-white);
}

/* Stats grid */
.calc-stats {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 12px;
    margin-bottom: 20px;
}
.calc-stat {
    background: rgba(255,255,255,0.04);
    border-radius: 10px;
    padding: 12px 14px;
    text-align: center;
}
.calc-stat__val {
    display: block;
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--vp-white);
}
.calc-stat__key {
    display: block;
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--vp-gray-400);
    margin-top: 3px;
}

/* Pen usage bar */
.calc-usage-wrap {
    margin-bottom: 20px;
}
.calc-usage-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}
.calc-usage-header span {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--vp-gray-400);
}
.calc-usage-header strong {
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--vp-white);
}
.calc-usage-track {
    height: 8px;
    background: rgba(255,255,255,0.08);
    border-radius: 4px;
    overflow: hidden;
}
.calc-usage-fill {
    height: 100%;
    border-radius: 4px;
    background: linear-gradient(90deg, #7c3aed, #a78bfa);
    transition: width 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    width: 0%;
}

/* Frequency selector block */
.calc-freq-block {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 20px 24px;
}
.calc-freq-grid {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 8px;
    margin-bottom: 18px;
}
.calc-freq-btn {
    background: rgba(255,255,255,0.05);
    border: 1.5px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 10px 4px;
    cursor: pointer;
    text-align: center;
    transition: all 0.2s;
    color: var(--vp-gray-400);
    min-width: 0;
}
.calc-freq-btn__label {
    display: block;
    font-size: 0.75rem;
    font-weight: 700;
    color: inherit;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.calc-freq-btn__sub {
    display: block;
    font-size: 0.58rem;
    margin-top: 3px;
    color: inherit;
    opacity: 0.7;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.calc-freq-btn:hover,
.calc-freq-btn.active {
    border-color: rgba(139,92,246,0.6);
    background: rgba(139,92,246,0.15);
    color: #c4b5fd;
}

/* Day-of-week dots */
.calc-day-dots {
    display: flex;
    justify-content: space-between;
    gap: 2px;
}
.calc-day-dot {
    flex: 1;
    text-align: center;
    min-width: 0;
}
.calc-day-dot__circle {
    width: clamp(22px, 4vw, 30px);
    height: clamp(22px, 4vw, 30px);
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    border: 1.5px solid rgba(255,255,255,0.1);
    margin: 0 auto 5px;
    transition: all 0.25s;
}
.calc-day-dot.active .calc-day-dot__circle {
    background: rgba(139,92,246,0.45);
    border-color: rgba(139,92,246,0.8);
    box-shadow: 0 0 10px rgba(139,92,246,0.35);
}
.calc-day-dot__name {
    font-size: 0.58rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: var(--vp-gray-400);
    transition: color 0.25s;
}
.calc-day-dot.active .calc-day-dot__name {
    color: #c4b5fd;
}

/* Schedule results */
.calc-schedule {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.calc-schedule__item {
    background: rgba(139,92,246,0.08);
    border: 1px solid rgba(139,92,246,0.2);
    border-radius: 10px;
    padding: 12px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.calc-schedule__icon {
    width: 34px; height: 34px;
    border-radius: 8px;
    background: rgba(139,92,246,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1rem;
}
.calc-schedule__text strong {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--vp-white);
}
.calc-schedule__text span {
    font-size: 0.7rem;
    color: var(--vp-gray-400);
}
.calc-freq-note {
    font-size: 0.7rem;
    color: var(--vp-gray-400);
    text-align: center;
    margin-top: 10px;
    font-style: italic;
}

/* Warning */
.calc-warning {
    background: rgba(245,158,11,0.1);
    border: 1px solid rgba(245,158,11,0.3);
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 0.78rem;
    color: #fcd34d;
    line-height: 1.5;
    margin-top: 16px;
    display: none;
}
.calc-warning.show { display: block; }

/* CTA strip */
.calc-cta-strip {
    background: linear-gradient(135deg, rgba(139,92,246,0.15), rgba(59,130,246,0.15));
    border: 1px solid rgba(139,92,246,0.25);
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    margin-top: 8px;
}
.calc-cta-strip p {
    color: var(--vp-gray-300);
    font-size: 0.88rem;
    margin-bottom: 16px;
    line-height: 1.5;
}
.calc-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #7c3aed, #4f46e5);
    color: #fff;
    text-decoration: none;
    padding: 14px 32px;
    border-radius: 100px;
    font-size: 0.88rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    transition: all 0.2s;
    box-shadow: 0 8px 24px rgba(124,58,237,0.35);
}
.calc-cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(124,58,237,0.5);
    color: #fff;
    text-decoration: none;
}

/* Placeholder state */
.calc-placeholder {
    text-align: center;
    padding: 32px 16px;
    color: var(--vp-gray-400);
    font-size: 0.88rem;
    line-height: 1.6;
}
.calc-placeholder .calc-placeholder__icon {
    font-size: 2.5rem;
    margin-bottom: 12px;
    display: block;
}

/* Responsive */
@media (max-width: 960px) {
    .calc-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    .calc-pen-col { position: static; }
    .calc-pen-stage { padding: 20px 12px; }
    #penCanvas { max-width: 600px; margin: 0 auto; }
    .calc-stats { grid-template-columns: 1fr 1fr; }
    .calc-page::before { width: 300px; height: 300px; right: -100px; top: -100px; }
    .calc-page::after  { width: 250px; height: 250px; left: -100px; bottom: -100px; }
}
@media (max-width: 580px) {
    .calc-products { grid-template-columns: 1fr; }
    .calc-input-row { flex-direction: column; }
    .calc-schedule { grid-template-columns: 1fr; }
    .calc-units-display__num { font-size: 3rem; }
    .calc-stats { grid-template-columns: 1fr 1fr; }
    .calc-input-block { padding: 16px; }
    .calc-freq-block { padding: 16px; }
    .calc-header { margin-bottom: 32px; }
    .calc-page { padding: 40px 0 60px; }
    .calc-pen-info { flex-wrap: wrap; gap: 16px; }
    .calc-results { padding: 16px; }
}
@media (max-width: 400px) {
    .calc-freq-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .calc-freq-btn__sub { display: none; }
    .calc-stats { grid-template-columns: 1fr; }
}
</style>

<main class="calc-page">
    <div class="container">

        <!-- Header -->
        <div class="calc-header">
            <div class="calc-header__badge">
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <?php echo vpp_text( 'vpp_calc_badge', 'Precision Research Dosing Tool' ); ?>
            </div>
            <h1 class="calc-header__title"><?php echo vpp_text( 'vpp_calc_title_1', 'FlexPen' ); ?> <span><?php echo vpp_text( 'vpp_calc_title_2', 'Dosage Calculator' ); ?></span></h1>
            <p class="calc-header__sub"><?php echo vpp_textarea( 'vpp_calc_subtitle', 'Select your compound, enter your target dose, and instantly see the exact dial setting on your VitalPep Pro FlexPen.' ); ?></p>
        </div>

        <!-- Grid -->
        <div class="calc-grid">

            <!-- Left: Pen Visual -->
            <div class="calc-pen-col">
                <div class="calc-pen-stage">
                    <div class="calc-pen-glow"></div>
                    <div class="calc-pen-img-wrap" id="penWrap">
                        <!-- Canvas renders the pen + animates the dial as one image -->
                        <canvas id="penCanvas" aria-label="VitalPep Pro FlexPen dosage dial"></canvas>
                    </div>
                </div>
                <div class="calc-pen-info">
                    <div class="calc-pen-info__item">
                        <span class="calc-pen-info__val" id="infoTotal">–</span>
                        <span class="calc-pen-info__key">Total Content</span>
                    </div>
                    <div class="calc-pen-info__item">
                        <span class="calc-pen-info__val">3 ml</span>
                        <span class="calc-pen-info__key">Pen Volume</span>
                    </div>
                    <div class="calc-pen-info__item">
                        <span class="calc-pen-info__val" id="infoConc">–</span>
                        <span class="calc-pen-info__key">Concentration</span>
                    </div>
                </div>
            </div><!-- .calc-pen-col -->

            <!-- Right: Calculator controls -->
            <div class="calc-panel">

                <!-- Product selection -->
                <div>
                    <div class="calc-section-label">01 — Select Compound</div>
                    <!-- Products are rendered by the PRODUCTS config in the script below -->
                    <div class="calc-products" id="productGrid"></div>
                </div>

                <!-- Dose input -->
                <div class="calc-input-block">
                    <div class="calc-section-label">02 — Enter Target Dose</div>
                    <div class="calc-input-row">
                        <div class="calc-input-wrap">
                            <label for="doseInput">Desired Dose</label>
                            <input type="number" id="doseInput" class="calc-input" placeholder="0" min="0" step="any">
                        </div>
                        <div class="calc-unit-toggle">
                            <label>Unit</label>
                            <div class="calc-toggle-btns">
                                <button class="calc-toggle-btn active" data-unit="mcg">mcg</button>
                                <button class="calc-toggle-btn" data-unit="mg">mg</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dosing frequency -->
                <div class="calc-freq-block">
                    <div class="calc-section-label">03 — Dosing Schedule</div>
                    <div class="calc-freq-grid" id="freqGrid">
                        <button class="calc-freq-btn" data-freq="daily" data-dpw="7">
                            <span class="calc-freq-btn__label">Daily</span>
                            <span class="calc-freq-btn__sub">7× / week</span>
                        </button>
                        <button class="calc-freq-btn" data-freq="eod" data-dpw="3.5">
                            <span class="calc-freq-btn__label">EOD</span>
                            <span class="calc-freq-btn__sub">Every other day</span>
                        </button>
                        <button class="calc-freq-btn" data-freq="3pw" data-dpw="3">
                            <span class="calc-freq-btn__label">3× / Wk</span>
                            <span class="calc-freq-btn__sub">Mon · Wed · Fri</span>
                        </button>
                        <button class="calc-freq-btn" data-freq="2pw" data-dpw="2">
                            <span class="calc-freq-btn__label">2× / Wk</span>
                            <span class="calc-freq-btn__sub">Tue · Fri</span>
                        </button>
                        <button class="calc-freq-btn active" data-freq="weekly" data-dpw="1">
                            <span class="calc-freq-btn__label">Weekly</span>
                            <span class="calc-freq-btn__sub">Once / week</span>
                        </button>
                    </div>
                    <div class="calc-day-dots" id="dayDots">
                        <div class="calc-day-dot" data-day="0"><div class="calc-day-dot__circle"></div><div class="calc-day-dot__name">Mon</div></div>
                        <div class="calc-day-dot" data-day="1"><div class="calc-day-dot__circle"></div><div class="calc-day-dot__name">Tue</div></div>
                        <div class="calc-day-dot" data-day="2"><div class="calc-day-dot__circle"></div><div class="calc-day-dot__name">Wed</div></div>
                        <div class="calc-day-dot" data-day="3"><div class="calc-day-dot__circle"></div><div class="calc-day-dot__name">Thu</div></div>
                        <div class="calc-day-dot" data-day="4"><div class="calc-day-dot__circle"></div><div class="calc-day-dot__name">Fri</div></div>
                        <div class="calc-day-dot" data-day="5"><div class="calc-day-dot__circle"></div><div class="calc-day-dot__name">Sat</div></div>
                        <div class="calc-day-dot" data-day="6"><div class="calc-day-dot__circle"></div><div class="calc-day-dot__name">Sun</div></div>
                    </div>
                    <div class="calc-freq-note" id="freqNote"></div>
                </div>

                <!-- Results -->
                <div class="calc-results" id="calcResults">
                    <div class="calc-placeholder" id="calcPlaceholder">
                        <span class="calc-placeholder__icon">🔬</span>
                        Select a compound and enter your dose above to calculate your dial setting.
                    </div>
                    <div id="calcOutput" style="display:none;">
                        <!-- Units display -->
                        <div class="calc-units-display">
                            <div class="calc-units-display__num" id="outputUnits">0</div>
                            <div class="calc-units-display__label">
                                <strong>Units to Dial</strong>
                                on your FlexPen
                            </div>
                        </div>
                        <!-- Stats -->
                        <div class="calc-stats">
                            <div class="calc-stat">
                                <span class="calc-stat__val" id="statVol">–</span>
                                <span class="calc-stat__key">Volume (ml)</span>
                            </div>
                            <div class="calc-stat">
                                <span class="calc-stat__val" id="statDose">–</span>
                                <span class="calc-stat__key">Actual Dose</span>
                            </div>
                            <div class="calc-stat">
                                <span class="calc-stat__val" id="statDoses">–</span>
                                <span class="calc-stat__key">Doses/Pen</span>
                            </div>
                        </div>
                        <!-- Usage bar -->
                        <div class="calc-usage-wrap">
                            <div class="calc-usage-header">
                                <span>Pen Volume Used Per Dose</span>
                                <strong id="usagePct">0%</strong>
                            </div>
                            <div class="calc-usage-track">
                                <div class="calc-usage-fill" id="usageFill"></div>
                            </div>
                        </div>
                        <!-- Schedule -->
                        <div class="calc-schedule">
                            <div class="calc-schedule__item">
                                <div class="calc-schedule__icon">💉</div>
                                <div class="calc-schedule__text">
                                    <strong id="schedPerDose">–</strong>
                                    <span id="schedPerDoseLabel">Per injection</span>
                                </div>
                            </div>
                            <div class="calc-schedule__item">
                                <div class="calc-schedule__icon">📅</div>
                                <div class="calc-schedule__text">
                                    <strong id="schedWeekly">–</strong>
                                    <span>Weekly total</span>
                                </div>
                            </div>
                            <div class="calc-schedule__item">
                                <div class="calc-schedule__icon">🗓️</div>
                                <div class="calc-schedule__text">
                                    <strong id="schedPenDuration">–</strong>
                                    <span>Pen duration</span>
                                </div>
                            </div>
                            <div class="calc-schedule__item">
                                <div class="calc-schedule__icon">📦</div>
                                <div class="calc-schedule__text">
                                    <strong id="schedMonthly">–</strong>
                                    <span>Monthly total</span>
                                </div>
                            </div>
                        </div>
                        <!-- Warning -->
                        <div class="calc-warning" id="calcWarning">
                            ⚠️ <strong>Note:</strong> The entered dose exceeds the typical research range for this compound. Please verify dosing parameters before proceeding.
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="calc-cta-strip">
                    <p><?php echo vpp_textarea( 'vpp_calc_cta', 'Questions about dosing protocols? Our team is available to discuss research parameters and compound specifications.' ); ?></p>
                    <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="calc-cta-btn">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        Submit Research Inquiry
                    </a>
                </div>

            </div><!-- .calc-panel -->
        </div><!-- .calc-grid -->
    </div><!-- .container -->
</main>

<script>
(function() {
    /* ================================================================
       PRODUCT CONFIG — add new pens here.
       Fields:
         name      Display name on the card
         mg        Total mg in the cartridge
         ml        Cartridge volume in ml
         unit      Default dose unit shown to user: 'mg' or 'mcg'
         maxDose   Max typical research dose (in the above unit) — triggers warning above this
         freq      Default dosing frequency key: 'daily'|'eod'|'3pw'|'2pw'|'weekly'
         color     Card accent colour: 'purple'|'blue'|'amber'|'green'|'teal'|'rose'
       ================================================================ */
    var PRODUCTS = <?php
    $calc_posts = get_posts( array(
        'post_type'      => 'vp_flexpen',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
        'meta_query'     => array( array( 'key' => '_vpp_fp_show_in_calc', 'value' => '1' ) ),
    ) );
    $calc_products = array();
    foreach ( $calc_posts as $cp ) {
        $g  = function( $k ) use ( $cp ) { return get_post_meta( $cp->ID, $k, true ); };
        $mg = floatval( $g('_vpp_fp_calc_mg') ) ?: floatval( preg_replace('/[^0-9.]/', '', $g('_vpp_fp_total') ) );
        $calc_products[] = array(
            'name'    => get_the_title( $cp ),
            'mg'      => $mg,
            'ml'      => floatval( $g('_vpp_fp_calc_ml') ) ?: 3,
            'unit'    => $g('_vpp_fp_calc_unit') ?: 'mg',
            'maxDose' => floatval( $g('_vpp_fp_calc_maxdose') ),
            'freq'    => $g('_vpp_fp_calc_freq') ?: 'weekly',
            'color'   => $g('_vpp_fp_calc_color') ?: 'blue',
        );
    }
    echo json_encode( $calc_products );
    ?>;

    /* Render product cards from PRODUCTS config */
    (function renderProducts() {
        var CHECK_SVG = '<svg fill="none" stroke="#fff" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>';
        var grid = document.getElementById('productGrid');
        PRODUCTS.forEach(function(p) {
            var concMgMl = (p.mg / p.ml);
            var concStr  = concMgMl % 1 === 0
                ? concMgMl + ' mg/ml'
                : concMgMl.toFixed(2).replace(/\.?0+$/, '') + ' mg/ml';
            var card = document.createElement('div');
            card.className = 'calc-product-card';
            card.setAttribute('data-color',    p.color);
            card.setAttribute('data-name',     p.name);
            card.setAttribute('data-mg',       p.mg);
            card.setAttribute('data-ml',       p.ml);
            card.setAttribute('data-unit',     p.unit);
            card.setAttribute('data-max-dose', p.maxDose);
            card.setAttribute('data-freq',     p.freq);
            card.innerHTML = [
                '<div class="calc-product-card__check">' + CHECK_SVG + '</div>',
                '<div><span class="calc-product-card__dot"></span>',
                '<span class="calc-product-card__name">' + p.name + '</span></div>',
                '<span class="calc-product-card__conc">' + p.mg + ' mg / ' + p.ml + ' ml · ' + concStr + '</span>',
            ].join('');
            grid.appendChild(card);
        });
    })();

    var selectedProduct = null;
    var inputUnit = 'mcg';

    /* Frequency state — daysPerWeek drives all schedule maths */
    var FREQS = {
        'daily':  { dpw: 7,   days: [0,1,2,3,4,5,6], note: 'Injected every day' },
        'eod':    { dpw: 3.5, days: [0,2,4,6],        note: 'Every other day — alternating days' },
        '3pw':    { dpw: 3,   days: [0,2,4],           note: 'Mon · Wed · Fri protocol' },
        '2pw':    { dpw: 2,   days: [1,4],             note: 'Tue · Fri protocol' },
        'weekly': { dpw: 1,   days: [0],               note: 'Once per week — common for peptides like Retatrutide' },
    };
    var currentFreqKey = 'weekly';

    /* ---- Frequency buttons ---- */
    document.querySelectorAll('.calc-freq-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.calc-freq-btn').forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            currentFreqKey = this.dataset.freq;
            updateDayDots(currentFreqKey);
            calculate();
        });
    });

    function setFreq(key) {
        currentFreqKey = key in FREQS ? key : 'daily';
        document.querySelectorAll('.calc-freq-btn').forEach(function(b) {
            b.classList.toggle('active', b.dataset.freq === currentFreqKey);
        });
        updateDayDots(currentFreqKey);
    }

    function updateDayDots(key) {
        var activeDays = FREQS[key] ? FREQS[key].days : [];
        document.querySelectorAll('.calc-day-dot').forEach(function(dot) {
            dot.classList.toggle('active', activeDays.indexOf(parseInt(dot.dataset.day)) !== -1);
        });
        var note = FREQS[key] ? FREQS[key].note : '';
        document.getElementById('freqNote').textContent = note;
    }

    /* initialise dots to default */
    updateDayDots(currentFreqKey);

    /* ---- Product cards (event delegation — cards are rendered dynamically) ---- */
    document.getElementById('productGrid').addEventListener('click', function(e) {
        var card = e.target.closest('.calc-product-card');
        if (!card) return;
        document.querySelectorAll('.calc-product-card').forEach(function(c) { c.classList.remove('selected'); });
        card.classList.add('selected');
        selectedProduct = {
            name:    card.dataset.name,
            mg:      parseFloat(card.dataset.mg),
            ml:      parseFloat(card.dataset.ml),
            maxDose: parseFloat(card.dataset.maxDose),
            unit:    card.dataset.unit
        };
        selectedProduct.concMgMl = selectedProduct.mg / selectedProduct.ml;

        // Update pen info strip
        document.getElementById('infoTotal').textContent = selectedProduct.mg + ' mg';
        document.getElementById('infoConc').textContent  = selectedProduct.concMgMl.toFixed(2) + ' mg/ml';

        // Auto-set unit toggle
        setUnit(selectedProduct.unit === 'mcg' ? 'mcg' : 'mg');

        // Auto-set recommended dosing frequency for this compound
        if (card.dataset.freq) setFreq(card.dataset.freq);

        calculate();
    });

    /* ---- Unit toggle ---- */
    document.querySelectorAll('.calc-toggle-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            setUnit(this.dataset.unit);
            calculate();
        });
    });
    function setUnit(u) {
        inputUnit = u;
        document.querySelectorAll('.calc-toggle-btn').forEach(function(b) {
            b.classList.toggle('active', b.dataset.unit === u);
        });
    }

    /* ---- Dose input ---- */
    document.getElementById('doseInput').addEventListener('input', function() { calculate(); });

    /* ---- Helper: format a mg value nicely ---- */
    function fmtMg(mg) {
        if (mg < 0.001) return (mg * 1000000).toFixed(0) + ' ng';
        if (mg < 1)     return (mg * 1000).toFixed(1) + ' mcg';
        return mg.toFixed(2) + ' mg';
    }

    function calculate() {
        var rawVal      = parseFloat(document.getElementById('doseInput').value);
        var results     = document.getElementById('calcResults');
        var output      = document.getElementById('calcOutput');
        var placeholder = document.getElementById('calcPlaceholder');

        results.classList.add('visible');

        if (!selectedProduct || isNaN(rawVal) || rawVal <= 0) {
            output.style.display      = 'none';
            placeholder.style.display = 'block';
            rollDial(0);
            return;
        }

        placeholder.style.display = 'none';
        output.style.display      = 'block';

        /* Convert input to mg */
        var doseMg   = (inputUnit === 'mcg') ? rawVal / 1000 : rawVal;
        var freq     = FREQS[currentFreqKey] || FREQS['daily'];
        var dpw      = freq.dpw;

        /* Core calculations */
        var volumeMl     = doseMg / selectedProduct.concMgMl;
        var units        = Math.round(volumeMl * 100);
        var pct          = Math.min((volumeMl / selectedProduct.ml) * 100, 100);
        var dosesPerPen  = selectedProduct.ml / volumeMl;

        var weeklyMg     = doseMg * dpw;
        var monthlyMg    = doseMg * dpw * 4.33;   /* avg weeks per month */
        var penWeeks     = dosesPerPen / dpw;

        /* Dose display string */
        var doseStr = rawVal >= 1000
            ? (rawVal / 1000).toFixed(2) + ' mg'
            : rawVal.toFixed(inputUnit === 'mcg' ? 0 : 2) + ' ' + inputUnit;

        /* Pen duration string */
        var penDurStr;
        if (penWeeks >= 4) {
            penDurStr = (penWeeks / 4.33).toFixed(1) + ' mo';
        } else if (penWeeks >= 1) {
            penDurStr = penWeeks.toFixed(1) + ' wks';
        } else {
            penDurStr = Math.floor(dosesPerPen) + ' doses';
        }

        /* Animate dial */
        rollDial(units);
        animateNum('outputUnits', units);

        /* Stats */
        document.getElementById('statVol').textContent   = volumeMl.toFixed(3) + ' ml';
        document.getElementById('statDose').textContent  = doseStr;
        document.getElementById('statDoses').textContent = Math.floor(dosesPerPen) > 0 ? Math.floor(dosesPerPen) : '<1';

        /* Usage bar */
        var pctRounded = pct.toFixed(1);
        document.getElementById('usageFill').style.width = pctRounded + '%';
        document.getElementById('usagePct').textContent  = pctRounded + '%';

        /* Schedule cards */
        document.getElementById('schedPerDose').textContent      = doseStr;
        document.getElementById('schedPerDoseLabel').textContent  = 'Per injection (' + currentFreqKey.replace('pw','×/wk').replace('eod','EOD').replace('daily','daily').replace('weekly','weekly') + ')';
        document.getElementById('schedWeekly').textContent       = fmtMg(weeklyMg) + ' / wk';
        document.getElementById('schedMonthly').textContent      = fmtMg(monthlyMg) + ' / mo';
        document.getElementById('schedPenDuration').textContent  = penDurStr;

        /* Warning */
        var maxMg = selectedProduct.unit === 'mcg' ? selectedProduct.maxDose / 1000 : selectedProduct.maxDose;
        document.getElementById('calcWarning').classList.toggle('show', doseMg > maxMg);
    }

    /* ================================================================
       CANVAS PEN — draws the pen image then animates the dial window
       directly on top so the number is part of the pen itself.
       ================================================================ */
    var PEN_URL = '<?php echo $pen_img; ?>';

    /*
     * DIAL COORDS — percentages of the natural image size.
     * xPct / yPct = top-left corner of the dial window on the pen.
     * wPct / hPct = width / height of that window.
     * Tweak these if the animation doesn't land on the dial exactly.
     */
    var DIAL = {
        xPct:    0.81,
        yPct:    0.35,
        wPct:    0.065,
        hPct:    0.305,
        radius:  6,      // matched to dial end-cap shape
        bg:      'rgba(14, 7, 30, 0.97)',
        numCol:  '#ffffff',
        subCol:  'rgba(255,255,255,0.55)',
    };

    var canvas   = document.getElementById('penCanvas');
    var ctx      = canvas.getContext('2d');
    var penImg   = new Image();
    var imgReady = false;

    /* current animated value — fractional so rolling looks smooth */
    var animVal  = 0;
    var animFrom = 0;
    var animTo   = 0;
    var animT0   = null;
    var ANIM_MS  = 650;
    var rafId    = null;


    penImg.onload = function() {
        canvas.width  = penImg.naturalWidth;
        canvas.height = penImg.naturalHeight;
        imgReady = true;
        drawFrame(0);
    };
    penImg.src = PEN_URL;

    /* ---- roll the dial to a new integer value ---- */
    function rollDial(target) {
        if (!imgReady) return;
        target = Math.max(0, Math.round(target));
        if (rafId) cancelAnimationFrame(rafId);
        animFrom = animVal;
        animTo   = target;
        animT0   = null;
        rafId = requestAnimationFrame(animLoop);
    }

    function animLoop(ts) {
        if (!animT0) animT0 = ts;
        var elapsed = ts - animT0;
        var t = Math.min(elapsed / ANIM_MS, 1);
        /* elastic ease-out — gives a slight spring overshoot like a real dial */
        var eased = t === 1 ? 1
            : 1 - Math.pow(2, -10 * t) * Math.cos(t * 10 * Math.PI / 3);
        animVal = animFrom + (animTo - animFrom) * eased;
        drawFrame(animVal);
        if (t < 1) rafId = requestAnimationFrame(animLoop);
        else { animVal = animTo; drawFrame(animTo); }
    }

    /* ---- draw one frame: pen image + animated dial ---- */
    function drawFrame(val) {
        var iw = canvas.width;
        var ih = canvas.height;

        ctx.clearRect(0, 0, iw, ih);
        ctx.drawImage(penImg, 0, 0);   /* base pen photo */

        /* dial window geometry */
        var dx = iw * DIAL.xPct;
        var dy = ih * DIAL.yPct;
        var dw = iw * DIAL.wPct;
        var dh = ih * DIAL.hPct;
        var r  = DIAL.radius;

        /* clip to the dial window shape */
        ctx.save();
        ctx.beginPath();
        ctx.moveTo(dx + r, dy);
        ctx.lineTo(dx + dw - r, dy);
        ctx.quadraticCurveTo(dx + dw, dy,      dx + dw, dy + r);
        ctx.lineTo(dx + dw, dy + dh - r);
        ctx.quadraticCurveTo(dx + dw, dy + dh, dx + dw - r, dy + dh);
        ctx.lineTo(dx + r,  dy + dh);
        ctx.quadraticCurveTo(dx, dy + dh,      dx, dy + dh - r);
        ctx.lineTo(dx,  dy + r);
        ctx.quadraticCurveTo(dx, dy,            dx + r, dy);
        ctx.closePath();
        ctx.clip();

        /* fill over the static digit in the photo */
        ctx.fillStyle = DIAL.bg;
        ctx.fillRect(dx, dy, dw, dh);

        /* rolling digit strip — draw current, previous & next numbers
           so they smoothly scroll past the window */
        var intVal   = Math.floor(val);
        var frac     = val - intVal;          /* 0→1 scroll progress */
        var rowH     = dh * 0.78;            /* height of one digit row */
        var fontSize = rowH * 0.92;

        ctx.font         = '900 ' + fontSize + 'px Arial, Helvetica, sans-serif';
        ctx.textAlign    = 'center';
        ctx.textBaseline = 'middle';

        for (var offset = -1; offset <= 2; offset++) {
            var num  = intVal + offset;
            if (num < 0) continue;

            /* y-position scrolls upward as frac goes 0→1 */
            var yPos = dy + dh / 2 + (offset - frac) * rowH;

            /* fade numbers further from the centre of the window */
            var dist  = Math.abs(offset - frac);
            var alpha = Math.max(0, 1 - dist * 1.6);
            /* slight shrink to reinforce the cylinder perspective */
            var scale = Math.max(0.55, 1 - dist * 0.28);

            ctx.save();
            ctx.globalAlpha = alpha;
            ctx.translate(dx + dw / 2, yPos);
            ctx.scale(scale, scale);
            ctx.fillStyle = DIAL.numCol;
            ctx.fillText(String(num), 0, 0);
            ctx.restore();
        }

        /* subtle top/bottom shadow bands — sell the "inside a cylinder" look */
        var fadeH = dh * 0.28;
        var topGrad = ctx.createLinearGradient(0, dy, 0, dy + fadeH);
        topGrad.addColorStop(0, DIAL.bg);
        topGrad.addColorStop(1, 'rgba(0,0,0,0)');
        ctx.fillStyle = topGrad;
        ctx.fillRect(dx, dy, dw, fadeH);

        var botGrad = ctx.createLinearGradient(0, dy + dh - fadeH, 0, dy + dh);
        botGrad.addColorStop(0, 'rgba(0,0,0,0)');
        botGrad.addColorStop(1, DIAL.bg);
        ctx.fillStyle = botGrad;
        ctx.fillRect(dx, dy + dh - fadeH, dw, fadeH);

        /* "UNITS" micro-label at bottom of window */
        ctx.font         = '700 ' + (dh * 0.18) + 'px Arial, sans-serif';
        ctx.textAlign    = 'center';
        ctx.textBaseline = 'bottom';
        ctx.globalAlpha  = 0.7;
        ctx.fillStyle    = DIAL.subCol;
        ctx.fillText('UNITS', dx + dw / 2, dy + dh - 3);
        ctx.globalAlpha  = 1;

        ctx.restore();   /* remove clip */
    }

    /* ---- Smooth count animation for the output display number ---- */
    var animTimers = {};
    function animateNum(id, target) {
        var el = document.getElementById(id);
        if (!el) return;
        clearInterval(animTimers[id]);
        var start = parseInt(el.textContent.replace(/[^0-9]/g, '')) || 0;
        var diff  = target - start;
        var steps = 22;
        var step  = 0;
        animTimers[id] = setInterval(function() {
            step++;
            el.textContent = Math.round(start + diff * (1 - Math.pow(1 - step / steps, 3)));
            if (step >= steps) { clearInterval(animTimers[id]); el.textContent = target; }
        }, 16);
    }
})();
</script>

<?php get_footer(); ?>
