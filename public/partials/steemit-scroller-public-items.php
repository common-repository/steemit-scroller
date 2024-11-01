<?php
/**
 * This file is used to markup the scroller items.
 *
 * @since      	1.0.1
 * @package 	Steemit-Scroller
 * @subpackage 	Steemit-Scroller/public/partials
 */

if ($scroller_options['scroller-layout'][0] == 'light') 
{
	include( plugin_dir_path( __FILE__ ) . 'templates/light.php' );
}
else if ($scroller_options['scroller-layout'][0] == 'minimal') 
{
	include( plugin_dir_path( __FILE__ ) . 'templates/minimal.php' );
}
else if ($scroller_options['scroller-layout'][0] == 'modern') 
{
	include( plugin_dir_path( __FILE__ ) . 'templates/modern.php' );
}
else if ($scroller_options['scroller-layout'][0] == 'caption') 
{
	include( plugin_dir_path( __FILE__ ) . 'templates/caption.php' );
}
else if ($scroller_options['scroller-layout'][0] == 'retro-light') 
{
	include( plugin_dir_path( __FILE__ ) . 'templates/retro-light.php' );
}
else if ($scroller_options['scroller-layout'][0] == 'retro-dark') 
{
	include( plugin_dir_path( __FILE__ ) . 'templates/retro-dark.php' );
}