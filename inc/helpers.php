<?php
/**
 * Vascular Grace — inc/helpers.php
 *
 * Utility / helper functions used across templates.
 *
 * @package VascularGrace
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get an ACF field with a safe fallback.
 *
 * @param string $field_name   ACF field name.
 * @param mixed  $post_id      Post ID, 'option', or false for current post.
 * @param mixed  $fallback     Value to return when field is empty.
 * @return mixed
 */
function vg_field( $field_name, $post_id = false, $fallback = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $fallback;
	}
	$value = get_field( $field_name, $post_id );
	return ( ! empty( $value ) ) ? $value : $fallback;
}

/**
 * Get an ACF Options Page field (global settings).
 *
 * @param string $field_name ACF field name.
 * @param mixed  $fallback   Fallback value.
 * @return mixed
 */
function vg_option( $field_name, $fallback = '' ) {
	return vg_field( $field_name, 'option', $fallback );
}

/**
 * Safely echo an escaped text field.
 *
 * @param string $field_name ACF field name.
 * @param mixed  $post_id    Post ID or 'option'.
 * @param string $fallback   Fallback string.
 */
function vg_the_text( $field_name, $post_id = false, $fallback = '' ) {
	echo esc_html( vg_field( $field_name, $post_id, $fallback ) );
}

/**
 * Safely echo an escaped URL field.
 *
 * @param string $field_name ACF field name.
 * @param mixed  $post_id    Post ID or 'option'.
 * @param string $fallback   Fallback URL.
 */
function vg_the_url( $field_name, $post_id = false, $fallback = '#' ) {
	echo esc_url( vg_field( $field_name, $post_id, $fallback ) );
}

/**
 * Safely echo a WYSIWYG / HTML field using wp_kses_post.
 *
 * @param string $field_name ACF field name.
 * @param mixed  $post_id    Post ID or 'option'.
 * @param string $fallback   Fallback HTML.
 */
function vg_the_html( $field_name, $post_id = false, $fallback = '' ) {
	echo wp_kses_post( vg_field( $field_name, $post_id, $fallback ) );
}

/**
 * Output a responsive image from an ACF Image field (array format).
 *
 * @param string $field_name ACF field name (must return array).
 * @param mixed  $post_id    Post ID or 'option'.
 * @param string $size       Image size. Default 'large'.
 * @param array  $attr       Additional img attributes.
 * @param int    $fallback_id Attachment ID to use as fallback.
 */
function vg_the_image( $field_name, $post_id = false, $size = 'large', $attr = array(), $fallback_id = 0 ) {
	$image = vg_field( $field_name, $post_id );
	if ( ! empty( $image ) && is_array( $image ) ) {
		echo wp_get_attachment_image( $image['ID'], $size, false, $attr );
	} elseif ( $fallback_id ) {
		echo wp_get_attachment_image( $fallback_id, $size, false, $attr );
	}
}

/**
 * Return the logo image tag from ACF Options or custom_logo theme support.
 *
 * @param string $css_class   CSS class for the <img>.
 * @param string $alt         Alt text.
 * @return string             HTML img tag.
 */
function vg_get_logo_img( $css_class = 'logo-img', $alt = 'Dr. S Srikanth Raju' ) {
	$logo = vg_option( 'site_logo' );
	if ( ! empty( $logo ) && is_array( $logo ) ) {
		return wp_get_attachment_image( $logo['ID'], 'full', false, array(
			'class' => esc_attr( $css_class ),
			'alt'   => esc_attr( $alt ),
		) );
	}
	// Fallback to bundled asset
	return '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/logo.png' ) . '" alt="' . esc_attr( $alt ) . '" class="' . esc_attr( $css_class ) . '">';
}

/**
 * Get the phone number from Options, with a tel: href ready.
 *
 * @return array [ 'display' => '+91 98765 43210', 'href' => 'tel:+919876543210' ]
 */
function vg_get_phone() {
	$raw     = vg_option( 'phone_primary', '+91 98765 43210' );
	$clean   = preg_replace( '/[^+\d]/', '', $raw );
	return array(
		'display' => esc_html( $raw ),
		'href'    => esc_url( 'tel:' . $clean ),
	);
}

/**
 * Render a do_shortcode call safely.
 *
 * @param string $shortcode  e.g. '[wpforms id="1"]'.
 */
function vg_do_shortcode( $shortcode ) {
	if ( ! empty( $shortcode ) ) {
		echo do_shortcode( wp_kses_post( $shortcode ) );
	}
}

/**
 * Allowed SVG HTML tags and attributes for wp_kses().
 *
 * @return array
 */
function vg_allowed_svg_tags() {
	return array(
		'svg'      => array(
			'width'           => true,
			'height'          => true,
			'viewbox'         => true,
			'fill'            => true,
			'xmlns'           => true,
			'stroke'          => true,
			'stroke-width'    => true,
			'stroke-linecap'  => true,
			'stroke-linejoin' => true,
			'class'           => true,
		),
		'path'     => array(
			'd'               => true,
			'fill'            => true,
			'stroke'          => true,
			'stroke-width'    => true,
			'stroke-linecap'  => true,
			'stroke-linejoin' => true,
		),
		'circle'   => array(
			'cx'           => true,
			'cy'           => true,
			'r'            => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
		),
		'line'     => array(
			'x1'           => true,
			'y1'           => true,
			'x2'           => true,
			'y2'           => true,
			'stroke'       => true,
			'stroke-width' => true,
		),
		'polyline' => array(
			'points'       => true,
			'stroke'       => true,
			'stroke-width' => true,
			'fill'         => true,
		),
		'polygon'  => array(
			'points'       => true,
			'stroke'       => true,
			'stroke-width' => true,
			'fill'         => true,
		),
		'rect'     => array(
			'x'            => true,
			'y'            => true,
			'width'        => true,
			'height'       => true,
			'rx'           => true,
			'ry'           => true,
			'stroke'       => true,
			'stroke-width' => true,
			'fill'         => true,
		),
	);
}

