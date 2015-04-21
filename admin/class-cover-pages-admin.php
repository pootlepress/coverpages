<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cover_Pages
 * @subpackage Cover_Pages/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cover_Pages
 * @subpackage Cover_Pages/admin
 * @author     Your Name <email@example.com>
 */
class Cover_Pages_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Customizer fields
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $fields    Fields to render
	 */
	private $settings_fields;

	/**
	 * Customizer fields
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $fields    Fields to render
	 */
	private $fields;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 * @param	string    $plugin_name       The name of this plugin.
	 * @param	string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->get_fields();
		require_once plugin_dir_path( __FILE__ ) . '/inc/customizer-classes.php';
		require_once plugin_dir_path( __FILE__ ) . '/inc/settings-callbacks.php';

	}
	
	/**
	 * Sets the fields the render in customizer
	 *
	 * @since	1.0.0
	 * @param	string    $plugin_name       The name of this plugin.
	 * @param	string    $version    The version of this plugin.
	 */
	public function get_fields() {

		$this->settings_fields = array(
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
			'choices'	=> array('1'=>'Template 1', '2'=>'Template 2'),
		  ),

		);
		$this->fields = array(
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
			'choices'	=> array('1'=>'Template 1', '2'=>'Template 2'),
		  ),
		);

	}

	/**
	 * Section id from name
	 * 
	 * @param string $sec Section Name
	 * @return string Section ID
	 */
	public function get_sec_id($sec){
		return $this->plugin_name . '-section-' . str_replace(array(' ', '_', ',', '.'), '-',strtolower($sec));
	}
	
	/**
	 * Field id from name
	 * 
	 * @param string $n Field Name
	 * @return string Field ID
	 */
	public function get_field_id($n){
		return $this->plugin_name . '-' . str_replace(array(' ', '_', ',', '.'),  '-',strtolower($n));
	}
	
	/**
	 * Creates sections and fields for settings page
	 *
	 * @since	1.0.0
	 * @param	string    $plugin_name       The name of this plugin.
	 * @param	string    $version    The version of this plugin.
	 */
	public function settings() {
		
		$fields = $this->settings_fields;

		//Creating sections array
		foreach ($fields as $id => $args){
			//Creating array containing sections as keys and array of fields arrays as value
			$sections[$args['section']][] = $args;
		}
		
		$page = $this->plugin_name.'-page';
		$GLOBALS['cover-page-settings'] = $sections;
		
		foreach ( $sections as $sec => $fields ){

			$sec_id = $this->get_sec_id($sec);
			
			add_settings_section(
				$sec_id,
				$sec,
				'cover_pages_section_cb',
				$sec_id
			);
			
			foreach ($fields as $f){

				$id = $this->get_field_id($f['id']);
				
				//Init options
				if( false == get_option( $id ) ) add_option( $id );

				register_setting(
					$sec_id,
					$id
				);

				add_settings_field( 
					$id,
					$f['label'],
					'cover_pages_settings_cb',
					$sec_id,
					$sec_id,
					$f
				);

			}
		}

	}
	
	/**
	 * Outputs the coverpages main settings page
	 *
	 * @since	1.0.0
	 * @param	string    $plugin_name       The name of this plugin.
	 * @param	string    $version    The version of this plugin.
	 */
	public function pages() {

		add_theme_page( 'Cover Page', 'Cover Page', 'edit_theme_options', $this->plugin_name.'-page', array( $this, 'CoverPageCallback' ) );

	}

	/**
	 * Adds customizer sections, fields and settings
	 * 
	 * @param object $wp_customize 
	 */
	public function customizer($wp_customize){
		
		$coverpages = isset( $_REQUEST['coverpages-customize'] );
		if( $coverpages ){
			remove_all_actions('customize_register');
		}

			//Registering control types
			$wp_customize->register_control_type( 'WP_Customize_Color_Control' );
			$wp_customize->register_control_type( 'WP_Customize_Upload_Control' );
			$wp_customize->register_control_type( 'WP_Customize_Image_Control' );

			//Fields to output
			$fields = $this->fields;
			$sections = array();

			//Creating sections array
			foreach ($fields as $id => $args){
				//Creating array containing sections as keys and array of fields arrays as value
				$sections[$args['section']][] = $args;
			}

				//Creating customizer Sections, Controls and Settings
				$this->customizer_fields( $wp_customize, $sections );

	}
	
	/**
	 * Sets the fields for the cusmtomizer
	 *
	 * @since	1.0.0
	 * @param object $wp_customize WP_Customizer
	 * @param array $sections Sections and thier fields
	 */
	public function customizer_fields( $wp_customize, $sections ){

		foreach ($sections as $sec => $fields){

			$wp_customize->add_section(
				$this->get_sec_id($sec),
				array(
					'title'     => $sec,
					'priority'  => 999
				)
			);


			foreach ($fields as $f){
				
				$id = $this->get_field_id($f['id']);

				//Arguments to pass
				$args =	array(
					'section'  => $this->get_sec_id($sec),
					'label'    => $f['label'],
					'settings'     => $id,
					
				);
				
				$default = '';
				if( isset( $f['default'] ) ){
					$default = $f['default'];
				}

				//Add Setting
				$wp_customize->add_setting(
					$id,
					array(
						'type'   => 'option',
						'default'   => $default,
						'transport' => 'refresh'
					)
				);

				//For Translation
				$f['label'] = __($f['label'], 'cover-pages');

				$this->render_customizer_field( $wp_customize, $f, $id, $args );
			}

		}

	}

	/**
	 * Renders the fields for the cusmtomizer
	 *
	 * @since    1.0.0
	 *
	 * @param object $wp_customize WP_Customizer
	 * @param $f
	 * @param $id
	 * @param $args
	 *
	 * @internal param array $sections Sections and thier fields
	 */
	public function render_customizer_field( $wp_customize, $f, $id, $args ){
		//Add control by type
		switch ( $f['type'] ){
			case 'color':

				$wp_customize->add_control(
					new WP_Customize_Color_Control(
						$wp_customize,
						$id,
						$args
					)
				);

				break;
			case 'slider':

				$wp_customize->add_control(
					new Cover_Page_Slider_Customize_Control(
						$wp_customize,
						$id,
						$args
					)
				);

				break;
			case 'image':

				$wp_customize->add_control(
					new WP_Customize_Image_Control(
						$wp_customize,
						$id,
						array(
							'section'  => $this->get_sec_id($f['section']),
							'label'    => $f['label'],
							'settings'     => $id,
						)
					)
				);

				break;
			case 'font':

				$args['choices'] = $this->get_fonts();
				$args['type'] = 'select';

				$wp_customize->add_control(
					$id,
					$args
				);

				break;
			case 'radio':
			case 'select':

				if( ! isset( $f['choices'] ) ) $f['choices'] = array( 'choice1' => 'Choice 1',  'choice2' => 'Choice 2' );
				$args['choices'] = $f['choices'];
				$args['type'] = $f['type'];

				$wp_customize->add_control(
					$id,
					$args
				);

				break;
			default:
				$args['type'] = $f['type'];
				if( 'checkbox' == $f['type'] ){
					add_option($id, 1);
				}
				$wp_customize->add_control(
					$id,
					$args
				);
		}
	}

	/**
	 * Array of fonts for font controls
	 *
	 * @since	1.0.0
	 * @return array Fonts
	 */
	public function get_fonts(){
		return array(
			'times'     => 'Times New Roman',
			'arial'     => 'Arial',
			'courier'   => 'Courier New'
		);
	}

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 * @param	string    $plugin_name       The name of this plugin.
	 * @param	string    $version    The version of this plugin.
	 */
	public function CoverPageCallback() {

		require plugin_dir_path(__FILE__).'/partials/cover-pages-admin-display.php';

	}

	/**
	 * Admin classes
	 * 
	 * @param string $classes
	 */
	public function admin_body_class( $classes ) {

		if( isset($_GET['coverpages-customize']) ){
			$classes .= ' coverpages-customize ';
		}

		return $classes;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		//Init CSS
		$css = '';
		//Hiding customizer info if coverpages-customizer requested
		if( isset($_GET['coverpages-customize']) ){
			$css .= '#customize-info{display:none;}';
		}
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cover-pages-admin.css', array(), $this->version, 'all' );
		wp_add_inline_style( $this->plugin_name, $css );
		wp_enqueue_style( $this->plugin_name . '-jqUI-css', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function customize_styles() {
	
	//Getting IDs of all coverpage fields using slider
	?>
<style id="coverpages">
	input.cover-pages-slider{
		display:block;
		position:fixed;
		top:-9999px;
	}
	div.cover-pages-slider{
		margin:16px 0;
	}
	<?php
		if( !isset($_GET['coverpages-customize']) ){
	?>
	#accordion-section-cover-pages-section-background,
	#accordion-section-cover-pages-section-logo--site-title-and-tagline,
	#accordion-section-cover-pages-section-text,
	#accordion-section-cover-pages-section-buttons-1,
	#accordion-section-cover-pages-section-buttons-2,
	#accordion-section-cover-pages-section-change-template,
	#accordion-section-cover-pages-section-activate{
		display: none !important;
	}
		<?php
		}
		
		?>
</style>
		<?php
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cover-pages-admin.js', array( 'jquery' ), $this->version, false );
		if(is_customize_preview()){
			wp_enqueue_script( 'jquery-ui-slider' );
		}

	}

}
