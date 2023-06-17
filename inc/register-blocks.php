<?php
/** Register ACF blocks styles with inline support
 *
 * @param string $handle
 * @param string $path
 * @param array $dependencies
 * @param string $version
 * @param string $media
 *
 * @return void
 */
function mosne_register_block_styles( string $handle = '', string $path = '', array $dependencies = [], string $version = '', string $media = 'all' ): void {
	$path = apply_filters( 'mosne_is_min', $path );
	wp_register_style( $handle, get_theme_file_uri( $path ), $dependencies, $version, $media );
	wp_style_add_data( $handle, 'path', get_theme_file_path( $path ) );
}

/** Register ACF blocks scripts with inline support
 *
 * @param string $handle
 * @param string $path
 * @param array $dependencies
 * @param string $version
 * @param bool $in_footer
 *
 * @return void
 */
function mosne_register_block_script( string $handle = '', string $path = '', array $dependencies = [], string $version = '', bool $in_footer = false ): void {
	$path = apply_filters( 'mosne_is_min', $path );
	wp_register_script( $handle, get_theme_file_uri( $path ), $dependencies, $version, $in_footer );
}

/**  Register ACF blocks
 * @return void
 */
function register_acf_blocks(): void {
	$version = wp_get_theme()->get( 'Version' );
	// register block works
	register_block_type( get_theme_file_path( 'blocks/selected-works' ) );
	mosne_register_block_script( 'selected-works', '/blocks/selected-works/selected-works.js', [ 'jquery' ], $version, true );
	mosne_register_block_styles( 'selected-works', '/blocks/selected-works/selected-works.css', [], $version, 'all' );
	// register block works
	register_block_type( get_theme_file_path( 'blocks/circle' ) );
	mosne_register_block_styles( 'circle', '/blocks/circle/circle.css', [], $version, 'all' );
}

add_action( 'init', 'register_acf_blocks' );
