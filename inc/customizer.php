<?php
/**
 * leado Theme Customizer
 *
 * @package leado
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function leado_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';

	$wp_customize->remove_control('header_textcolor');
	$wp_customize->remove_control("header_image");
	$wp_customize->remove_control('display_header_text');

	$wp_customize->remove_panel("widgets");


	$wp_customize->add_section( 'leado_settings' , array(
	    'title'      => 'Leedo Settings',
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'phone_number' , array(
	    'default'     => '888-888-8888',
	    'transport'   => 'refresh',
	) );


	$wp_customize->add_control('phone_number_control', array(
		'label'        => 'Phone Number',
		'section'    => 'leado_settings',
		'settings'   => 'phone_number',
		'type' => 'text'
	) );
}
add_action( 'customize_register', 'leado_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function leado_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function leado_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function leado_customize_preview_js() {
	wp_enqueue_script( 'leado-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'leado_customize_preview_js' );
