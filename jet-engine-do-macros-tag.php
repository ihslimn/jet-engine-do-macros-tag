<?php
/**
 * Plugin Name: JetEngine - Do macros
 * Description: Add dynamic tag that processes entered macros.
 * Plugin URI:  
 * Version:     1.0.2
 * Author:      
 * Author URI:  
 * Text Domain: jet-engine
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Do_Macros_Tag' ) ) {
	
	class Do_Macros_Tag {

		public function __construct() {
			add_action( 'elementor/dynamic_tags/register_tags', array( $this, 'register_dynamic_tag' ) );
		}

		public function register_dynamic_tag( $dynamic_tags ) {

			if ( ! function_exists( 'jet_engine' ) ) {
				return;
			}

			require_once( __DIR__ . '/dynamic-tags/jet-engine-do-macros-dynamic-tag.php' );
			require_once( __DIR__ . '/dynamic-tags/jet-engine-do-macros-dynamic-tag-image.php' );

			$dynamic_tags->register_tag( 'Elementor_Dynamic_Tag_Jet_Engine_Do_Macros' );
			$dynamic_tags->register_tag( 'Elementor_Dynamic_Tag_Jet_Engine_Do_Macros_Image' );

		}

	}

}

if ( class_exists( 'Do_Macros_Tag' ) ) {

	new Do_Macros_Tag();

}