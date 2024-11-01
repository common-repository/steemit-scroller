<?php
/**
 * Provide the view for a metabox
 *
 * @since      	1.0.1
 * @package 	Steemit-Scroller
 * @subpackage 	Steemit-Scroller/admin/partials
 */

wp_nonce_field( $this->plugin_name, 'scroller_options' );

$post_id = get_the_ID();

?>
<div id="steemitscroller-admin-metabox-options">
<?php

	// General settings ?>
	<div id="steemitscroller-admin-metabox-general-settings" class="inside">
	<table class="form-table">
	<tbody>
	<?php
	
		// Grid class - General settings
		$atts 					= array();
		$atts['description'] 	= 'An optional class to be applied to the scroller container.';
		$atts['id'] 			= 'scroller-class';
		$atts['label'] 			= 'Scroller class';
		$atts['name'] 			= 'scroller-class';
		$atts['placeholder'] 	= '';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
		// Referral username - General settings
		$atts 					= array();
		$atts['description'] 	= '(Beta) Adds a referral username to posts urls.';
		$atts['id'] 			= 'scroller-referral';
		$atts['label'] 			= 'Referral username';
		$atts['name'] 			= 'scroller-referral';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
						
		// Load FontAwesome - General settings
		$atts 					= array();
		$atts['description'] 	= 'Disable if you are already using the FontAwesome library in your template.';
		$atts['id'] 			= 'scroller-font-awesome';
		$atts['label'] 			= 'Load FontAwesome';
		$atts['name'] 			= 'scroller-font-awesome';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'yes';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
			
	?>
	</tbody>
	</table>
	</div>
	<?php 

	// Data source ?>
	<div id="steemitscroller-admin-metabox-data-source" class="inside hidden">
			
		<?php
		// Dynamic source ?>
		<div id="steemitscroller-admin-metabox-data-source-dynamic" class="">
		
			<?php
			// Items type: Posts ?>
			<div id="steemitscroller-admin-metabox-data-source-posts" class="">
			<table class="form-table">
			<tbody>
			<?php
				
				// Posts count - Pagination
				$atts 					= array();
				$atts['description'] 	= 'The amount of posts to be displayed in the scroller.';
				$atts['id'] 			= 'scroller-initial-items';
				$atts['label'] 			= 'Posts count';
				$atts['name'] 			= 'scroller-initial-items';
				$atts['placeholder'] 	= '';
				$atts['type'] 			= 'text';
				$atts['value'] 			= '5';
				
				if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
					$atts['value'] = get_post_meta($post_id, $atts['id'], true);
				}
				
				apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
				
				?><tr><?php
				include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
				?></tr><?php
									
				// Authors - Data source
				$atts 					= array();
				$atts['description'] 	= 'Enter a Steem author username.';
				$atts['id'] 			= 'scroller-author';
				$atts['label'] 			= 'Author';
				$atts['name'] 			= 'scroller-author'; // [] for array
				$atts['type'] 			= 'text';
				$atts['value'] 			= '';
				
				if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
					$atts['value'] = get_post_meta($post_id, $atts['id'], true);
				}
				
				apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
				
				?><tr><?php
				include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
				?></tr><?php								
								
				// Include Tags - Data source
				$atts 					= array();
				$atts['description'] 	= 'Separate tags with commas.';
				$atts['id'] 			= 'scroller-tags-include';
				$atts['label'] 			= 'Include tags';
				$atts['name'] 			= 'scroller-tags-include';
				$atts['type'] 			= 'textarea';
				$atts['cols'] 			= '50';
				$atts['rows'] 			= '4';
				$atts['value'] 			= '';
				
				if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
					$atts['value'] = get_post_meta($post_id, $atts['id'], true);
				}
				
				apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
				
				?><tr><?php
				include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-textarea.php' );
				?></tr><?php
				
				// Exclude Tags - Data source
				$atts 					= array();
				$atts['description'] 	= 'Separate tags with commas.';
				$atts['id'] 			= 'scroller-tags-exclude';
				$atts['label'] 			= 'Exclude tags';
				$atts['name'] 			= 'scroller-tags-exclude';
				$atts['type'] 			= 'textarea';
				$atts['cols'] 			= '50';
				$atts['rows'] 			= '4';
				$atts['value'] 			= '';
				
				if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
					$atts['value'] = get_post_meta($post_id, $atts['id'], true);
				}
				
				apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
				
				?><tr><?php
				include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-textarea.php' );
				?></tr><?php	
				
				// Exclude Posts - Data source
				$atts 					= array();
				$atts['description'] 	= 'Enter each post permlink on a new line.';
				$atts['id'] 			= 'scroller-posts-exclude';
				$atts['label'] 			= 'Exclude posts';
				$atts['name'] 			= 'scroller-posts-exclude';
				$atts['type'] 			= 'textarea';
				$atts['cols'] 			= '50';
				$atts['rows'] 			= '4';
				$atts['value'] 			= '';
				
				if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
					$atts['value'] = get_post_meta($post_id, $atts['id'], true);
				}
				
				apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
				
				?><tr><?php
				include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-textarea.php' );
				?></tr><?php	
								
			?>
			</tbody>
			</table>
			</div>
											
		</div>
	
	</div>
	<?php
	
	// Layout ?>
	<div id="steemitscroller-admin-metabox-layout" class="inside hidden">
	<table class="form-table">
	<tbody>
	<?php
		
		// Theme
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-layout';
		$atts['label'] 			= 'Theme';
		$atts['name'] 			= 'scroller-layout';
		$atts['type'] 			= 'select';
		$atts['value'] 			= 'light';
		$atts['selections']     = array(
			array(
			  'value'       => 'light',
			  'label'       => 'Light'
			),
			array(
			  'value'       => 'minimal',
			  'label'       => 'Minimal'
			),
			array(
			  'value'       => 'modern',
			  'label'       => 'Modern'
			),
			array(
			  'value'       => 'caption',
			  'label'       => 'Caption'
			),
			array(
			  'value'       => 'retro-light',
			  'label'       => 'Retro light'
			),
			array(
			  'value'       => 'retro-dark',
			  'label'       => 'Retro dark'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-select.php' );
		?></tr><?php
		
		// Items spacing - Layout settings
		$atts 					= array();
		$atts['description'] 	= 'Space around each item (in pixels).';
		$atts['id'] 			= 'scroller-items-spacing';
		$atts['label'] 			= 'Items spacing';
		$atts['name'] 			= 'scroller-items-spacing';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '10';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
	?>
	</tbody>
	</table>
	</div>
	<?php

	// Image settings ?>
	<div id="steemitscroller-admin-metabox-image-settings" class="inside hidden">
	<table class="form-table">
	<tbody>
	<?php
	
		// Show images - Image settings
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-show-images';
		$atts['label'] 			= 'Show images';
		$atts['name'] 			= 'scroller-show-images';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'yes';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Image size
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-image-size';
		$atts['label'] 			= 'Image size';
		$atts['name'] 			= 'scroller-image-size';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= '0x0';
		$atts['selections']     = array(
			array(
			  'value'       => '256x512',
			  'label'       => 'Small',			
			),
			array(
			  'value'       => '0x0',
			  'label'       => 'Large'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
					
		// Fallback image - Image settings
		$atts 					= array();
		$atts['description'] 	= 'Absolute url. The fallback image will be displayed if an item does not have an image.';
		$atts['id'] 			= 'scroller-fallback-image';
		$atts['label'] 			= 'Fallback image';
		$atts['name'] 			= 'scroller-fallback-image';
		$atts['placeholder'] 	= 'Path to image';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
		// Hover box - Image settings
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-hover-box';
		$atts['label'] 			= 'Show hover box';
		$atts['name'] 			= 'scroller-hover-box';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'yes';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Hover link icon - Image settings
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-hover-link';
		$atts['label'] 			= 'Show hover link icon';
		$atts['name'] 			= 'scroller-hover-link';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'yes';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Hover lightbox icon - Image settings
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-hover-lightbox';
		$atts['label'] 			= 'Show hover lightbox icon';
		$atts['name'] 			= 'scroller-hover-lightbox';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'yes';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
	?>
	</tbody>
	</table>
	</div>
	<?php
	
	// Detail box settings ?>
	<div id="steemitscroller-admin-metabox-detail-box" class="inside hidden">
	
		<div id="steemitscroller-admin-metabox-detail-box-general">
		<table class="form-table">
		<tbody>
		<?php
			
			// Title
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-title';
			$atts['label'] 			= 'Show title';
			$atts['name'] 			= 'scroller-item-title';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'yes';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
			
			// Title limit - Item settings
			$atts 					= array();
			$atts['description'] 	= 'Word limit for title.';
			$atts['id'] 			= 'scroller-title-limit';
			$atts['label'] 			= 'Title limit';
			$atts['name'] 			= 'scroller-title-limit';
			$atts['placeholder'] 	= '';
			$atts['type'] 			= 'text';
			$atts['value'] 			= '8';
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
			?></tr><?php
		
			// Body text
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-introtext';
			$atts['label'] 			= 'Show body text';
			$atts['name'] 			= 'scroller-item-introtext';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'yes';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
			
			// Body text limit - Item settings
			$atts 					= array();
			$atts['description'] 	= 'Word limit for body text.';
			$atts['id'] 			= 'scroller-introtext-limit';
			$atts['label'] 			= 'Body text limit';
			$atts['name'] 			= 'scroller-introtext-limit';
			$atts['placeholder'] 	= '';
			$atts['type'] 			= 'text';
			$atts['value'] 			= '15';
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
			?></tr><?php
					
			// Date
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-date';
			$atts['label'] 			= 'Show date';
			$atts['name'] 			= 'scroller-item-date';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'yes';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
									
			// Category
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-category';
			$atts['label'] 			= 'Show category';
			$atts['name'] 			= 'scroller-item-category';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'yes';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
			
			// Tags
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-tags';
			$atts['label'] 			= 'Show tags';
			$atts['name'] 			= 'scroller-item-tags';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'yes';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
						
			// Author
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-author';
			$atts['label'] 			= 'Show author';
			$atts['name'] 			= 'scroller-item-author';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'yes';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
			
			// Author reputation
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-author-rep';
			$atts['label'] 			= 'Show author reputation';
			$atts['name'] 			= 'scroller-item-author-rep';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'yes';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
			
			// Reward
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-reward';
			$atts['label'] 			= 'Show reward';
			$atts['name'] 			= 'scroller-item-reward';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'no';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
			
			// Votes
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-votes';
			$atts['label'] 			= 'Show votes';
			$atts['name'] 			= 'scroller-item-votes';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'no';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
			
			// Comments count
			$atts 					= array();
			$atts['description'] 	= '';
			$atts['id'] 			= 'scroller-item-comments-count';
			$atts['label'] 			= 'Show comments count';
			$atts['name'] 			= 'scroller-item-comments-count';
			$atts['type'] 			= 'radio';
			$atts['value'] 			= 'yes';
			$atts['selections']     = array(
				array(
				  'value'       => 'yes',
				  'label'       => 'Yes'
				),
				array(
				  'value'       => 'no',
				  'label'       => 'No'
				)
			);
			
			if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
				$atts['value'] = get_post_meta($post_id, $atts['id'], true);
			}
			
			apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
			
			?><tr><?php
			include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
			?></tr><?php
						
		?>
		</tbody>
		</table>
		</div>
		
	</div>
	<?php 
		
	// Navigation ?>
	<div id="steemitscroller-admin-metabox-navigation" class="inside hidden">
	<table class="form-table">
	<tbody>
	<?php
		
		// Navigation arrows
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-nav-arrows';
		$atts['label'] 			= 'Navigation arrows';
		$atts['name'] 			= 'scroller-nav-arrows';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'yes';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Pagination dots
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-page-dots';
		$atts['label'] 			= 'Pagination dots';
		$atts['name'] 			= 'scroller-page-dots';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'no';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Drag and Scroll
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-drag-scroll';
		$atts['label'] 			= 'Drag and Scroll';
		$atts['name'] 			= 'scroller-drag-scroll';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'yes';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Rewind to start
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-rewind';
		$atts['label'] 			= 'Rewind to start';
		$atts['name'] 			= 'scroller-rewind';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'no';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Infinite loop
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-infinite-loop';
		$atts['label'] 			= 'Infinite loop';
		$atts['name'] 			= 'scroller-infinite-loop';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'no';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Center items
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-center-items';
		$atts['label'] 			= 'Center items';
		$atts['name'] 			= 'scroller-center-items';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'no';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Right to left
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-rtl';
		$atts['label'] 			= 'Right to left';
		$atts['name'] 			= 'scroller-rtl';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'no';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
	?>
	</tbody>
	</table>
	</div>
	<?php
	
	// Effects ?>
	<div id="steemitscroller-admin-metabox-effects" class="inside hidden">
	<table class="form-table">
	<tbody>
	<?php
	
		// Navigation speed
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-nav-speed';
		$atts['label'] 			= 'Navigation speed';
		$atts['name'] 			= 'scroller-nav-speed';
		$atts['placeholder'] 	= '';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '500';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
		// Dots speed
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-dots-speed';
		$atts['label'] 			= 'Dots speed';
		$atts['name'] 			= 'scroller-dots-speed';
		$atts['placeholder'] 	= '';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '500';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
		// Autoplay
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-autoplay';
		$atts['label'] 			= 'Autoplay';
		$atts['name'] 			= 'scroller-autoplay';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'no';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Autoplay speed
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-autoplay-speed';
		$atts['label'] 			= 'Autoplay speed';
		$atts['name'] 			= 'scroller-autoplay-speed';
		$atts['placeholder'] 	= '';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '2000';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
		// Stop on hover
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-stop-on-hover';
		$atts['label'] 			= 'Stop on hover';
		$atts['name'] 			= 'scroller-stop-on-hover';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'no';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
		
		// Auto height
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-autoheight';
		$atts['label'] 			= 'Auto height';
		$atts['name'] 			= 'scroller-autoheight';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'no';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php
	
	?>
	</tbody>
	</table>
	</div>
	<?php
	
	// Responsive levels ?>
	<div id="steemitscroller-admin-metabox-responsive" class="inside hidden">
	<table class="form-table">
	<tbody>
	<?php
	
		// Responsive layout
		$atts 					= array();
		$atts['description'] 	= '';
		$atts['id'] 			= 'scroller-responsive';
		$atts['label'] 			= 'Responsive layout';
		$atts['name'] 			= 'scroller-responsive';
		$atts['type'] 			= 'radio';
		$atts['value'] 			= 'yes';
		$atts['selections']     = array(
			array(
			  'value'       => 'yes',
			  'label'       => 'Yes'
			),
			array(
			  'value'       => 'no',
			  'label'       => 'No'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-radio.php' );
		?></tr><?php	
			
		// LG items per row
		$atts 					= array();
		$atts['description'] 	= 'Items per row for Large screens.';
		$atts['id'] 			= 'scroller-lg-items';
		$atts['label'] 			= 'LG items per row';
		$atts['name'] 			= 'scroller-lg-items';
		$atts['type'] 			= 'select';
		$atts['value'] 			= '4';
		$atts['selections']     = array(
			array(
			  'value'       => '1',
			  'label'       => '1'
			),
			array(
			  'value'       => '2',
			  'label'       => '2'
			),
			array(
			  'value'       => '3',
			  'label'       => '3'
			),
			array(
			  'value'       => '4',
			  'label'       => '4'
			),
			array(
			  'value'       => '5',
			  'label'       => '5'
			),
			array(
			  'value'       => '6',
			  'label'       => '6'
			),
			array(
			  'value'       => '7',
			  'label'       => '7'
			),
			array(
			  'value'       => '8',
			  'label'       => '8'
			),
			array(
			  'value'       => '9',
			  'label'       => '9'
			),
			array(
			  'value'       => '10',
			  'label'       => '10'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-select.php' );
		?></tr><?php
		
		// LG size
		$atts 					= array();
		$atts['description'] 	= 'Lower size limit in pixels for Large screens.';
		$atts['id'] 			= 'scroller-lg-size';
		$atts['label'] 			= 'LG size';
		$atts['name'] 			= 'scroller-lg-size';
		$atts['placeholder'] 	= '';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '1139';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
		// MD items per row
		$atts 					= array();
		$atts['description'] 	= 'Items per row for Medium screens.';
		$atts['id'] 			= 'scroller-md-items';
		$atts['label'] 			= 'MD items per row';
		$atts['name'] 			= 'scroller-md-items';
		$atts['type'] 			= 'select';
		$atts['value'] 			= '3';
		$atts['selections']     = array(
			array(
			  'value'       => '1',
			  'label'       => '1'
			),
			array(
			  'value'       => '2',
			  'label'       => '2'
			),
			array(
			  'value'       => '3',
			  'label'       => '3'
			),
			array(
			  'value'       => '4',
			  'label'       => '4'
			),
			array(
			  'value'       => '5',
			  'label'       => '5'
			),
			array(
			  'value'       => '6',
			  'label'       => '6'
			),
			array(
			  'value'       => '7',
			  'label'       => '7'
			),
			array(
			  'value'       => '8',
			  'label'       => '8'
			),
			array(
			  'value'       => '9',
			  'label'       => '9'
			),
			array(
			  'value'       => '10',
			  'label'       => '10'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-select.php' );
		?></tr><?php
		
		// MD size
		$atts 					= array();
		$atts['description'] 	= 'Lower size limit in pixels for Medium screens.';
		$atts['id'] 			= 'scroller-md-size';
		$atts['label'] 			= 'MD size';
		$atts['name'] 			= 'scroller-md-size';
		$atts['placeholder'] 	= '';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '939';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
		// SM items per row
		$atts 					= array();
		$atts['description'] 	= 'Items per row for Small screens.';
		$atts['id'] 			= 'scroller-sm-items';
		$atts['label'] 			= 'SM items per row';
		$atts['name'] 			= 'scroller-sm-items';
		$atts['type'] 			= 'select';
		$atts['value'] 			= '2';
		$atts['selections']     = array(
			array(
			  'value'       => '1',
			  'label'       => '1'
			),
			array(
			  'value'       => '2',
			  'label'       => '2'
			),
			array(
			  'value'       => '3',
			  'label'       => '3'
			),
			array(
			  'value'       => '4',
			  'label'       => '4'
			),
			array(
			  'value'       => '5',
			  'label'       => '5'
			),
			array(
			  'value'       => '6',
			  'label'       => '6'
			),
			array(
			  'value'       => '7',
			  'label'       => '7'
			),
			array(
			  'value'       => '8',
			  'label'       => '8'
			),
			array(
			  'value'       => '9',
			  'label'       => '9'
			),
			array(
			  'value'       => '10',
			  'label'       => '10'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-select.php' );
		?></tr><?php
		
		// SM size
		$atts 					= array();
		$atts['description'] 	= 'Lower size limit in pixels for Small screens.';
		$atts['id'] 			= 'scroller-sm-size';
		$atts['label'] 			= 'SM size';
		$atts['name'] 			= 'scroller-sm-size';
		$atts['placeholder'] 	= '';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '719';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
		// XS items per row
		$atts 					= array();
		$atts['description'] 	= 'Items per row for Extra small screens.';
		$atts['id'] 			= 'scroller-xs-items';
		$atts['label'] 			= 'XS items per row';
		$atts['name'] 			= 'scroller-xs-items';
		$atts['type'] 			= 'select';
		$atts['value'] 			= '2';
		$atts['selections']     = array(
			array(
			  'value'       => '1',
			  'label'       => '1'
			),
			array(
			  'value'       => '2',
			  'label'       => '2'
			),
			array(
			  'value'       => '3',
			  'label'       => '3'
			),
			array(
			  'value'       => '4',
			  'label'       => '4'
			),
			array(
			  'value'       => '5',
			  'label'       => '5'
			),
			array(
			  'value'       => '6',
			  'label'       => '6'
			),
			array(
			  'value'       => '7',
			  'label'       => '7'
			),
			array(
			  'value'       => '8',
			  'label'       => '8'
			),
			array(
			  'value'       => '9',
			  'label'       => '9'
			),
			array(
			  'value'       => '10',
			  'label'       => '10'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-select.php' );
		?></tr><?php
		
		// XS size
		$atts 					= array();
		$atts['description'] 	= 'Lower size limit in pixels for Extra small screens.';
		$atts['id'] 			= 'scroller-xs-size';
		$atts['label'] 			= 'XS size';
		$atts['name'] 			= 'scroller-xs-size';
		$atts['placeholder'] 	= '';
		$atts['type'] 			= 'text';
		$atts['value'] 			= '479';
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );
		?></tr><?php
		
		// XXS items per row
		$atts 					= array();
		$atts['description'] 	= 'Items per row for Extra extra small screens.';
		$atts['id'] 			= 'scroller-xxs-items';
		$atts['label'] 			= 'XXS items per row';
		$atts['name'] 			= 'scroller-xxs-items';
		$atts['type'] 			= 'select';
		$atts['value'] 			= '1';
		$atts['selections']     = array(
			array(
			  'value'       => '1',
			  'label'       => '1'
			),
			array(
			  'value'       => '2',
			  'label'       => '2'
			),
			array(
			  'value'       => '3',
			  'label'       => '3'
			),
			array(
			  'value'       => '4',
			  'label'       => '4'
			),
			array(
			  'value'       => '5',
			  'label'       => '5'
			),
			array(
			  'value'       => '6',
			  'label'       => '6'
			),
			array(
			  'value'       => '7',
			  'label'       => '7'
			),
			array(
			  'value'       => '8',
			  'label'       => '8'
			),
			array(
			  'value'       => '9',
			  'label'       => '9'
			),
			array(
			  'value'       => '10',
			  'label'       => '10'
			)
		);
		
		if ( ! empty( get_post_meta($post_id, $atts['id'], true) ) ) {
			$atts['value'] = get_post_meta($post_id, $atts['id'], true);
		}
		
		apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );
		
		?><tr><?php
		include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-select.php' );
		?></tr><?php
	
	?>
	</tbody>
	</table>
	</div>

</div>


