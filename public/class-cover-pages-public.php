<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cover_Pages
 * @subpackage Cover_Pages/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cover_Pages
 * @subpackage Cover_Pages/public
 * @author     Your Name <email@example.com>
 */
class Cover_Pages_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cover-pages-public.css', array(), $this->version );

	}

	/**
	 * Gets the settings from options
	 * @since    1.0.0
	 */
	public function get_options(){
		$b1 = get_option( 'cover-pages-button1' );
		$b2 = get_option( 'cover-pages-button2' );

		return array(
			'bg' => array(
				'img' => get_option( 'cover-pages-bg-image', '' ),
				'color' => get_option( 'cover-pages-bg-color', '' ),
				'opacity' => get_option( 'cover-pages-bg-opacity', '' ),
			),
			'title' => array(
				'font' => get_option( 'cover-pages-title-font', '' ),
				'size' => get_option( 'cover-pages-title-size', '' ),
				'color' => get_option( 'cover-pages-title-color', '' ),
			),
			'tagline' => array(
				'font' => get_option( 'cover-pages-tag-font', '' ),
				'size' => get_option( 'cover-pages-tag-size', '' ),
				'color' => get_option( 'cover-pages-tag-color', '' ),
			),
			'text' => array(
				'font' => get_option( 'cover-pages-text-font', '' ),
				'size' => get_option( 'cover-pages-text-size', '' ),
				'color' => get_option( 'cover-pages-text-color', '' ),
			),
			'button1' => array(
				'display' => ! empty( $b1['display'] ),
				'brad' => $b1['bradius'],
				'color' => $b1['color'],
				'size' => $b1['size'],
			),
			'button2' => array(
				'display' => ! empty( $b2['display'] ),
				'brad' => $b2['bradius'],
				'color' => $b2['color'],
				'size' => $b2['size'],
			),
		);
	}

	/**
	 * Outputs CSS from Options
	 * @since    1.0.0
	 */
	public function options_css() {

		//Getting all the options
		$settings = $this->get_options();

		$css = $this->bg_css( $settings['bg'] );
		$css .= $this->typo_css( $settings['title'], 'title' );
		$css .= $this->typo_css( $settings['tagline'], 'tagline' );
		$css .= $this->typo_css( $settings['text'], 'text' );
		$css .= $this->button_css( $settings['button1'], 'button1' );
		$css .= $this->button_css( $settings['button2'], 'button2' );

		echo "<style id='cover-page-option-styles'>" . esc_html( $css ) . '</style>';

	}

	/**
	 * Outputs CSS for background options
	 * @since    1.0.0
	 */
	public function bg_css( $settings ) {

		$css = "#image-wrap{\n";

		if ( $settings['img'] ) {
			$css .= " background-image: url({$settings['img']} );\n";
		}
		if ( $settings['color'] ) {
			$css .= " background-color: {$settings['color']};\n";
		}

		$css .= "\n}\n";
		$css .= "#wrap{\n";

		if ( $settings['opacity'] ) {
			$a = $settings['opacity'] / 100;
			list($r, $g, $b) = sscanf( $settings['color'], '#%02x%02x%02x' );
			$css .= " background-color: rgba( {$r}, {$g}, {$b}, {$a} );\n";
		}

		$css .= "\n}\n";

		return $css;

	}

	/**
	 * Outputs typography CSS from Options
	 * @since    1.0.0
	 *
	 * @param array $settings Section settings
	 * @param string $element Id of element to apply styles to
	 *
	 * @return string
	 */
	public function typo_css( $settings, $element = 'title' ) {

		$css = "#{$element}{\n";

		if ( $settings['font'] ) {
			$css .= " font-family:{$settings['font']};\n";
		}
		if ( $settings['size'] ) {
			$css .= " font-size:{$settings['size']}px;\n";
		}
		if ( $settings['color'] ) {
			$css .= " color:{$settings['color']};\n";
		}

		$css .= "\n}\n";

		return $css;

	}

	/**
	 * Outputs CSS from Options
	 * @since    1.0.0
	 *
	 * @param array $settings Section settings
	 * @param string $button Name of button
	 *
	 * @return string
	 */
	public function button_css( $settings, $button = 'button1' ) {

		$css = "#{$button}{\n";

		if ( ! $settings['display'] ) {
			$css .= ' display:none; ';
		}
		if ( $settings['brad'] ) {
			$css .= " -webkit-border-radius:{$settings['brad']}px;\n";
			$css .= " border-radius:{$settings['brad']}px;\n";
		}
		if ( $settings['color'] ) {
			$css .= " background-color:{$settings['color']};\n";
		}
		if ( $settings['size'] ) {
			$css .= " width:{$settings['size']}px;\n";
		}

		$css .= "\n}\n";

		return $css;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cover-pages-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Home page if activated.
	 *
	 * @since    1.0.0
	 */
	public function home($template) {

		if ( ( get_option( 'cover-pages-activate' ) || isset( $_GET['coverpages-customize'] ) ) && is_front_page() ) {
			$template = plugin_dir_path( __FILE__ ) . '/partials/cover-pages-public-display.php';
		}
		
		return $template;

	}

}
