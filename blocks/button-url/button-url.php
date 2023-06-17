<?php
/**
 * Button-url Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or it's parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// get url
$url = get_field( 'link', get_the_id() );
if ( empty( $url ) ) {
	return;
}
//fix url
if ( ! preg_match( '~^(?:f|ht)tps?://~i', $url ) ) {
	$url = 'https://' . $url;
}

?>
<div <?php echo $anchor; ?> <?php echo get_block_wrapper_attributes(); ?>>
	<div class="wp-block-button">
		<a class="wp-block-button__link" href="<?php echo esc_url( $url ); ?>" target="_blank">
			Visit website
		</a>
	</div>
</div>
