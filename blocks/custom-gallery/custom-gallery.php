<?php
/**
 * Custom gallery Block Template.
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
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-works';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

$images = get_field('images', get_the_id());
$color = get_field('color', get_the_id());
$theme_color = (!empty($color)) ? "--carousel--theme--color: $color" : '';
$extra_attrs['class'] = $className ?? '';
$extra_attrs['style'] = $theme_color ?? '';
?>
<div <?php echo $anchor; ?> <?php echo get_block_wrapper_attributes($extra_attrs); ?>>
    <?php if ($is_preview) : ?>
       Gallery
    <?php endif; ?>
    <?php if ($images) : ?>
        <section class="m-carousel">
            <div class="m-carousel__rel m-carousel__noscrollbar">
                <div class="m-carousel__nav">
                    <button class="m-carousel__button m-carousel__prev">Prev</button>
                    <button class="m-carousel__button m-carousel__next">Next</button>
                </div>
                <div class="m-carousel__wrapper">
                    <?php foreach ($images as $key => $img) : ?>
                        <div class="m-carousel__slide">
                            <div class="m-carousel__content">
                                <?php
                                if (!empty($img)) {
                                    echo mosne_image($img, 'large', 'figure', true);
                                }
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="m-carousel__dots"></div>
            </div>
            <div class="m-carousel__counter" aria-live="polite">
                <span class="m-carousel__current">1</span>
                <span class="m-carousel__separator">/</span>
                <span class="m-carousel__tot">1</span>
            </div>
        </section>
    <?php endif; ?>
</div>
