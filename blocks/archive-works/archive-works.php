<?php
/**
 * Archive Works Block Template.
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
$previouse_year = '';
$count          = 0;
?>
<div <?php echo $anchor; ?> <?php echo get_block_wrapper_attributes(); ?>>
	<div class="mosne-archive-works">
		<div class="mosne-archive-works__col">
			<h2 aria-hidden="true" class="mosne-archive-works__year is-sticky"><span>20</span></h2>
		</div>
		<div class="mosne-archive-works__col">
			<?php
			if ( have_posts() ) :
			while ( have_posts() ) :
			the_post();
			$color        = get_field( 'color', get_the_id() );
			$circle_style = "background-color: $color";
			$the_full_date    = get_the_date( 'Y' );
			$the_date     = substr( $the_full_date, - 2 );
			?>
			<?php if ( $the_date !== $previouse_year ) : ?>
			<?php if ( $count > 0 ) : ?>
				</ul>
				</section>
			<?php endif; ?>
			<section class="mosne-archive-works__section wp-block-query aligncenter is-style-stagger">
				<h2 aria-label="<?php echo esc_html( $the_full_date ); ?>" class="mosne-archive-works__year">
					<span aria-label="hidden"><?php echo esc_html( $the_date ); ?></span>
				</h2>
				<ul class="is-flex-container columns-5 aligncenter wp-block-post-template is-layout-flow">
					<?php endif; ?>
					<li <?php post_class('wp-block-post'); ?>>
						<?php block_template_part( 'simple-card-works' ); ?>
					</li>
					<?php
					$previouse_year = $the_date;
					$count ++;
					endwhile;
					endif;
					?>
				</ul>
			</section>
			<section class="mosne-archive-works__section wp-block-query aligncenter is-style-stagger">
				<h2 class="mosne-archive-works__year">
					<span>... 1998</span>
				</h2>
			</section>
		</div>
	</div>
</div>
