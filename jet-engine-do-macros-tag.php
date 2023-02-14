<?php
/**
 * Plugin Name: JetEngine - Do macros
 * Description: Add dynamic tag that processes entered macros.
 * Plugin URI:  
 * Version:     1.0.1
 * Author:      
 * Author URI:  
 * Text Domain: jet-engine
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Do_Macros_Tag' ) ) {
	
	class Do_Macros_Tag {

		private $new_elementor = false;

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'add_hooks' ) );
		}

		public function add_hooks() {

			if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '3.5.0', '>=' ) ) {
				$this->new_elementor = true;
				add_action( 'elementor/dynamic_tags/register', array( $this, 'register_dynamic_tag' ) );
			} else {
				add_action( 'elementor/dynamic_tags/register_tags', array( $this, 'register_dynamic_tag' ) );
			}

		}

		public function register_dynamic_tag( $dynamic_tags ) {

			if ( ! function_exists( 'jet_engine' ) ) {
				return;
			}

			require_once( __DIR__ . '/dynamic-tags/jet-engine-do-macros-dynamic-tag.php' );

			if ( $this->new_elementor ) {
				$dynamic_tags->register( new Elementor_Dynamic_Tag_Jet_Engine_Do_Macros() );
			} else {
				$dynamic_tags->register_tag( 'Elementor_Dynamic_Tag_Jet_Engine_Do_Macros' );
			}

		}

	}

}

if ( class_exists( 'Do_Macros_Tag' ) ) {

	new Do_Macros_Tag();

}
