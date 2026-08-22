<?php
/**
 * Template Name: Home
 *
 * Homepage template — pulls all content from ACF fields scoped to this template.
 * Default values match the original HTML exactly so the site renders correctly
 * before any admin edits are made.
 *
 * ACF Field Group Location: Page Template → is → template-home.php
 *
 * @package VascularGrace
 */

get_header();

// ── Field defaults ──────────────────────────────────────────────────────────
$hero_subtitle  = vg_field( 'hero_subtitle', get_the_ID(), 'DEPARTMENT' );
$hero_title     = vg_field( 'hero_title', get_the_ID(), 'Vascular <span class="text-crimson italic amp">&amp;</span> Endovascular<br><span class="text-blue highlight">Surgery.</span>' );
$hero_desc      = vg_field( 'hero_desc', get_the_ID(), 'From varicose veins to complex aortic aneurysms — precision care for the arteries, veins and lymphatics that keep you moving. Trained in both open and endovascular technique, chosen because the vessel decides, not the surgeon.' );
$hero_doc_image = vg_field( 'hero_doctor_image', get_the_ID() );
$hero_vas_image = vg_field( 'hero_vascular_image', get_the_ID() );

$about_title   = vg_field( 'about_section_title', get_the_ID(), 'A vascular specialist committed to precision and compassion.' );
$about_desc    = vg_field( 'about_section_desc', get_the_ID(), 'Dr. S Srikanth Raju is a Senior Consultant Vascular &amp; Endovascular Surgeon and Clinical Director at Yashoda Hospitals, Hitec City. With 16+ years of experience, he is one of India\'s few vascular surgeons trained in both open and endovascular procedures.' );
$about_cta_url = vg_field( 'about_cta_url', get_the_ID(), home_url( '/about/' ) );
$exp_years     = vg_field( 'exp_badge_years', get_the_ID(), '16+' );
$exp_label     = vg_field( 'exp_badge_label', get_the_ID(), 'CLINICAL PRACTICE' );

$serv_title    = vg_field( 'services_section_title', get_the_ID(), 'Advanced vascular treatments, tailored to you.' );
$serv_desc     = vg_field( 'services_section_desc', get_the_ID(), 'From varicose veins to complex arterial disease — modern, minimally invasive care with faster recovery and lasting results.' );

$stats         = vg_field( 'stats', get_the_ID() );
$default_stats = array(
    array( 'stat_number' => '16+',    'stat_label' => 'YEARS EXPERIENCE' ),
    array( 'stat_number' => '10,000+','stat_label' => 'PROCEDURES PERFORMED' ),
    array( 'stat_number' => '98%',    'stat_label' => 'SUCCESS RATE' ),
    array( 'stat_number' => '15+',    'stat_label' => 'AWARDS &amp; FELLOWSHIPS' ),
);

$journey_title  = vg_field( 'journey_title', get_the_ID(), 'A calm, deliberate process — designed around you.' );
$journey_steps  = vg_field( 'journey_steps', get_the_ID() );
$default_steps  = array(
    array( 'step_title' => 'Consultation',          'step_text' => 'A detailed discussion of your symptoms, history and concerns.' ),
    array( 'step_title' => 'Precision Diagnosis',   'step_text' => 'Doppler ultrasound, CT angiography and modern imaging.' ),
    array( 'step_title' => 'Personalized Plan',     'step_text' => 'A treatment path designed around your health and lifestyle.' ),
    array( 'step_title' => 'Minimally Invasive Care','step_text' => 'Same-day procedures with faster recovery and less discomfort.' ),
    array( 'step_title' => 'Long-term Follow-up',   'step_text' => 'Structured follow-up to prevent recurrence and protect outcomes.' ),
);

$testimonials_heading   = vg_field( 'testimonials_heading', get_the_ID(), 'Care that patients remember for the right reasons.' );
$testimonials_shortcode = vg_field( 'testimonials_shortcode', get_the_ID(), '' );

$faq_title  = vg_field( 'faq_title', get_the_ID(), 'Answers to what patients ask most.' );
$faq_desc   = vg_field( 'faq_desc', get_the_ID(), 'Common questions about vascular procedures, recovery, and consultations.' );
$faqs       = vg_field( 'faqs', get_the_ID() );
$default_faqs = array(
    array(
        'question' => 'Is laser treatment for varicose veins painful?',
        'answer'   => 'No. Endovenous laser ablation is performed under local anaesthesia. Most patients walk out within an hour and resume normal activity the next day.',
    ),
    array(
        'question' => 'How is diabetic foot managed?',
        'answer'   => 'We combine advanced wound care, revascularization when needed, and a structured foot protection program to prevent amputation and preserve mobility.',
    ),
    array(
        'question' => 'Are your procedures covered by insurance?',
        'answer'   => 'Most vascular procedures are covered by major insurers. Our team will help you verify coverage before treatment.',
    ),
    array(
        'question' => 'How soon can I recover after minimally invasive vascular surgery?',
        'answer'   => 'Most patients resume routine activity within 24–48 hours. Recovery is faster and far less painful than traditional open surgery.',
    ),
);

$display_stats = ( ! empty( $stats ) && is_array( $stats ) ) ? $stats : $default_stats;
$display_steps = ( ! empty( $journey_steps ) && is_array( $journey_steps ) ) ? $journey_steps : $default_steps;
$display_faqs  = ( ! empty( $faqs ) && is_array( $faqs ) ) ? $faqs : $default_faqs;
?>

    <!-- ── HERO SECTION ────────────────────────────────────────────────── -->
    <section class="hero-section bg-white text-dark" id="home">
        <div class="vascular-bg">
            <div class="glow-container">
                <div class="glow red-glow"></div>
                <div class="glow blue-glow"></div>
            </div>
            <?php if ( ! empty( $hero_vas_image ) && is_array( $hero_vas_image ) ) : ?>
                <?php echo wp_get_attachment_image( $hero_vas_image['ID'], 'full', false, array( 'alt' => esc_attr__( 'Vascular System', 'vascular-grace' ), 'class' => 'vascular-image' ) ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/vascular-system.png' ); ?>" alt="<?php esc_attr_e( 'Vascular System', 'vascular-grace' ); ?>" class="vascular-image">
            <?php endif; ?>
        </div>

        <div class="container hero-container relative z-10">
            <div class="hero-content">
                <p class="hero-subtitle"><span class="line bg-crimson"></span> <?php echo esc_html( $hero_subtitle ); ?></p>
                <h1 class="hero-title">
                    <?php echo wp_kses_post( $hero_title ); ?>
                </h1>
                <p class="hero-description"><?php echo esc_html( $hero_desc ); ?></p>

                <div class="doctor-info-hero">
                    <p class="doc-name">
                        <?php vg_the_text( 'doctor_name_full', 'option', 'Dr. S Srikanth Raju' ); ?>
                        <span class="doc-creds"><?php vg_the_text( 'doctor_credentials', 'option', 'MBBS · MS (Gen. Surgery) · DNB (Vascular)' ); ?></span>
                    </p>
                    <p class="doc-role"><?php vg_the_text( 'doctor_role', 'option', 'Sr. Consultant Vascular &amp; Endovascular Surgeon / Clinical Director' ); ?></p>
                </div>
            </div>

            <div class="hero-image-wrapper">
                <div class="doctor-portrait-box">
                    <?php if ( ! empty( $hero_doc_image ) && is_array( $hero_doc_image ) ) : ?>
                        <?php echo wp_get_attachment_image( $hero_doc_image['ID'], 'large', false, array( 'alt' => esc_attr( vg_option( 'doctor_name_full', 'Dr. S Srikanth Raju' ) ), 'class' => 'doctor-image' ) ); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/dr-srikanth-raju-transparent.png' ); ?>" alt="<?php echo esc_attr( vg_option( 'doctor_name_full', 'Dr. S Srikanth Raju' ) ); ?>" class="doctor-image">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ── ABOUT SECTION ───────────────────────────────────────────────── -->
    <section class="about-section py-large bg-white" id="about">
        <div class="container about-grid">
            <div class="about-image-column relative">
                <div class="about-image-card">
                    <div class="about-card-bg">
                        <svg class="about-vascular-svg" viewBox="0 0 300 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M150,30 V370" stroke="rgba(55, 91, 182, 0.7)" stroke-width="2" stroke-dasharray="6 8"/>
                            <path d="M140,50 C140,150 120,250 140,360" stroke="rgba(205, 36, 60, 0.6)" stroke-width="1.5" stroke-dasharray="5 7"/>
                            <path d="M160,50 C160,150 180,250 160,360" stroke="rgba(205, 36, 60, 0.6)" stroke-width="1.5" stroke-dasharray="5 7"/>
                            <path d="M130,80 C130,180 100,280 130,350" stroke="rgba(55, 91, 182, 0.4)" stroke-width="1" stroke-dasharray="4 6"/>
                            <path d="M170,80 C170,180 200,280 170,350" stroke="rgba(55, 91, 182, 0.4)" stroke-width="1" stroke-dasharray="4 6"/>
                        </svg>
                    </div>
                    <div class="about-card-overlay">
                        <div class="overlay-icon text-crimson">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"></circle><path d="m8.21 13.89-1.21 7.11 5-3 5 3-1.21-7.11"></path></svg>
                        </div>
                        <div class="overlay-text">
                            <div class="overlay-title"><?php esc_html_e( 'Fellowship-trained', 'vascular-grace' ); ?></div>
                            <div class="overlay-subtitle"><?php esc_html_e( 'Vascular &amp; Endovascular Surgery · Advanced Foot Care', 'vascular-grace' ); ?></div>
                        </div>
                    </div>
                </div>
                <div class="experience-badge">
                    <div class="exp-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#cd243c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 7.65l.77.77L12 20.67l7.65-7.67.77-.77a5.4 5.4 0 0 0 0-7.65Z"></path><path d="M3.5 12h3.5l2-3 2.5 6 1.5-3h4"></path></svg>
                    </div>
                    <div class="exp-text">
                        <div class="exp-title"><?php echo esc_html( $exp_years ); ?></div>
                        <div class="exp-subtitle"><?php echo esc_html( $exp_label ); ?></div>
                    </div>
                </div>
            </div>

            <div class="about-content">
                <div class="section-label text-crimson"><?php esc_html_e( '— ABOUT THE DOCTOR', 'vascular-grace' ); ?></div>
                <h2 class="section-title"><?php echo esc_html( $about_title ); ?></h2>
                <p class="section-description"><?php echo wp_kses_post( $about_desc ); ?></p>

                <div class="features-grid">
                    <?php
                    $features = vg_field( 'about_features', get_the_ID() );
                    $default_features = array(
                        array( 'feat_title' => 'MBBS · MS · DNB',    'feat_subtitle' => 'Vascular Surgery',        'feat_color' => 'text-blue' ),
                        array( 'feat_title' => '4.9 ★',              'feat_subtitle' => '499 Google reviews',      'feat_color' => 'text-blue' ),
                        array( 'feat_title' => 'Open + Endo',         'feat_subtitle' => 'Dual-trained surgeon',    'feat_color' => 'text-blue' ),
                        array( 'feat_title' => 'VSI Member',          'feat_subtitle' => 'Vascular Society of India','feat_color' => 'text-blue' ),
                    );
                    $display_features = ( ! empty( $features ) ) ? $features : $default_features;
                    foreach ( $display_features as $feat ) :
                        ?>
                        <div class="feature-card">
                            <div class="feature-icon <?php echo esc_attr( $feat['feat_color'] ?? 'text-blue' ); ?>">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path><path d="M22 10v6"></path><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path></svg>
                            </div>
                            <div class="feature-title"><?php echo esc_html( $feat['feat_title'] ?? '' ); ?></div>
                            <div class="feature-subtitle"><?php echo esc_html( $feat['feat_subtitle'] ?? '' ); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <a href="<?php echo esc_url( $about_cta_url ); ?>" class="btn-text text-blue hover-blue-dark">
                    <?php esc_html_e( 'Read the full biography', 'vascular-grace' ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ── SERVICES SECTION ────────────────────────────────────────────── -->
    <section class="services-section py-large bg-gray-light">
        <div class="container">
            <div class="services-header">
                <div class="max-w-2xl">
                    <div class="section-label text-crimson"><span class="line bg-crimson"></span><?php esc_html_e( 'Services', 'vascular-grace' ); ?></div>
                    <h2 class="section-title"><?php echo esc_html( $serv_title ); ?></h2>
                    <p class="section-description"><?php echo esc_html( $serv_desc ); ?></p>
                </div>
            </div>

            <div class="services-grid mt-large">
                <?php get_template_part( 'template-parts/sections/services-grid', null, array( 'limit' => 8, 'card_style' => 'home' ) ); ?>
            </div>

            <div class="text-center mt-12">
                <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn-text text-blue hover-blue-dark inline-flex items-center gap-2">
                    <?php esc_html_e( 'View all services', 'vascular-grace' ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ── STATS SECTION ───────────────────────────────────────────────── -->
    <section class="stats-section bg-dark text-white relative overflow-hidden">
        <div class="cta-wave-bg">
            <svg class="cta-vascular-svg" viewBox="0 0 1440 320" fill="none" preserveAspectRatio="none">
                <path class="vascular-flow artery" d="M0,160 C320,300 720,30 1440,180" stroke="rgba(205, 36, 60, 0.6)" stroke-width="2" stroke-dasharray="6 8"/>
                <path class="vascular-flow vein" d="M0,110 C380,30 820,290 1440,130" stroke="rgba(55, 91, 182, 0.6)" stroke-width="2" stroke-dasharray="6 8"/>
                <path class="vascular-flow artery-sub" d="M0,220 C450,90 950,260 1440,230" stroke="rgba(205, 36, 60, 0.35)" stroke-width="1.5" stroke-dasharray="4 6"/>
                <path class="vascular-flow vein-sub" d="M0,70 C280,220 760,70 1440,80" stroke="rgba(55, 91, 182, 0.35)" stroke-width="1.5" stroke-dasharray="4 6"/>
            </svg>
        </div>
        <div class="container relative z-10">
            <div class="stats-grid">
                <?php foreach ( $display_stats as $stat ) : ?>
                    <div class="stat-item">
                        <div class="stat-number"><?php echo esc_html( $stat['stat_number'] ?? '' ); ?></div>
                        <div class="stat-label"><?php echo wp_kses( $stat['stat_label'] ?? '', array() ); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── TREATMENT JOURNEY ───────────────────────────────────────────── -->
    <section class="journey-section py-large bg-gray-light">
        <div class="container">
            <div class="max-w-2xl">
                <div class="section-label text-crimson"><span class="line bg-crimson"></span><?php esc_html_e( 'Treatment Journey', 'vascular-grace' ); ?></div>
                <h2 class="section-title"><?php echo esc_html( $journey_title ); ?></h2>
            </div>

            <div class="journey-grid mt-large">
                <?php foreach ( $display_steps as $i => $step ) : ?>
                    <div class="journey-card">
                        <div class="journey-number text-blue"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></div>
                        <div class="journey-divider"></div>
                        <h3 class="journey-title"><?php echo esc_html( $step['step_title'] ?? '' ); ?></h3>
                        <p class="journey-text"><?php echo esc_html( $step['step_text'] ?? '' ); ?></p>
                    </div>
                    <?php if ( $i < count( $display_steps ) - 1 ) : ?>
                        <div class="journey-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── TESTIMONIALS SECTION ────────────────────────────────────────── -->
    <section class="testimonials-section py-large bg-white">
        <div class="container">
            <div class="max-w-2xl">
                <div class="section-label text-crimson"><span class="line bg-crimson"></span><?php esc_html_e( 'Patient Stories', 'vascular-grace' ); ?></div>
                <h2 class="section-title"><?php echo esc_html( $testimonials_heading ); ?></h2>
            </div>

            <div class="testimonials-grid mt-large">
                <?php if ( ! empty( $testimonials_shortcode ) ) : ?>
                    <!-- Trustindex / review widget via shortcode (editable from admin) -->
                    <?php vg_do_shortcode( $testimonials_shortcode ); ?>
                <?php else : ?>
                    <?php
                    // Check if Google reviews are cached in Trustindex database
                    $ti_reviews = vg_get_trustindex_google_reviews( 3 );
                    if ( ! empty( $ti_reviews ) ) :
                        foreach ( $ti_reviews as $r ) :
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
                        <?php
                        endforeach;
                    else :
                        // Static fallback testimonials
                        $static_testimonials = vg_field( 'testimonials', get_the_ID() );
                        $default_testimonials = array(
                            array(
                                'text'     => 'My varicose veins had troubled me for years. Dr. Raju\'s laser treatment was quick and painless — I was walking home the same day.',
                                'name'     => 'Anitha R.',
                                'location' => 'Hyderabad',
                                'initial'  => 'A',
                                'color'    => 'bg-blue',
                            ),
                            array(
                                'text'     => 'As a diabetic, I was terrified of losing my foot. Dr. Raju saved my leg and gave me back my life.',
                                'name'     => 'Ravi K.',
                                'location' => 'Bengaluru',
                                'initial'  => 'R',
                                'color'    => 'bg-crimson',
                            ),
                            array(
                                'text'     => 'The clinic feels world-class and the doctor explains everything. I finally feel understood.',
                                'name'     => 'Meera S.',
                                'location' => 'Chennai',
                                'initial'  => 'M',
                                'color'    => 'bg-dark',
                            ),
                        );
                        $t_list = ( ! empty( $static_testimonials ) ) ? $static_testimonials : $default_testimonials;
                        foreach ( $t_list as $t ) :
                            ?>
                            <div class="testimonial-card">
                                <div class="quote-mark">"</div>
                                <p class="testimonial-text"><?php echo esc_html( $t['text'] ?? ( $t['testimonial_text'] ?? '' ) ); ?></p>
                                <div class="testimonial-author">
                                    <div class="author-avatar <?php echo esc_attr( $t['color'] ?? ( $t['avatar_color'] ?? 'bg-blue' ) ); ?> text-white">
                                        <?php echo esc_html( $t['initial'] ?? ( $t['avatar_initial'] ?? '' ) ); ?>
                                    </div>
                                    <div class="author-info">
                                        <div class="author-name"><?php echo esc_html( $t['name'] ?? ( $t['author_name'] ?? '' ) ); ?></div>
                                        <div class="author-location"><?php echo esc_html( $t['location'] ?? ( $t['author_location'] ?? '' ) ); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ── FAQ SECTION ─────────────────────────────────────────────────── -->
    <section class="faq-section py-large bg-gray-light">
        <div class="container">
            <div class="faq-layout">
                <div class="faq-header">
                    <div class="section-label text-crimson"><span class="line bg-crimson"></span><?php esc_html_e( 'Frequently Asked', 'vascular-grace' ); ?></div>
                    <h2 class="section-title"><?php echo esc_html( $faq_title ); ?></h2>
                    <p class="section-description"><?php echo esc_html( $faq_desc ); ?></p>
                </div>

                <div class="faq-list">
                    <?php foreach ( $display_faqs as $faq ) : ?>
                        <div class="faq-item">
                            <button class="faq-question">
                                <?php echo esc_html( $faq['question'] ?? ( $faq['faq_question'] ?? '' ) ); ?>
                                <span class="faq-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"></path></svg>
                                </span>
                            </button>
                            <div class="faq-answer">
                                <p><?php echo wp_kses_post( $faq['answer'] ?? ( $faq['faq_answer'] ?? '' ) ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA BAND ────────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>
