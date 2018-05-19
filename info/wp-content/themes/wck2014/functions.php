<?php
function wck2014_load_cssjs() {
	// CSS
	wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wck2014_load_cssjs' );

function wck2014_custom_header_remove( $wp_customize ) {
	$wp_customize->remove_section( 'header_image' );
}
add_action( 'customize_register', 'wck2014_custom_header_remove' );

function wck2014_deactivate_add_theme_support() {
	remove_theme_support( 'custom-header' );
}
add_action( 'after_setup_theme', 'wck2014_deactivate_add_theme_support', 102 );

?>
