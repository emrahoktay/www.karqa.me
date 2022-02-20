<?php
/**
 * Logo Slider Options
 *
 * @package WEN_Travel
 */

/**
 * Add Logo Slider options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_logo_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'wen_travel_logo_slider', array(
			'panel' => 'wen_travel_theme_options',
			'title' => esc_html__( 'Logo Slider', 'wen-travel-photography' ),
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_logo_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => wen_travel_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'wen-travel-photography' ),
			'section'           => 'wen_travel_logo_slider',
			'type'              => 'select',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_logo_slider_subtitle',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_logo_slider_active',
			'label'             => esc_html__( 'Subtitle', 'wen-travel-photography' ),
			'section'           => 'wen_travel_logo_slider',
			'type'              => 'text',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_logo_slider_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_logo_slider_active',
			'label'             => esc_html__( 'Title', 'wen-travel-photography' ),
			'section'           => 'wen_travel_logo_slider',
			'type'              => 'text',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_logo_slider_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_logo_slider_active',
			'label'             => esc_html__( 'Description', 'wen-travel-photography' ),
			'section'           => 'wen_travel_logo_slider',
			'type'              => 'textarea',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_logo_slider_number',
			'default'           => '6',
			'sanitize_callback' => 'wen_travel_sanitize_number_range',

			'active_callback'   => 'wen_travel_is_logo_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed (Max no of slides is 20)', 'wen-travel-photography' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Items', 'wen-travel-photography' ),
			'section'           => 'wen_travel_logo_slider',
			'type'              => 'number',
		)
	);

	$logo_slider_number = get_theme_mod( 'wen_travel_logo_slider_number', 6 );

	for ( $i = 1; $i <= $logo_slider_number ; $i++ ) {
		// Page Sliders
		wen_travel_register_option( $wp_customize, array(
				'name'              => 'wen_travel_logo_slider_page_' . $i,
				'sanitize_callback' => 'wen_travel_sanitize_post',
				'active_callback'   => 'wen_travel_is_logo_slider_active',
				'label'             => esc_html__( 'Page', 'wen-travel-photography' ) . ' # ' . $i,
				'section'           => 'wen_travel_logo_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'wen_travel_logo_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'wen_travel_is_logo_slider_active' ) ) :
	/**
	* Return true if logo_slider is active
	*
	* @since WEN Travel Dark 1.0
	*/
	function wen_travel_is_logo_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'wen_travel_logo_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return wen_travel_check_section( $enable );
	}
endif;