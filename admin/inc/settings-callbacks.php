<?php
/**
 * Settings sections and fields callbacks
 *
 * @link       http://pootlepress.com
 * @since      1.0.0
 * @package    Cover_Pages
 * @subpackage Cover_Pages/public/partials
 */

/**
 * 
 * @param string $id The coverpage id of setting
 * @return type
 */
function cover_page_option($id){
	return get_option('cover-pages-'.$id);
}

/**
 * 
 * @param string $id The coverpage id of setting
 * @return string the wp settings id
 */
function cover_page_settings_id($id){
	return 'cover-pages-'.$id;
}

/**
 * Callback for all our setting sections
 *
 * @since	1.0.0
 */
function cover_pages_section_cb(){
	//Just for hiding error
}

/**
 * Callback for all our setting fields
 * 
 * @param array $args coverpage field arguments
 * @since	1.0.0
 */
function cover_pages_settings_cb( $args ){
	
	$id = $args['id'];
	
	$type = $args['type'];
	
	//Description
	if( isset($args['desc']) ) {
		$desc = $args['desc'];
	} else {
		$desc = false;
	}

	switch ($args['type']){
		case 'checkbox':
			?>
			<input type="checkbox" id="<?php echo cover_page_settings_id( $id ) ?>" name="<?php echo cover_page_settings_id( $id ) ?>" value="1" <?php checked( cover_page_option( $id ) ) ?> />
			<?php
			break;
		case 'radio':
			foreach( $args['choices'] as $k => $v ){
				?>
			<label for="<?php echo cover_page_settings_id( $id ) .  $k ?>"><input type="radio" id="<?php echo cover_page_settings_id( $id ) . $k ?>" name="<?php echo cover_page_settings_id( $id ) ?>" value="<?php echo $k; ?>" <?php checked( $k, cover_page_option( $id ) ) ?> /> <?php echo $v; ?> </label> <br/>
				<?php
			}
			break;
		default:
			?>
			<input type="<?php echo $type ?>" id="<?php echo cover_page_settings_id( $id ) ?>" name="<?php echo cover_page_settings_id( $id ) ?>" value="<?php echo cover_page_option( $id ) ?>" />
			<?php
	}

	if( $desc ){
		echo '<p class="description"> '  . $desc . '</p>';
	}
}
