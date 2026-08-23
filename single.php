<?php
/**
 * Vascular Grace — single.php
 *
 * Single Blog Post Template — modern, high-converting clinical article layout.
 *
 * @package VascularGrace
 */

get_header();

while ( have_posts() ) :
	the_post();

	$post_id          = get_the_ID();
	$categories       = get_the_category();
	$primary_cat      = ! empty( $categories ) ? $categories[0] : null;
	$reading_time     = vg_get_reading_time( $post_id );
	$doctor_name      = vg_option( 'doctor_name_full', 'Dr. S Srikanth Raju' );
	$doctor_creds     = vg_option( 'doctor_credentials', 'MBBS · MS (Gen. Surgery) · DNB (Vascular)' );
	$doctor_role      = vg_option( 'doctor_role', 'Sr. Consultant Vascular & Endovascular Surgeon / Clinical Director' );
	$phone            = vg_get_phone();
	$post_url         = urlencode( get_permalink() );
	$post_title_enc   = urlencode( get_the_title() );
	?>

	<!-- ── ARTICLE HERO BANNER ─────────────────────────────────────────── -->
	<header class="about-hero-section single-post-hero bg-dark text-white relative overflow-hidden">
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
			<nav class="about-breadcrumbs mb-6" aria-label="<?php esc_attr_e( 'Breadcrumb', 'vascular-grace' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'vascular-grace' ); ?></a>
				<span class="crumb-sep">›</span>
				<a href="<?php echo esc_url( home_url( '/blogs/' ) ); ?>"><?php esc_html_e( 'Blogs', 'vascular-grace' ); ?></a>
				<?php if ( $primary_cat ) : ?>
					<span class="crumb-sep">›</span>
					<a href="<?php echo esc_url( get_category_link( $primary_cat->term_id ) ); ?>"><?php echo esc_html( $primary_cat->name ); ?></a>
				<?php endif; ?>
				<span class="crumb-sep">›</span>
				<span class="crumb-active text-white truncate max-w-xs inline-block align-bottom"><?php the_title(); ?></span>
			</nav>

			<div class="single-hero-content max-w-4xl">
				<?php if ( $primary_cat ) : ?>
					<div class="about-pill inline-flex items-center gap-2 mb-4">
						<span class="pulse-dot"></span>
						<span class="text-xs uppercase tracking-widest text-white/90 font-semibold"><?php echo esc_html( $primary_cat->name ); ?></span>
					</div>
				<?php endif; ?>

				<h1 class="single-post-title font-display text-white">
					<?php the_title(); ?>
				</h1>

				<!-- Author & Post Metadata Bar -->
				<div class="single-post-meta flex-align gap-6 flex-wrap mt-6 pt-6 border-t border-white/10 text-sm text-white/80">
					<div class="meta-item flex-align gap-2">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
						<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
					</div>

					<div class="meta-divider text-white/30 hidden sm:inline">|</div>

					<div class="meta-item flex-align gap-2">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
						<span><?php echo esc_html( $reading_time ); ?></span>
					</div>
				</div>
			</div>
		</div>

		<!-- Smooth Bottom Wave Curve -->
		<div class="about-hero-curve">
			<svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
				<path d="M0,25 C360,75 1080,-25 1440,35 L1440,90 L0,90 Z" fill="#ffffff"></path>
			</svg>
		</div>
	</header>

	<!-- ── ARTICLE BODY & SIDEBAR SECTION ─────────────────────────────── -->
	<main class="single-article-section py-large bg-white">
		<div class="container">
			<div class="single-article-layout">

				<!-- ── LEFT: Main Article Column ── -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article-main' ); ?>>

					<!-- Featured Image -->
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="single-featured-image-box mb-8">
							<?php the_post_thumbnail( 'full', array( 'class' => 'single-featured-img', 'alt' => esc_attr( get_the_title() ) ) ); ?>
						</div>
					<?php endif; ?>

					<!-- Post Content Prose -->
					<div class="entry-content single-post-content legal-prose">
						<?php the_content(); ?>
					</div>

					<!-- Tags & Share Row -->
					<div class="single-post-footer mt-12 pt-8 border-t border-slate-200 flex-between flex-wrap gap-4">
						<?php
						$tags = get_the_tags();
						if ( $tags ) :
							?>
							<div class="single-tags-list flex-align gap-2 flex-wrap">
								<span class="text-xs uppercase font-bold tracking-wider text-slate-400 mr-1"><?php esc_html_e( 'Tags:', 'vascular-grace' ); ?></span>
								<?php foreach ( $tags as $tag ) : ?>
									<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="single-tag-badge">
										#<?php echo esc_html( $tag->name ); ?>
									</a>
								<?php endforeach; ?>
							</div>
						<?php else : ?>
							<div></div>
						<?php endif; ?>

						<!-- Share Buttons -->
						<div class="single-share-wrap flex-align gap-2">
							<span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-2"><?php esc_html_e( 'Share:', 'vascular-grace' ); ?></span>
							<a href="https://api.whatsapp.com/send?text=<?php echo $post_title_enc . '%20' . $post_url; ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-wa" aria-label="<?php esc_attr_e( 'Share on WhatsApp', 'vascular-grace' ); ?>">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.952 3.71 1.453 5.709 1.454h.005c6.554 0 11.89-5.336 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
							</a>
							<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $post_url; ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-in" aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'vascular-grace' ); ?>">
								<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
							</a>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-fb" aria-label="<?php esc_attr_e( 'Share on Facebook', 'vascular-grace' ); ?>">
								<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
							</a>
							<a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title_enc; ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-x" aria-label="<?php esc_attr_e( 'Share on X', 'vascular-grace' ); ?>">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
							</a>
						</div>
					</div>

					<!-- Doctor Bio & Consultation Card -->
					<div class="single-author-card mt-12">
						<div class="author-card-avatar-box">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/srikanth-raju.jpg' ); ?>" alt="<?php echo esc_attr( $doctor_name ); ?>" class="author-card-avatar">
						</div>
						<div class="author-card-body">
							<div class="author-card-badge"><?php esc_html_e( 'Reviewed by Specialist', 'vascular-grace' ); ?></div>
							<h3 class="author-card-name font-display"><?php echo esc_html( $doctor_name ); ?></h3>
							<p class="author-card-creds text-crimson font-medium text-xs uppercase tracking-wider mb-2"><?php echo esc_html( $doctor_creds ); ?></p>
							<p class="author-card-desc text-muted text-sm mb-4">
								<?php echo esc_html( $doctor_role ); ?>. <?php esc_html_e( 'Committed to minimally invasive laser treatments, limb salvage, and comprehensive vascular diagnostics.', 'vascular-grace' ); ?>
							</p>
							<div class="author-card-actions flex-align flex-wrap">
								<a href="#book" class="btn btn-primary btn-sm" data-open-modal="appointment">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
									<?php esc_html_e( 'Book Consultation', 'vascular-grace' ); ?>
								</a>
								<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn-text text-blue text-sm font-semibold" style="margin-left: 10px;">
									<?php esc_html_e( 'View Doctor Profile →', 'vascular-grace' ); ?>
								</a>
							</div>
						</div>
					</div>

					<!-- Post Prev / Next Navigation -->
					<div class="single-post-nav mt-12 pt-8 border-t border-slate-200">
						<div class="post-nav-grid">
							<?php
							$prev_post = get_previous_post();
							if ( $prev_post ) :
								?>
								<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="post-nav-item nav-prev">
									<span class="nav-label text-xs uppercase tracking-wider text-muted flex-align gap-1 mb-1">
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
										<?php esc_html_e( 'Previous Article', 'vascular-grace' ); ?>
									</span>
									<span class="nav-title font-display font-semibold line-clamp-2"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
								</a>
							<?php else : ?>
								<div></div>
							<?php endif; ?>

							<?php
							$next_post = get_next_post();
							if ( $next_post ) :
								?>
								<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="post-nav-item nav-next text-right">
									<span class="nav-label text-xs uppercase tracking-wider text-muted flex-align gap-1 justify-end mb-1">
										<?php esc_html_e( 'Next Article', 'vascular-grace' ); ?>
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
									</span>
									<span class="nav-title font-display font-semibold line-clamp-2"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
								</a>
							<?php endif; ?>
						</div>
					</div>

				</article>

				<!-- ── RIGHT: Sticky Consultation & Related Sidebar ── -->
				<aside class="single-blog-sidebar">
					<div class="sticky-sidebar-inner">

						<!-- Appointment Booking Card -->
						<div class="sidebar-widget sidebar-cta-box">
							<div class="sidebar-badge-top">
								<span class="pulse-dot"></span>
								<span class="text-xs uppercase font-bold tracking-wider text-crimson"><?php esc_html_e( 'Clinical Appointments', 'vascular-grace' ); ?></span>
							</div>
							<h3 class="sidebar-cta-title font-display"><?php esc_html_e( 'Need Expert Vascular Consultation?', 'vascular-grace' ); ?></h3>
							<p class="sidebar-cta-desc text-muted text-sm mb-6">
								<?php esc_html_e( 'Get an accurate Doppler diagnosis and personalized treatment plan from Dr. S Srikanth Raju at Yashoda Hospitals.', 'vascular-grace' ); ?>
							</p>
							<a href="#book" class="btn btn-primary btn-full shadow-crimson" data-open-modal="appointment">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
								<?php esc_html_e( 'Book Consultation', 'vascular-grace' ); ?>
							</a>
						</div>

						<!-- Recent Clinical Insights Widget -->
						<?php
						$recent_query = new WP_Query( array(
							'post_type'      => 'post',
							'posts_per_page' => 4,
							'post__not_in'   => array( $post_id ),
							'orderby'        => 'date',
							'order'          => 'DESC',
						) );

						if ( $recent_query->have_posts() ) :
							?>
							<div class="sidebar-widget sidebar-articles-widget mt-8">
								<h4 class="sidebar-widget-title font-display"><?php esc_html_e( 'Latest Articles', 'vascular-grace' ); ?></h4>
								<div class="sidebar-post-list">
									<?php
									while ( $recent_query->have_posts() ) :
										$recent_query->the_post();
										?>
										<article class="sidebar-post-item flex-align gap-3">
											<?php if ( has_post_thumbnail() ) : ?>
												<a href="<?php the_permalink(); ?>" class="sidebar-post-thumb flex-shrink-0" tabindex="-1" aria-hidden="true">
													<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'sidebar-thumb-img' ) ); ?>
												</a>
											<?php endif; ?>
											<div class="sidebar-post-content">
												<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>" class="text-xs text-muted block mb-1"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
												<h5 class="sidebar-post-item-title font-display text-sm">
													<a href="<?php the_permalink(); ?>" class="hover-crimson"><?php the_title(); ?></a>
												</h5>
											</div>
										</article>
									<?php endwhile; wp_reset_postdata(); ?>
								</div>
							</div>
						<?php endif; ?>

					</div>
				</aside>

			</div>
		</div>
	</main>

	<!-- ── RELATED ARTICLES GRID ───────────────────────────────────────── -->
	<?php
	$related_args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post__not_in'   => array( $post_id ),
		'orderby'        => 'rand',
	);
	if ( $primary_cat ) {
		$related_args['cat'] = $primary_cat->term_id;
	}
	$related_query = new WP_Query( $related_args );

	if ( $related_query->have_posts() ) :
		?>
		<section class="related-posts-section py-large bg-slate-50 border-t border-slate-200">
			<div class="container">
				<div class="section-header flex-between flex-wrap gap-4 mb-8">
					<div>
						<div class="badge-tag mb-2"><?php esc_html_e( 'Explore More', 'vascular-grace' ); ?></div>
						<h2 class="section-title font-display"><?php esc_html_e( 'Related Medical Articles', 'vascular-grace' ); ?></h2>
					</div>
					<a href="<?php echo esc_url( home_url( '/blogs/' ) ); ?>" class="btn btn-outline btn-sm">
						<?php esc_html_e( 'View All Blogs →', 'vascular-grace' ); ?>
					</a>
				</div>

				<div class="blog-grid">
					<?php
					while ( $related_query->have_posts() ) :
						$related_query->the_post();
						?>
						<article class="blog-card" id="related-post-<?php the_ID(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="blog-card-image-link" tabindex="-1" aria-hidden="true">
									<?php the_post_thumbnail( 'medium_large', array( 'class' => 'blog-card-image' ) ); ?>
								</a>
							<?php endif; ?>
							<div class="blog-card-body">
								<div class="blog-card-meta text-muted text-sm">
									<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
									<?php
									$rcats = get_the_category();
									if ( $rcats ) :
										echo ' · <span class="blog-card-cat text-crimson">' . esc_html( $rcats[0]->name ) . '</span>';
									endif;
									?>
								</div>
								<h3 class="blog-card-title font-display">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<p class="blog-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18, '…' ); ?></p>
								<a href="<?php the_permalink(); ?>" class="btn-text text-blue hover-blue-dark">
									<?php esc_html_e( 'Read article', 'vascular-grace' ); ?>
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
								</a>
							</div>
						</article>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- ── UNIVERSAL CTA BAND ──────────────────────────────────────────── -->
	<?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php
endwhile;

get_footer();
