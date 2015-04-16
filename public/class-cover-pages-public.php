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
	 * Outputs CSS from Options
	 */
	public function options_css(){
		
		//Getting all the options
		$bg_img = get_option("cover-pages-bg-image");
		$bg_color = get_option("cover-pages-bg-color");
		$bg_opacity = get_option("cover-pages-bg-opacity");
		$ttl_font = get_option("cover-pages-title-font");
		$ttl_size = get_option("cover-pages-title-size");
		$ttl_color = get_option("cover-pages-title-color");
		$tg_font = get_option("cover-pages-tag-font");
		$tg_size = get_option("cover-pages-tag-size");
		$tg_color = get_option("cover-pages-tag-color");
		$txt_font = get_option("cover-pages-text-font");
		$txt_size = get_option("cover-pages-text-size");
		$txt_color = get_option("cover-pages-text-color");
		$b1_display = get_option("cover-pages-button1-display");
		$b1_brad = get_option("cover-pages-button1-bradius");
		$b1_color = get_option("cover-pages-button1-color");
		$b1_size = get_option("cover-pages-button1-size");
		$b2_display = get_option("cover-pages-button2-display");
		$b2_brad = get_option("cover-pages-button2-bradius");
		$b2_color = get_option("cover-pages-button2-color");
		$b2_size = get_option("cover-pages-button2-size");

		//Init CSS fpr output
		$css = "";

		$css .="#image-wrap{\n";

		if($bg_img){
			$css .= " background-image: url({$bg_img});\n";
		}
		if($bg_color){
			$css .= " background-color: {$bg_color};\n";
		}

		$css .="\n}\n";
		$css .="#wrap{\n";

		if($bg_opacity){
			$a = $bg_opacity/100;
			list($r, $g, $b) = sscanf($bg_color, "#%02x%02x%02x");
			$css .= " background-color: rgba( {$r}, {$g}, {$b}, {$a} );\n";
		}

		$css .="\n}\n";
		$css .="#title{\n";

		if($ttl_font){
			$css .= " font-family:{$ttl_font};\n";
		}
		if($ttl_size){
			$css .= " font-size:{$ttl_size}px;\n";
		}
		if($ttl_color){
			$css .= " color:{$ttl_color};\n";
		}

		$css .="\n}\n";
		$css .="#tagline{\n";

		if($tg_font){
			$css .= " font-family:{$tg_font};\n";
		}
		if($tg_size){
			$css .= " font-size:{$tg_size}px;\n";
		}
		if($tg_color){
			$css .= " color:{$tg_color};\n";
		}

		$css .="\n}\n";
		$css .="#text{\n";

		if($txt_font){
			$css .= " font-family:{$txt_font};\n";
		}
		if($txt_size){
			$css .= " font-size:{$txt_size}px;\n";
		}
		if($txt_color){
			$css .= " color:{$txt_color};\n";
		}

		$css .="\n}\n";
		$css .="#button1{\n";

		if(!$b1_display){
			$css .= " display:none; ";
		}
		if($b1_brad){
			$css .= " -webkit-border-radius:{$b1_brad}px;\n";
			$css .= " border-radius:{$b1_brad}px;\n";
		}
		if($b1_color){
			$css .= " background-color:{$b1_color};\n";
		}
		if($b1_size){
			$css .= " width:{$b1_size}px;\n";
		}

		$css .="\n}\n";
		$css .="#button2{\n";

		if($b2_display){
			$css .= "  ";
		}
		if($b2_brad){
			$css .= " -webkit-border-radius:{$b2_brad}px;\n";
			$css .= " border-radius:{$b2_brad}px;\n";
		}
		if($b2_color){
			$css .= " background-color:{$b2_color};\n";
		}
		if($b2_size){
			$css .= " width:{$b2_size}px;\n";
		}

		$css .="\n}\n";
		
		echo "<style id='cover-page-option-styles'>{$css}</style>";

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

		if( ( get_option('cover-pages-activate') || isset( $_GET['coverpages-customize'] ) ) && is_front_page() ){
			$template = plugin_dir_path( __FILE__ ) . '/partials/cover-pages-public-display.php';
		}
		
		return $template;

	}

}
