<?php
/**
 * Template Part: Appointment Booking Modal
 *
 * Triggered site-wide by data-open-modal="appointment" or href="#book".
 * app.js handles open/close/form-submit logic — do not alter markup
 * without also updating app.js selectors.
 *
 * @package VascularGrace
 */
?>
<!-- Theme-Synced Appointment / Contact Popup Modal -->
<div class="modal-wrapper" id="appointment-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div class="modal-backdrop"></div>
    <div class="modal-card">
        <div class="modal-header">
            <div>
                <span class="modal-badge">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <?php esc_html_e( 'Priority Consultation', 'vascular-grace' ); ?>
                </span>
                <h3 class="modal-title" id="modal-title"><?php esc_html_e( 'Book an Appointment', 'vascular-grace' ); ?></h3>
                <p class="modal-subtitle">
                    <?php
                    printf(
                        /* translators: %s: Doctor name */
                        esc_html__( 'Consult %s · Vascular & Endovascular Surgeon', 'vascular-grace' ),
                        esc_html( vg_option( 'doctor_name_full', 'Dr. S Srikanth Raju' ) )
                    );
                    ?>
                </p>
            </div>
            <button type="button" class="modal-close-btn" aria-label="<?php esc_attr_e( 'Close dialog', 'vascular-grace' ); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <?php
        /**
         * Appointment form: either a plugin shortcode (WPForms / CF7) or the built-in HTML form.
         * Set the shortcode via: WP Admin → Theme Settings → Contact Details → Appointment Form Shortcode.
         */
        $appt_shortcode = vg_option( 'appointment_form_shortcode', '' );
        if ( ! empty( $appt_shortcode ) ) :
        ?>
        <!-- ── PLUGIN FORM (WPForms / Contact Form 7 / etc.) ──────── -->
        <div class="modal-plugin-form">
            <?php echo do_shortcode( wp_kses_post( $appt_shortcode ) ); ?>
        </div>

        <?php else : ?>
        <!-- ── BUILT-IN HTML FORM (default) ───────────────────────── -->
        <form id="appointment-modal-form" class="modal-form-grid">
            <div class="modal-form-row">
                <div class="modal-field">
                    <label class="modal-label" for="modal-name"><?php esc_html_e( 'Full Name *', 'vascular-grace' ); ?></label>
                    <input type="text" id="modal-name" name="name" class="modal-input" placeholder="<?php esc_attr_e( 'e.g. Ramesh Kumar', 'vascular-grace' ); ?>" required>
                </div>
                <div class="modal-field">
                    <label class="modal-label" for="modal-phone"><?php esc_html_e( 'Phone Number *', 'vascular-grace' ); ?></label>
                    <input type="tel" id="modal-phone" name="phone" class="modal-input" placeholder="<?php echo esc_attr( vg_option( 'phone_primary', '+91 98765 43210' ) ); ?>" required>
                </div>
            </div>

            <div class="modal-form-row">
                <div class="modal-field">
                    <label class="modal-label" for="modal-email"><?php esc_html_e( 'Email Address', 'vascular-grace' ); ?></label>
                    <input type="email" id="modal-email" name="email" class="modal-input" placeholder="<?php esc_attr_e( 'you@example.com', 'vascular-grace' ); ?>">
                </div>
                <div class="modal-field">
                    <label class="modal-label" for="modal-service-select"><?php esc_html_e( 'Treatment / Specialty', 'vascular-grace' ); ?></label>
                    <select id="modal-service-select" name="service" class="modal-select">
                        <option value="General Consultation"><?php esc_html_e( 'General Consultation', 'vascular-grace' ); ?></option>
                        <?php
                        // Dynamically populate from Service CPT
                        $modal_services = new WP_Query( array(
                            'post_type'      => 'service',
                            'posts_per_page' => -1,
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                        ) );
                        if ( $modal_services->have_posts() ) :
                            while ( $modal_services->have_posts() ) : $modal_services->the_post();
                                ?>
                                <option value="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></option>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // Static fallback options
                            $options = array(
                                'Varicose Veins'          => 'Varicose Veins (Laser / RFA / Glue)',
                                'Peripheral Artery Disease' => 'Peripheral Artery Disease (PAD)',
                                'Diabetic Foot Care'      => 'Diabetic &amp; Ischemic Foot Care',
                                'Deep Vein Thrombosis'    => 'Deep Vein Thrombosis (DVT)',
                                'AV Fistula &amp; Dialysis Access' => 'AV Fistula &amp; Dialysis Access',
                                'Carotid Artery Disease'  => 'Carotid Artery Disease &amp; Stroke Prevention',
                                'Aortic Aneurysm'         => 'Aortic Aneurysm &amp; Endovascular Repair',
                            );
                            foreach ( $options as $val => $label ) {
                                printf( '<option value="%s">%s</option>', esc_attr( $val ), wp_kses( $label, array() ) );
                            }
                        endif;
                        ?>
                    </select>
                </div>
            </div>

            <div class="modal-field">
                <label class="modal-label" for="modal-date"><?php esc_html_e( 'Preferred Date', 'vascular-grace' ); ?></label>
                <input type="date" id="modal-date" name="preferred_date" class="modal-input">
            </div>

            <div class="modal-field">
                <label class="modal-label" for="modal-notes"><?php esc_html_e( 'Brief Medical Symptoms / Notes', 'vascular-grace' ); ?></label>
                <textarea id="modal-notes" name="notes" class="modal-textarea" rows="3" placeholder="<?php esc_attr_e( 'Tell us briefly about your condition, symptoms, or previous treatments...', 'vascular-grace' ); ?>"></textarea>
            </div>

            <button type="submit" class="modal-submit-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path><path d="m21.854 2.147-10.94 10.939"></path></svg>
                <?php esc_html_e( 'Confirm Consultation Request', 'vascular-grace' ); ?>
            </button>

            <p class="modal-privacy-note">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <?php esc_html_e( 'Strictly confidential. Our clinical coordinator will call to confirm.', 'vascular-grace' ); ?>
            </p>
        </form>
        <?php endif; ?>


        <div id="modal-success-state" class="modal-success-state">
            <div class="modal-success-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <h4 class="modal-success-title"><?php esc_html_e( 'Appointment Request Received!', 'vascular-grace' ); ?></h4>
            <p class="modal-success-desc">
                <?php
                printf(
                    /* translators: %1$s: doctor name, %2$s: hospital name */
                    esc_html__( "Thank you. %1\$s's clinic coordinator will contact you shortly on your provided phone number to confirm your preferred time slot at %2\$s.", 'vascular-grace' ),
                    esc_html( vg_option( 'doctor_name_full', 'Dr. S Srikanth Raju' ) ),
                    esc_html( vg_option( 'address_line1', 'Yashoda Hospitals, Hitec City' ) )
                );
                ?>
            </p>
            <button type="button" class="btn btn-primary modal-close-trigger"><?php esc_html_e( 'Done', 'vascular-grace' ); ?></button>
        </div>
    </div>
</div>
