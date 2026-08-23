<?php
/**
 * Vascular Grace — single-service.php
 *
 * Dedicated Standalone Service Page Template.
 * High-converting clinical procedure landing page synced with the theme.
 *
 * @package VascularGrace
 */

get_header();

while ( have_posts() ) :
	the_post();

	$service_id        = get_the_ID();
	$service_title     = get_the_title();
	$service_oneliner  = vg_field( 'service_oneliner', $service_id, '' );
	$service_badge     = vg_field( 'service_badge', $service_id, __( 'Specialized Vascular Procedure', 'vascular-grace' ) );
	$service_hero_sub  = vg_field( 'service_hero_subtitle', $service_id, $service_oneliner );
	$service_icon_svg  = vg_field( 'service_icon_svg', $service_id, '' );
	$service_main_img  = vg_field( 'service_main_image', $service_id );
	$service_gallery   = vg_field( 'service_gallery', $service_id, array() );
	$spec_duration     = vg_field( 'service_spec_duration', $service_id, '30–45 Mins' );
	$spec_anesthesia   = vg_field( 'service_spec_anesthesia', $service_id, 'Local / Tumescent' );
	$spec_stay         = vg_field( 'service_spec_stay', $service_id, 'Day Care / Same Day' );
	$spec_recovery     = vg_field( 'service_spec_recovery', $service_id, 'Walk home in 2 hours' );
	$symptoms_raw      = vg_field( 'service_symptoms', $service_id, '' );
	$treatment_steps   = vg_field( 'service_treatment_steps', $service_id, array() );
	$benefits_raw      = vg_field( 'service_benefits', $service_id, '' );
	$faqs              = vg_field( 'service_faqs', $service_id, array() );

	$doctor_name       = vg_option( 'doctor_name_full', 'Dr. S Srikanth Raju' );
	$doctor_creds      = vg_option( 'doctor_credentials', 'MBBS · MS (Gen. Surgery) · DNB (Vascular)' );
	$doctor_role       = vg_option( 'doctor_role', 'Sr. Consultant Vascular & Endovascular Surgeon / Clinical Director' );
	?>

	<!-- ── SERVICE HERO BANNER ─────────────────────────────────────────── -->
	<header class="about-hero-section service-single-hero bg-dark text-white relative overflow-hidden">
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
				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'vascular-grace' ); ?></a>
				<span class="crumb-sep">›</span>
				<span class="crumb-active text-white truncate max-w-xs inline-block align-bottom"><?php echo esc_html( $service_title ); ?></span>
			</nav>

			<div class="service-hero-main max-w-4xl">
				<div class="about-pill inline-flex items-center gap-2 mb-4">
					<span class="pulse-dot"></span>
					<span class="text-xs uppercase tracking-widest text-white/90 font-semibold"><?php echo esc_html( $service_badge ); ?></span>
				</div>

				<h1 class="service-hero-title font-display text-white">
					<?php echo esc_html( $service_title ); ?>
				</h1>

				<?php if ( ! empty( $service_hero_sub ) ) : ?>
					<p class="service-hero-desc text-white/85 text-lg mt-4 leading-relaxed max-w-3xl">
						<?php echo esc_html( $service_hero_sub ); ?>
					</p>
				<?php endif; ?>

				<!-- Fast Hero Action CTA -->
				<div class="service-hero-actions flex-align gap-4 flex-wrap mt-8">
					<a href="#book" class="btn btn-primary shadow-crimson" data-open-modal="appointment">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
						<?php esc_html_e( 'Book Consultation', 'vascular-grace' ); ?>
					</a>
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

	<!-- ── SERVICE DETAIL & SIDEBAR SECTION ────────────────────────────── -->
	<main class="single-service-section py-large bg-white">
		<div class="container">
			<div class="single-service-layout">

				<!-- ── LEFT: Main Clinical Content Column ── -->
				<div class="service-main-column">

					<!-- Quick Specs Highlight Grid -->
					<div class="service-specs-grid mb-8">
						<div class="spec-card">
							<div class="spec-icon text-crimson">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
							</div>
							<div class="spec-label"><?php esc_html_e( 'Procedure Duration', 'vascular-grace' ); ?></div>
							<div class="spec-val"><?php echo esc_html( $spec_duration ); ?></div>
						</div>

						<div class="spec-card">
							<div class="spec-icon text-blue">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
							</div>
							<div class="spec-label"><?php esc_html_e( 'Anesthesia', 'vascular-grace' ); ?></div>
							<div class="spec-val"><?php echo esc_html( $spec_anesthesia ); ?></div>
						</div>

						<div class="spec-card">
							<div class="spec-icon text-crimson">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
							</div>
							<div class="spec-label"><?php esc_html_e( 'Hospital Stay', 'vascular-grace' ); ?></div>
							<div class="spec-val"><?php echo esc_html( $spec_stay ); ?></div>
						</div>

						<div class="spec-card">
							<div class="spec-icon text-blue">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 7.65l.77.77L12 20.67l7.65-7.67.77-.77a5.4 5.4 0 0 0 0-7.65Z"></path></svg>
							</div>
							<div class="spec-label"><?php esc_html_e( 'Recovery', 'vascular-grace' ); ?></div>
							<div class="spec-val"><?php echo esc_html( $spec_recovery ); ?></div>
						</div>
					</div>

					<!-- Primary Clinical / Featured Image -->
					<?php if ( ! empty( $service_main_img ) || has_post_thumbnail() ) : ?>
						<div class="service-featured-box mb-8">
							<?php
							if ( ! empty( $service_main_img ) ) {
								$img_id = is_array( $service_main_img ) ? ( $service_main_img['ID'] ?? $service_main_img['id'] ?? 0 ) : $service_main_img;
								if ( $img_id ) {
									echo wp_get_attachment_image( $img_id, 'full', false, array( 'class' => 'service-featured-img', 'alt' => esc_attr( $service_title ) ) );
								} else {
									$img_url = is_array( $service_main_img ) ? ( $service_main_img['url'] ?? '' ) : $service_main_img;
									echo '<img src="' . esc_url( $img_url ) . '" class="service-featured-img" alt="' . esc_attr( $service_title ) . '">';
								}
							} else {
								the_post_thumbnail( 'full', array( 'class' => 'service-featured-img', 'alt' => esc_attr( $service_title ) ) );
							}
							?>
						</div>
					<?php endif; ?>

					<!-- Detailed Description / Clinical Overview -->
					<?php if ( get_the_content() ) : ?>
						<section class="service-content-block mb-8">
							<div class="badge-tag mb-2"><?php esc_html_e( 'Clinical Overview', 'vascular-grace' ); ?></div>
							<h2 class="service-section-title font-display"><?php esc_html_e( 'Procedure Overview & Clinical Approach', 'vascular-grace' ); ?></h2>
							<div class="service-prose-body legal-prose">
								<?php the_content(); ?>
							</div>
						</section>
					<?php endif; ?>

					<!-- Symptoms & Indications Box -->
					<?php if ( ! empty( $symptoms_raw ) ) : ?>
						<div class="service-info-card symptoms-card mb-8">
							<div class="service-card-header flex-align gap-3 mb-4">
								<div class="icon-circle bg-red-100 text-crimson">
									<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
								</div>
								<h3 class="service-card-heading font-display text-slate-900 m-0"><?php esc_html_e( 'Symptoms & When to Seek Medical Attention', 'vascular-grace' ); ?></h3>
							</div>
							<ul class="styled-checklist">
								<?php
								$symptom_lines = array_filter( array_map( 'trim', explode( "\n", $symptoms_raw ) ) );
								foreach ( $symptom_lines as $sline ) :
									$clean_line = ltrim( $sline, "•-*\t " );
									if ( ! empty( $clean_line ) ) :
										?>
										<li>
											<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#cd243c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
											<span><?php echo esc_html( $clean_line ); ?></span>
										</li>
										<?php
									endif;
								endforeach;
								?>
							</ul>
						</div>
					<?php endif; ?>

					<!-- Clinical Photo Gallery (If Uploaded) -->
					<?php if ( ! empty( $service_gallery ) && is_array( $service_gallery ) ) : ?>
						<section class="service-gallery-section mb-8">
							<div class="badge-tag mb-2"><?php esc_html_e( 'Clinical Technology', 'vascular-grace' ); ?></div>
							<h3 class="service-section-title font-display"><?php esc_html_e( 'Procedure & Technology Gallery', 'vascular-grace' ); ?></h3>
							<div class="service-gallery-grid">
								<?php foreach ( $service_gallery as $gal_item ) : ?>
									<?php
									$gal_id = is_array( $gal_item ) ? ( $gal_item['ID'] ?? $gal_item['id'] ?? 0 ) : $gal_item;
									$gal_caption = is_array( $gal_item ) ? ( $gal_item['caption'] ?? '' ) : '';
									?>
									<div class="gallery-card">
										<?php
										if ( $gal_id ) {
											echo wp_get_attachment_image( $gal_id, 'medium_large', false, array( 'class' => 'gallery-img' ) );
										} else {
											$gal_url = is_array( $gal_item ) ? ( $gal_item['url'] ?? '' ) : $gal_item;
											echo '<img src="' . esc_url( $gal_url ) . '" class="gallery-img" alt="' . esc_attr( $service_title ) . '">';
										}
										?>
										<?php if ( ! empty( $gal_caption ) ) : ?>
											<div class="gallery-card-caption"><?php echo esc_html( $gal_caption ); ?></div>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</section>
					<?php endif; ?>

					<!-- Treatment Steps / Procedural Roadmap -->
					<?php if ( ! empty( $treatment_steps ) && is_array( $treatment_steps ) ) : ?>
						<section class="service-steps-section mb-8">
							<div class="badge-tag mb-2"><?php esc_html_e( 'Step-by-Step Care', 'vascular-grace' ); ?></div>
							<h3 class="service-section-title font-display"><?php esc_html_e( 'How the Treatment is Performed', 'vascular-grace' ); ?></h3>

							<div class="treatment-steps-timeline">
								<?php foreach ( $treatment_steps as $step_idx => $step ) : ?>
									<div class="treatment-step-item">
										<div class="step-number-badge"><?php echo esc_html( str_pad( (string) ( $step_idx + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></div>
										<div class="step-content">
											<h4 class="step-title font-display"><?php echo esc_html( $step['step_title'] ?? '' ); ?></h4>
											<p class="step-desc text-muted text-sm mt-1"><?php echo esc_html( $step['step_desc'] ?? '' ); ?></p>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</section>
					<?php endif; ?>

					<!-- Benefits / Why Choose Dr. Raju -->
					<?php if ( ! empty( $benefits_raw ) ) : ?>
						<div class="service-info-card benefits-card mb-8">
							<div class="service-card-header flex-align gap-3 mb-4">
								<div class="icon-circle bg-blue-100 text-blue">
									<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
								</div>
								<h3 class="service-card-heading font-display text-slate-900 m-0"><?php esc_html_e( 'Clinical Advantages & Benefits', 'vascular-grace' ); ?></h3>
							</div>
							<ul class="styled-checklist benefits-list">
								<?php
								$benefit_lines = array_filter( array_map( 'trim', explode( "\n", $benefits_raw ) ) );
								foreach ( $benefit_lines as $bline ) :
									$clean_bline = ltrim( $bline, "•-*\t " );
									if ( ! empty( $clean_bline ) ) :
										?>
										<li>
											<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#375bb6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
											<span><?php echo esc_html( $clean_bline ); ?></span>
										</li>
										<?php
									endif;
								endforeach;
								?>
							</ul>
						</div>
					<?php endif; ?>

					<!-- FAQs Accordion -->
					<?php if ( ! empty( $faqs ) && is_array( $faqs ) ) : ?>
						<section class="service-faqs-section mb-8">
							<div class="badge-tag mb-2"><?php esc_html_e( 'Patient Guidance', 'vascular-grace' ); ?></div>
							<h3 class="service-section-title font-display"><?php esc_html_e( 'Frequently Asked Questions', 'vascular-grace' ); ?></h3>

							<div class="faq-list">
								<?php foreach ( $faqs as $f_idx => $faq_item ) : ?>
									<div class="faq-item<?php echo 0 === $f_idx ? ' active' : ''; ?>">
										<button type="button" class="faq-question flex-between w-full text-left" aria-expanded="<?php echo 0 === $f_idx ? 'true' : 'false'; ?>">
											<span class="font-display text-slate-900 font-semibold"><?php echo esc_html( $faq_item['faq_question'] ?? '' ); ?></span>
											<span class="faq-icon-toggle">
												<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
											</span>
										</button>
										<div class="faq-answer">
											<p class="text-muted text-sm pt-2 leading-relaxed"><?php echo esc_html( $faq_item['faq_answer'] ?? '' ); ?></p>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</section>
					<?php endif; ?>

					<!-- Doctor Specialist Bio Card -->
					<div class="single-author-card">
						<div class="author-card-avatar-box">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/srikanth-raju.jpg' ); ?>" alt="<?php echo esc_attr( $doctor_name ); ?>" class="author-card-avatar">
						</div>
						<div class="author-card-body">
							<div class="author-card-badge"><?php esc_html_e( 'Treating Surgeon', 'vascular-grace' ); ?></div>
							<h3 class="author-card-name font-display"><?php echo esc_html( $doctor_name ); ?></h3>
							<p class="author-card-creds text-crimson font-medium text-xs uppercase tracking-wider mb-2"><?php echo esc_html( $doctor_creds ); ?></p>
							<p class="author-card-desc text-muted text-sm mb-4">
								<?php echo esc_html( $doctor_role ); ?>. <?php esc_html_e( 'Expert in Doppler ultrasound mapping, endovenous laser ablation, open/endovascular arterial surgery, and comprehensive foot salvage.', 'vascular-grace' ); ?>
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

				</div>

				<!-- ── RIGHT: Sticky Consultation Sidebar ── -->
				<aside class="single-service-sidebar">
					<div class="sticky-sidebar-inner">

						<!-- Priority Appointment Card -->
						<div class="sidebar-widget sidebar-cta-box">
							<div class="sidebar-badge-top">
								<span class="pulse-dot"></span>
								<span class="text-xs uppercase font-bold tracking-wider text-crimson"><?php esc_html_e( 'Direct Consultation', 'vascular-grace' ); ?></span>
							</div>
							<h3 class="sidebar-cta-title font-display"><?php esc_html_e( 'Schedule an Appointment with Dr. Raju', 'vascular-grace' ); ?></h3>
							<p class="sidebar-cta-desc text-muted text-sm mb-6">
								<?php esc_html_e( 'Get expert evaluation, Doppler imaging review, and custom treatment planning at Yashoda Hospitals, Hitec City.', 'vascular-grace' ); ?>
							</p>
							<a href="#book" class="btn btn-primary btn-full shadow-crimson" data-open-modal="appointment">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
								<?php esc_html_e( 'Book Consultation', 'vascular-grace' ); ?>
							</a>
						</div>

					</div>
				</aside>

			</div>
		</div>
	</main>

	<!-- ── OTHER RELATED SERVICES ──────────────────────────────────────── -->
	<?php
	$related_services = new WP_Query( array(
		'post_type'      => 'service',
		'posts_per_page' => 3,
		'post__not_in'   => array( $service_id ),
		'orderby'        => 'rand',
	) );

	if ( $related_services->have_posts() ) :
		?>
		<section class="related-services-section py-large bg-slate-50 border-t border-slate-200">
			<div class="container">
				<div class="section-header flex-between flex-wrap gap-4 mb-8">
					<div>
						<div class="badge-tag mb-2"><?php esc_html_e( 'Comprehensive Care', 'vascular-grace' ); ?></div>
						<h2 class="section-title font-display"><?php esc_html_e( 'Other Specialized Procedures', 'vascular-grace' ); ?></h2>
					</div>
					<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn-outline btn-sm">
						<?php esc_html_e( 'View All Services →', 'vascular-grace' ); ?>
					</a>
				</div>

				<div class="services-grid-container">
					<?php
					while ( $related_services->have_posts() ) :
						$related_services->the_post();
						$rel_cta_type = vg_field( 'service_cta_type', get_the_ID(), 'modal' );
						$rel_cta_url  = vg_field( 'service_cta_url', get_the_ID(), '#book' );
						$rel_icon     = vg_field( 'service_icon_svg', get_the_ID(), '' );
						?>
						<div class="service-listing-card">
							<div class="service-icon-box text-blue">
								<?php if ( $rel_icon ) : ?>
									<?php echo wp_kses( $rel_icon, vg_allowed_svg_tags() ); ?>
								<?php else : ?>
									<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
								<?php endif; ?>
							</div>
							<h3 class="service-card-title font-display"><?php the_title(); ?></h3>
							<p class="service-card-desc"><?php echo esc_html( vg_field( 'service_oneliner', get_the_ID(), '' ) ); ?></p>
							<?php if ( 'page' === $rel_cta_type ) : ?>
								<a href="<?php the_permalink(); ?>" class="service-discuss-link">
									<?php esc_html_e( 'View Full Procedure', 'vascular-grace' ); ?>
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
								</a>
							<?php else : ?>
								<div class="service-discuss-link" role="button" tabindex="0" data-open-modal="appointment" style="cursor:pointer;">
									<?php esc_html_e( 'Discuss with Doctor', 'vascular-grace' ); ?>
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
								</div>
							<?php endif; ?>
						</div>
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
