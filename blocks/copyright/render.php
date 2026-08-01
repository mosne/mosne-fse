<?php
/**
 * Copyright block — server render.
 *
 * Output: © {Y} {text}
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block inner content (unused).
 * @var WP_Block $block      Block instance.
 */

declare(strict_types=1);

$text = isset( $attributes['text'] ) ? (string) $attributes['text'] : '';
$year = current_time( 'Y' );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'mosne-copyright',
	)
);
?>
<p <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	&copy; <?php echo esc_html( $year ); ?> <?php echo esc_html( $text ); ?>
</p>
