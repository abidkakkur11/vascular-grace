<?php
/**
 * Theme Licensing & Verification System
 *
 * Provides evaluation notice and verifies local hash-based license keys.
 *
 * @package VascularGrace
 */

defined( 'ABSPATH' ) || exit;

/**
 * Secret salt used for generating domain-bound license keys.
 * Keep this private.
 */
define( 'VG_LICENSE_SALT', 'vg_grace_sec_key_2026_vascular' );

/**
 * Universal Master License Hash (SHA-256 HMAC of secret master key).
 * The plain text master key is not stored in files.
 */
define( 'VG_MASTER_LICENSE_HASH', 'f728c06c46dd9e1f2d3de9471232e867197d0c72bf57367af2c98a7b4841b296' );

/**
 * Helper: Generate expected license key for a given domain/host.
 * Format: VG-XXXX-XXXX-XXXX
 *
 * @param string $host The domain name (e.g. vascular.local or drsrikanthraju.com).
 * @return string
 */
function vg_generate_license_key( $host = '' ) {
	if ( empty( $host ) ) {
		$host = function_exists( 'home_url' ) ? wp_parse_url( home_url(), PHP_URL_HOST ) : '';
	}
	// Normalize domain (remove www., convert to lowercase)
	$clean_host = strtolower( preg_replace( '/^www\./', '', trim( (string) $host ) ) );
	$hash       = hash_hmac( 'sha256', $clean_host, VG_LICENSE_SALT );

	// Create formatted 4-part key: VG-XXXX-XXXX-XXXX
	$part1 = strtoupper( substr( $hash, 0, 4 ) );
	$part2 = strtoupper( substr( $hash, 4, 4 ) );
	$part3 = strtoupper( substr( $hash, 8, 4 ) );

	return 'VG-' . $part1 . '-' . $part2 . '-' . $part3;
}

/**
 * Check if the current installation has an active, valid license.
 * Supports both Universal Master Key and domain-specific key.
 *
 * @return bool
 */
function vg_is_theme_licensed() {
	// Retrieve license key from ACF options or WP options
	$entered_key = function_exists( 'vg_option' ) ? vg_option( 'theme_license_key', '' ) : '';
	if ( empty( $entered_key ) ) {
		$entered_key = get_option( 'theme_license_key', '' );
	}

	if ( empty( $entered_key ) ) {
		return false;
	}

	$entered_key = strtoupper( trim( (string) $entered_key ) );

	// 1. Verify Universal Master Key via secure hash comparison
	$entered_master_hash = hash_hmac( 'sha256', $entered_key, VG_LICENSE_SALT );
	if ( hash_equals( VG_MASTER_LICENSE_HASH, $entered_master_hash ) ) {
		return true;
	}

	// 2. Verify Domain-specific Key
	$expected = vg_generate_license_key();
	return hash_equals( $expected, $entered_key );
}

/**
 * Display Admin Notice when running in Evaluation Mode.
 */
function vg_license_admin_notice() {
	// Only show in WP Admin to Administrators
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$is_licensed = vg_is_theme_licensed();

	if ( ! $is_licensed ) {
		$settings_url = admin_url( 'admin.php?page=theme-settings' );
		?>
		<div class="notice notice-warning is-dismissible" style="border-left-color: #cd243c; padding: 12px 18px; margin: 15px 0;">
			<p style="font-size: 14px; margin: 0; line-height: 1.5;">
				<strong style="color: #cd243c;">Vascular Grace Theme:</strong>
				This installation is currently in <strong>Evaluation / Staging Mode</strong>.
				Please enter the verified <strong>Theme License Key</strong> in
				<a href="<?php echo esc_url( $settings_url ); ?>" style="font-weight: 600; text-decoration: underline;">Theme Settings &rarr; License Activation</a>
				to complete project handover.
			</p>
		</div>
		<?php
	}
}
if ( function_exists( 'add_action' ) ) {
	add_action( 'admin_notices', 'vg_license_admin_notice' );
}

/**
 * Add a status indicator badge under the License tab in ACF Theme Settings.
 */
function vg_render_license_status_message( $field ) {
	$is_licensed = vg_is_theme_licensed();
	$host        = function_exists( 'home_url' ) ? wp_parse_url( home_url(), PHP_URL_HOST ) : 'current domain';

	if ( $is_licensed ) {
		echo '<div style="padding: 12px 16px; background: #ecfdf5; border: 1px solid #10b981; border-radius: 8px; color: #065f46; font-size: 14px; margin-bottom: 15px;">';
		echo '&#10004; <strong>License Active &amp; Verified</strong> for domain <code>' . esc_html( $host ) . '</code>. Full production handover verified.';
		echo '</div>';
	} else {
		echo '<div style="padding: 12px 16px; background: #fffbeb; border: 1px solid #f59e0b; border-radius: 8px; color: #92400e; font-size: 14px; margin-bottom: 15px;">';
		echo '&#9888; <strong>Status: Evaluation / Preview Mode</strong> for domain <code>' . esc_html( $host ) . '</code>. Enter your license key below to activate.';
		echo '</div>';
	}
	return $field;
}
if ( function_exists( 'add_filter' ) ) {
	add_filter( 'acf/render_field/name=theme_license_key', 'vg_render_license_status_message', 5 );
}

/**
 * Display Frontend Banner when running in Evaluation / Unlicensed Mode.
 */
function vg_license_frontend_banner() {
	if ( vg_is_theme_licensed() ) {
		return;
	}
	?>
	<div id="vg-eval-banner" style="position: fixed; bottom: 0; left: 0; right: 0; background: #0f172a; color: #f8fafc; padding: 12px 24px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; font-size: 13px; z-index: 999999; box-shadow: 0 -4px 25px rgba(0,0,0,0.3); border-top: 3px solid #cd243c; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
		<div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
			<span style="display: inline-block; background: #cd243c; color: #ffffff; font-weight: 700; font-size: 11px; padding: 3px 8px; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.05em; line-height: 1.2;">Evaluation Preview</span>
			<span style="color: #cbd5e1; line-height: 1.4;">This website is currently in <strong>Staging / Demonstration Mode</strong>. Pending final project handover authorization.</span>
		</div>
		<?php if ( current_user_can( 'manage_options' ) ) : ?>
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=theme-settings' ) ); ?>" style="color: #ffffff; background: #cd243c; text-decoration: none; padding: 6px 14px; border-radius: 6px; font-weight: 600; font-size: 12px; white-space: nowrap; transition: opacity 0.2s ease;">
				Activate License &rarr;
			</a>
		<?php endif; ?>
	</div>
	<?php
}
if ( function_exists( 'add_action' ) ) {
	add_action( 'wp_footer', 'vg_license_frontend_banner', 999 );
}
