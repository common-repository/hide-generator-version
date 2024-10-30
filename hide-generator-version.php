<?php
/**
 * Plugin Name: Hide Generator Version
 * Plugin URI: https://wordpress.org/plugins/hide-generator-version
 * Description: Removes the 'generator' meta-tag and comprehensively hides the WordPress version number.
 * Version: 1.1.1
 * Author: freemp
 * Author URI: https://profiles.wordpress.org/freemp
 * Text Domain: hide-generator-version
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

/* Remove generator tag. */
add_filter( 'the_generator', '__return_empty_string', PHP_INT_MAX );
/* Remove version number strings. */
function hide_generator_version_remove_query_arg( $src ) {
	global $wp_version;
	parse_str( parse_url( $src, PHP_URL_QUERY ), $query );
	if ( isset( $query['ver'] ) && $query['ver'] === $wp_version ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'script_loader_src', 'hide_generator_version_remove_query_arg', PHP_INT_MAX );
add_filter( 'style_loader_src', 'hide_generator_version_remove_query_arg', PHP_INT_MAX );
