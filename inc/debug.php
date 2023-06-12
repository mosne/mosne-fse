<?php
/* @param string $path
 * @return string
 * usage: in wp-config.php
 * if ( ! defined( 'MOSNE_DEBUG' ) ) {
 * define( 'MOSNE_DEBUG', true );
 * }
 */
function mosne_is_min_debug(string $path): string
{
    if (defined('MOSNE_DEBUG') && MOSNE_DEBUG) {
        return $path;
    }
    //replace .js with .min.js and .css with .min.css
    return preg_replace('/\.(js|css)$/', '.min.$1', $path);
}

// add filter to allow minified assets
add_filter('mosne_is_min', 'mosne_is_min_debug');
