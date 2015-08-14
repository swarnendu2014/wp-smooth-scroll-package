<?php
/**
 * Add an option page
 */

function wp_smooth_scroll_config_options() {

	if(isset($_POST['savePluginsSettings']) && 1 == $_POST['savePluginsSettings']){

		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";

		update_option('wpssp_plugin_top_bottom' , $_POST['top-bottom']);
		update_option('wpssp_plugin_top_bottom_val' , $_POST['top-bottom-value']);

		update_option('wpssp_plugin_left_right' , $_POST['left-right']);
		update_option('wpssp_plugin_left_right_val' , $_POST['left-right-value']);

		update_option('wpssp_plugin_custom_style' , $_POST['customStyleForPlugin']);


	}


	$wpssp_plugin_top_bottom = get_option('wpssp_plugin_top_bottom');
	$wpssp_plugin_top_bottom_val = get_option('wpssp_plugin_top_bottom_val');

	$wpssp_plugin_left_right = get_option('wpssp_plugin_left_right');
	$wpssp_plugin_left_right_val = get_option('wpssp_plugin_left_right_val');

	$wpssp_plugin_custom_style = get_option('wpssp_plugin_custom_style');


	if ( current_user_can( 'edit_users' ) && (isset($_GET['settings-updated'])  && $_GET['settings-updated'] == true)){
		global $wp_roles;
		$roles = $wp_roles->get_names();

		$dp_roles = get_option('duplicate_post_roles');
		if ( $dp_roles == "" ) $dp_roles = array();

		foreach ($roles as $name => $display_name){
			$role = get_role($name);

			// role should have at least edit_posts capability
			if ( !$role->has_cap('edit_posts') ) continue;

			/* If the role doesn't have the capability and it was selected, add it. */
			if ( !$role->has_cap( 'copy_posts' )  && in_array($name, $dp_roles) )
			$role->add_cap( 'copy_posts' );

			/* If the role has the capability and it wasn't selected, remove it. */
			elseif ( $role->has_cap( 'copy_posts' ) && !in_array($name, $dp_roles) )
			$role->remove_cap( 'copy_posts' );
		}
	}


	?>
	<div class="plugin-settings">
		<h2>Settings</h2>
	</div>
	<hr/>
	<form action="" method="post">
		<div class="options">
			<h4>Select position </h4>
			<div>
				<input type="radio" name="top-bottom" value="top" <?php if($wpssp_plugin_top_bottom=='top'){echo 'checked="checked"';}?>  > top 
				<input type="radio" name="top-bottom" value="bottom"  <?php if($wpssp_plugin_top_bottom=='bottom'){echo 'checked="checked"';}?>  > bottom 
				<input type="number" min="0" value="<?php echo $wpssp_plugin_top_bottom_val; ?>" name="top-bottom-value">px
			</div>
			<div>
				<input type="radio" name="left-right" value="left"  <?php if($wpssp_plugin_left_right=='left'){echo 'checked="checked"';}?> > left 
				<input type="radio" name="left-right" value="right"  <?php if($wpssp_plugin_left_right=='right'){echo 'checked="checked"';}?> > right 
				<input type="number" min="0" value="<?php echo $wpssp_plugin_left_right_val; ?>" name="left-right-value">px
			</div>
		</div>

		<div class="selectStyle">
			<textarea name="customStyleForPlugin" id="customStyleForPlugin" cols="60" rows="10"><?php echo $wpssp_plugin_custom_style ?></textarea>
		</div>

		<div class="buttons">
			<input type="hidden" name="savePluginsSettings" value="1" >
			<input type="submit" value="save" >
		</div>
	</form>

	<?php
}
?>

