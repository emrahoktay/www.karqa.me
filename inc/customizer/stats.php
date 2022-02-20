<?php
/**
 * Stats options
 *
 * @package WEN_Travel
 */

/**
 * Add stats content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_stats_options( $wp_customize ) {

    $wp_customize->add_section( 'wen_travel_stats', array(
			'title' => esc_html__( 'Stats', 'wen-travel-photography' ),
			'panel' => 'wen_travel_theme_options',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_stats_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => wen_travel_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'wen-travel-photography' ),
			'section'           => 'wen_travel_stats',
			'type'              => 'select',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_stats_bg_image',
			'sanitize_callback' => 'wen_travel_sanitize_image',
			'active_callback'   => 'wen_travel_is_stats_active',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'PNG Background Image for Posts', 'wen-travel-photography' ),
			'section'           => 'wen_travel_stats',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_stats_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_stats_active',
			'label'             => esc_html__( 'Title', 'wen-travel-photography' ),
			'section'           => 'wen_travel_stats',
			'type'              => 'text',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_stats_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_stats_active',
			'label'             => esc_html__( 'Description', 'wen-travel-photography' ),
			'section'           => 'wen_travel_stats',
			'type'              => 'textarea',
		)
	);

    wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_stats_number',
			'default'           => 4,
			'sanitize_callback' => 'wen_travel_sanitize_number_range',
			'active_callback'   => 'wen_travel_is_stats_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'wen-travel-photography' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'wen-travel-photography' ),
			'section'           => 'wen_travel_stats',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'wen_travel_stats_number', 4 );

	//loop for stats post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		wen_travel_register_option( $wp_customize, array(
				'name'              => 'wen_travel_stats_page_' . $i,
				'sanitize_callback' => 'wen_travel_sanitize_post',
				'active_callback'   => 'wen_travel_is_stats_active',
				'label'             => esc_html__( 'Stats Page', 'wen-travel-photography' ) . ' ' . $i ,
				'section'           => 'wen_travel_stats',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'wen_travel_stats_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'wen_travel_is_stats_active' ) ) :
	/**
	* Return true if stats content is active
	*
	* @since Wen Travel Pro 1.0
	*/
	function wen_travel_is_stats_active( $control ) {
		$enable = $control->manager->get_setting( 'wen_travel_stats_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return wen_travel_check_section( $enable );
	}
endif;