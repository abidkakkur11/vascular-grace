<?php
/**
 * Vascular Grace — functions.php
 *
 * Handles: theme setup, enqueue, nav menus, CPT, ACF Options Page,
 * and all supporting includes.
 *
 * @package VascularGrace
 */

defined( 'ABSPATH' ) || exit;

define( 'VASCULAR_GRACE_VERSION', '1.0.0' );
define( 'VASCULAR_GRACE_TEXT_DOMAIN', 'vascular-grace' );

/* =========================================================
 * 1. THEME SETUP
 * ========================================================= */
function vascular_grace_setup() {
	// Make theme available for translation
	load_theme_textdomain( VASCULAR_GRACE_TEXT_DOMAIN, get_template_directory() . '/languages' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Enable featured images
	add_theme_support( 'post-thumbnails' );

	// HTML5 markup
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Responsive oEmbed wrapping
	add_theme_support( 'responsive-embeds' );

	// Custom logo (in addition to ACF logo field on Options page)
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Register nav menu locations — header split nav and footer explore menu
	register_nav_menus( array(
		'nav_left'       => esc_html__( 'Header - Left Nav', VASCULAR_GRACE_TEXT_DOMAIN ),
		'nav_right'      => esc_html__( 'Header - Right Nav', VASCULAR_GRACE_TEXT_DOMAIN ),
		'footer_explore' => esc_html__( 'Footer - Explore Menu', VASCULAR_GRACE_TEXT_DOMAIN ),
	) );
}
add_action( 'after_setup_theme', 'vascular_grace_setup' );


/* =========================================================
 * 2. ENQUEUE ASSETS
 * ========================================================= */
function vascular_grace_scripts() {
	// Google Fonts — matches original HTML
	wp_enqueue_style(
		'vascular-grace-google-fonts',
		'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300..600;1,9..144,300..600&family=Inter:wght@300;400;500;600&display=swap',
		array(),
		null
	);

	// Main stylesheet (original CSS verbatim)
	wp_enqueue_style(
		'vascular-grace-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array( 'vascular-grace-google-fonts' ),
		VASCULAR_GRACE_VERSION
	);

	// Main JS (original app.js verbatim — handles modal, mobile nav, FAQ accordion)
	wp_enqueue_script(
		'vascular-grace-app',
		get_template_directory_uri() . '/assets/js/app.js',
		array(),
		VASCULAR_GRACE_VERSION,
		true // Load in footer
	);
}
add_action( 'wp_enqueue_scripts', 'vascular_grace_scripts' );


/* =========================================================
 * 3. SERVICE CUSTOM POST TYPE
 * ========================================================= */
function vascular_grace_register_cpt() {
	$labels = array(
		'name'                  => esc_html_x( 'Services', 'Post type general name', VASCULAR_GRACE_TEXT_DOMAIN ),
		'singular_name'         => esc_html_x( 'Service', 'Post type singular name', VASCULAR_GRACE_TEXT_DOMAIN ),
		'menu_name'             => esc_html_x( 'Services', 'Admin menu text', VASCULAR_GRACE_TEXT_DOMAIN ),
		'add_new'               => esc_html__( 'Add New', VASCULAR_GRACE_TEXT_DOMAIN ),
		'add_new_item'          => esc_html__( 'Add New Service', VASCULAR_GRACE_TEXT_DOMAIN ),
		'new_item'              => esc_html__( 'New Service', VASCULAR_GRACE_TEXT_DOMAIN ),
		'edit_item'             => esc_html__( 'Edit Service', VASCULAR_GRACE_TEXT_DOMAIN ),
		'view_item'             => esc_html__( 'View Service', VASCULAR_GRACE_TEXT_DOMAIN ),
		'all_items'             => esc_html__( 'All Services', VASCULAR_GRACE_TEXT_DOMAIN ),
		'search_items'          => esc_html__( 'Search Services', VASCULAR_GRACE_TEXT_DOMAIN ),
		'not_found'             => esc_html__( 'No services found.', VASCULAR_GRACE_TEXT_DOMAIN ),
		'not_found_in_trash'    => esc_html__( 'No services found in trash.', VASCULAR_GRACE_TEXT_DOMAIN ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'services' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-heart',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		// 'page-attributes' enables menu_order for admin reordering
	);

	register_post_type( 'service', $args );
}
add_action( 'init', 'vascular_grace_register_cpt' );


/* =========================================================
 * 4. ACF OPTIONS PAGE (Theme Settings)
 * ========================================================= */
function vascular_grace_acf_options() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( array(
			'page_title' => esc_html__( 'Theme Settings', VASCULAR_GRACE_TEXT_DOMAIN ),
			'menu_title' => esc_html__( 'Theme Settings', VASCULAR_GRACE_TEXT_DOMAIN ),
			'menu_slug'  => 'theme-settings',
			'capability' => 'manage_options',
			'redirect'   => false,
			'icon_url'   => 'dashicons-admin-customizer',
		) );
	}
}
add_action( 'acf/init', 'vascular_grace_acf_options' );


/* =========================================================
 * 5. ACF LOCAL JSON — Save & Load Paths
 * ========================================================= */
// Tell ACF to save field groups as JSON inside acf-json/
function vascular_grace_acf_json_save_point( $path ) {
	return get_template_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'vascular_grace_acf_json_save_point' );

// Tell ACF to load from the same folder
function vascular_grace_acf_json_load_point( $paths ) {
	$paths[] = get_template_directory() . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'vascular_grace_acf_json_load_point' );




/* =========================================================
 * 6. INCLUDE HELPER FILES
 * ========================================================= */
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/theme-options.php';
require get_template_directory() . '/inc/license.php';


/* =========================================================
 * 7. ADMIN NOTICE: ACF PRO DEPENDENCY
 * ========================================================= */
function vascular_grace_acf_notice() {
	if ( ! class_exists( 'ACF' ) ) {
		echo '<div class="notice notice-error"><p>';
		echo '<strong>' . esc_html__( 'Vascular Grace Theme', VASCULAR_GRACE_TEXT_DOMAIN ) . '</strong> ';
		echo esc_html__( 'requires Advanced Custom Fields Pro to be installed and activated for dynamic content to work correctly.', VASCULAR_GRACE_TEXT_DOMAIN );
		echo '</p></div>';
	}
}
add_action( 'admin_notices', 'vascular_grace_acf_notice' );


/* =========================================================
 * 8. CUSTOM NAV MENU WALKER
 * Preserves exact .nav-link / .mobile-nav-link class structure
 * ========================================================= */
class Vascular_Grace_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * @param string   $output Output string to append to.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$is_current  = in_array( 'current-menu-item', $classes, true ) ||
		               in_array( 'current_page_item', $classes, true ) ||
		               in_array( 'current-menu-ancestor', $classes, true );

		$link_class  = isset( $args->link_class ) ? esc_attr( $args->link_class ) : 'nav-link';
		if ( $is_current ) {
			$link_class .= ' active';
		}

		$atts           = array();
		$atts['href']   = ! empty( $item->url ) ? $item->url : '#';
		$atts['class']  = $link_class;

		if ( ! empty( $item->attr_title ) ) {
			$atts['title'] = $item->attr_title;
		}
		if ( ! empty( $item->target ) ) {
			$atts['target'] = $item->target;
		}
		if ( '_blank' === $item->target ) {
			$atts['rel'] = 'noopener noreferrer';
		}

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$output .= '<a' . $attributes . '>' . esc_html( $title ) . '</a>';
	}

	// Override to suppress <li> wrappers — nav structure uses bare <a> tags
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}


/* =========================================================
 * 9. FLUSH REWRITE RULES ON ACTIVATION
 * ========================================================= */
function vascular_grace_rewrite_flush() {
	vascular_grace_register_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'vascular_grace_rewrite_flush' );


/* =========================================================
 * 10. DISABLE GUTENBERG BLOCK EDITOR
 * Enforces classic editor and removes unnecessary block assets
 * ========================================================= */
// Disable Gutenberg block editor for all post types (posts, pages, services, etc.)
add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
add_filter( 'use_block_editor_for_post', '__return_false', 100 );

// Disable Gutenberg for widgets
add_filter( 'use_widgets_block_editor', '__return_false' );

// Remove Gutenberg block library CSS from frontend for faster loading
function vascular_grace_remove_gutenberg_assets() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'vascular_grace_remove_gutenberg_assets', 100 );

