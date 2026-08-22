<?php
/**
 * Template Name: Media
 *
 * Media / Press page — managed via ACF Repeater for press mentions,
 * awards, and media gallery items.
 *
 * ACF Field Group Location: Page Template → is → template-media.php
 *
 * @package VascularGrace
 */

get_header();

$hero_title    = vg_field( 'media_hero_title', get_the_ID(), "Media &\n<span class=\"hero-title-accent\">Press.</span>" );
$hero_subtitle = vg_field( 'media_hero_subtitle', get_the_ID(), 'Press mentions, awards, television appearances, and media coverage featuring Dr. S Srikanth Raju.' );

$press_items = vg_field( 'press_items', get_the_ID() );
$default_press = array(
    array(
        'press_outlet'   => 'The Times of India',
        'press_date'     => 'Healthcare Feature',
        'press_headline' => 'Advanced Endovascular Laser Interventions Revolutionize Varicose Vein Treatment with Day-Care Procedures',
        'press_url'      => '#',
    ),
    array(
        'press_outlet'   => 'The Hindu',
        'press_date'     => 'Medical Insight',
        'press_headline' => 'Preventing Limb Amputation in Diabetic Patients: Early Vascular Diagnosis and Revascularization Protocols',
        'press_url'      => '#',
    ),
    array(
        'press_outlet'   => 'Deccan Chronicle',
        'press_date'     => 'Special Report',
        'press_headline' => 'Expert Vascular Surgeon on Recognizing Deep Vein Thrombosis (DVT) Symptoms and Minimizing Long-Term Risks',
        'press_url'      => '#',
    ),
    array(
        'press_outlet'   => 'Telangana Today',
        'press_date'     => 'Clinical Profile',
        'press_headline' => 'Complex Aortic Aneurysm Repair Successfully Performed at Yashoda Hospitals, Hitec City',
        'press_url'      => '#',
    ),
);
$display_press = ( ! empty( $press_items ) && is_array( $press_items ) ) ? $press_items : $default_press;

$awards = vg_field( 'awards', get_the_ID() );
$default_awards = array(
    array(
        'award_title'       => 'Best Vascular Case Presentation Award',
        'award_institution' => 'Vascular Society of India (VSI)',
        'award_year'        => '2023',
    ),
    array(
        'award_title'       => 'Excellence in Endovascular Interventions',
        'award_institution' => 'National Endovascular Surgery Conference',
        'award_year'        => '2021',
    ),
    array(
        'award_title'       => 'DNB Gold Medal Candidate in Peripheral Vascular Surgery',
        'award_institution' => 'National Board of Examinations',
        'award_year'        => '2019',
    ),
    array(
        'award_title'       => 'Distinguished Clinical Research Fellowship',
        'award_institution' => 'Narayana Health City, Bengaluru',
        'award_year'        => '2018',
    ),
);
$display_awards = ( ! empty( $awards ) && is_array( $awards ) ) ? $awards : $default_awards;

$gallery_items = vg_field( 'media_gallery', get_the_ID() );
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
                <span class="crumb-active text-white"><?php esc_html_e( 'Media', 'vascular-grace' ); ?></span>
            </div>
            <div class="about-hero-content max-w-4xl">
                <div class="about-pill inline-flex items-center gap-2 mb-6">
                    <span class="pulse-dot"></span>
                    <span class="text-xs uppercase tracking-widest text-white/80 font-semibold"><?php esc_html_e( 'Media &amp; Press', 'vascular-grace' ); ?></span>
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

    <!-- ── PRESS MENTIONS ──────────────────────────────────────────────── -->
    <section class="media-press-section py-large bg-white">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— PRESS MENTIONS', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Featured In News &amp; Publications', 'vascular-grace' ); ?></h2>
            </div>
            <div class="press-grid">
                <?php foreach ( $display_press as $item ) : ?>
                    <div class="press-card">
                        <div class="press-card-header">
                            <?php if ( ! empty( $item['press_logo'] ) && is_array( $item['press_logo'] ) ) : ?>
                                <?php echo wp_get_attachment_image( $item['press_logo']['ID'], 'medium', false, array( 'class' => 'press-logo', 'alt' => esc_attr( $item['press_outlet'] ?? '' ) ) ); ?>
                            <?php else : ?>
                                <span class="press-outlet-badge"><?php echo esc_html( $item['press_outlet'] ?? '' ); ?></span>
                            <?php endif; ?>
                            <?php if ( ! empty( $item['press_date'] ) ) : ?>
                                <span class="press-date text-muted text-xs"><?php echo esc_html( $item['press_date'] ); ?></span>
                            <?php endif; ?>
                        </div>
                        <h3 class="press-headline font-display"><?php echo esc_html( $item['press_headline'] ?? '' ); ?></h3>
                        <?php if ( ! empty( $item['press_url'] ) && '#' !== $item['press_url'] ) : ?>
                            <a href="<?php echo esc_url( $item['press_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn-text text-blue hover-blue-dark">
                                <?php esc_html_e( 'Read article', 'vascular-grace' ); ?>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── AWARDS & RECOGNITION ────────────────────────────────────────── -->
    <section class="media-awards-section py-large bg-soft">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— RECOGNITION', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Honors &amp; Fellowships', 'vascular-grace' ); ?></h2>
            </div>
            <div class="awards-grid">
                <?php foreach ( $display_awards as $award ) : ?>
                    <div class="award-card">
                        <div class="award-icon-wrap">
                            <svg class="text-crimson" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"></circle><path d="m8.21 13.89-1.21 7.11 5-3 5 3-1.21-7.11"></path></svg>
                        </div>
                        <div class="award-content">
                            <div class="award-meta">
                                <?php if ( ! empty( $award['award_year'] ) ) : ?>
                                    <span class="award-year-tag"><?php echo esc_html( $award['award_year'] ); ?></span>
                                <?php endif; ?>
                            </div>
                            <h3 class="award-title font-display"><?php echo esc_html( $award['award_title'] ?? '' ); ?></h3>
                            <?php if ( ! empty( $award['award_institution'] ) ) : ?>
                                <p class="award-institution text-muted text-sm"><?php echo esc_html( $award['award_institution'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── MEDIA GALLERY (if images uploaded) ─────────────────────────── -->
    <?php if ( ! empty( $gallery_items ) && is_array( $gallery_items ) ) : ?>
    <section class="media-gallery-section py-large bg-white">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— GALLERY', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Media &amp; Events Gallery', 'vascular-grace' ); ?></h2>
            </div>
            <div class="gallery-grid">
                <?php foreach ( $gallery_items as $gitem ) :
                    $gimg = $gitem['gallery_image'] ?? null;
                    if ( empty( $gimg ) || ! is_array( $gimg ) ) continue;
                    ?>
                    <div class="gallery-item">
                        <div class="gallery-img-wrapper">
                            <?php echo wp_get_attachment_image( $gimg['ID'], 'medium_large', false, array( 'class' => 'gallery-img', 'alt' => esc_attr( $gitem['gallery_caption'] ?? '' ) ) ); ?>
                        </div>
                        <?php if ( ! empty( $gitem['gallery_caption'] ) ) : ?>
                            <p class="gallery-caption"><?php echo esc_html( $gitem['gallery_caption'] ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── CTA BAND ────────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>

