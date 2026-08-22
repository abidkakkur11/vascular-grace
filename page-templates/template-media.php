<?php
/**
 * Template Name: Media
 *
 * Media / Videos & Press page — matches the original design with:
 * 1. Short-Form Videos (Instagram Reels & YT Shorts)
 * 2. Long-Form Educational Videos (YouTube Talks & Patient Case Studies)
 * 3. News & Media Highlights (Press & Coverage)
 *
 * ACF Field Group Location: Page Template → is → template-media.php
 *
 * @package VascularGrace
 */

get_header();

$hero_title    = vg_field( 'media_hero_title', get_the_ID(), "Clinical insights, videos and <br><span class=\"hero-title-accent\">news features.</span>" );
$hero_subtitle = vg_field( 'media_hero_subtitle', get_the_ID(), 'Watch patient awareness shorts, in-depth surgical talks, and explore recent media coverage with Dr. S Srikanth Raju.' );

// Section 1: Shorts & Reels
$shorts_items = vg_field( 'media_shorts', get_the_ID() );
$default_shorts = array(
    array(
        'short_title' => "Early Signs of Varicose Veins You Shouldn't Ignore",
        'short_url'   => '',
        'short_bg'    => 'short-bg-1',
    ),
    array(
        'short_title' => 'Daily Foot Care Routine for Diabetic Patients',
        'short_url'   => '',
        'short_bg'    => 'short-bg-2',
    ),
    array(
        'short_title' => 'How to Prevent DVT on Flights Longer than 4 Hours',
        'short_url'   => '',
        'short_bg'    => 'short-bg-3',
    ),
    array(
        'short_title' => 'Laser vs Surgery: What is Walk-in Walk-out Vein Care?',
        'short_url'   => '',
        'short_bg'    => 'short-bg-4',
    ),
);
$display_shorts = ( ! empty( $shorts_items ) && is_array( $shorts_items ) ) ? $shorts_items : $default_shorts;

// Section 2: Educational YouTube Videos
$youtube_items = vg_field( 'media_youtube', get_the_ID() );
$default_youtube = array(
    array(
        'yt_title' => 'Modern Management of Peripheral Arterial Disease (PAD)',
        'yt_url'   => '',
        'yt_bg'    => 'yt-bg-1',
    ),
    array(
        'yt_title' => 'Endovenous Laser Ablation: What Happens on Procedure Day?',
        'yt_url'   => '',
        'yt_bg'    => 'yt-bg-2',
    ),
    array(
        'yt_title' => 'Complex Aortic Aneurysm Repair (EVAR) & Dissection Care',
        'yt_url'   => '',
        'yt_bg'    => 'yt-bg-3',
    ),
);
$display_youtube = ( ! empty( $youtube_items ) && is_array( $youtube_items ) ) ? $youtube_items : $default_youtube;

// Section 3: News & Media Highlights
$news_items = vg_field( 'media_news', get_the_ID() );
$default_news = array(
    array(
        'news_title' => 'Minimally Invasive Techniques Transforming Diabetic Foot Management in Telangana',
        'news_url'   => '',
        'news_bg'    => 'news-bg-1',
    ),
    array(
        'news_title' => 'Yashoda Hospitals Successfully Performs Emergency Aortic Aneurysm Salvage',
        'news_url'   => '',
        'news_bg'    => 'news-bg-2',
    ),
    array(
        'news_title' => 'Walk-In Walk-Out Laser Surgery: The Future of Varicose Vein Treatment',
        'news_url'   => '',
        'news_bg'    => 'news-bg-3',
    ),
);
$display_news = ( ! empty( $news_items ) && is_array( $news_items ) ) ? $news_items : $default_news;
?>

    <!-- Page Hero Banner (Dark Theme) -->
    <section class="about-hero-section bg-dark text-white relative overflow-hidden">
        <!-- Ambient vascular glow & curved flow paths -->
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
            <!-- Breadcrumbs -->
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

        <!-- Smooth Curved Wave Cutout at bottom -->
        <div class="about-hero-curve">
            <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
                <path d="M0,25 C360,75 1080,-25 1440,35 L1440,90 L0,90 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- SECTION 1: Instagram Reels & YT Shorts -->
    <section class="media-section py-large bg-white">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— SHORT-FORM VIDEOS', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Quick Tips &amp; Awareness Shorts', 'vascular-grace' ); ?></h2>
            </div>

            <div class="shorts-grid">
                <?php foreach ( $display_shorts as $i => $short ) :
                    $s_bg    = ! empty( $short['short_bg'] ) ? esc_attr( $short['short_bg'] ) : ( 'short-bg-' . ( ( $i % 4 ) + 1 ) );
                    $s_thumb = $short['short_thumb'] ?? null;
                    $s_url   = ! empty( $short['short_url'] ) ? esc_url( $short['short_url'] ) : '';
                    $tag     = $s_url ? 'a' : 'div';
                    $href    = $s_url ? ' href="' . $s_url . '" target="_blank" rel="noopener noreferrer"' : '';
                    $style   = ( ! empty( $s_thumb ) && is_array( $s_thumb ) ) ? ' style="background-image:url(' . esc_url( $s_thumb['url'] ) . ');"' : '';
                    ?>
                    <<?php echo $tag . $href; ?> class="short-video-card">
                        <div class="short-thumb-wrapper">
                            <div class="short-gradient-art <?php echo $s_bg; ?>"<?php echo $style; ?>>
                                <div class="grid-noise-overlay"></div>
                                <div class="play-btn-pulse">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
                            </div>
                        </div>
                        <div class="short-card-info">
                            <h3 class="short-card-title font-display"><?php echo esc_html( $short['short_title'] ?? '' ); ?></h3>
                        </div>
                    </<?php echo $tag; ?>>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION 2: Long-Form YouTube Videos -->
    <section class="media-section py-large bg-soft">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— EDUCATIONAL VIDEOS', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'In-Depth Clinical Talks &amp; Patient Case Studies', 'vascular-grace' ); ?></h2>
            </div>

            <div class="youtube-videos-grid">
                <?php foreach ( $display_youtube as $i => $yt ) :
                    $yt_bg    = ! empty( $yt['yt_bg'] ) ? esc_attr( $yt['yt_bg'] ) : ( 'yt-bg-' . ( ( $i % 3 ) + 1 ) );
                    $yt_thumb = $yt['yt_thumb'] ?? null;
                    $yt_url   = ! empty( $yt['yt_url'] ) ? esc_url( $yt['yt_url'] ) : '';
                    $tag      = $yt_url ? 'a' : 'div';
                    $href     = $yt_url ? ' href="' . $yt_url . '" target="_blank" rel="noopener noreferrer"' : '';
                    $style    = ( ! empty( $yt_thumb ) && is_array( $yt_thumb ) ) ? ' style="background-image:url(' . esc_url( $yt_thumb['url'] ) . ');"' : '';
                    ?>
                    <<?php echo $tag . $href; ?> class="yt-video-card">
                        <div class="yt-thumb-wrapper">
                            <div class="yt-gradient-art <?php echo $yt_bg; ?>"<?php echo $style; ?>>
                                <div class="grid-noise-overlay"></div>
                                <div class="yt-play-button">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
                            </div>
                        </div>
                        <div class="yt-video-body">
                            <h3 class="yt-video-title font-display"><?php echo esc_html( $yt['yt_title'] ?? '' ); ?></h3>
                        </div>
                    </<?php echo $tag; ?>>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION 3: News & Media Highlights -->
    <section class="media-section py-large bg-white">
        <div class="container">
            <div class="section-header mb-12">
                <div class="section-label text-crimson mb-3"><?php esc_html_e( '— PRESS &amp; COVERAGE', 'vascular-grace' ); ?></div>
                <h2 class="section-title text-dark"><?php esc_html_e( 'Featured in News &amp; Media Highlights', 'vascular-grace' ); ?></h2>
            </div>

            <div class="news-media-grid">
                <?php foreach ( $display_news as $i => $news ) :
                    $n_bg    = ! empty( $news['news_bg'] ) ? esc_attr( $news['news_bg'] ) : ( 'news-bg-' . ( ( $i % 3 ) + 1 ) );
                    $n_thumb = $news['news_thumb'] ?? null;
                    $n_url   = ! empty( $news['news_url'] ) ? esc_url( $news['news_url'] ) : '';
                    $tag     = $n_url ? 'a' : 'article';
                    $href    = $n_url ? ' href="' . $n_url . '" target="_blank" rel="noopener noreferrer"' : '';
                    $style   = ( ! empty( $n_thumb ) && is_array( $n_thumb ) ) ? ' style="background-image:url(' . esc_url( $n_thumb['url'] ) . ');"' : '';
                    ?>
                    <<?php echo $tag . $href; ?> class="news-article-card">
                        <div class="news-thumb-wrapper">
                            <div class="news-gradient-art <?php echo $n_bg; ?>"<?php echo $style; ?>>
                                <div class="grid-noise-overlay"></div>
                            </div>
                        </div>
                        <div class="news-body">
                            <h3 class="news-title font-display">
                                <?php echo esc_html( $news['news_title'] ?? '' ); ?>
                            </h3>
                        </div>
                    </<?php echo $tag; ?>>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── CTA BAND ────────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>

