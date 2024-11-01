<?php
/**
 * The metabox-specific functionality of the plugin.
 *
 * @since      	1.0.1
 * @package 	Steemit-Scroller
 * @subpackage 	Steemit-Scroller/admin
 */
 
class Steemit_Scroller_Admin_Metaboxes {
		
	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.1
	 * @access 		private
	 * @var 		string 			$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;
	
	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.1
	 * @access 		private
	 * @var 		string 			$version 			The current version of this plugin.
	 */
	private $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.1
	 * @param 		string 			$plugin_name 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

	}
	
	/**
	 * Includes the JavaScript necessary to control the toggling of the tabs in the
	 * meta box that's represented by this class.
	 *
	 * @since    1.0.1
	 */
	public function enqueue_admin_scripts() {
	 
		if ( 'steemitscroller' === get_current_screen()->id ) {
	 
			wp_enqueue_script(
				$this->plugin_name . '-tabs',
				plugins_url( 'steemit-scroller/admin/js/steemit-scroller-admin-tabs.js' ),
				array( 'jquery' ),
				$this->version
			);
	 
		}
	 
	}
	
	/**
	 * Meta box setup function for Scroller.
	 *
	 * @since 	1.0.1
	 */
	public function steemitscroller_post_meta_boxes_setup() {
	
		/* Add meta boxes on the 'add_meta_boxes' hook. */
		add_action( 'add_meta_boxes', array( $this, 'steemitscroller_add_scroller_options' ) );
		
		/* Save post meta on the 'save_post' hook. */
		add_action( 'save_post', array( $this, 'steemitscroller_save_post_meta' ) );

	}	
		
	/**
	 * Create one or more meta boxes to be displayed on the post editor screen - Scroller
	 *
	 * @since 	1.0.1
	 */
	public function steemitscroller_add_scroller_options() {
	
		add_meta_box(
			'steemit_scroller_scroller_options', 
			apply_filters( $this->plugin_name . '-metabox-title-scroller-options', esc_html__( 'Scroller Options', 'steemit-scroller' ) ),
			array( $this, 'steemitscroller_metabox'),						
			'steemitscroller', // post type												
			'normal',											
			'default',
			array(
				'file' => 'scroller-options'
			)								
		);
		
	}
	
	/**
	 * Calls a metabox file specified in the add_meta_box args - Scroller
	 *
	 * @since 	1.0.1
	 * @return 	void
	 */
	public function steemitscroller_metabox( $post, $params ) {

		if ( ! is_admin() ) { return; }
		if ( 'steemitscroller' !== $post->post_type ) { return; }

		if ( ! empty( $params['args']['classes'] ) ) {

			$classes = 'repeater ' . $params['args']['classes'];

		}
		
		include( plugin_dir_path( __FILE__ ) . 'partials/steemit-scroller-admin-metabox-' . $params['args']['file'] . '-navigation.php' );
		include( plugin_dir_path( __FILE__ ) . 'partials/steemit-scroller-admin-metabox-' . $params['args']['file'] . '.php' );

	}
	
	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.1
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted, $scroller_type ) {

		$nonces 		= array();
		$nonce_check 	= 0;

		$nonces[] 		= $scroller_type.'_options';

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], $this->plugin_name ) ) { $nonce_check++; }

		}

		return $nonce_check;

	}

	/**
	 * Returns an array of the all the metabox fields and their respective types - Scroller
	 *
	 * @since 		1.0.1
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function get_scroller_metabox_fields() {

		$fields = array();
		
		// General settings
		$fields[] = array( 'scroller-class', 'text' );
		$fields[] = array( 'scroller-referral', 'text' );
		$fields[] = array( 'scroller-font-awesome', 'select' );
		
		// Data source
		$fields[] = array( 'scroller-initial-items', 'text' );
		$fields[] = array( 'scroller-author', 'text' );
		$fields[] = array( 'scroller-tags-include', 'textarea' );
		$fields[] = array( 'scroller-tags-exclude', 'textarea' );
		$fields[] = array( 'scroller-posts-exclude', 'textarea' );
		
		// Layout
		$fields[] = array( 'scroller-layout', 'select' );
		$fields[] = array( 'scroller-items-spacing', 'text' );
		
		// Image settings
		$fields[] = array( 'scroller-show-images', 'radio' );
		$fields[] = array( 'scroller-image-size', 'radio' );
		$fields[] = array( 'scroller-fallback-image', 'text' );	
		$fields[] = array( 'scroller-hover-box', 'radio' );	
		$fields[] = array( 'scroller-hover-link', 'radio' );	
		$fields[] = array( 'scroller-hover-lightbox', 'radio' );	
		
		// Detail box
		$fields[] = array( 'scroller-item-title', 'radio' );
		$fields[] = array( 'scroller-title-limit', 'text' );
		$fields[] = array( 'scroller-item-introtext', 'radio' );
		$fields[] = array( 'scroller-introtext-limit', 'text' );
		$fields[] = array( 'scroller-item-date', 'radio' );
		$fields[] = array( 'scroller-item-category', 'radio' );
		$fields[] = array( 'scroller-item-tags', 'radio' );
		$fields[] = array( 'scroller-item-author', 'radio' );
		$fields[] = array( 'scroller-item-author-rep', 'radio' );
		$fields[] = array( 'scroller-item-reward', 'radio' );
		$fields[] = array( 'scroller-item-votes', 'radio' );
		$fields[] = array( 'scroller-item-comments-count', 'radio' );
										
		// Navigation
		$fields[] = array( 'scroller-nav-arrows', 'radio' );
		$fields[] = array( 'scroller-page-dots', 'radio' );
		$fields[] = array( 'scroller-drag-scroll', 'radio' );
		$fields[] = array( 'scroller-rewind', 'radio' );
		$fields[] = array( 'scroller-infinite-loop', 'radio' );
		$fields[] = array( 'scroller-center-items', 'radio' );
		$fields[] = array( 'scroller-rtl', 'radio' );
		
		// Effects
		$fields[] = array( 'scroller-nav-speed', 'text' );	
		$fields[] = array( 'scroller-dots-speed', 'text' );	
		$fields[] = array( 'scroller-autoplay', 'radio' );	
		$fields[] = array( 'scroller-autoplay-speed', 'text' );	
		$fields[] = array( 'scroller-stop-on-hover', 'radio' );	
		$fields[] = array( 'scroller-autoheight', 'radio' );	
		
		// Responsive levels
		$fields[] = array( 'scroller-responsive', 'radio' );	
		$fields[] = array( 'scroller-lg-items', 'select' );
		$fields[] = array( 'scroller-lg-size', 'text' );
		$fields[] = array( 'scroller-md-items', 'select' );
		$fields[] = array( 'scroller-ms-size', 'text' );
		$fields[] = array( 'scroller-sm-items', 'select' );
		$fields[] = array( 'scroller-sm-size', 'text' );
		$fields[] = array( 'scroller-xs-items', 'select' );
		$fields[] = array( 'scroller-xs-size', 'text' );
		$fields[] = array( 'scroller-xxs-items', 'select' );
						
		return $fields;

	}
	
	/**
	 * Sanitizes input.
	 *
	 * @since 		1.0.1
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function sanitizer( $type, $data ) {

		if ( empty( $type ) ) { return; }
		if ( empty( $data ) ) { return; }

		$return 	= '';
		$sanitizer 	= new Steemit_Scroller_Sanitize();

		$sanitizer->set_data( $data );
		$sanitizer->set_type( $type );

		$return = $sanitizer->clean();

		unset( $sanitizer );

		return $return;

	}
	
	/**
	 * Saves metabox data - Scroller
	 *
	 * @since 	1.0.1
	 * @access 	public
	 * @param 	int 		$post_id 		The post ID
	 * @param 	object 		$object 		The post object
	 * @return 	void
	 */
	public function steemitscroller_save_post_meta( $post_id, $object = null) {

		//wp_die( '<pre>' . print_r( $_POST ) . '</pre>' );

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		
		$safe_post_type = $this->sanitizer( 'text', $_POST['post_type'] );
		if ( $safe_post_type !== 'steemitscroller' ) { return $post_id; }

		$nonce_check = $this->check_nonces( $_POST, $scroller_type = 'scroller' );

		if ( 0 < $nonce_check ) { return $post_id; }

		$metas = $this->get_scroller_metabox_fields();

		foreach ( $metas as $meta ) {

			$name = $this->sanitizer( 'text', $meta[0] );
			$type = $meta[1];
			
			if (is_array($_POST[$name])) {
				$new_value = $this->sanitizer( 'array', $_POST[$name] );
			} else {
				$new_value = $this->sanitizer( $type, $_POST[$name] );
			}

			update_post_meta( $post_id, $name, $new_value );

		} // foreach

	}
	
}
