<?php
/**
 * Theme functions and definitions
 *
 * @package WordPress
 * @subpackage Mosne_FSE
 * @since Mosne_FSE 1.0
 */
/** Register and enqueue assets for the front end.
 * @return void
 */
function mosne_fse_enqueue_assets(): void {
	$version = wp_get_theme()->get( 'Version' );
	//register scripts
	wp_register_script( 'mosne-fse-plugins', get_theme_file_uri( '/assets/js/plugins.js' ), array( 'jquery' ), $version, true );
	wp_register_script( 'mosne-fse-scripts', get_theme_file_uri( '/assets/js/scripts.js' ), array( 'jquery', 'mosne-fse-plugins' ), $version, true );
	// enqueue scripts
	wp_enqueue_script( 'mosne-fse-plugins' );
	wp_enqueue_script( 'mosne-fse-scripts' );
	// register styles
	wp_register_style( 'mosne-fse-style', get_theme_file_uri( '/assets/style.css' ), array(), $version, 'screen' );
	// enqueue styles
	wp_enqueue_style( 'mosne-fse-style' );
}

add_action( 'wp_enqueue_scripts', 'mosne_fse_enqueue_assets' );

/**  Register ACF blocks
 * @return void
 */
function register_acf_blocks(): void {
	$version = wp_get_theme()->get( 'Version' );
	// register block works
	register_block_type( __DIR__ . '/blocks/works' );
	wp_register_script( 'block-works', get_template_directory_uri() . '/blocks/works/works.js', array( 'jquery' ), $version, true );
	wp_register_style( 'block-works', get_theme_file_uri( '/blocks/works/works.css' ), $version, 'screen' );
}

add_action( 'init', 'register_acf_blocks' );
