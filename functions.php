<?php
/**
 * Theme functions and definitions
 *
 * @param string $path
 * @return string
 * @since Mosne_FSE 1.0
 * @package WordPress
 * @subpackage Mosne_FSE
 */

function mosne_is_min_debug(string $path) : string
{
    if (defined('MOSNE_DEBUG') && MOSNE_DEBUG) {
        return $path;
    }
    //replace .js with .min.js and .css with .min.css
    return preg_replace('/\.(js|css)$/', '.min.$1', $path);
}

// add filter to allow minified assets
add_filter('mosne_is_min', 'mosne_is_min_debug');

/** Register and enqueue assets for the front end.
 * @return void
 */
function mosne_fse_enqueue_assets(): void
{
    $version = wp_get_theme()->get('Version');
    //register scripts
    $plugins_path = apply_filters('mosne_is_min', "/assets/js/plugins.js");
    $script_path = apply_filters('mosne_is_min', "/assets/js/scripts.js");
    $style_path = apply_filters('mosne_is_min', "/assets/style.css");

    wp_register_script('mosne-fse-plugins', get_theme_file_uri($plugins_path), array('jquery'), $version, true);
    wp_register_script('mosne-fse-scripts', get_theme_file_uri($script_path), array('jquery', 'mosne-fse-plugins'), $version, true);
    // enqueue scripts
    wp_enqueue_script('mosne-fse-plugins');
    wp_enqueue_script('mosne-fse-scripts');
    // register styles
    wp_register_style('mosne-fse-style', get_theme_file_uri($style_path), array(), $version, 'screen');
    // enqueue styles
    wp_enqueue_style('mosne-fse-style');
}

add_action('wp_enqueue_scripts', 'mosne_fse_enqueue_assets');

/** Register ACF blocks styles with inline support
 * @param string $handle
 * @param string $path
 * @param array $dependencies
 * @param string $version
 * @param string $media
 * @return void
 */
function mosne_register_block_styles(string $handle = '', string $path = '', array $dependencies = [], string $version = '', string $media = 'all'): void
{
    $path = apply_filters('mosne_is_min', $path);
    wp_register_style($handle, get_theme_file_uri($path), $dependencies, $version, $media);
    wp_style_add_data($handle, 'path', get_theme_file_path($path));
}

/** Register ACF blocks scripts with inline support
 * @param string $handle
 * @param string $path
 * @param array $dependencies
 * @param string $version
 * @param bool $in_footer
 * @return void
 * usage: in wp-config.php
 * if ( ! defined( 'MOSNE_DEBUG' ) ) {
 * define( 'MOSNE_DEBUG', true );
 * }
 */
function mosne_register_block_script(string $handle = '', string $path = '', array $dependencies = [], string $version = '', bool $in_footer = false): void
{
    $path = apply_filters('mosne_is_min', $path);
    wp_register_script($handle, get_theme_file_uri($path), $dependencies, $version, $in_footer);
}

/**  Register ACF blocks
 * @return void
 */
function register_acf_blocks(): void
{
    $version = wp_get_theme()->get('Version');
    // register block works
    register_block_type(__DIR__ . '/blocks/works');
    mosne_register_block_script('works', '/blocks/works/works.js', ['jquery'], $version, true);
    mosne_register_block_styles('works', '/blocks/works/works.css', ['global-styles'], $version, 'all');
}

add_action('init', 'register_acf_blocks');
