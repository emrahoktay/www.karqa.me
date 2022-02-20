<?php
/*
 * This is the child theme for WEN Travel theme.
 */

/**
 * Enqueue default CSS styles
 */
function wen_travel_photography_enqueue_styles() {
	// Include parent theme CSS.
    wp_enqueue_style( 'wen-travel-style', get_template_directory_uri() . '/style.css', null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

    // Include child theme CSS.
    wp_enqueue_style( 'wen-travel-photography-style', get_stylesheet_directory_uri() . '/style.css', array( 'wen-travel-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/style.css' ) ) );

	// Load rtl css.
	if ( is_rtl() ) {
		wp_enqueue_style( 'wen-travel-rtl', get_template_directory_uri() . '/rtl.css', array( 'wen-travel-style' ), filemtime( get_stylesheet_directory() . '/rtl.css' ) );
	}

	// Enqueue child block styles after parent block style.
	wp_enqueue_style( 'wen-travel-photography-block-style', get_stylesheet_directory_uri() . '/css/child-blocks.css', array( 'wen-travel-block-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/css/child-blocks.css' ) ) );
}
add_action( 'wp_enqueue_scripts', 'wen_travel_photography_enqueue_styles' );

/**
 * Add child theme editor styles
 */
function wen_travel_photography_editor_style() {
	add_editor_style( array(
			'css/child-editor-style.css',
			wen_travel_fonts_url(),
			get_theme_file_uri( 'css/font-awesome/css/font-awesome.css' ),
		)
	);
}
add_action( 'after_setup_theme', 'wen_travel_photography_editor_style', 11 );

/**
 * Enqueue editor styles for Gutenberg
 */
function wen_travel_photography_block_editor_styles() {
	// Enqueue child block editor style after parent editor block css.
	wp_enqueue_style( 'wen-travel-photography-block-editor-style', get_stylesheet_directory_uri() . '/css/child-editor-blocks.css', array( 'wen-travel-block-editor-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/css/child-editor-blocks.css' ) ) );
}
add_action( 'enqueue_block_editor_assets', 'wen_travel_photography_block_editor_styles', 11 );

/**
 * Enqueue scripts and styles.
 */
function wen_travel_photography_scripts() {
    //Slider Scripts
    $enable_logo_slider      = wen_travel_check_section( get_theme_mod( 'wen_travel_logo_slider_option', 'disabled' ) );

    if ( $enable_logo_slider ) {
        // Enqueue owl carousel css. Must load CSS before JS.
        wp_enqueue_style( 'owl-carousel-core', get_theme_file_uri( 'css/owl-carousel/owl.carousel.min.css' ), null, '2.3.4' );
        wp_enqueue_style( 'owl-carousel-default', get_theme_file_uri( 'css/owl-carousel/owl.theme.default.min.css' ), null, '2.3.4' );

        // Enqueue script
        wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/js/owl.carousel.min.js'), array( 'jquery' ), '2.3.4', true );

        $deps[] = 'owl-carousel';

        wp_enqueue_script( 'wen-travel-photography-script',  get_stylesheet_directory_uri() . '/js/custom.min.js', array( 'jquery', 'owl-carousel' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'wen_travel_photography_scripts' );

/**
 * Loads the child theme textdomain and update notifier.
 */
function wen_travel_photography_setup() {
    load_child_theme_textdomain( 'wen-travel-photography', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'wen_travel_photography_setup', 11 );

/**
 * Change default background color
 */
function wen_travel_photography_background_default_color( $args ) {
    $args['default-color'] = '#000000';

    return $args;
}
add_filter( 'wen_travel_custom_bg_args', 'wen_travel_photography_background_default_color' );

/**
 * Change default header text color
 */
function wen_travel_photography_header_default_color( $args ) {
	$args['default-image'] =  get_theme_file_uri( 'images/header-image.jpg' );
	$args['default-text-color'] = '#ffffff';

	return $args;
}
add_filter( 'wen_travel_custom_header_args', 'wen_travel_photography_header_default_color' );

/**
 * Remove color-scheme-default and add color-scheme-dark to body class
 *
 * @since 1.0.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function wen_travel_photography_body_classes( $classes ) {
	// Added color scheme to body class.
	$classes['menu-type']    = 'navigation-default';
	$classes['color-scheme'] = 'color-scheme-photography';
	$classes['header-style'] = 'header-style-two';

	return $classes;
}
add_filter( 'body_class', 'wen_travel_photography_body_classes', 100 );

if ( ! function_exists( 'wen_travel_header_media_text' ) ):
	/**
	 * Display Header Media Text
	 *
	 * @since WEN Travel 1.0
	 */
	function wen_travel_header_media_text() {

		if ( ! wen_travel_has_header_media_text() ) {
			// Bail early if header media text is disabled on front page
			return false;
		}
		?>
		<div class="custom-header-content sections header-media-section content-align-left text-align-left">
			<div class="custom-header-content-wrapper">

				<?php
				if ( is_singular() && ! is_page() ) {
					wen_travel_header_title( '<div class="section-title-wrapper"><h1 class="section-title">', '</h1></div>' );
				} else {
					wen_travel_header_title( '<div class="section-title-wrapper"><h2 class="section-title">', '</h2></div>' );
				}
				?>
				<?php wen_travel_header_description( '<div class="site-header-text">', '</div>' ); ?>

				<?php if ( is_front_page() ) :
					$header_media_url      = get_theme_mod( 'wen_travel_header_media_url', '#' );
					$header_media_url_text = get_theme_mod( 'wen_travel_header_media_url_text' );
				?>

					<?php if ( $header_media_url_text ) : ?>
						<a href="<?php echo esc_url( $header_media_url ); ?>" target="<?php echo esc_attr( get_theme_mod( 'wen_travel_header_url_target' ) ) ? '_blank' : '_self'; ?>" class="more-link"><?php echo esc_html( $header_media_url_text ); ?><span class="screen-reader-text"><?php echo wp_kses_post( $header_media_url_text ); ?></span></a>
					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .custom-header-content-wrapper -->
		</div><!-- .custom-header-content -->
		<?php
	} // wen_travel_header_media_text.
endif;

/**
 * Adds stats background CSS
 */
function wen_travel_stats_bg_css() {
	$enable   = get_theme_mod( 'wen_travel_stats_option', 'disabled' );

	if ( ! wen_travel_check_section( $enable ) ) {
		// Bail if contact section is disabled.
		return;
	}

	$css = '';

	$background = get_theme_mod( 'wen_travel_stats_bg_image' );

	if ( $background ) {
		$css = '#stats-section .hentry-inner { background-image: url("' . esc_url( $background ) . '"); }';
	}

	wp_add_inline_style( 'wen-travel-photography-style', $css );
}
add_action( 'wp_enqueue_scripts', 'wen_travel_stats_bg_css', 11 );

function wen_travel_sections( $selector = 'header' ) {
		get_template_part( 'template-parts/header/header-media' );
		get_template_part( 'template-parts/slider/display-slider' );
		get_template_part( 'third-party/wp-travel/template-parts/trip-filter' );
		get_template_part( 'third-party/wp-travel/template-parts/featured-trips' );
		get_template_part( 'template-parts/collection/display-collection' );
		get_template_part( 'template-parts/hero-content/content-hero' );
		get_template_part( 'template-parts/service/display-service' );
		get_template_part( 'template-parts/portfolio/display-portfolio' );
		get_template_part( 'template-parts/stats/display-stats' );
		get_template_part( 'template-parts/testimonial/display-testimonial' );
		get_template_part( 'third-party/wp-travel/template-parts/latest-trips' );
		get_template_part( 'template-parts/featured-content/display-featured' );	
}

/**
 * Load Customizer Options for Collection section
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/collection.php';

/**
 * Include Logo Slider Section
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/logo-slider.php';

/**
 * Include Stats Section
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/stats.php';
