<?php

/**
 * Javascript class
 *
 * @since      	1.0.1
 * @package 	Steemit-Scroller
 * @subpackage 	Steemit-Scroller/includes
 */

class Steemit_Scroller_Javascript {

	/**
	 * Constructor
	 */
	public function __construct() {

		// Nothing to see here...

	} // __construct()
	
	/**
	 * Creates main javascript.
	 *
	 * @since    1.0.1
	 */
	public function getMainScript($scroller_id) {
		
		$steemitscroller_id = 'steemitscroller-'.$scroller_id;
		$steemitscroller_wrapper_id = 'steemitscroller-wrapper-'.$scroller_id;
		$scroller_options = get_post_meta( $scroller_id, '', false );
		$steemitscroller_ajaxurl = admin_url( 'admin-ajax.php' );

		// Params
		$responsive = isset($scroller_options['scroller-responsive'][0]) ? $scroller_options['scroller-responsive'][0] : 'yes';
		$responsive_lg_num = isset($scroller_options['scroller-lg-items'][0]) ? (int)$scroller_options['scroller-lg-items'][0] : 4;
		$responsive_md_num = isset($scroller_options['scroller-md-items'][0]) ? (int)$scroller_options['scroller-md-items'][0] : 3;
		$responsive_sm_num = isset($scroller_options['scroller-sm-items'][0]) ? (int)$scroller_options['scroller-sm-items'][0] : 2;
		$responsive_xs_num = isset($scroller_options['scroller-xs-items'][0]) ? (int)$scroller_options['scroller-xs-items'][0] : 1;
		$responsive_xxs_num = isset($scroller_options['scroller-xxs-items'][0]) ? (int)$scroller_options['scroller-xxs-items'][0] : 1;
		$responsive_lg = isset($scroller_options['scroller-lg-size'][0]) ? (int)$scroller_options['scroller-lg-size'][0] : 1139;
		$responsive_md = isset($scroller_options['scroller-md-size'][0]) ? (int)$scroller_options['scroller-md-size'][0] : 939;
		$responsive_sm = isset($scroller_options['scroller-sm-size'][0]) ? (int)$scroller_options['scroller-sm-size'][0] : 719;
		$responsive_xs = isset($scroller_options['scroller-xs-size'][0]) ? (int)$scroller_options['scroller-xs-size'][0] : 479;

		if ($responsive == 'yes') {
			$starting_items = $responsive_xxs_num;
			$responsive = '{				
								'.$responsive_xs.'	:{
									items: '.$responsive_xs_num.'
								},
								'.$responsive_sm.'	:{
									items: '.$responsive_sm_num.'
								},
								'.$responsive_md.'	:{
									items: '.$responsive_md_num.'
								},
								'.$responsive_lg.'	:{
									items: '.$responsive_lg_num.'
								}
		}';	
		} else {
			$starting_items = $responsive_lg_num;
			$responsive = 'false';
		}
		
		$items_spacing = isset($scroller_options['scroller-items-spacing'][0]) ? (int)$scroller_options['scroller-items-spacing'][0] : 10;
		$loop = isset($scroller_options['scroller-infinite-loop'][0]) ? $scroller_options['scroller-infinite-loop'][0] : 'yes';
		$loop = ($loop == 'yes') ? 'true' : 'false';
		$center = isset($scroller_options['scroller-center-items'][0]) ? $scroller_options['scroller-center-items'][0] : 'yes';
		$center = ($center == 'yes') ? 'true' : 'false';
		$drag = isset($scroller_options['scroller-drag-scroll'][0]) ? $scroller_options['scroller-drag-scroll'][0] : 'yes';
		$drag = ($drag == 'yes') ? 'true' : 'false';
		$nav_arrow = isset($scroller_options['scroller-nav-arrows'][0]) ? $scroller_options['scroller-nav-arrows'][0] : 'yes';
		$nav_arrow = ($nav_arrow == 'yes') ? 'true' : 'false';
		$rewind = isset($scroller_options['scroller-rewind'][0]) ? $scroller_options['scroller-rewind'][0] : 'yes';
		$rewind = ($rewind == 'yes') ? 'true' : 'false';

		$rtl = isset($scroller_options['scroller-rtl'][0]) ? $scroller_options['scroller-rtl'][0] : 'no';
		if ($rtl == 'yes') {
			$rtl = 'true';
			$navText = '["<i class=\"fa fa-angle-right\"></i>","<i class=\"fa fa-angle-left\"></i>"]';
		} else {
			$rtl = 'false';
			$navText = '["<i class=\"fa fa-angle-left\"></i>","<i class=\"fa fa-angle-right\"></i>"]';
		}
		
		$dots = isset($scroller_options['scroller-page-dots'][0]) ? $scroller_options['scroller-page-dots'][0] : 'yes';
		$dots = ($dots == 'yes') ? 'true' : 'false';
		$autoplay = isset($scroller_options['scroller-autoplay'][0]) ? $scroller_options['scroller-autoplay'][0] : 'yes';
		$autoplay = ($autoplay == 'yes') ? 'true' : 'false';
		$autoplay_speed = isset($scroller_options['scroller-autoplay-speed'][0]) ? (int)$scroller_options['scroller-autoplay-speed'][0] : 2000;
		$stop_on_hover = isset($scroller_options['scroller-stop-on-hover'][0]) ? $scroller_options['scroller-stop-on-hover'][0] : 'no';
		$stop_on_hover = ($stop_on_hover == 'yes') ? 'true' : 'false';
		$nav_speed = isset($scroller_options['scroller-nav-speed'][0]) ? (int)$scroller_options['scroller-nav-speed'][0] : 500;
		$dots_speed = isset($scroller_options['scroller-dots-speed'][0]) ? (int)$scroller_options['scroller-dots-speed'][0] : 500;
		$autoheight = isset($scroller_options['scroller-autoheight'][0]) ? $scroller_options['scroller-autoheight'][0] : 'no';
		$autoheight = ($autoheight == 'yes') ? 'true' : 'false';

		$javascript = "
		<script type='text/javascript'>
			(function ($) {
				$(document).ready(function() 
				{
		";
		
		// Spinner
		if ($scroller_options['scroller-load-asynch'][0] == 'yes')
		{	
			$javascript .= "
				// Options
				var scrollerId = ".$scroller_id.";
									
				// Initialize spinner
				var createSpinner = function()
				{ 
					var spinner_options = {
					  lines: 9,
					  length: 4,
					  width: 3,
					  radius: 3,
					  corners: 1,
					  rotate: 0,
					  direction: 1,
					  color: '#333',
					  speed: 1,
					  trail: 52,
					  shadow: false,
					  hwaccel: false,
					  className: 'spinner',
					  zIndex: 2e9,
					  top: '50%',
					  left: '50%'
					};
					$('#steemitscroller-loader-'+scrollerId+'').append(new Spinner(spinner_options).spin().el);
					
					return;
				}
				
				// Check if spinner has initialized
				if (!$('#steemitscroller-loader-'+scrollerId+' .spinner').length)
					createSpinner();
		
				// Show loader
				$('#steemitscroller-loader-'+scrollerId+'').show();
			";
		}
		
		$javascript .= "
			$('#".$steemitscroller_id."').owlCarousel({
				
				items 					: ".$starting_items.",
				margin					: ".$items_spacing.",
				loop					: ".$loop.",
				center					: ".$center.",
				mouseDrag 				: ".$drag.",
				touchDrag 				: ".$drag.",
				pullDrag 				: true,
				freeDrag 				: false,
				stagePadding			: 0,
				merge					: false,
				mergeFit				: true,
				autoWidth				: false,
				startPosition			: 0,
				URLhashListener			: false,
				nav						: ".$nav_arrow.",
				rewind					: ".$rewind.",
				navText					: ".$navText.",
				navElement				: \"div\",
				slideBy					: 1,
				dots					: ".$dots.",
				dotsEach				: false,
				dotData					: false,
				lazyLoad				: false,
				lazyContent				: false,
				autoplay				: ".$autoplay.",
				autoplayTimeout			: ".$autoplay_speed.",						
				autoplayHoverPause		: ".$stop_on_hover.",
				smartSpeed				: 100,
				autoplaySpeed			: ".$nav_speed.",
				navSpeed				: ".$nav_speed.",
				dotsSpeed				: ".$dots_speed.",
				dragEndSpeed			: ".$nav_speed.",
				callbacks				: true,
				responsive				: ".$responsive.",
				responsiveRefreshRate	: 200,
				responsiveBaseElement	: window,
				video					: false,
				videoHeight				: false,
				videoWidth				: false,
				animateOut				: false,
				animateIn				: false,
				fallbackEasing			: \"swing\",
				info					: false,
				nestedItemSelector		: false,
				itemElement				: \"div\",
				stageElement			: \"div\",
				navContainer			: false,
				dotsContainer			: false,
				rtl						: ".$rtl.",
				refreshClass			: \"owl-refresh\",
				loadingClass			: \"owl-loading\",
				loadedClass				: \"owl-loaded\",
				rtlClass				: \"owl-rtl\",
				dragClass				: \"owl-drag\",
				grabClass				: \"owl-grab\",
				stageClass				: \"owl-stage\",
				stageOuterClass			: \"owl-stage-outer\",
				navContainerClass		: \"owl-nav\",
				controlsClass			: \"owl-controls\",
				dotClass				: \"owl-dot\",
				dotsClass				: \"owl-dots\",
				autoHeight				: ".$autoheight.",
				autoHeightClass			: \"owl-height\",
				responsiveClass			: false
			
			});
		";
		
		if ($scroller_options['scroller-layout'][0] == 'modern')
		{
			if ($scroller_options['scroller-item-introtext'][0] == 'yes')
			{
				$javascript .= "		
				
					$('#".$steemitscroller_id.".ssc-modern .ssc-media').on('mouseover',function(){
						var introtext_height = $(this).find('.ssc-intro').innerHeight();
						$(this).find('.ssc-intro-outer').css({'height':introtext_height+'px'});
					});
					$('#".$steemitscroller_id.".ssc-modern .ssc-media').on('mouseout',function(){
						$(this).find('.ssc-intro-outer').css({'height':'0'});
					});
				
				";
			}
		}
		
		if ($scroller_options['scroller-layout'][0] == 'caption')
		{
			$javascript .= "		
				
				$('#".$steemitscroller_id.".ssc-caption .ssc-item .reveal_opener .openme').on('click',function(){
					$('#".$steemitscroller_id.".ssc-caption .ssc-item').removeClass('revactive');
					$('#".$steemitscroller_id.".ssc-caption .ssc-item .closeme').hide();
					$('#".$steemitscroller_id.".ssc-caption .ssc-item .openme').show(); 
					$(this).parent().parent().addClass('revactive');
					$(this).hide();
					$('.closeme', $(this).parent()).css({'display':'block'});
				});
				$('#".$steemitscroller_id.".ssc-caption .ssc-item .reveal_opener .closeme').on('click',function(){
					$('#".$steemitscroller_id.".ssc-caption .ssc-item').removeClass('revactive');
					$('#".$steemitscroller_id.".ssc-caption .ssc-item .closeme').hide();
					$('#".$steemitscroller_id.".ssc-caption .ssc-item .openme').show(); 
				});	
				
			";
		}
		
		$javascript .= "													
				});
			})(jQuery)
		</script>
		";
		
		return $javascript;
		
	}

} // class