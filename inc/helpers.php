<?php
/**
 * @param int $image_id
 * @param string $size
 * @param string $mode
 * @param bool $caption
 * @return string
 */
function mosne_image(int $image_id, string $size = 'large', string $mode = 'figure', bool $has_caption = false): string
{
    if (empty($image_id)) {
        return '';
    }
    $image = wp_get_attachment_image($image_id, $size);
    $caption = ($has_caption) ? wp_get_attachment_caption($image_id) : '';
    $html = '';
    if ('figure' === $mode) {
        $html .= '<figure class="wp-block-image size-'.$size.'">' . $image;

        if (!empty($caption)) {
            $html .= '<figcaption>'.$caption;
        }
        $html .= $caption . '</figcaption></figure>';
    } else {
        // image only
        $html .= $image;
    }
    return $html;
}
