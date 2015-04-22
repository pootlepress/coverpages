<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cover_Pages
 * @subpackage Cover_Pages/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Cover_Pages
 * @subpackage Cover_Pages/includes
 * @author     Your Name <email@example.com>
 */
class Cover_Pages {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Cover_Pages_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'cover-pages';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Cover_Pages_Loader. Orchestrates the hooks of the plugin.
	 * - Cover_Pages_i18n. Defines internationalization functionality.
	 * - Cover_Pages_Admin. Defines all hooks for the admin area.
	 * - Cover_Pages_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		foreach ( $this->dependencies() as $dep ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . $dep;
		}

		$this->loader = new Cover_Pages_Loader();

	}

	/**
	 * Returns array of following files to include
	 *
	 * - Cover_Pages_Loader. Orchestrates the hooks of the plugin.
	 * - Cover_Pages_i18n. Defines internationalization functionality.
	 * - Cover_Pages_Admin. Defines all hooks for the admin area.
	 * - Cover_Pages_Public. Defines all hooks for the public side of the site.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function dependencies(){
		return array(
			/**
			 * The class responsible for orchestrating the actions and filters of the
			 * core plugin.
			 */
			'includes/class-cover-pages-loader.php',
			/**
			 * The class responsible for defining internationalization functionality
			 * of the plugin.
			 */
			'includes/class-cover-pages-i18n.php',
			/**
			 * The class responsible for defining all actions that occur in the admin area.
			 */
			'admin/class-cover-pages-admin.php',
			/**
			 * The class responsible for defining all actions that occur in the public-facing
			 * side of the site.
			 */
			'public/class-cover-pages-public.php',
		);
	}
	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Cover_Pages_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Cover_Pages_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Cover_Pages_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'settings' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'pages' );
		$this->loader->add_filter( 'admin_body_class', $plugin_admin, 'admin_body_class' );
		$this->loader->add_action( 'customize_controls_print_styles', $plugin_admin, 'customize_styles' );
		add_action( 'customize_register', 'cover_pages_customizer_classes', 0 );
		//We need to call our action at 0 so that it can remove all other actions
		$this->loader->add_action( 'customize_register', $plugin_admin, 'customizer', 1 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Cover_Pages_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter( 'template_include', $plugin_public, 'home' );
		$this->loader->add_action( 'cover_pages_head', $plugin_public, 'options_css' );
		add_action( 'cover_pages_footer', 'wp_admin_bar_render', 1000 );
		add_action( 'cover_pages_footer', 'wp_print_footer_scripts', 20 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Cover_Pages_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
