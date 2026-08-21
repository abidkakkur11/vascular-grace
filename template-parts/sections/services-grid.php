<?php
/**
 * Template Part: Services Grid
 *
 * Renders the service cards from the 'service' CPT via WP_Query.
 * Used on: Home page (limited to 8), Services page (all).
 *
 * Accepts an optional $args variable (passed via set_query_var):
 *   'limit'       → int, posts_per_page. Default -1 (all).
 *   'card_style'  → 'home' or 'listing'. Default 'home'.
 *
 * @package VascularGrace
 */

$grid_args   = isset( $args ) ? $args : array();
$limit       = isset( $grid_args['limit'] ) ? intval( $grid_args['limit'] ) : -1;
$card_style  = isset( $grid_args['card_style'] ) ? sanitize_key( $grid_args['card_style'] ) : 'home';

$delay_classes = array( '', ' delay-1', ' delay-2', ' delay-3' );

$services_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => $limit > 0 ? $limit : -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

if ( $services_query->have_posts() ) :
    $i = 0;
    while ( $services_query->have_posts() ) :
        $services_query->the_post();

        $service_title     = get_the_title();
        $service_oneliner  = vg_field( 'service_oneliner', get_the_ID(), '' );
        $service_icon_svg  = vg_field( 'service_icon_svg', get_the_ID(), '' );
        $service_thumb     = get_post_thumbnail_id();
        $cta_type          = vg_field( 'service_cta_type', get_the_ID(), 'modal' ); // 'modal' | 'url'
        $cta_url           = vg_field( 'service_cta_url', get_the_ID(), '#book' );
        $delay_class       = $delay_classes[ $i % 4 ];

        if ( 'home' === $card_style ) :
            // Home page small card style
            ?>
            <div class="service-card group<?php echo esc_attr( $delay_class ); ?>">
                <div class="service-hover-bar"></div>
                <div class="service-icon bg-blue-light text-blue group-hover-bg-blue group-hover-text-white">
                    <?php if ( $service_icon_svg ) : ?>
                        <?php echo wp_kses( $service_icon_svg, vg_allowed_svg_tags() ); ?>
                    <?php else : ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                    <?php endif; ?>
                </div>
                <h3 class="service-title"><?php echo esc_html( $service_title ); ?></h3>
                <p class="service-text"><?php echo esc_html( $service_oneliner ); ?></p>

                <?php if ( 'url' === $cta_type && ! empty( $cta_url ) ) : ?>
                    <a href="<?php echo esc_url( $cta_url ); ?>" class="service-link text-blue">
                        <?php esc_html_e( 'Learn more', 'vascular-grace' ); ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="arrow"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                <?php else : ?>
                    <!-- Default: open booking modal — matches original HTML behavior -->
                    <div class="service-link text-blue" role="button" tabindex="0" data-open-modal="appointment" style="cursor:pointer;">
                        <?php esc_html_e( 'Learn more', 'vascular-grace' ); ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="arrow"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </div>
                <?php endif; ?>
            </div>
            <?php

        else :
            // Services listing page card style
            ?>
            <div class="service-listing-card">
                <div class="service-icon-box text-blue">
                    <?php if ( $service_icon_svg ) : ?>
                        <?php echo wp_kses( $service_icon_svg, vg_allowed_svg_tags() ); ?>
                    <?php else : ?>
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                    <?php endif; ?>
                </div>
                <h2 class="service-card-title font-display"><?php echo esc_html( $service_title ); ?></h2>
                <p class="service-card-desc"><?php echo esc_html( $service_oneliner ); ?></p>

                <?php if ( 'url' === $cta_type && ! empty( $cta_url ) ) : ?>
                    <a href="<?php echo esc_url( $cta_url ); ?>" class="service-discuss-link">
                        <?php esc_html_e( 'Discuss with the doctor', 'vascular-grace' ); ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                <?php else : ?>
                    <div class="service-discuss-link" role="button" tabindex="0" data-open-modal="appointment" style="cursor:pointer;">
                        <?php esc_html_e( 'Discuss with the doctor', 'vascular-grace' ); ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </div>
                <?php endif; ?>
            </div>
            <?php
        endif;

        $i++;
    endwhile;
    wp_reset_postdata();

else :
    // No services in DB — show a message only in admin context
    if ( current_user_can( 'edit_posts' ) ) :
        ?>
        <div class="service-card" style="grid-column: 1 / -1; text-align: center; padding: 2rem; opacity: .6;">
            <p><?php esc_html_e( 'No services found. Add services via the WordPress admin → Services menu.', 'vascular-grace' ); ?></p>
            <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=service' ) ); ?>" class="btn btn-primary" style="margin-top: 1rem;">
                <?php esc_html_e( 'Add First Service', 'vascular-grace' ); ?>
            </a>
        </div>
        <?php
    endif;
endif;

