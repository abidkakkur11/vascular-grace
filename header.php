<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Header / Nav -->
    <header class="header" id="header">
        <div class="container header-container">

            <!-- Left Nav Links (Desktop) — nav_left menu location -->
            <nav class="desktop-nav left-nav" aria-label="<?php esc_attr_e( 'Primary Left Navigation', 'vascular-grace' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'nav_left',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Vascular_Grace_Nav_Walker(),
                    'link_class'     => 'nav-link',
                    'fallback_cb'    => function() {
                        // Fallback if no menu assigned
                        $pages = array(
                            home_url( '/' )                        => __( 'Home', 'vascular-grace' ),
                            home_url( '/about/' )                  => __( 'About', 'vascular-grace' ),
                            home_url( '/services/' )          => __( 'Services', 'vascular-grace' ),
                        );
                        foreach ( $pages as $url => $label ) {
                            $active = ( esc_url( home_url( add_query_arg( array(), $GLOBALS['wp']->request ) ) ) === $url ) ? ' active' : '';
                            printf( '<a href="%s" class="nav-link%s">%s</a>', esc_url( $url ), esc_attr( $active ), esc_html( $label ) );
                        }
                    },
                ) );
                ?>
            </nav>

            <!-- Logo (Centered on Desktop, Left on Mobile) -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="<?php esc_attr_e( 'Dr. S Srikanth Raju Home', 'vascular-grace' ); ?>">
                <?php echo vg_get_logo_img( 'logo-img', 'Dr. S Srikanth Raju - Vascular & Endovascular Surgeon' ); ?>
            </a>

            <!-- Right Nav Links + CTA (Desktop) — nav_right menu location -->
            <nav class="desktop-nav right-nav" aria-label="<?php esc_attr_e( 'Primary Right Navigation', 'vascular-grace' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'nav_right',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Vascular_Grace_Nav_Walker(),
                    'link_class'     => 'nav-link',
                    'fallback_cb'    => function() {
                        $pages = array(
                            home_url( '/blogs/' )          => __( 'Blogs', 'vascular-grace' ),
                            home_url( '/testimonials/' )   => __( 'Testimonials', 'vascular-grace' ),
                            home_url( '/contact/' )        => __( 'Contact', 'vascular-grace' ),
                        );
                        foreach ( $pages as $url => $label ) {
                            $active = ( esc_url( home_url( add_query_arg( array(), $GLOBALS['wp']->request ) ) ) ) === $url ? ' active' : '';
                            printf( '<a href="%s" class="nav-link%s">%s</a>', esc_url( $url ), esc_attr( $active ), esc_html( $label ) );
                        }
                    },
                ) );
                ?>

                <!-- Header CTA Button -->
                <?php
                $cta_text = vg_option( 'header_cta_text', __( 'Book Appointment', 'vascular-grace' ) );
                $cta_url  = vg_option( 'header_cta_url', '#book' );
                ?>
                <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-primary nav-btn" data-open-modal="appointment">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line><path d="M9 16l2 2 4-4"></path></svg>
                    <?php echo esc_html( $cta_text ); ?>
                </a>
            </nav>

            <!-- Mobile Hamburger Toggle -->
            <div class="header-mobile-toggle">
                <button class="menu-toggle" id="mobile-menu-btn" aria-label="<?php esc_attr_e( 'Toggle Menu', 'vascular-grace' ); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Offcanvas Nav -->
        <nav class="mobile-nav" id="mobile-nav" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'vascular-grace' ); ?>">
            <div class="mobile-nav-header">
                <span class="mobile-nav-title"><?php esc_html_e( 'Menu', 'vascular-grace' ); ?></span>
                <button type="button" class="mobile-nav-close-btn" id="mobile-nav-close-btn" aria-label="<?php esc_attr_e( 'Close Menu', 'vascular-grace' ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="mobile-nav-links">
                <?php
                // Merge both menus for mobile — show all links
                wp_nav_menu( array(
                    'theme_location' => 'nav_left',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Vascular_Grace_Nav_Walker(),
                    'link_class'     => 'mobile-nav-link',
                    'fallback_cb'    => function() {
                        $pages = array(
                            home_url( '/' )                   => __( 'Home', 'vascular-grace' ),
                            home_url( '/about/' )             => __( 'About', 'vascular-grace' ),
                            home_url( '/services/' )          => __( 'Services', 'vascular-grace' ),
                        );
                        foreach ( $pages as $url => $label ) {
                            printf( '<a href="%s" class="mobile-nav-link">%s</a>', esc_url( $url ), esc_html( $label ) );
                        }
                    },
                ) );

                wp_nav_menu( array(
                    'theme_location' => 'nav_right',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Vascular_Grace_Nav_Walker(),
                    'link_class'     => 'mobile-nav-link',
                    'fallback_cb'    => function() {
                        $pages = array(
                            home_url( '/blogs/' )        => __( 'Blogs', 'vascular-grace' ),
                            home_url( '/testimonials/' ) => __( 'Testimonials', 'vascular-grace' ),
                            home_url( '/contact/' )      => __( 'Contact', 'vascular-grace' ),
                        );
                        foreach ( $pages as $url => $label ) {
                            printf( '<a href="%s" class="mobile-nav-link">%s</a>', esc_url( $url ), esc_html( $label ) );
                        }
                    },
                ) );
                ?>
            </div>
            <div class="mobile-nav-cta">
                <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-primary mobile-btn" data-open-modal="appointment">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line><path d="M9 16l2 2 4-4"></path></svg>
                    <?php echo esc_html( $cta_text ); ?>
                </a>
            </div>
        </nav>

        <!-- Mobile Offcanvas Backdrop -->
        <div class="mobile-backdrop" id="mobile-backdrop"></div>
    </header>
