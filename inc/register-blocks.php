<?php
/**
 * Register ACF blocks from block.json metadata.
 *
 * Styles and scripts are declared in each block.json via file: paths.
 *
 * @return void
 */
function register_acf_blocks(): void {
	$blocks_dir = get_theme_file_path( 'blocks' );
	$block_dirs = glob( $blocks_dir . '/*', GLOB_ONLYDIR );

	if ( ! is_array( $block_dirs ) ) {
		return;
	}

	foreach ( $block_dirs as $block_dir ) {
		if ( file_exists( $block_dir . '/block.json' ) ) {
			register_block_type( $block_dir );
		}
	}
}

add_action( 'init', 'register_acf_blocks' );
