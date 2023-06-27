<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

Class Elementor_Dynamic_Tag_Jet_Engine_Do_Macros_Image extends \Elementor\Core\DynamicTags\Data_Tag {

	public function get_name() {
		return 'jet-engine-do-macros-tag-image';
	}

	public function get_title() {
		return 'Do Macros - Image';
	}

	public function get_group() {
		return Jet_Engine_Dynamic_Tags_Module::JET_GROUP;
	}

	public function get_categories() {
		return [ 
			\Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY
		];
	}

	protected function register_controls() {
		$this->add_control(
			'macros_string',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => 'Macros string',
			]
		);
	}

	public function get_value( array $options = array() ) {
		$macros_string   = $this->get_settings( 'macros_string' );

		$result = jet_engine()->listings->macros->do_macros( $macros_string );
		$result = do_shortcode( $result );

		$result = \Jet_Engine_Tools::get_attachment_image_data_array( $result );

		return $result;
	}

}