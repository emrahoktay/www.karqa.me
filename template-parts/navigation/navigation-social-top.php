<?php
/**
 * Displays social top navigation
 *
 * @package WEN_Travel
 */

if ( ! has_nav_menu( 'social-top' ) ) {
	// Bail if there is no social top.
	return;
}
?>
<div class="header-top-right">
	<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'wen-travel-photography' ); ?>">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'social-top',
				'menu_class'     => 'social-links-menu',
				'depth'          => 1,
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>',
				'link_after'       => '</span>' . wen_travel_get_svg( array( 'icon' => 'chain' ) ),
			) );
		?>
	</nav><!-- .social-navigation -->
</div><!-- .header-top-right -->
