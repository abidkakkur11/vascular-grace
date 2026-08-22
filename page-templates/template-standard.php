<?php
/**
 * Template Name: Standard Content / Legal Policy
 *
 * Common versatile template for Disclaimer, Privacy Policy, Terms & Conditions,
 * Medical Disclaimer, or any standard text-heavy informational page.
 * Uses the default WordPress editor (the_content()).
 *
 * @package VascularGrace
 */

get_header();
?>

    <?php while ( have_posts() ) : the_post(); ?>

    <!-- Page Hero Banner (Dark Theme) -->
    <section class="about-hero-section bg-dark text-white relative overflow-hidden">
        <!-- Ambient vascular glow & curved flow paths -->
        <div class="about-hero-bg">
            <div class="hero-glow-left"></div>
            <div class="hero-glow-right"></div>
            <svg class="about-vascular-curves" viewBox="0 0 1440 400" fill="none" preserveAspectRatio="none">
                <path class="artery-vein-path vein" d="M-100,120 C300,20 700,320 1200,180 C1350,140 1480,200 1600,220" stroke="rgba(55, 91, 182, 0.45)" stroke-width="2" stroke-dasharray="6 8"/>
                <path class="artery-vein-path artery" d="M-100,160 C350,60 750,360 1250,220 C1400,180 1520,240 1600,260" stroke="rgba(205, 36, 60, 0.45)" stroke-width="2" stroke-dasharray="6 8"/>
            </svg>
        </div>
        
        <div class="container relative z-10">
            <!-- Breadcrumbs -->
            <div class="about-breadcrumbs mb-8">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'vascular-grace' ); ?></a>
                <span class="crumb-sep">›</span>
                <span class="crumb-active text-white"><?php the_title(); ?></span>
            </div>
            
            <div class="about-hero-content max-w-4xl">
                <div class="about-pill inline-flex items-center gap-2 mb-6">
                    <span class="pulse-dot"></span>
                    <span class="text-xs uppercase tracking-widest text-white/80 font-semibold"><?php esc_html_e( 'Policy &amp; Information', 'vascular-grace' ); ?></span>
                </div>
                <h1 class="about-hero-title font-display text-white">
                    <?php the_title(); ?>
                </h1>
                <p class="about-hero-subtitle text-white/80 mt-4 text-sm">
                    <?php
                    /* translators: %s: date */
                    printf( esc_html__( 'Last updated: %s', 'vascular-grace' ), get_the_modified_date( 'F j, Y' ) );
                    ?>
                </p>
            </div>
        </div>

        <!-- Smooth Curved Wave Cutout at bottom -->
        <div class="about-hero-curve">
            <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
                <path d="M0,25 C360,75 1080,-25 1440,35 L1440,90 L0,90 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="legal-page-section py-large bg-white">
        <div class="container">
            <div class="legal-content-wrapper">
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content legal-prose' ); ?>>
                    <?php the_content(); ?>
                </article>
            </div>
        </div>
    </main>

    <?php endwhile; ?>

    <!-- CTA Band -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>
