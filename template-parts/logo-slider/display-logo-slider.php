<?php
/**
 * The template used for displaying logo_slider
 *
 * @package WEN_Travel
 */
?>
<?php
$enable_logo_slider = get_theme_mod( 'wen_travel_logo_slider_option', 'disabled' );

if ( ! wen_travel_check_section( $enable_logo_slider ) ) {
	return;
}

$wen_travel_subtitle     = get_theme_mod( 'wen_travel_logo_slider_subtitle' );
$wen_travel_title        = get_theme_mod( 'wen_travel_logo_slider_title');
$wen_travel_description  = get_theme_mod( 'wen_travel_logo_slider_description' );

$classes[] = 'wen-travel-logo-slider-section section';

if ( ! $wen_travel_title && ! $wen_travel_subtitle && ! $wen_travel_description ) {
	$classes[] = 'no-section-heading';
}
?>
<div id="logo-slider-section" class="logo-slider-section <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $wen_travel_subtitle || $wen_travel_title || $wen_travel_description ) : ?>
					<div class="section-heading-wrapper">

						<?php if( $wen_travel_subtitle ) : ?>
							<div class="section-subtitle">
								<?php echo esc_html( $wen_travel_subtitle ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $wen_travel_title ) : ?>
							<div class="section-title-wrapper">
								<h2 class="section-title"wen_travel_><?php echo wp_kses_post( $wen_travel_title ); ?></h2>
							</div><!-- .page-title-wrapper -->
						<?php endif; ?>

						<?php if ( $wen_travel_description ) : ?>
							<div class="section-description">
								<p>
									<?php
										echo wp_kses_post( $wen_travel_description );
									?>
								</p>
							</div><!-- .section-description-wrapper -->
						<?php endif; ?>
					</div><!-- .section-heading-wrapper -->
				<?php endif; ?>

		<div class="section-content-wrapper wen-travel-logo-slider-content-wrapper owl-carousel owl-dots-enabled">
			<?php
				get_template_part( 'template-parts/logo-slider/post-type-logo-slider' );
			?>
		</div><!-- .section-content-wrapper  -->
	</div><!-- .wrapper -->
</div><!-- #wen-travel-logo-slider-section -->
