    <!-- Footer -->
    <footer class="footer bg-dark-deep text-white">
        <div class="container py-large">
            <div class="footer-grid">

                <!-- Brand Column -->
                <div class="footer-col brand-col">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo mb-6 inline-block" aria-label="<?php esc_attr_e( 'Dr. S Srikanth Raju Home', 'vascular-grace' ); ?>">
                        <?php echo vg_get_logo_img( 'footer-logo-img', 'Dr. S Srikanth Raju Logo' ); ?>
                    </a>
                    <p class="footer-text mb-6">
                        <?php vg_the_text( 'footer_tagline', 'option', __( 'Sr. Consultant Vascular & Endovascular Surgeon. Restoring healthy blood flow, saving limbs and improving lives — with advanced, minimally invasive care.', 'vascular-grace' ) ); ?>
                    </p>
                    <div class="footer-rating flex-align gap-2 mb-6">
                        <span class="font-bold"><?php vg_the_text( 'footer_rating', 'option', '4.9' ); ?></span>
                        <div class="stars text-crimson flex">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        </div>
                        <span class="text-muted text-sm">· <?php vg_the_text( 'footer_review_count', 'option', '499 Google reviews' ); ?></span>
                    </div>
                </div>

                <!-- Explore Links -->
                <div class="footer-col">
                    <h4 class="footer-heading"><?php esc_html_e( 'Explore', 'vascular-grace' ); ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'vascular-grace' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'vascular-grace' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'vascular-grace' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/blogs/' ) ); ?>"><?php esc_html_e( 'Blogs', 'vascular-grace' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/testimonials/' ) ); ?>"><?php esc_html_e( 'Testimonials', 'vascular-grace' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/media/' ) ); ?>"><?php esc_html_e( 'Media', 'vascular-grace' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'vascular-grace' ); ?></a></li>
                    </ul>
                </div>

                <!-- Services Quick Links -->
                <div class="footer-col">
                    <h4 class="footer-heading"><?php esc_html_e( 'Services', 'vascular-grace' ); ?></h4>
                    <ul class="footer-links">
                        <?php
                        // Dynamic footer service links from CPT
                        $footer_services = new WP_Query( array(
                            'post_type'      => 'service',
                            'posts_per_page' => 6,
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                        ) );
                        if ( $footer_services->have_posts() ) :
                            while ( $footer_services->have_posts() ) : $footer_services->the_post();
                                ?>
                                <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php the_title(); ?></a></li>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            // Static fallback matching original HTML
                            $fallback_services = array(
                                'Varicose Vein Laser / RFA / Glue',
                                'DVT — Thrombolysis &amp; Stenting',
                                'Peripheral Arterial Disease',
                                'Diabetic &amp; Ischemic Foot Care',
                                'AV Fistula &amp; Salvage',
                                'Aneurysm &amp; Aortic Repair',
                            );
                            $services_url = esc_url( home_url( '/services/' ) );
                            foreach ( $fallback_services as $svc ) :
                                ?>
                                <li><a href="<?php echo $services_url; ?>"><?php echo wp_kses( $svc, array() ); ?></a></li>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>

                <!-- Practice Info -->
                <div class="footer-col">
                    <h4 class="footer-heading"><?php esc_html_e( 'Practice', 'vascular-grace' ); ?></h4>
                    <p class="footer-text mb-4 text-sm">
                        <?php vg_the_text( 'address_line1', 'option', 'Yashoda Hospitals, Hitec City' ); ?>,
                        <?php vg_the_text( 'address_line2', 'option', 'Hyderabad, Telangana 500081' ); ?>
                    </p>
                    <p class="footer-text mb-6 text-sm">
                        <?php vg_the_text( 'business_hours', 'option', 'Mon–Sat · 9:00 AM – 5:00 PM' ); ?>
                    </p>
                    <?php
                    $cta_url  = vg_option( 'header_cta_url', '#book' );
                    $cta_text = vg_option( 'header_cta_text', __( 'Book Appointment', 'vascular-grace' ) );
                    ?>
                    <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-primary btn-full text-center" data-open-modal="appointment">
                        <?php echo esc_html( $cta_text ); ?>
                    </a>
                </div>

            </div>

            <!-- Footer Bottom Bar -->
            <div class="footer-bottom flex-between border-t border-muted pt-6 mt-12 text-sm text-muted">
                <p><?php vg_the_text( 'copyright_text', 'option', '© 2026 Dr. S Srikanth Raju · Med Reg No. TSMC 67043. All rights reserved.' ); ?></p>
                <div class="footer-bottom-links">
                    <a href="<?php vg_the_url( 'privacy_policy_url', 'option', '#' ); ?>"><?php esc_html_e( 'Privacy Policy', 'vascular-grace' ); ?></a>
                    <span class="mx-2">|</span>
                    <a href="<?php vg_the_url( 'disclaimer_url', 'option', '#' ); ?>"><?php esc_html_e( 'Medical Disclaimer', 'vascular-grace' ); ?></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Appointment Booking Modal — Present on every page, triggered by data-open-modal="appointment" -->
    <?php get_template_part( 'template-parts/sections/modal', 'appointment' ); ?>

    <?php wp_footer(); ?>
</body>
</html>
