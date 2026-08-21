<?php
/**
 * Template Name: Media
 *
 * Media / Press page — managed via ACF Repeater for press mentions,
 * awards, and media gallery items.
 *
 * @package VascularGrace
 */

get_header();

$hero_title    = vg_field( 'media_hero_title', get_the_ID(), "Media &\n<span class=\"hero-title-accent\">Press.</span>" );
$hero_subtitle = vg_field( 'media_hero_subtitle', get_the_ID(), 'Press mentions, awards, television appearances, and media coverage featuring Dr. S Srikanth Raju.' );

$press_items   = vg_field( 'press_items', get_the_ID() );
$awards        = vg_field( 'awards', get_the_ID() );
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
    <?php if ( ! empty( $press_items ) ) : ?>
    <section class="media-press-section py-large bg-white">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— PRESS MENTIONS', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Featured In', 'vascular-grace' ); ?></h2>
            </div>
            <div class="press-grid">
                <?php foreach ( $press_items as $item ) : ?>
                    <div class="press-card">
                        <?php if ( ! empty( $item['press_logo'] ) && is_array( $item['press_logo'] ) ) : ?>
                            <?php echo wp_get_attachment_image( $item['press_logo']['ID'], 'medium', false, array( 'class' => 'press-logo', 'alt' => esc_attr( $item['press_outlet'] ?? '' ) ) ); ?>
                        <?php else : ?>
                            <div class="press-outlet-name font-display"><?php echo esc_html( $item['press_outlet'] ?? '' ); ?></div>
                        <?php endif; ?>
                        <p class="press-headline"><?php echo esc_html( $item['press_headline'] ?? '' ); ?></p>
                        <?php if ( ! empty( $item['press_url'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['press_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="btn-text text-blue hover-blue-dark">
                                <?php esc_html_e( 'Read article', 'vascular-grace' ); ?> ↗
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── AWARDS ──────────────────────────────────────────────────────── -->
    <?php if ( ! empty( $awards ) ) : ?>
    <section class="media-awards-section py-large bg-gray-light">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— RECOGNITION', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Awards &amp; Fellowships', 'vascular-grace' ); ?></h2>
            </div>
            <div class="awards-list">
                <?php foreach ( $awards as $award ) : ?>
                    <div class="award-card">
                        <div class="award-icon text-crimson">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"></circle><path d="m8.21 13.89-1.21 7.11 5-3 5 3-1.21-7.11"></path></svg>
                        </div>
                        <div>
                            <h4 class="award-title font-display"><?php echo esc_html( $award['award_title'] ?? '' ); ?></h4>
                            <p class="award-year text-muted text-sm"><?php echo esc_html( $award['award_year'] ?? '' ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── MEDIA GALLERY ───────────────────────────────────────────────── -->
    <?php if ( ! empty( $gallery_items ) ) : ?>
    <section class="media-gallery-section py-large bg-white">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— GALLERY', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Media Gallery', 'vascular-grace' ); ?></h2>
            </div>
            <div class="gallery-grid">
                <?php foreach ( $gallery_items as $gitem ) :
                    $gimg = $gitem['gallery_image'] ?? null;
                    if ( empty( $gimg ) || ! is_array( $gimg ) ) continue;
                    ?>
                    <div class="gallery-item">
                        <?php echo wp_get_attachment_image( $gimg['ID'], 'medium_large', false, array( 'class' => 'gallery-img', 'alt' => esc_attr( $gitem['gallery_caption'] ?? '' ) ) ); ?>
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
