<?php
/** Register custom block styles
 * @return void
 */
function register_custom_block_styles(): void
{
    // Register block styles for the "core/button" block.
    register_block_style(
        'core/button',
        array(
            'name' => 'big',
            'label' => __('Big Button', 'mosne'),
        )
    );
}

add_action('init', 'register_custom_block_styles');
