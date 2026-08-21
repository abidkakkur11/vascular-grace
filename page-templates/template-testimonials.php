<?php
/**
 * Template Name: Testimonials
 *
 * Testimonials page — renders via Trustindex shortcode stored in ACF.
 * Surrounding HTML structure preserved exactly to maintain CSS styling.
 *
 * @package VascularGrace
 */

get_header();

$hero_title    = vg_field( 'testimonials_hero_title', get_the_ID(), "What patients say\nabout <span class=\"hero-title-accent\">Dr. Raju.</span>" );
$hero_subtitle = vg_field( 'testimonials_hero_subtitle', get_the_ID(), 'Real experiences from patients treated for varicose veins, diabetic foot, PAD, and complex vascular conditions.' );
$section_heading = vg_field( 'testimonials_section_heading', get_the_ID(), 'Care that patients remember for the right reasons.' );
$shortcode       = vg_field( 'testimonials_shortcode', get_the_ID(), '' );
?>

    <!-- ── PAGE HERO ───────────────────────────────────────────────────── -->
    <section class="about-hero-section bg-dark text-white relative overflow-hidden">
        <div class="about-hero-bg">
            <div class="hero-glow-left"></div>
            <div class="hero-glow-right"></div>
            <svg class="about-vascular-curves" viewBox="0 0 1440 400" fill="none" preserveAspectRatio="none">
                <path class="artery-vein-path vein" d="M-100,120 C300,20 700,320 1200,180 C1350,140 1480,200 1600,220" stroke="rgba(55, 91, 182, 0.45)" stroke-width="2" stroke-dasharray="6 8"/>
                <path class="artery-vein-path artery" d="M-100,160 C350,60 750,360 1250,220 C1400,180 1520,240 1600,260" stroke="rgba(205, 36, 60, 0.45)" stroke-width="2" stroke-dasharray="6 8"/>
            </svg>
        </div>
        <div class="container relative z-10">
            <div class="about-breadcrumbs mb-8">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'vascular-grace' ); ?></a>
                <span class="crumb-sep">›</span>
                <span class="crumb-active text-white"><?php esc_html_e( 'Testimonials', 'vascular-grace' ); ?></span>
            </div>
            <div class="about-hero-content max-w-4xl">
                <div class="about-pill inline-flex items-center gap-2 mb-6">
                    <span class="pulse-dot"></span>
                    <span class="text-xs uppercase tracking-widest text-white/80 font-semibold"><?php esc_html_e( 'Patient Stories', 'vascular-grace' ); ?></span>
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

    <!-- ── TESTIMONIALS / REVIEW WIDGET ────────────────────────────────── -->
    <section class="testimonials-section py-large bg-white">
        <div class="container">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <div class="section-label text-crimson justify-center"><span class="line bg-crimson"></span><?php esc_html_e( 'Patient Stories', 'vascular-grace' ); ?></div>
                <h2 class="section-title"><?php echo esc_html( $section_heading ); ?></h2>
            </div>

            <?php if ( ! empty( $shortcode ) ) : ?>
                <!--
                    Testimonials rendered via Trustindex shortcode.
                    Shortcode is editable from admin (ACF field: testimonials_shortcode)
                    without touching any theme code.
                -->
                <div class="testimonials-widget-wrapper">
                    <?php vg_do_shortcode( $shortcode ); ?>
                </div>
            <?php else : ?>
                <!-- Static fallback testimonials (shown until shortcode is configured) -->
                <div class="testimonials-grid mt-large">
                    <?php
                    $fallback = array(
                        array( 'text' => 'My varicose veins had troubled me for years. Dr. Raju\'s laser treatment was quick and painless — I was walking home the same day.', 'name' => 'Anitha R.', 'location' => 'Hyderabad', 'initial' => 'A', 'color' => 'bg-blue' ),
                        array( 'text' => 'As a diabetic, I was terrified of losing my foot. Dr. Raju saved my leg and gave me back my life.', 'name' => 'Ravi K.', 'location' => 'Bengaluru', 'initial' => 'R', 'color' => 'bg-crimson' ),
                        array( 'text' => 'The clinic feels world-class and the doctor explains everything. I finally feel understood.', 'name' => 'Meera S.', 'location' => 'Chennai', 'initial' => 'M', 'color' => 'bg-dark' ),
                    );
                    foreach ( $fallback as $t ) :
                        ?>
                        <div class="testimonial-card">
                            <div class="quote-mark">"</div>
                            <p class="testimonial-text"><?php echo esc_html( $t['text'] ); ?></p>
                            <div class="testimonial-author">
                                <div class="author-avatar <?php echo esc_attr( $t['color'] ); ?> text-white"><?php echo esc_html( $t['initial'] ); ?></div>
                                <div class="author-info">
                                    <div class="author-name"><?php echo esc_html( $t['name'] ); ?></div>
                                    <div class="author-location"><?php echo esc_html( $t['location'] ); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ── CTA BAND ────────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>
