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
	 * Settings fields
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $fields    Fields to render
	 */
	private $custo_fields;

	/**
	 * Settings fields
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $settings_fields    Fields to render
	 */
	private $settings_fields;

	/**
	 * Settings fields
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

		$this->custo_fields = new Cover_Pages_Customizer_Fields( $plugin_name, $version );

	}

	/**
	 * Sets the fields the render in customizer
	 *
	 * @since	1.0.0
	 */
	public function get_fields() {

		global $coverpages_settings_api_fields;
		global $coverpages_customization_api_fields;

		$this->settings_fields = $coverpages_settings_api_fields;
		$this->fields = $coverpages_customization_api_fields;

	}

	/**
	 * Section id from name
	 * 
	 * @param string $sec Section Name
	 * @return string Section ID
	 */
	public function get_sec_id($sec){
		return $this->plugin_name . '-section-' . str_replace( array( ' ', '_', ',', '.' ), '-', strtolower( $sec ) );
	}
	
	/**
	 * Field id from name
	 * 
	 * @param string $n Field Name
	 * @return string Field ID
	 */
	public function get_field_id($n){
		return $this->plugin_name . '-' . str_replace( array( ' ', '_', ',', '.' ),  '-', strtolower( $n ) );
	}

	/**
	 * Creates sections and fields for settings page
	 *
	 * @since	1.0.0
	 */
	public function settings() {
		
		$fields = $this->settings_fields;

		$sections = array();

		//Creating sections array
		foreach ( $fields as $id => $args ) {
			//Creating array containing sections as keys and array of fields arrays as value
			$sections[ $args['section'] ][] = $args;
		}
		
		$GLOBALS['cover-page-settings'] = $sections;
		
		foreach ( $sections as $sec => $fields ){

			$sec_id = $this->get_sec_id( $sec );

			add_settings_section(
				$sec_id,
				$sec,
				'cover_pages_section_cb',
				$sec_id
			);
			
			foreach ( $fields as $f ) {

				$id = $this->get_field_id( $f['id'] );
				
				//Init options
				if ( false == get_option( $id ) ) { add_option( $id ); }

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
	 */
	public function pages() {

		add_theme_page( 'Cover Page', 'Cover Page', 'edit_theme_options', $this->plugin_name.'-page', array( $this, 'cover_page_callback' ) );

	}

	/**
	 * Adds customizer sections, fields and settings
	 * 
	 * @param object $wp_customize 
	 */
	public function customizer($wp_customize){
		
		$coverpages = filter_input( INPUT_GET, 'coverpages-customize' );
		if ( $coverpages ) {
			remove_all_actions( 'customize_register' );
		}

		//Registering control types
		$wp_customize->register_control_type( 'WP_Customize_Color_Control' );
		$wp_customize->register_control_type( 'WP_Customize_Upload_Control' );
		$wp_customize->register_control_type( 'WP_Customize_Image_Control' );

		//Fields to output
		$fields = $this->fields;
		$sections = array();

		//Creating sections array
		foreach ( $fields as $id => $args ){
			//Creating array containing sections as keys and array of fields arrays as value
			$sections[ $args['section'] ][] = $args;
		}

		//Creating customizer Sections, Controls and Settings
		$this->custo_fields->customizer_fields( $wp_customize, $sections );

	}

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 */
	public function cover_page_callback() {

		require plugin_dir_path( __FILE__ ).'/partials/cover-pages-admin-display.php';

	}

	/**
	 * Admin classes
	 * 
	 * @param string $classes
	 */
	public function admin_body_class( $classes ) {

		if ( filter_input( INPUT_GET, 'coverpages-customize' ) ) {
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
		if ( filter_input( INPUT_GET, 'coverpages-customize' ) ) {
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

	if ( ! filter_input( INPUT_GET, 'coverpages-customize' ) ) {
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
		if ( is_customize_preview() ) {
			wp_enqueue_script( 'jquery-ui-slider' );
		}

	}

}
