<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      	1.0.1
 * @package 	Steemit-Scroller
 * @subpackage 	Steemit-Scroller/includes
 */
 
class Steemit_Scroller {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.1
	 * @access   protected
	 * @var      Steemit_Scroller_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.1
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.1
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
	 * @since    1.0.1
	 */
	public function __construct() {

		$this->plugin_name = 'steemit-scroller';
		$this->version = '1.0.1';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_metabox_hooks();
		
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Steemit_Scroller_Loader. Orchestrates the hooks of the plugin.
	 * - Steemit_Scroller_i18n. Defines internationalization functionality.
	 * - Steemit_Scroller_Admin. Defines all hooks for the admin area.
	 * - Steemit_Scroller_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.1
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-steemit-scroller-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-steemit-scroller-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-steemit-scroller-admin.php';
		
		/**
		 * The class responsible for defining all actions relating to metaboxes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-steemit-scroller-admin-metaboxes.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-steemit-scroller-public.php';
		
		/**
		 * The class responsible for sanitizing user input
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-steemit-scroller-sanitize.php';
		
		/**
		 * The class that contains all utilities functions
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-steemit-scroller-utilities.php';
				
		/**
		 * The class that contains all data source functions
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-steemit-scroller-data.php';
		
		/**
		 * The class that controls all front-end javascript operations
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-steemit-scroller-javascript.php';

		$this->loader = new Steemit_Scroller_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Steemit_Scroller_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.1
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Steemit_Scroller_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Steemit_Scroller_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		// Add admin menu
		$this->loader->add_action( 'init', $plugin_admin, 'steemitscroller_register_post_type' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu' );
		
		// Add shortcode column
		$this->loader->add_filter( 'manage_steemitscroller_posts_columns' , $plugin_admin, 'steemitscroller_add_shortcode_column' );
		$this->loader->add_action( 'manage_steemitscroller_posts_custom_column' , $plugin_admin, 'steemitscroller_posts_shortcode_display', 10, 2 );
		
		// Add settings
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_sections' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_fields' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Steemit_Scroller_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		// Handle ajax requests (wp_ajax_*action*)
		// Load items
		$this->loader->add_action( 'wp_ajax_scroller_create_items', $plugin_public, 'scroller_create_items' );
		$this->loader->add_action( 'wp_ajax_nopriv_scroller_create_items', $plugin_public, 'scroller_create_items' );
		
		// Load filters
		$this->loader->add_action( 'wp_ajax_scroller_create_filters', $plugin_public, 'scroller_create_filters' );
		$this->loader->add_action( 'wp_ajax_nopriv_scroller_create_filters', $plugin_public, 'scroller_create_filters' );
	}
	
	/**
	 * Register all of the hooks related to metaboxes.
	 *
	 * @since 		1.0.1
	 * @access 		private
	 */
	private function define_metabox_hooks() {

		$plugin_metaboxes = new Steemit_Scroller_Admin_Metaboxes( $this->get_plugin_name(), $this->get_version() );
		
		/* Fire our meta box setup function on the post editor screen. */
		// Scroller
		$this->loader->add_action( 'load-post.php', $plugin_metaboxes, 'steemitscroller_post_meta_boxes_setup' );
		$this->loader->add_action( 'load-post-new.php', $plugin_metaboxes, 'steemitscroller_post_meta_boxes_setup' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.1
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.1
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.1
	 * @return    Steemit_Scroller_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.1
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	
}
