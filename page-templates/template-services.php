<?php
/**
 * Template Name: Services
 *
 * Services archive page — all services from CPT rendered dynamically.
 *
 * ACF Field Group Location: Page Template → is → template-services.php
 *
 * @package VascularGrace
 */

get_header();

$hero_title    = vg_field( 'services_hero_title', get_the_ID(), "Full-spectrum vascular and\n<span class=\"hero-title-accent\">endovascular care.</span>" );
$hero_subtitle = vg_field( 'services_hero_subtitle', get_the_ID(), 'Trained in both open and endovascular techniques, Dr. Raju delivers the complete range of modern vascular treatments — from same-day laser to complex reconstructive surgery.' );
$help_title    = vg_field( 'services_help_title', get_the_ID(), 'Not sure what you need?' );
$help_desc     = vg_field( 'services_help_desc', get_the_ID(), 'Book a private consultation with Dr. Raju to get a clear diagnosis and a treatment plan tailored to your condition.' );
?>

    <!-- ── PAGE HERO ───────────────────────────────────────────────────── -->
    <section class="about-hero-section bg-dark text-white relative overflow-hidden">
        <div class="about-hero-bg">
            <div class="hero-glow-left"></div>
            <div class="hero-glow-right"></div>
            <svg class="about-vascular-curves" viewBox="0 0 1440 400" fill="none" preserveAspectRatio="none">
                <path class="artery-vein-path vein" d="M-100,120 C300,20 700,320 1200,180 C1350,140 1480,200 1600,220" stroke="rgba(55, 91, 182, 0.45)" stroke-width="2" stroke-dasharray="6 8"/>
                <path class="artery-vein-path artery" d="M-100,160 C350,60 750,360 1250,220 C1400,180 1520,240 1600,260" stroke="rgba(205, 36, 60, 0.45)" stroke-width="2" stroke-dasharray="6 8"/>
                <path class="artery-vein-path vein-sub" d="M-50,220 C400,180 800,40 1300,280 C1420,310 1500,290 1600,300" stroke="rgba(55, 91, 182, 0.3)" stroke-width="1.5" stroke-dasharray="4 6"/>
            </svg>
        </div>
        <div class="container relative z-10">
            <div class="about-breadcrumbs mb-8">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'vascular-grace' ); ?></a>
                <span class="crumb-sep">›</span>
                <span class="crumb-active text-white"><?php esc_html_e( 'Services', 'vascular-grace' ); ?></span>
            </div>
            <div class="about-hero-content max-w-4xl">
                <div class="about-pill inline-flex items-center gap-2 mb-6">
                    <span class="pulse-dot"></span>
                    <span class="text-xs uppercase tracking-widest text-white/80 font-semibold"><?php esc_html_e( 'Services Offered', 'vascular-grace' ); ?></span>
                </div>
                <h1 class="about-hero-title font-display text-white">
                    <?php echo wp_kses_post( nl2br( $hero_title ) ); ?>
                </h1>
                <p class="about-hero-subtitle text-white/80 mt-6">
                    <?php echo esc_html( $hero_subtitle ); ?>
                </p>
            </div>
        </div>
        <div class="about-hero-curve">
            <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
                <path d="M0,25 C360,75 1080,-25 1440,35 L1440,90 L0,90 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- ── SERVICES LISTING ─────────────────────────────────────────────── -->
    <section class="services-listing-section py-large bg-white">
        <div class="container">
            <div class="services-grid-container">
                <?php get_template_part( 'template-parts/sections/services-grid', null, array( 'limit' => -1, 'card_style' => 'listing' ) ); ?>
            </div>

            <!-- Bottom Diagnostic Help Banner -->
            <div class="services-help-banner">
                <div class="help-banner-icon text-crimson">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                </div>
                <div>
                    <h3 class="help-banner-title font-display"><?php echo esc_html( $help_title ); ?></h3>
                    <p class="help-banner-desc"><?php echo esc_html( $help_desc ); ?></p>
                </div>
                <div class="help-banner-btn-wrap">
                    <a href="#book" class="btn btn-primary" data-open-modal="appointment"><?php esc_html_e( 'Book Consultation ↗', 'vascular-grace' ); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA BAND ────────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>
