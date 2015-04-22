<?php
/**
 * Admin fields output class.
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
 * @class Cover_Pages_Customizer_Fields
 * @package    Cover_Pages
 * @subpackage Cover_Pages/admin
 * @author     Your Name <email@example.com>
 */
class Cover_Pages_Customizer_Fields {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

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
	 * @since    1.0.0
	 *
	 * @param    string $plugin_name The name of this plugin.
	 * @param    string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->get_fields();

	}

	/**
	 * Sets the fields the render in customizer
	 *
	 * @since	1.0.0
	 */
	public function get_fields() {

		global $coverpages_customization_api_fields;

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
	 * Sets the fields for the cusmtomizer
	 *
	 * @since	1.0.0
	 * @param object $wp_customize WP_Customizer
	 * @param array $sections Sections and thier fields
	 */
	public function customizer_fields( $wp_customize, $sections ){

		foreach ( $sections as $sec => $fields ) {

			$wp_customize->add_section(
				$this->get_sec_id( $sec ),
				array(
					'title'     => $sec,
					'priority'  => 999,
				)
			);

			foreach ( $fields as $f ){

				$id = $this->get_field_id( $f['id'] );

				//Arguments to pass
				$args = array(
					'section'  => $this->get_sec_id( $sec ),
					'label'    => $f['label'],
					'settings' => $id,

				);

				$default = '';
				if ( isset( $f['default'] ) ) {
					$default = $f['default'];
				}

				//Add Setting
				$wp_customize->add_setting(
					$id,
					array(
						'type'   => 'option',
						'default'   => $default,
						'transport' => 'refresh',
					)
				);

				//For Translation
				$f['label'] = esc_html__( $f['label'], 'cover-pages' );

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
		if ( in_array( $f['type'], array( 'color', 'slider', 'image', ) ) ) {

			$this->cool_fields( $wp_customize, $f['type'], $id, $args );
			return;

		}

		//Setting type
		$args['type'] = $f['type'];

		if ( 'font' == $f['type'] ) {

			$args['choices'] = $this->get_fonts();
			$args['type'] = 'select';

		} elseif ( in_array( $f['type'], array( 'radio', 'select', ) ) ) {

			$args['choices'] = empty( $f['choices'] ) ? array() : $f['choices'];

		}

		$wp_customize->add_control(
			$id,
			$args
		);

	}

	/**
	 * Array of fonts for font controls
	 *
	 * @since	1.0.0
	 * @return array Fonts
	 */
	public function cool_fields( $wp_customize, $type, $id, $args ){
		$field_class = '';
		switch ( $type ) {

			case 'color':
				$field_class .= 'WP_Customize_Color_Control';
				break;

			case 'slider':
				$field_class .= 'Cover_Page_Slider_Customize_Control';
				break;

			case 'image':
				$field_class .= 'WP_Customize_Image_Control';
				break;
		}
		if ( '' != $field_class ){
			$wp_customize->add_control(
				new $field_class(
					$wp_customize,
					$id,
					$args
				)
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
			'courier'   => 'Courier New',
		);
	}

}