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
            <div class="max-w-2xl mb-12">
                <div class="section-label text-crimson"><span class="line bg-crimson"></span><?php esc_html_e( 'Patient Stories', 'vascular-grace' ); ?></div>
                <h2 class="section-title"><?php echo esc_html( $section_heading ); ?></h2>
            </div>

            <?php if ( ! empty( $shortcode ) ) : ?>
                <!-- Testimonials rendered via shortcode -->
                <div class="testimonials-widget-wrapper">
                    <?php vg_do_shortcode( $shortcode ); ?>
                </div>
            <?php else : ?>
                <?php
                // Check if Google reviews are cached in Trustindex database
                $ti_reviews = vg_get_trustindex_google_reviews( 30 );
                if ( ! empty( $ti_reviews ) ) :
                    ?>
                    <div class="testimonials-masonry-grid mt-large">
                        <?php foreach ( $ti_reviews as $r ) :
                            $author_name = ! empty( $r->user ) ? esc_html( $r->user ) : __( 'Verified Patient', 'vascular-grace' );
                            $initial     = mb_substr( $author_name, 0, 1, 'UTF-8' );
                            $photo       = ! empty( $r->user_photo ) ? esc_url( $r->user_photo ) : '';
                            $rating      = ! empty( $r->rating ) ? intval( $r->rating ) : 5;
                            $rev_date    = ! empty( $r->date ) && '0000-00-00' !== $r->date ? date_i18n( 'M Y', strtotime( $r->date ) ) : '';
                            ?>
                            <div class="testimonial-card">
                                <div class="review-card-header">
                                    <div class="review-stars" aria-label="<?php echo esc_attr( sprintf( __( '%d out of 5 stars', 'vascular-grace' ), $rating ) ); ?>">
                                        <?php for ( $s = 0; $s < 5; $s++ ) : ?>
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="<?php echo $s < $rating ? 'currentColor' : '#e2e8f0'; ?>"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="google-icon-badge" title="Google Verified Review">
                                        <svg width="14" height="14" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
                                    </div>
                                </div>

                                <p class="testimonial-text"><?php echo esc_html( $r->text ); ?></p>

                                <div class="testimonial-author">
                                    <?php if ( $photo ) : ?>
                                        <img src="<?php echo $photo; ?>" alt="<?php echo esc_attr( $author_name ); ?>" class="author-photo-img" loading="lazy">
                                    <?php else : ?>
                                        <div class="author-avatar bg-blue text-white"><?php echo esc_html( $initial ); ?></div>
                                    <?php endif; ?>
                                    <div class="author-info">
                                        <div class="author-name"><?php echo $author_name; ?></div>
                                        <div class="author-verified-tag">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            <?php esc_html_e( 'Google Review', 'vascular-grace' ); ?>
                                        </div>
                                    </div>
                                    <?php if ( $rev_date ) : ?>
                                        <span class="review-date-muted"><?php echo esc_html( $rev_date ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <!-- Static fallback testimonials -->
                    <div class="testimonials-masonry-grid mt-large">
                        <?php
                        $fallback = array(
                            array( 'text' => 'My varicose veins had troubled me for years. Dr. Raju\'s laser treatment was quick and painless — I was walking home the same day.', 'name' => 'Anitha R.', 'location' => 'Hyderabad', 'initial' => 'A', 'color' => 'bg-blue' ),
                            array( 'text' => 'As a diabetic, I was terrified of losing my foot. Dr. Raju saved my leg and gave me back my life. His bedside manner and surgical precision are unmatched.', 'name' => 'Ravi K.', 'location' => 'Bengaluru', 'initial' => 'R', 'color' => 'bg-crimson' ),
                            array( 'text' => 'The clinic feels world-class and the doctor explains everything. I finally feel understood.', 'name' => 'Meera S.', 'location' => 'Chennai', 'initial' => 'M', 'color' => 'bg-dark' ),
                            array( 'text' => 'Extremely knowledgeable surgeon. Highly recommend Dr. Srikanth Raju for complex endovascular procedures. The team at Yashoda Hitec City was very supportive.', 'name' => 'Suresh Reddy', 'location' => 'Hyderabad', 'initial' => 'S', 'color' => 'bg-blue' ),
                            array( 'text' => 'My DVT recovery was smooth under Dr. Raju\'s care. Transparent guidance and excellent follow-up.', 'name' => 'Priya M.', 'location' => 'Hyderabad', 'initial' => 'P', 'color' => 'bg-crimson' ),
                            array( 'text' => 'Top vascular specialist in Hyderabad. Procedure was completely minimally invasive with no downtime.', 'name' => 'Venkatesh G.', 'location' => 'Warangal', 'initial' => 'V', 'color' => 'bg-dark' ),
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
            <?php endif; ?>

            <!-- View All on Google Button -->
            <div class="text-center mt-12">
                <a href="<?php echo esc_url( vg_get_gmb_review_url() ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-large shadow-crimson inline-flex items-center gap-2">
                    <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#ffffff" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#ffffff" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#ffffff" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#ffffff" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
                    <?php esc_html_e( 'View All Reviews on Google', 'vascular-grace' ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ── CTA BAND ────────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>


