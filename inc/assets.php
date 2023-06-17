<?php
/** Register and enqueue assets for the front end.
 * @return void
 */
function mosne_fse_enqueue_assets(): void {
	$version = wp_get_theme()->get( 'Version' );
	//register scripts
	$plugins_path = apply_filters( 'mosne_is_min', "/assets/js/plugins.js" );
	$script_path  = apply_filters( 'mosne_is_min', "/assets/js/scripts.js" );
	$style_path   = apply_filters( 'mosne_is_min', "/assets/style.css" );

	wp_register_script( 'mosne-fse-plugins', get_theme_file_uri( $plugins_path ), [ 'jquery' ], $version, true );
	wp_register_script( 'mosne-fse-scripts', get_theme_file_uri( $script_path ), [ 'jquery', 'mosne-fse-plugins' ], $version, true );
	// enqueue scripts
	wp_enqueue_script( 'mosne-fse-plugins' );
	wp_enqueue_script( 'mosne-fse-scripts' );
	// register styles
	wp_register_style( 'mosne-fse-style', get_theme_file_uri( $style_path ), [], $version, 'screen' );
	// enqueue styles
	wp_enqueue_style( 'mosne-fse-style' );

}

add_action( 'wp_enqueue_scripts', 'mosne_fse_enqueue_assets' );

/** Editor styles
 * @return void
 */
function mosne_fse_editor_assets(): void {
	$style_path   = apply_filters( 'mosne_is_min', "./assets/style.css" );
	add_editor_style( $style_path );
}


add_action( 'ini', 'mosne_fse_editor_assets' );

