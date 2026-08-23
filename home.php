<?php
/**
 * Home — Blog Posts Index (Archive)
 *
 * WordPress loads this file automatically as the blog posts index
 * when "Settings > Reading → Posts page" is set to any page.
 * This makes the Blogs page work without needing to assign a template.
 *
 * @package VascularGrace
 */

get_header();

global $wp_query;

// Get the ID of the page designated as the "Posts page" in Settings > Reading
$blog_page_id = get_option( 'page_for_posts' );

$hero_title    = vg_field( 'blogs_hero_title', $blog_page_id, "Medical insights &\n<span class=\"hero-title-accent\">health articles.</span>" );
$hero_subtitle = vg_field( 'blogs_hero_subtitle', $blog_page_id, 'Evidence-based articles on vascular health, treatment options, and patient guidance from Dr. S Srikanth Raju.' );

$paged = get_query_var( 'paged' ) ?: 1;
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
                <span class="crumb-sep">&#8250;</span>
                <span class="crumb-active text-white"><?php esc_html_e( 'Blogs', 'vascular-grace' ); ?></span>
            </div>
            <div class="about-hero-content max-w-4xl">
                <div class="about-pill inline-flex items-center gap-2 mb-6">
                    <span class="pulse-dot"></span>
                    <span class="text-xs uppercase tracking-widest text-white/80 font-semibold"><?php esc_html_e( 'Health &amp; Medical Insights', 'vascular-grace' ); ?></span>
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

    <!-- ── BLOG GRID ───────────────────────────────────────────────────── -->
    <section class="blogs-section py-large bg-white">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="blog-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="blog-card" id="post-<?php the_ID(); ?>">
                            <a href="<?php the_permalink(); ?>" class="blog-card-image-link" tabindex="-1" aria-hidden="true">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'blog-card-image' ) ); ?>
                                <?php else : ?>
                                    <div class="blog-placeholder-art">
                                        <svg class="blog-placeholder-svg" viewBox="0 0 100 60" fill="none">
                                            <path d="M0 30 Q25 10 50 30 T100 30" stroke="rgba(205,36,60,0.4)" stroke-width="2"/>
                                            <path d="M0 35 Q25 55 50 35 T100 35" stroke="rgba(55,91,182,0.4)" stroke-width="2"/>
                                        </svg>
                                        <span class="blog-placeholder-text font-display"><?php echo esc_html( vg_option( 'doctor_name_full', 'Dr. S Srikanth Raju' ) ); ?></span>
                                    </div>
                                <?php endif; ?>
                            </a>
                            <div class="blog-card-body">
                                <div class="blog-card-meta text-muted text-sm">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                    <?php
                                    $cats = get_the_category();
                                    if ( $cats ) :
                                        echo ' · <span class="blog-card-cat text-crimson">' . esc_html( $cats[0]->name ) . '</span>';
                                    endif;
                                    ?>
                                </div>
                                <h2 class="blog-card-title font-display">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="blog-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20, '…' ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn-text text-blue hover-blue-dark">
                                    <?php esc_html_e( 'Read more', 'vascular-grace' ); ?>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="blog-pagination mt-large text-center">
                    <?php
                    echo paginate_links( array(
                        'total'   => $wp_query->max_num_pages,
                        'current' => $paged,
                        'type'    => 'list',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <div class="blog-empty text-center py-large">
                    <p class="text-muted"><?php esc_html_e( 'No blog posts published yet. Check back soon.', 'vascular-grace' ); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ── CTA BAND ────────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>
