<?php
/** Register custom block styles
 * @return void
 */
function register_custom_block_styles(): void {
	// Button block.
	register_block_style(
		'core/button',
		[
			'name'  => 'big',
			'label' => __( 'Big Button', 'mosne' ),
		]
	);
	// Query block.
	register_block_style(
		'core/query',
		[
			'name'  => 'stagger',
			'label' => __( 'Stagger', 'mosne' ),
		]
	);
}

add_action( 'init', 'register_custom_block_styles' );
