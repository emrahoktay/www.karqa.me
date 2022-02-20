<?php
/**
 * Add Collection Settings in Customizer
 *
 * @package WEN_Travel
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_travel_collection_options( $wp_customize ) {
	$wp_customize->add_section( 'wen_travel_collection', array(
			'panel'    => 'wen_travel_theme_options',
			'title'    => esc_html__( 'Collection', 'wen-travel-photography' ),
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_collection_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'wen_travel_sanitize_select',
			'choices'           => wen_travel_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'wen-travel-photography' ),
			'section'           => 'wen_travel_collection',
			'type'              => 'select',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_collection_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_collection_active',
			'label'             => esc_html__( 'Title', 'wen-travel-photography' ),
			'section'           => 'wen_travel_collection',
			'type'              => 'text',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_collection_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'wen_travel_is_collection_active',
			'label'             => esc_html__( 'Description', 'wen-travel-photography' ),
			'section'           => 'wen_travel_collection',
			'type'              => 'textarea',
		)
	);

	wen_travel_register_option( $wp_customize, array(
			'name'              => 'wen_travel_collection_number',
			'default'           => 4,
			'sanitize_callback' => 'wen_travel_sanitize_number_range',
			'active_callback'   => 'wen_travel_is_collection_active',
			'label'             => esc_html__( 'Number of items to show', 'wen-travel-photography' ),
			'section'           => 'wen_travel_collection',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'wen_travel_collection_number', 4 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		wen_travel_register_option( $wp_customize, array(
				'name'              => 'wen_travel_collection_page_' . $i,
				'sanitize_callback' => 'wen_travel_sanitize_post',
				'active_callback'   => 'wen_travel_is_collection_active',
				'label'             => esc_html__( 'Page', 'wen-travel-photography' ) . ' ' . $i ,
				'section'           => 'wen_travel_collection',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'wen_travel_collection_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'wen_travel_is_collection_active' ) ) :
	/**
	* Return true if collection is active
	*
	* @since Wen Travel Dark 1.0
	*/
	function wen_travel_is_collection_active( $control ) {
		$enable = $control->manager->get_setting( 'wen_travel_collection_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return wen_travel_check_section( $enable );
	}
endif;