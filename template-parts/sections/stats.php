<?php
/**
 * Global Practice Statistics / Milestones Banner.
 *
 * Configured in WP Admin → Theme Settings → Practice Stats / Milestones.
 * Automatically falls back to clinical defaults if not set in backend.
 *
 * @package VascularGrace
 */

$global_stats  = vg_option( 'global_stats' );
$default_stats = array(
	array( 'stat_number' => '16+',     'stat_label' => 'Years Experience' ),
	array( 'stat_number' => '10,000+', 'stat_label' => 'Procedures Performed' ),
	array( 'stat_number' => '98%',     'stat_label' => 'Success Rate' ),
	array( 'stat_number' => '15+',     'stat_label' => 'Awards & Fellowships' ),
);

$display_stats = ( ! empty( $global_stats ) && is_array( $global_stats ) ) ? $global_stats : $default_stats;
$extra_class   = isset( $args['class'] ) ? ' ' . esc_attr( $args['class'] ) : '';
?>

<!-- ── GLOBAL STATS SECTION ─────────────────────────────────────────── -->
<section class="stats-section bg-dark text-white relative overflow-hidden<?php echo $extra_class; ?>">
	<div class="cta-wave-bg">
		<svg class="cta-vascular-svg" viewBox="0 0 1440 320" fill="none" preserveAspectRatio="none" aria-hidden="true">
			<path class="vascular-flow artery" d="M0,160 C320,300 720,30 1440,180" stroke="rgba(205, 36, 60, 0.6)" stroke-width="2" stroke-dasharray="6 8"/>
			<path class="vascular-flow vein" d="M0,110 C380,30 820,290 1440,130" stroke="rgba(55, 91, 182, 0.6)" stroke-width="2" stroke-dasharray="6 8"/>
			<path class="vascular-flow artery-sub" d="M0,220 C450,90 950,260 1440,230" stroke="rgba(205, 36, 60, 0.35)" stroke-width="1.5" stroke-dasharray="4 6"/>
			<path class="vascular-flow vein-sub" d="M0,70 C280,220 760,70 1440,80" stroke="rgba(55, 91, 182, 0.35)" stroke-width="1.5" stroke-dasharray="4 6"/>
		</svg>
	</div>
	<div class="container relative z-10">
		<div class="stats-grid">
			<?php foreach ( $display_stats as $stat ) : ?>
				<div class="stat-item">
					<div class="stat-number font-display"><?php echo esc_html( $stat['stat_number'] ?? '' ); ?></div>
					<div class="stat-label"><?php echo wp_kses_post( $stat['stat_label'] ?? '' ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
