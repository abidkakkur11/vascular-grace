<?php
/**
 * Template Name: About
 *
 * About page — Dr. Srikanth Raju's biography, credentials, timeline,
 * publications, memberships, philosophy, stats, and CTA.
 *
 * ACF Field Group Location: Page Template → is → template-about.php
 *
 * @package VascularGrace
 */

get_header();

// ── Field defaults ───────────────────────────────────────────────────────────
$hero_title    = vg_field( 'about_hero_title', get_the_ID(), "A vascular surgeon devoted\nto precision and quiet\n<span class=\"hero-title-accent\">compassion.</span>" );
$hero_subtitle = vg_field( 'about_hero_subtitle', get_the_ID(), 'MBBS, MS (General Surgery), DNB (Vascular Surgery) · Sr. Consultant Vascular &amp;<br>Endovascular Surgeon and Clinical Director at Yashoda Hospitals, Hitec City.' );

$intro_lead1 = vg_field( 'about_intro_lead1', get_the_ID(), 'Dr. S Srikanth Raju is a Senior Consultant Vascular &amp; Endovascular Surgeon and Foot Care Specialist at Yashoda Hospitals, Hitec City. He has specialized expertise in the diagnosis and management of a wide spectrum of foot and ankle conditions, with a strong focus on preventive care and diabetic foot management.' );
$intro_lead2 = vg_field( 'about_intro_lead2', get_the_ID(), 'He is one of India\'s few vascular surgeons who has received training in both open and endovascular procedures, and is adept at performing the full range of modern vascular surgeries — from same-day laser treatment for varicose veins to complex aortic aneurysm repairs and emergency limb salvage.' );
$intro_image = vg_field( 'about_intro_image', get_the_ID() );

$credentials = vg_field( 'credentials', get_the_ID() );
$default_creds = array(
    array( 'cred_title' => 'MBBS · MS · DNB', 'cred_sub' => 'Vascular Surgery',          'cred_color' => 'text-blue' ),
    array( 'cred_title' => 'TSMC 67043',       'cred_sub' => 'Medical Registration',       'cred_color' => 'text-crimson' ),
    array( 'cred_title' => 'English · Hindi · Telugu', 'cred_sub' => 'Languages Spoken',   'cred_color' => 'text-blue' ),
    array( 'cred_title' => 'Yashoda Hospitals', 'cred_sub' => 'Hitec City, Hyderabad',     'cred_color' => 'text-crimson' ),
);
$display_creds = ! empty( $credentials ) ? $credentials : $default_creds;

$education = vg_field( 'education', get_the_ID() );
$default_edu = array(
    array( 'edu_year' => '2004 – 2010', 'edu_degree' => 'MBBS',                          'edu_institution' => 'Dr. NTR University of Health Sciences' ),
    array( 'edu_year' => '2012 – 2015', 'edu_degree' => 'MS General Surgery',             'edu_institution' => 'Dr. NTR University of Health Sciences' ),
    array( 'edu_year' => '2016 – 2019', 'edu_degree' => 'DNB Peripheral Vascular Surgery','edu_institution' => 'Narayana Health City, Bengaluru' ),
);
$display_edu = ! empty( $education ) ? $education : $default_edu;

$timeline = vg_field( 'professional_timeline', get_the_ID() );
$default_timeline = array(
    array( 'tl_period' => 'Mar – Sep 2019',       'tl_role' => 'Junior Consultant, Vascular &amp; Endovascular Surgery',  'tl_place' => 'Krishna Institute of Medical Sciences, Secunderabad', 'tl_side' => 'left',    'tl_current' => false ),
    array( 'tl_period' => 'Sep – Dec 2020',       'tl_role' => 'Senior Consultant, Vascular &amp; Endovascular Surgery', 'tl_place' => 'Krishna Institute of Medical Sciences, Secunderabad', 'tl_side' => 'right',   'tl_current' => false ),
    array( 'tl_period' => 'Dec 2020 – Aug 2022',  'tl_role' => 'Senior Consultant, Vascular &amp; Endovascular Surgery', 'tl_place' => 'Medicover Hospitals, Madhapur',                       'tl_side' => 'left',    'tl_current' => false ),
    array( 'tl_period' => 'Aug 2022 – Present',   'tl_role' => 'Senior Consultant Vascular &amp; Endovascular Surgeon · Clinical Director', 'tl_place' => 'Yashoda Hospitals, Hitec City',    'tl_side' => 'right',   'tl_current' => true ),
);
$display_timeline = ! empty( $timeline ) ? $timeline : $default_timeline;

$publications = vg_field( 'publications', get_the_ID() );
$default_pubs = array(
    array( 'pub_type' => 'Thesis',          'pub_title' => 'A Study of the Predictive Value of Clinical, Laboratory and Radiological Data in Acute Appendicitis' ),
    array( 'pub_type' => 'Prospective Study','pub_title' => 'Short &amp; Medium Term Outcomes of AV Access Enhancement and Salvage Procedures in End Stage Renal Disease' ),
    array( 'pub_type' => 'Case Report · Indian Journal of Mednodent and Allied Sciences, 3(1), Feb 2015', 'pub_title' => 'Adult Cystic Hygroma — A Rare Entity' ),
    array( 'pub_type' => 'Case Report · Indian Journal of Mednodent and Allied Sciences, 2(3), Nov 2014', 'pub_title' => 'Management of Trans-Section of Right Hepatic Duct during Laparoscopic Cholecystectomy' ),
);
$display_pubs = ! empty( $publications ) ? $publications : $default_pubs;

$philosophy_quote = vg_field( 'philosophy_quote', get_the_ID(), '"Vascular care is at its best when it is precise, gentle and clearly understood. Every patient deserves a diagnosis they trust and a treatment plan built around their life — not just their disease."' );
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
                <span class="crumb-active text-white"><?php esc_html_e( 'About', 'vascular-grace' ); ?></span>
            </div>
            <div class="about-hero-content max-w-4xl">
                <div class="about-pill inline-flex items-center gap-2 mb-6">
                    <span class="pulse-dot"></span>
                    <span class="text-xs uppercase tracking-widest text-white/80 font-semibold"><?php esc_html_e( 'About', 'vascular-grace' ); ?></span>
                </div>
                <h1 class="about-hero-title font-display text-white">
                    <?php echo wp_kses_post( nl2br( $hero_title ) ); ?>
                </h1>
                <p class="about-hero-subtitle text-white/80 mt-6">
                    <?php echo wp_kses_post( $hero_subtitle ); ?>
                </p>
            </div>
        </div>
        <div class="about-hero-curve">
            <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
                <path d="M0,25 C360,75 1080,-25 1440,35 L1440,90 L0,90 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- ── INTRO & CREDENTIALS ─────────────────────────────────────────── -->
    <section class="about-intro-section py-large bg-white">
        <div class="container">
            <div class="about-intro-layout mb-16">
                <div class="about-intro-photo-col">
                    <div class="about-intro-photo-frame">
                        <?php if ( ! empty( $intro_image ) && is_array( $intro_image ) && ! empty( $intro_image['url'] ) ) : ?>
                            <img src="<?php echo esc_url( $intro_image['url'] ); ?>" alt="<?php echo esc_attr( $intro_image['alt'] ?? get_the_title() ); ?>" class="about-intro-img" loading="lazy">
                        <?php else : ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/dr-srikanth-raju-transparent.png' ); ?>" alt="<?php esc_attr_e( 'Dr. S Srikanth Raju', 'vascular-grace' ); ?>" class="about-intro-img default-portrait" loading="lazy">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="about-intro-text-col">
                    <div class="section-label text-crimson mb-3"><?php esc_html_e( '— CLINICAL LEADERSHIP', 'vascular-grace' ); ?></div>
                    <h2 class="section-title text-dark mb-6"><?php esc_html_e( 'Dedicated Vascular &amp; Endovascular Care', 'vascular-grace' ); ?></h2>
                    <p class="intro-lead mb-6"><?php echo wp_kses_post( $intro_lead1 ); ?></p>
                    <p class="intro-lead"><?php echo wp_kses_post( $intro_lead2 ); ?></p>
                </div>
            </div>

            <div class="about-credentials-grid">
                <?php foreach ( $display_creds as $cred ) : ?>
                    <div class="cred-card">
                        <div class="cred-icon <?php echo esc_attr( $cred['cred_color'] ?? 'text-blue' ); ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                        </div>
                        <h4 class="cred-title font-display"><?php echo wp_kses( $cred['cred_title'] ?? '', array() ); ?></h4>
                        <p class="cred-sub"><?php echo esc_html( $cred['cred_sub'] ?? '' ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── EDUCATION ───────────────────────────────────────────────────── -->
    <section class="about-education-section py-large bg-soft">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— ACADEMIC BACKGROUND', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Educational Qualifications', 'vascular-grace' ); ?></h2>
            </div>
            <div class="education-grid">
                <?php foreach ( $display_edu as $edu ) : ?>
                    <div class="education-card">
                        <div class="edu-year text-crimson"><?php echo esc_html( $edu['edu_year'] ?? '' ); ?></div>
                        <h3 class="edu-degree font-display"><?php echo esc_html( $edu['edu_degree'] ?? '' ); ?></h3>
                        <p class="edu-institution"><?php echo esc_html( $edu['edu_institution'] ?? '' ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── TIMELINE ────────────────────────────────────────────────────── -->
    <section class="about-journey-section py-large bg-white">
        <div class="container max-w-4xl">
            <div class="section-header mb-16">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— CAREER MILESTONES', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Professional Journey', 'vascular-grace' ); ?></h2>
            </div>
            <div class="timeline-wrapper relative">
                <div class="timeline-line"></div>
                <?php foreach ( $display_timeline as $item ) :
                    $side    = esc_attr( $item['tl_side'] ?? 'left' );
                    $current = ! empty( $item['tl_current'] );
                    ?>
                    <div class="timeline-item <?php echo $side; ?>-item<?php echo $current ? ' current-milestone' : ''; ?>">
                        <div class="timeline-dot<?php echo $current ? ' active-dot' : ''; ?>"></div>
                        <div class="timeline-content">
                            <span class="timeline-period text-crimson"><?php echo esc_html( $item['tl_period'] ?? '' ); ?></span>
                            <h4 class="timeline-role font-display"><?php echo wp_kses( $item['tl_role'] ?? '', array() ); ?></h4>
                            <p class="timeline-place"><?php echo esc_html( $item['tl_place'] ?? '' ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── RESEARCH & MEMBERSHIPS ──────────────────────────────────────── -->
    <section class="about-research-section py-large bg-soft">
        <div class="container">
            <div class="research-grid">
                <div class="research-col">
                    <div class="flex-align gap-3 mb-8">
                        <svg class="text-blue" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 7v14"></path><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path></svg>
                        <h2 class="section-title text-dark"><?php esc_html_e( 'Research &amp; Publications', 'vascular-grace' ); ?></h2>
                    </div>
                    <div class="publication-cards-list">
                        <?php foreach ( $display_pubs as $pub ) : ?>
                            <div class="publication-card">
                                <span class="pub-type text-crimson"><?php echo wp_kses( $pub['pub_type'] ?? '', array() ); ?></span>
                                <h4 class="pub-title font-display"><?php echo wp_kses( $pub['pub_title'] ?? '', array() ); ?></h4>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="affiliations-col">
                    <div class="flex-align gap-3 mb-8">
                        <svg class="text-crimson" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <h2 class="section-title text-dark"><?php esc_html_e( 'Memberships', 'vascular-grace' ); ?></h2>
                    </div>
                    <div class="publication-card mb-8">
                        <div class="flex-align gap-3">
                            <div class="membership-badge">VSI</div>
                            <div>
                                <h4 class="pub-title font-display mb-1"><?php esc_html_e( 'Vascular Society of India', 'vascular-grace' ); ?></h4>
                                <p class="text-sm text-muted"><?php esc_html_e( 'Full Life Member', 'vascular-grace' ); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-align gap-3 mb-8">
                        <svg class="text-blue" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16"></path><path d="M10 9h4"></path><path d="M10 13h4"></path><path d="M10 17h4"></path></svg>
                        <h2 class="section-title text-dark"><?php esc_html_e( 'Affiliation', 'vascular-grace' ); ?></h2>
                    </div>
                    <div class="publication-card">
                        <h4 class="pub-title font-display mb-2"><?php vg_the_text( 'address_line1', 'option', 'Yashoda Hospitals, Hitec City' ); ?></h4>
                        <p class="text-sm text-muted mb-3"><?php vg_the_text( 'doctor_role', 'option', 'Sr. Consultant Vascular &amp; Endovascular Surgeon · Clinical Director' ); ?></p>
                        <div class="opd-badge">
                            <span class="font-semibold text-dark"><?php esc_html_e( 'OPD Schedule:', 'vascular-grace' ); ?></span>
                            <?php vg_the_text( 'business_hours', 'option', 'Mon–Sat · 9:00 AM – 5:00 PM' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── PHILOSOPHY ──────────────────────────────────────────────────── -->
    <section class="about-philosophy-section py-large bg-white">
        <div class="container max-w-3xl text-center">
            <div class="philosophy-icon-wrap mx-auto mb-6">
                <svg class="text-crimson" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
            </div>
            <h2 class="section-title text-dark mb-6"><?php esc_html_e( 'Philosophy of Care', 'vascular-grace' ); ?></h2>
            <blockquote class="philosophy-quote font-display">
                <?php echo esc_html( $philosophy_quote ); ?>
            </blockquote>
            <div class="philosophy-author text-muted mt-6 text-sm">
                — <?php vg_the_text( 'doctor_name_full', 'option', 'Dr. S Srikanth Raju' ); ?>
            </div>
        </div>
    </section>

    <!-- ── STATS BAND ───────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/stats', null, array( 'class' => 'py-large' ) ); ?>

    <!-- ── CTA BAND ────────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>
