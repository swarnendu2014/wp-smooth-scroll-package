<?php
/*
Plugin Name: Wp Smooth Scroll Package
Version: 0.1
Description: This plugin adds a back to top button to every page to scroll to top of the page
Author: Quadrant Informatics Pvt Ltd
Author URI: http://www.quadrant.technology
Plugin URI: http://www.quadrant.technology
Text Domain: wp-smooth-scroll-package
*/

/*------------------------------------------------------------------*/ 
/*------------------------------------------------------------------*/ 
$page_scroll_plugin_url = trailingslashit(WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)));

/* Version check */
global $wp_version;	
$exit_msg='WP Digg This requires WordPress 2.5 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
if (version_compare($wp_version,"2.5","<")){
	exit ($exit_msg);
}

/*------------------------------------------------------------------*/ 
/*------------------------------------------------------------------*/ 

add_action('wp_head', 'wpssp_addStylesheetFileToHead' );
add_action('wp_print_scripts', 'wpssp_addScriptToHead');

if ( is_admin() ){ // admin actions

	add_action('admin_menu', 'wp_smooth_scroll_config_menu');	
	add_action( 'admin_head', 'wp_smooth_scroll_admin_menu_icons_css' );

	// Always use wp_enqueue_scripts action hook to both enqueue and register scripts
	require_once (dirname(__FILE__).'/wp-smooth-scroll-admin.php');
}


add_action( 'wp_footer', 'footer_callback_to_add_script' );

register_activation_hook( __FILE__, 'wp_smoth_scroll_package_activation_callback' );

/*------------------------------------------------------------------*/ 
/*------------------------------------------------------------------*/ 


function wp_smoth_scroll_package_activation_callback() {

    update_option('wpssp_plugin_top_bottom' , 'bottom');
	update_option('wpssp_plugin_top_bottom_val' , '55');

	update_option('wpssp_plugin_left_right' , 'right');
	update_option('wpssp_plugin_left_right_val' , '15');

	update_option('wpssp_plugin_custom_style' , '');
}

function wpssp_addScriptToHead(){
	global $page_scroll_plugin_url;
	
	if (!is_admin()){
		wp_enqueue_script('jquery');
		wp_enqueue_script('page_scroll_script', $page_scroll_plugin_url.'js/scroll-script.js', array('jquery')); 
	
						
	}
}

function footer_callback_to_add_script() {
	$style_str ='';
	$style_str .= get_option('wpssp_plugin_top_bottom').':'.get_option('wpssp_plugin_top_bottom_val').'px;';
	$style_str .= get_option('wpssp_plugin_left_right').':'.get_option('wpssp_plugin_left_right_val').'px;';
	$style_str .= get_option('wpssp_plugin_custom_style');

    $script_data = '<script>jQuery(\'body\').append( \'<div class="pageTop" style="'. $style_str .'"></div>\' );</script>';

	echo $script_data;
}


function wpssp_addStylesheetFileToHead(){
	global $page_scroll_plugin_url;
	echo '<link rel="stylesheet" href="'.$page_scroll_plugin_url.'css/page-scroll.css" type="text/css" />'; 

}


function wp_smooth_scroll_admin_menu_icons_css() {
	?>
    <style>
        /* CSS code goes here */
        #adminmenu #toplevel_page_wp_smooth_scroll_config div.wp-menu-image::before {
		    content: '\f174';
		}
        #adminmenu #toplevel_page_wp_smooth_scroll_config div.wp-menu-image {
		    background: none !important;
		}
		#adminmenu #toplevel_page_wp_smooth_scroll_config div.wp-menu-image {
		    background: none !important;
		}
	</style>
	<?php
}

function wp_smooth_scroll_config_menu() {
	add_menu_page(
		__("WP Smooth Scroll Package Config Options", WP_SMOOTH_SCROLL_CONFIG_DOMAIN), 
		__("WP Smooth Scroll Package Config", WP_SMOOTH_SCROLL_CONFIG_DOMAIN), 
		'manage_options', 'wp_smooth_scroll_config', 
		'wp_smooth_scroll_config_options'
	);
}



?>