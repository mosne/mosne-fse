<?php
/**
 * Register and enqueue theme assets for the front end and editor.
 *
 * @return void
 */
function mosne_fse_enqueue_assets(): void {
	$style_path  = '/dist/style-index.css';
	$script_path = '/dist/scripts.js';
	$style_file  = get_theme_file_path( $style_path );
	$script_file = get_theme_file_path( $script_path );

	if ( file_exists( $style_file ) ) {
		wp_enqueue_style(
			'mosne-fse-style',
			get_theme_file_uri( $style_path ),
			[],
			(string) filemtime( $style_file ),
			'screen'
		);
	}

	if ( file_exists( $script_file ) && filesize( $script_file ) > 0 ) {
		$asset_file = get_theme_file_path( '/dist/scripts.asset.php' );
		$asset      = file_exists( $asset_file )
			? include $asset_file
			: [
				'dependencies' => [],
				'version'      => (string) filemtime( $script_file ),
			];

		wp_enqueue_script(
			'mosne-fse-scripts',
			get_theme_file_uri( $script_path ),
			$asset['dependencies'],
			$asset['version'],
			true
		);
	}
}

add_action( 'wp_enqueue_scripts', 'mosne_fse_enqueue_assets' );

/**
 * Load compiled theme styles in the block editor.
 *
 * @return void
 */
function mosne_fse_editor_assets(): void {
	add_editor_style( 'dist/style-index.css' );
}

add_action( 'admin_init', 'mosne_fse_editor_assets' );
