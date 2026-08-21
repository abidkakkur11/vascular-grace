<?php
/**
 * Template Part: CTA Band Section
 *
 * Reusable CTA section with booking button + call button + benefits list.
 * Used on: Home, About, Services, Contact, Service Single, Testimonials, Media pages.
 *
 * ACF Fields (page-level, with per-page overrides):
 *   cta_heading    → Text
 *   cta_desc       → Textarea
 *   cta_btn_text   → Text (defaults to global Options)
 *   cta_btn_url    → URL
 *   cta_benefits   → Repeater → benefit_text (Text)
 *
 * @package VascularGrace
 */

$phone = vg_get_phone();

$cta_heading = vg_field( 'cta_heading', get_the_ID(), __( "Take the first step\ntoward healthy\ncirculation.", 'vascular-grace' ) );
$cta_desc    = vg_field( 'cta_desc', get_the_ID(), __( 'Book a private consultation with Dr. Srikanth Raju. Most patients receive a treatment plan within their first visit.', 'vascular-grace' ) );
$cta_btn_url = vg_field( 'cta_btn_url', get_the_ID(), '#book' );
$cta_btn_txt = vg_field( 'cta_btn_text', get_the_ID(), __( 'Book Appointment', 'vascular-grace' ) );

$default_benefits = array(
    __( 'World-class endovascular suite', 'vascular-grace' ),
    __( 'Same-day minimally invasive procedures', 'vascular-grace' ),
    __( 'Transparent pricing &amp; insurance help', 'vascular-grace' ),
    __( 'Structured long-term follow-up', 'vascular-grace' ),
);
$benefits = vg_field( 'cta_benefits', get_the_ID() );
?>
<!-- CTA Band -->
<section class="cta-section py-large bg-white">
    <div class="container">
        <div class="cta-box bg-dark text-white relative overflow-hidden">
            <div class="cta-glow"></div>
            <div class="cta-wave-bg">
                <svg class="cta-vascular-svg" viewBox="0 0 1440 320" fill="none" preserveAspectRatio="none">
                    <path class="vascular-flow artery" d="M0,160 C320,300 720,30 1440,180" stroke="rgba(205, 36, 60, 0.6)" stroke-width="2" stroke-dasharray="6 8"/>
                    <path class="vascular-flow vein" d="M0,110 C380,30 820,290 1440,130" stroke="rgba(55, 91, 182, 0.6)" stroke-width="2" stroke-dasharray="6 8"/>
                    <path class="vascular-flow artery-sub" d="M0,220 C450,90 950,260 1440,230" stroke="rgba(205, 36, 60, 0.35)" stroke-width="1.5" stroke-dasharray="4 6"/>
                    <path class="vascular-flow vein-sub" d="M0,70 C280,220 760,70 1440,80" stroke="rgba(55, 91, 182, 0.35)" stroke-width="1.5" stroke-dasharray="4 6"/>
                </svg>
            </div>

            <div class="cta-grid relative z-10">
                <div class="cta-content">
                    <div class="cta-pill">
                        <svg class="text-crimson" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        <?php esc_html_e( 'CONSULTATION', 'vascular-grace' ); ?>
                    </div>
                    <h2 class="section-title"><?php echo nl2br( esc_html( $cta_heading ) ); ?></h2>
                    <p class="section-description text-white opacity-80" style="color: rgba(255,255,255,0.8);">
                        <?php echo esc_html( $cta_desc ); ?>
                    </p>
                    <div class="cta-buttons">
                        <a href="<?php echo esc_url( $cta_btn_url ); ?>" class="btn btn-primary btn-large shadow-crimson" data-open-modal="appointment">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <?php echo esc_html( $cta_btn_txt ); ?>
                        </a>
                        <a href="<?php echo esc_url( $phone['href'] ); ?>" class="btn btn-outline btn-large">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            <?php
                            printf(
                                /* translators: %s: Phone number */
                                esc_html__( 'Call %s', 'vascular-grace' ),
                                $phone['display']
                            );
                            ?>
                        </a>
                    </div>
                </div>

                <div class="cta-benefits-list">
                    <?php
                    $display_benefits = ( ! empty( $benefits ) && is_array( $benefits ) ) ? $benefits : $default_benefits;
                    foreach ( $display_benefits as $benefit ) :
                        $benefit_text = is_array( $benefit ) ? ( $benefit['benefit_text'] ?? '' ) : $benefit;
                        if ( empty( $benefit_text ) ) continue;
                        ?>
                        <div class="benefit-box">
                            <svg class="text-crimson" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="m9 12 2 2 4-4"></path></svg>
                            <span><?php echo esc_html( $benefit_text ); ?></span>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
