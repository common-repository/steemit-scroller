<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @since      	1.0.1
 * @package 	Steemit-Scroller
 * @subpackage 	Steemit-Scroller/public
 */
 
class Steemit_Scroller_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.1
	 * @param    string    $plugin_name       The name of the plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version; 
		
		// Add shortcode
		add_shortcode( 'steemitscroller', array( $this, 'steemitscroller_display' ) );
	
	}
	
	/**
	 * Display the scroller.
	 *
	 * @since    1.0.1
	 */
	public function steemitscroller_display($atts, $content = null ) {

		// Get scroller data
		$atts = shortcode_atts(array('id' => ""), $atts, 'steemitscroller');
		$scroller_id = $atts['id'];
		$scroller_options = get_post_meta( $scroller_id, '', false );
		$steemitscroller_id = 'steemitscroller-'.$scroller_id;
		$steemitscroller_wrapper_id = 'steemitscroller-wrapper-'.$scroller_id;

		// Start inline css
		$custom_css = '';
					
		// Font awesome
		if ($scroller_options['scroller-font-awesome'][0] == 'yes')
		{
			wp_enqueue_style( $this->plugin_name.'_fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
		}
							
		// Check if we have a username
		if (!isset($scroller_options['scroller-author'][0]) || !$scroller_options['scroller-author'][0])
		{
			$html = '<div class="mn_steem_scroller_error"><p>'.__('Please enter a username on the Steemit Scroller plugin Settings page.', 'steemit-scroller' ).'</p></div>';
		}
		else
		{
			// Javascript operations
			$javascript = new Steemit_Scroller_Javascript();
			$html = $javascript->getMainScript($scroller_id);
			
			// Start html
			$html .= '<div id="'.$steemitscroller_wrapper_id.'" class="steemitscroller-wrapper '.$scroller_options['scroller-class'][0].'">';
														
				// Scroller display
				$html .= $this->scroller_create_items_wrapper($atts);
			
			$html .= '</div>';
				
			// Add inline css
			wp_enqueue_style( $this->plugin_name.'_custom_style', plugin_dir_url( __FILE__ ) . 'css/steemit-scroller-public-custom.css', array(), $this->version, 'all' );
			wp_add_inline_style( $this->plugin_name.'_custom_style', $custom_css );
		}
				
		return $html;
	}	
		
	/**
	 * Creates the items wrapper.
	 *
	 * @since    1.0.1
	 */
	public function scroller_create_items_wrapper($atts) {

		// Get scroller data
		$atts = shortcode_atts(array('id' => ""), $atts, 'steemitscroller');
		$scroller_id = $atts['id'];
		$scroller_options = get_post_meta( $scroller_id, '', false );
		$steemitscroller_id = 'steemitscroller-'.$scroller_id;

		// Create items wrapper
		$html = '<div id="'.$steemitscroller_id.'" class="owl-carousel owl-theme ssc ssc-'.$scroller_options['scroller-layout'][0].'">';
		
			// Load items
			$html .= $this->scroller_create_items($atts);
		
		$html .= '</div>';
				
		return $html;
	}
	
	/**
	 * Creates the items.
	 *
	 * @since    1.0.1
	 */
	public function scroller_create_items($atts) {
	
		// Get ajax variables
		$safe_ajax = (int)$_POST['ajax'];
		if ($safe_ajax == '1')
		{
			$ajax = true;	
		}
		else
		{
			$ajax = false;	
		}

		if ($ajax)
		{
			$scroller_id = (int)$_POST['scrollerid'];
			$permlink = false;
			$page = (int)$_POST['page'];
		}
		else
		{
			$atts = shortcode_atts(array('id' => ""), $atts, 'steemitscroller');
			$scroller_id = $atts['id'];
			$permlink = false;
			$page = false;
		}
		$scroller_options = get_post_meta( $scroller_id, '', false );
		$utilities = new Steemit_Scroller_Utilities();
		$dataSource = new Steemit_Scroller_Data();
	
		// Referral code
		$referral_code = $scroller_options['scroller-referral'][0] ? '?r='.$scroller_options['scroller-referral'][0] : '';
			
		// Images
		$scroller_show_images = $scroller_options['scroller-show-images'][0];
		$scroller_image_size = $scroller_options['scroller-image-size'][0];
		$scroller_fallback_image = $scroller_options['scroller-fallback-image'][0];	
		$scroller_hover_box = $scroller_options['scroller-hover-box'][0];	
		$scroller_hover_link = $scroller_options['scroller-hover-link'][0];	
		$scroller_hover_lightbox = $scroller_options['scroller-hover-lightbox'][0];	
		
		// Detail box options
		$scroller_title_limit = $scroller_options['scroller-title-limit'][0];
		$scroller_introtext_limit = $scroller_options['scroller-introtext-limit'][0];
		$scroller_date_format = $scroller_options['scroller-date-format'][0];

		$this->detailBox = $scroller_options['scroller-detail-box'][0];
		$this->detailBoxTitle = $scroller_options['scroller-item-title'][0];
		$this->detailBoxIntrotext = $scroller_options['scroller-item-introtext'][0];
		$this->detailBoxDate = $scroller_options['scroller-item-date'][0];
		$this->detailBoxCategory = $scroller_options['scroller-item-category'][0];
		$this->detailBoxTags = $scroller_options['scroller-item-tags'][0];
		$this->detailBoxAuthor = $scroller_options['scroller-item-author'][0];
		$this->detailBoxAuthorRep = $scroller_options['scroller-item-author-rep'][0];
		$this->detailBoxReward = $scroller_options['scroller-item-reward'][0];
		$this->detailBoxVotes = $scroller_options['scroller-item-votes'][0];
		$this->detailBoxComments = $scroller_options['scroller-item-comments-count'][0];
	
		// Query items
		$queryItems = $dataSource->scroller_query_items($scroller_options, $ajax, $permlink, $page);

		foreach ($queryItems as $key => $item) 
		{
			// Strip slashes		
			$item->title = trim(stripslashes( $item->title ));
			$item->body  = trim(stripslashes( $item->body ));
			
			// Trim title
			$item->short_title = wp_trim_words( $item->title, (int)$scroller_title_limit);
			
			// Trim body
			$item->short_body = wp_trim_words( $item->body, (int)$scroller_introtext_limit);
			
			// Format date
			$item->formatted_date = $utilities->ssc_time_since($item->created);
			
			// Author reputation
			$item->author_reputation = $utilities->ssc_format_reputation($item->author_reputation);
			
			// Reward
			$total_payout_value = round((float)$item->total_payout_value, 2);
			$curator_payout_value = round((float)$item->curator_payout_value, 2);
			$pending_payout_value = round((float)$item->pending_payout_value, 2);
			$total_pending_payout_value = round((float)$item->total_pending_payout_value, 2);
			$item->total_reward = number_format(round(($total_payout_value + $curator_payout_value + $pending_payout_value + $total_pending_payout_value), 2), 2);
			
			// Votes
			$item->votes = $item->net_votes;
			
			// Replies count
			$item->replies_count = $utilities->ssc_replies_count($item->author, $item->permlink);
			
			// Metadata
			$metadata = json_decode($item->json_metadata, false);
		
			// Tags
			$item->tags = $metadata->tags;
			array_shift($item->tags);
			
			// Image
			if (isset($metadata->image))
			{
				$raw_image = $metadata->image;
				if (array_key_exists('0', $raw_image))
				{
					$item->image = 'https://steemitimages.com/'.$scroller_image_size.'/'.$raw_image[0];
				}
			}
			else
			{
				if ($scroller_fallback_image)
				{
					$item->image = $scroller_fallback_image;
				}
			}
												
			$items[] = $item;
		}

		// Get scroller from file
		ob_start();
			include( plugin_dir_path( __FILE__ ) . 'partials/steemit-scroller-public-items.php' );		
			$items = ob_get_clean();		
		
		if ($ajax) {
			echo $items;
			wp_die();
		} else {
			return $items;	
		}
	}
				
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.1
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/steemit-scroller-public.css', array(), $this->version, 'all' );
		
		// Lightbox
		wp_enqueue_style( $this->plugin_name.'_lb', plugin_dir_url( __FILE__ ) . 'lightbox/lightbox.min.css', array(), $this->version, 'all' );

		// Owl
		wp_enqueue_style( $this->plugin_name.'_owl', plugin_dir_url( __FILE__ ) . 'css/owl.carousel.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'_owltheme', plugin_dir_url( __FILE__ ) . 'css/owl.theme.default.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.1
	 */
	public function enqueue_scripts() {
		
		// Spinner
		wp_enqueue_script( $this->plugin_name.'_spin', plugin_dir_url( __FILE__ ) . 'js/spin.min.js', array( 'jquery' ), $this->version, false );
		
		// Lightbox
		wp_enqueue_script( $this->plugin_name.'_lb', plugin_dir_url( __FILE__ ) . 'lightbox/lightbox.min.js', array( 'jquery' ), $this->version, false );
		
		// Owl
		wp_enqueue_script( $this->plugin_name.'_owl', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.min.js', array( 'jquery' ), $this->version, false );

	}

}
