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

/**
 * Extract YouTube Video ID from any standard or short URL.
 *
 * @param string $url Video URL.
 * @return string|false YouTube Video ID or false.
 */
function vg_get_youtube_id( $url ) {
	if ( empty( $url ) ) {
		return false;
	}
	$pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i';
	if ( preg_match( $pattern, $url, $match ) ) {
		return $match[1];
	}
	return false;
}

/**
 * Get Video Thumbnail URL.
 * Priority: 1. Custom uploaded thumbnail -> 2. Automatic YouTube thumbnail -> 3. Fallback placeholder.
 *
 * @param string      $video_url     The video URL (YouTube, Vimeo, etc.).
 * @param array|string $custom_thumb  ACF image array or URL.
 * @return string Thumbnail image URL.
 */
function vg_get_video_thumbnail( $video_url = '', $custom_thumb = null ) {
	// 1. Custom thumbnail image from ACF
	if ( ! empty( $custom_thumb ) ) {
		if ( is_array( $custom_thumb ) && ! empty( $custom_thumb['url'] ) ) {
			return esc_url( $custom_thumb['url'] );
		}
		if ( is_numeric( $custom_thumb ) ) {
			$img_url = wp_get_attachment_image_url( (int) $custom_thumb, 'large' );
			if ( $img_url ) {
				return esc_url( $img_url );
			}
		}
		if ( is_string( $custom_thumb ) && ! empty( $custom_thumb ) ) {
			return esc_url( $custom_thumb );
		}
	}

	// 2. Automatic YouTube default thumbnail
	$yt_id = vg_get_youtube_id( $video_url );
	if ( $yt_id ) {
		return 'https://img.youtube.com/vi/' . esc_attr( $yt_id ) . '/hqdefault.jpg';
	}

	return '';
}

/**
 * Fetch cached Google reviews directly from Trustindex database table.
 * Returns array of review objects, or empty array if Trustindex is not yet connected.
 *
 * @param int $limit Max number of reviews to retrieve (default 30).
 * @return array
 */
function vg_get_trustindex_google_reviews( $limit = 30 ) {
	global $wpdb;
	$table = $wpdb->prefix . 'trustindex_google_reviews';

	// Safe check if table exists
	$table_exists = $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table ) );
	if ( empty( $table_exists ) || $table_exists !== $table ) {
		return array();
	}

	$limit_sql = ( $limit > 0 ) ? 'LIMIT ' . intval( $limit ) : '';
	$results   = $wpdb->get_results( "SELECT * FROM {$table} WHERE rating >= 4 AND text != '' ORDER BY date DESC {$limit_sql}" );

	if ( empty( $results ) || ! is_array( $results ) ) {
		return array();
	}

	return $results;
}

/**
 * Get Google Business Profile / Google Reviews URL.
 *
 * @return string
 */
function vg_get_gmb_review_url() {
	$url = vg_option( 'gmb_review_url', '' );
	if ( ! empty( $url ) ) {
		return esc_url( $url );
	}

	// Check if Trustindex has a connected page
	$page_details = get_option( 'trustindex-google-page-details' );
	if ( ! empty( $page_details ) && is_array( $page_details ) && ! empty( $page_details['id'] ) ) {
		if ( is_numeric( $page_details['id'] ) ) {
			return 'https://maps.google.com/?cid=' . esc_attr( $page_details['id'] );
		}
	}

	return 'https://www.google.com/search?q=Dr.+S+Srikanth+Raju+Vascular+Surgeon+Yashoda+Hospitals+Hitec+City';
}

/**
 * Calculate estimated reading time for a post.
 *
 * @param int|null $post_id Post ID.
 * @return string
 */
function vg_get_reading_time( $post_id = null ) {
	$content    = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( strip_tags( (string) $content ) );
	$minutes    = max( 1, (int) ceil( $word_count / 200 ) );
	/* translators: %d: number of minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'vascular-grace' ), $minutes );
}




