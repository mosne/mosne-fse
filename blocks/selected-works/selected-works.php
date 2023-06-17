<?php
/**
 * Works Block Template.
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
?>
<div <?php echo $anchor; ?> <?php echo get_block_wrapper_attributes(); ?>>
	<section class="selected-works">
		<?php if ( have_rows( 'taxonomies_order' ) ): ?>
			<ul class="selected-works__row has-tertiary-background-color">
				<?php while ( have_rows( 'taxonomies_order' ) ): the_row();
					$selected_works = get_sub_field( 'selected_works' );
					$color_class    = get_sub_field( 'color_class' );
					?>
					<li class="selected-works__tax">
						<p class="selected-works__tax-label"><?php echo esc_html( get_sub_field( 'title' ) ); ?></p>
					</li>
					<?php foreach ( $selected_works as $selected_work ) : ?>
						<li class="selected-works__item <?php echo esc_attr( $color_class ); ?>">
							<a href="<?php echo esc_url( get_permalink( $selected_work) ); ?>"
							   class="selected-works__link">
								<span class="selected-works__hover"><?php echo esc_html( get_the_title($selected_work) ); ?></span>
							</a>
						</li>
					<?php endforeach;
				endwhile; ?>
			</ul>
		<?php endif; ?>
		<div class="selected-works__tooltip" aria-hidden="true"><strong class="selected-works__tooltip-label">hello</strong></div>
	</section>
</div>
