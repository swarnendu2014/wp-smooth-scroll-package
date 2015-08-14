<?php
// Added by WarmStal
if(!is_admin())
return;

require_once (dirname(__FILE__).'/wp-smooth-scroll-options.php');

/**
 * Wrapper for the option 'duplicate_post_version'
 */
function wp_smooth_scroll_config_get_installed_version() {
	return get_option( 'wp_smooth_scroll_config_version' );
}

/**
 * Wrapper for the defined constant DUPLICATE_POST_CURRENT_VERSION
 */
function wp_smooth_scroll_config_get_current_version() {
	return WP_SMOOTH_SCROLL_CONFIG_CURRENT_VERSION;
}

/**
 * Plugin upgrade
 */

//Add some links on the plugin page
add_filter('plugin_row_meta', 'wp_smooth_scroll_config_add_plugin_links', 10, 2);

function wp_smooth_scroll_config_add_plugin_links($links, $file) {
	if ( $file == plugin_basename(dirname(__FILE__).'/wp-smooth-scroll-config.php') ) {
		$links[] = '<a href="#">' . __('Donate', WP_SMOOTH_SCROLL_CONFIG_DOMAIN) . '</a>';
		$links[] = '<a href="#">' . __('Translate', WP_SMOOTH_SCROLL_CONFIG_DOMAIN) . '</a>';
	}
	return $links;
}
?>