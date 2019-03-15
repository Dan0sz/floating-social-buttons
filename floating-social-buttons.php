<?php
/**
 * Plugin Name: Floating Social Buttons
 * Description: Adds sticky social buttons to the top of each post.
 * Version: 1.0.1
 * Author: Daan van den Bergh
 * Author URI: https://daan.dev
 * License: GPL2v2 or later
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

define('FLOATING_SOCIAL_BUTTONS_STATIC_VERSION', '1.0.1');

/**
 * @param $content
 *
 * @return string
 */
function share_buttons_add_to_content($content)
{
	if (!is_single() || is_front_page()) {
		return $content;
	}
	
	$containers = array(
        'share-buttons-container',
        'share-buttons-container-clone'
    );
	
	ob_start();
	foreach ($containers as $container) {
        include 'includes/buttons.phtml';
    }
	$buttons = ob_get_clean();
	$content = $buttons . $content;

	return $content;
}
add_filter('the_content', 'share_buttons_add_to_content');

/**
 * Enqueues the necessary scripts only on post pages.
 */
function share_buttons_stylesheet()
{
    if (is_single() && !is_page() && !is_front_page()) {
        wp_register_style(
            'share-buttons-styles',
            plugins_url() . '/floating-social-buttons/css/buttons.min.css',
            array(),
            FLOATING_SOCIAL_BUTTONS_STATIC_VERSION,
            'all'
        );
        wp_enqueue_style('share-buttons-styles');
    
        wp_register_script(
            'share-buttons-scripts',
            plugins_url() . '/floating-social-buttons/js/buttons.js',
            array(
                'jquery'
            ),
            FLOATING_SOCIAL_BUTTONS_STATIC_VERSION,
            true
        );
        wp_enqueue_script('share-buttons-scripts');
    }
}
add_action('wp_enqueue_scripts', 'share_buttons_stylesheet');
