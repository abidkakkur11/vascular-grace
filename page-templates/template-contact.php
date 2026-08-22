<?php
/**
 * Template Name: Contact
 *
 * Contact page — clinic info, map, and appointment form (shortcode-based).
 *
 * ACF Field Group Location: Page Template → is → template-contact.php
 *
 * @package VascularGrace
 */

get_header();

$hero_title    = vg_field( 'contact_hero_title', get_the_ID(), "Book a <span class=\"hero-title-accent\">consultation.</span>" );
$hero_subtitle = vg_field( 'contact_hero_subtitle', get_the_ID(), 'Visit Dr. Raju at Yashoda Hospitals, Hitec City — or book an online consultation from anywhere.' );

// Form shortcode (plugin-agnostic — paste WPForms/CF7/Gravity shortcode in admin)
$form_shortcode = vg_field( 'contact_form_shortcode', get_the_ID(), '' );
$form_title     = vg_field( 'contact_form_title', get_the_ID(), 'Request an Appointment' );
$form_desc      = vg_field( 'contact_form_desc', get_the_ID(), "Share your details below and Dr. Raju's team will contact you shortly to confirm your consultation slot." );

// Contact details (from Options with per-page fallbacks)
$phone       = vg_get_phone();
$whatsapp    = vg_option( 'whatsapp_number', '919876543210' );
$email       = vg_option( 'email_primary', 'contact@drsrikanthraju.com' );
$address1    = vg_option( 'address_line1', 'Yashoda Hospitals, Hitec City' );
$address2    = vg_option( 'address_line2', 'Hyderabad, Telangana, India' );
$hours       = vg_option( 'business_hours', 'Mon–Sat · 9:00 AM – 5:00 PM' );
$hours_sub   = vg_option( 'business_hours_sub', 'Sunday · by appointment' );
$maps_embed  = vg_option( 'google_maps_embed', '' );
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
                <span class="crumb-active text-white"><?php esc_html_e( 'Contact', 'vascular-grace' ); ?></span>
            </div>
            <div class="about-hero-content max-w-4xl">
                <div class="about-pill inline-flex items-center gap-2 mb-6">
                    <span class="pulse-dot"></span>
                    <span class="text-xs uppercase tracking-widest text-white/80 font-semibold"><?php esc_html_e( 'Contact', 'vascular-grace' ); ?></span>
                </div>
                <h1 class="about-hero-title font-display text-white">
                    <?php echo wp_kses_post( $hero_title ); ?>
                </h1>
                <p class="about-hero-subtitle text-white/80 mt-6">
                    <?php echo esc_html( $hero_subtitle ); ?>
                </p>
                <div class="about-hero-btns contact-hero-btns mt-8 flex-align gap-4 flex-wrap">
                    <a href="#book" class="btn btn-primary shadow-crimson" data-open-modal="appointment">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line><path d="M9 16l2 2 4-4"></path></svg>
                        <?php esc_html_e( 'Book Appointment', 'vascular-grace' ); ?>
                    </a>
                    <a href="<?php echo esc_url( $phone['href'] ); ?>" class="btn btn-outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <?php printf( esc_html__( 'Call %s', 'vascular-grace' ), $phone['display'] ); ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="about-hero-curve">
            <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none">
                <path d="M0,25 C360,75 1080,-25 1440,35 L1440,90 L0,90 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- ── CONTACT & FORM ───────────────────────────────────────────────── -->
    <section class="contact-main-section py-large bg-white">
        <div class="container">
            <div class="contact-layout-grid">

                <!-- Left: Clinic info + map -->
                <div class="contact-info-column">

                    <div class="contact-info-card">
                        <div class="contact-info-icon text-crimson">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div class="contact-info-content">
                            <div class="contact-info-label"><?php esc_html_e( 'Clinic', 'vascular-grace' ); ?></div>
                            <h4 class="contact-info-heading font-display"><?php echo esc_html( $address1 ); ?></h4>
                            <p class="contact-info-sub"><?php echo esc_html( $address2 ); ?></p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-info-icon text-crimson">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div class="contact-info-content">
                            <div class="contact-info-label"><?php esc_html_e( 'OPD Hours', 'vascular-grace' ); ?></div>
                            <h4 class="contact-info-heading font-display"><?php echo esc_html( $hours ); ?></h4>
                            <p class="contact-info-sub"><?php echo esc_html( $hours_sub ); ?></p>
                        </div>
                    </div>

                    <a href="<?php echo esc_url( $phone['href'] ); ?>" class="contact-info-card clickable-card">
                        <div class="contact-info-icon text-crimson">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div class="contact-info-content">
                            <div class="contact-info-label"><?php esc_html_e( 'Direct Phone', 'vascular-grace' ); ?></div>
                            <h4 class="contact-info-heading font-display"><?php echo $phone['display']; ?></h4>
                            <p class="contact-info-sub"><?php esc_html_e( 'Call to speak with clinical coordinator', 'vascular-grace' ); ?></p>
                        </div>
                    </a>

                    <a href="<?php echo esc_url( 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $whatsapp ) ); ?>" target="_blank" rel="noopener noreferrer" class="contact-info-card clickable-card">
                        <div class="contact-info-icon text-crimson">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"></path></svg>
                        </div>
                        <div class="contact-info-content">
                            <div class="contact-info-label"><?php esc_html_e( 'WhatsApp', 'vascular-grace' ); ?></div>
                            <h4 class="contact-info-heading font-display"><?php esc_html_e( 'Chat with Coordinator', 'vascular-grace' ); ?></h4>
                            <p class="contact-info-sub"><?php esc_html_e( 'Quick responses &amp; appointment assistance', 'vascular-grace' ); ?></p>
                        </div>
                    </a>

                    <a href="<?php echo esc_url( 'mailto:' . antispambot( $email ) ); ?>" class="contact-info-card clickable-card">
                        <div class="contact-info-icon text-crimson">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path><rect height="16" rx="2" width="20" x="2" y="4"></rect></svg>
                        </div>
                        <div class="contact-info-content">
                            <div class="contact-info-label"><?php esc_html_e( 'Email', 'vascular-grace' ); ?></div>
                            <h4 class="contact-info-heading font-display"><?php echo esc_html( antispambot( $email ) ); ?></h4>
                            <p class="contact-info-sub"><?php esc_html_e( 'Send records or general inquiries', 'vascular-grace' ); ?></p>
                        </div>
                    </a>

                    <!-- Embedded Google Map (editable from Theme Settings Options) -->
                    <div class="contact-map-wrapper">
                        <?php if ( ! empty( $maps_embed ) ) : ?>
                            <?php
                            // Allow <iframe> for the map embed
                            $allowed_iframe = array(
                                'iframe' => array(
                                    'class'           => true,
                                    'src'             => true,
                                    'loading'         => true,
                                    'title'           => true,
                                    'width'           => true,
                                    'height'          => true,
                                    'frameborder'     => true,
                                    'allowfullscreen' => true,
                                    'style'           => true,
                                ),
                            );
                            echo wp_kses( $maps_embed, $allowed_iframe );
                            ?>
                        <?php else : ?>
                            <iframe
                                class="contact-map-frame"
                                src="<?php echo esc_url( 'https://www.google.com/maps?q=' . rawurlencode( $address1 . ' ' . $address2 ) . '&output=embed' ); ?>"
                                loading="lazy"
                                title="<?php echo esc_attr( $address1 ); ?>"
                            ></iframe>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right: Appointment form (shortcode) -->
                <div class="contact-form-column">
                    <?php if ( ! empty( $form_shortcode ) ) : ?>
                        <!--
                            Appointment form rendered via plugin shortcode.
                            Shortcode is stored in ACF field 'contact_form_shortcode'
                            and editable from admin without touching code.
                            The surrounding wrapper preserves existing CSS styling.
                        -->
                        <div class="contact-appointment-form-wrapper">
                            <h2 class="form-title font-display"><?php echo esc_html( $form_title ); ?></h2>
                            <p class="form-desc"><?php echo esc_html( $form_desc ); ?></p>
                            <div class="form-fields-grid mt-8">
                                <?php vg_do_shortcode( $form_shortcode ); ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <!-- Fallback: static HTML form matching original design (no plugin yet configured) -->
                        <form class="contact-appointment-form" id="contact-page-form">
                            <h2 class="form-title font-display"><?php echo esc_html( $form_title ); ?></h2>
                            <p class="form-desc"><?php echo esc_html( $form_desc ); ?></p>
                            <div class="form-fields-grid mt-8">
                                <div class="form-row-2">
                                    <div class="form-group">
                                        <label class="form-label" for="contact-name"><?php esc_html_e( 'Full name *', 'vascular-grace' ); ?></label>
                                        <input type="text" id="contact-name" name="name" class="form-input" placeholder="<?php esc_attr_e( 'e.g. Ramesh Kumar', 'vascular-grace' ); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="contact-phone"><?php esc_html_e( 'Phone *', 'vascular-grace' ); ?></label>
                                        <input type="tel" id="contact-phone" name="phone" class="form-input" placeholder="<?php echo esc_attr( $phone['display'] ); ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="contact-email"><?php esc_html_e( 'Email', 'vascular-grace' ); ?></label>
                                    <input type="email" id="contact-email" name="email" class="form-input" placeholder="<?php esc_attr_e( 'you@example.com', 'vascular-grace' ); ?>">
                                </div>
                                <div class="form-row-2">
                                    <div class="form-group">
                                        <label class="form-label" for="contact-concern"><?php esc_html_e( 'Concern', 'vascular-grace' ); ?></label>
                                        <input type="text" id="contact-concern" name="concern" class="form-input" placeholder="<?php esc_attr_e( 'e.g. Varicose veins, Diabetic foot', 'vascular-grace' ); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="contact-date"><?php esc_html_e( 'Preferred date', 'vascular-grace' ); ?></label>
                                        <input type="date" id="contact-date" name="date" class="form-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="contact-message"><?php esc_html_e( 'Message', 'vascular-grace' ); ?></label>
                                    <textarea id="contact-message" name="message" class="form-textarea" rows="4" placeholder="<?php esc_attr_e( 'Tell us briefly about your symptoms or medical history...', 'vascular-grace' ); ?>"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-submit-form">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path><path d="m21.854 2.147-10.94 10.939"></path></svg>
                                    <?php esc_html_e( 'Request Appointment', 'vascular-grace' ); ?>
                                </button>
                                <p class="form-note text-center"><?php esc_html_e( 'By submitting, you agree to be contacted by the clinic team.', 'vascular-grace' ); ?></p>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <!-- ── CTA BAND ────────────────────────────────────────────────────── -->
    <?php get_template_part( 'template-parts/sections/cta-band' ); ?>

<?php get_footer(); ?>
