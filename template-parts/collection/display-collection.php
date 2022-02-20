<?php
/**
 * The template for displaying collection items
 *
 * @package WEN_Travel
 */

$wen_travel_enable = get_theme_mod( 'wen_travel_collection_option', 'disabled' );

if ( ! wen_travel_check_section( $wen_travel_enable ) ) {
	// Bail if collection section is disabled.
	return;
}

$wen_travel_title       = get_theme_mod( 'wen_travel_collection_title');
$wen_travel_description = get_theme_mod( 'wen_travel_collection_description' );

if ( ! $wen_travel_title && ! $wen_travel_description ) {
	$wen_travel_classes[] = 'no-section-heading';
}

$wen_travel_classes[] = 'layout-three';
$wen_travel_classes[] = 'page';
$wen_travel_classes[] = 'section';
?>

<div id="collection-content-section" class="collection-content-section <?php echo esc_attr( implode( ' ', $wen_travel_classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $wen_travel_title || $wen_travel_description ) : ?>
			<div class="section-heading-wrapper">
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

		<div class="section-content-wrapper collection-content-wrapper layout-three">

			<div class="grid">
				<div class="grid-sizer"></div>
					<?php
						get_template_part( 'template-parts/collection/post-types', 'collection' );
					?>
			</div><!-- .project-masonry -->
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #collection-section -->
