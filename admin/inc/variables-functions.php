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

//Settings fields
$coverpages_settings_api_fields = array(
	'activate' => array(
		'id'		=> 'activate',
		'section'	=> 'General',
		'label'		=> 'Activate on Site',
		'type'		=> 'checkbox',
		'desc'		=> 'Check this box to enable CoverPage',
	),
	'template' => array(
		'id'		=> 'template',
		'section'	=> 'Template',
		'label'		=> 'Change Template',
		'type'		=> 'radio',
		'desc'		=> 'This will soon be click-n-select thumbnail',
		'choices'	=> array( '1' => 'Template 1', '2' => 'Template 2' ),
	),
);

//Settings fields
$coverpages_customization_api_fields =  array(
	'bg-image' => array(
		'id'		=> 'bg-image',
		'section'	=> 'Background',
		'label'		=> 'Background image',
		'type'		=> 'image',
	),
	'bg-color' => array(
		'id'		=> 'bg-color',
		'section'	=> 'Background',
		'label'		=> 'Background color',
		'type'		=> 'color',
	),
	'bg-opacity' => array(
		'id'		=> 'bg-opacity',
		'section'	=> 'Background',
		'label'		=> 'Background color Opacity',
		'type'		=> 'slider',
	),
	'logo' => array(
		'id'		=> 'logo',
		'section'	=> 'Logo, site title and tagline',
		'label'		=> 'Upload logo',
		'type'		=> 'image',
	),
	'title' => array(
		'id'		=> 'title',
		'section'	=> 'Logo, site title and tagline',
		'label'		=> 'Site title',
		'type'		=> 'text',
	),
	'title-font' => array(
		'id'		=> 'title-font',
		'section'	=> 'Logo, site title and tagline',
		'label'		=> 'Site title Font type',
		'type'		=> 'font',
	),
	'title-size' => array(
		'id'		=> 'title-size',
		'section'	=> 'Logo, site title and tagline',
		'label'		=> 'Site title Font size',
		'type'		=> 'slider',
	),
	'title-color' => array(
		'id'		=> 'title-color',
		'section'	=> 'Logo, site title and tagline',
		'label'		=> 'Site title Font color',
		'type'		=> 'color',
	),
	'tag-line' => array(
		'id'		=> 'tag-line',
		'section'	=> 'Logo, site title and tagline',
		'label'		=> 'Tagline',
		'type'		=> 'text',
	),
	'tag-font' => array(
		'id'		=> 'tag-font',
		'section'	=> 'Logo, site title and tagline',
		'label'		=> 'Tagline Font type',
		'type'		=> 'font',
	),
	'tag-size' => array(
		'id'		=> 'tag-size',
		'section'	=> 'Logo, site title and tagline',
		'label'		=> 'Tagline Font size',
		'type'		=> 'slider',
	),
	'tag-color' => array(
		'id'		=> 'tag-color',
		'section'	=> 'Logo, site title and tagline',
		'label'		=> 'Tagline Font color',
		'type'		=> 'color',
	),
	'text' => array(
		'id'		=> 'text',
		'section'	=> 'Text',
		'label'		=> 'Text',
		'type'		=> 'text',
	),
	'text-font' => array(
		'id'		=> 'text-font',
		'section'	=> 'Text',
		'label'		=> 'Text Font Type',
		'type'		=> 'font',
	),
	'text-size' => array(
		'id'		=> 'text-size',
		'section'	=> 'Text',
		'label'		=> 'Text Font Size',
		'type'		=> 'slider',
	),
	'text-color' => array(
		'id'		=> 'text-color',
		'section'	=> 'Text',
		'label'		=> 'Text Font Color',
		'type'		=> 'color',
	),
	'button1-display' => array(
		'id'		=> 'button1[display]',
		'section'	=> 'Buttons 1',
		'label'		=> 'Display button',
		'type'		=> 'checkbox',
		'default'	=> 1,
	),
	'button1-text' => array(
		'id'		=> 'button1[text]',
		'section'	=> 'Buttons 1',
		'label'		=> 'Button Text',
		'type'		=> 'text',
	),
	'button1-bradius' => array(
		'id'		=> 'button1[bradius]',
		'section'	=> 'Buttons 1',
		'label'		=> 'Corner Style',
		'type'		=> 'slider',
	),
	'button1-color' => array(
		'id'		=> 'button1[color]',
		'section'	=> 'Buttons 1',
		'label'		=> 'Button Color',
		'type'		=> 'color',
	),
	'button1-size' => array(
		'id'		=> 'button1[size]',
		'section'	=> 'Buttons 1',
		'label'		=> 'Button Size',
		'type'		=> 'slider',
	),
	'button1-link' => array(
		'id'		=> 'button1[link]',
		'section'	=> 'Buttons 1',
		'label'		=> 'Button Link',
		'type'		=> 'text',
	),
	'button2-display' => array(
		'id'		=> 'button2[display]',
		'section'	=> 'Buttons 2',
		'label'		=> 'Display button',
		'type'		=> 'checkbox',
		'default'	=> 1,
	),
	'button2-text' => array(
		'id'		=> 'button2[text]',
		'section'	=> 'Buttons 2',
		'label'		=> 'Button Text',
		'type'		=> 'text',
	),
	'button2-bradius' => array(
		'id'		=> 'button2[bradius]',
		'section'	=> 'Buttons 2',
		'label'		=> 'Corner Style',
		'type'		=> 'slider',
	),
	'button2-color' => array(
		'id'		=> 'button2[color]',
		'section'	=> 'Buttons 2',
		'label'		=> 'Button Color',
		'type'		=> 'color',
	),
	' button2-size' => array(
		'id'		=> 'button2[size]',
		'section'	=> 'Buttons 2',
		'label'		=> 'Button Size',
		'type'		=> 'slider',
	),
	' button2-link' => array(
		'id'		=> 'button2[link]',
		'section'	=> 'Buttons 2',
		'label'		=> 'Button Link',
		'type'		=> 'text',
	),
	'template' => array(
		'id'		=> 'template',
		'section'	=> 'Change template',
		'label'		=> 'Change Template',
		'type'		=> 'radio',
		'choices'	=> array( '1' => 'Template 1', '2' => 'Template 2' ),
	),
);
		