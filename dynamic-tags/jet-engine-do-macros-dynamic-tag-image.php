<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

Class Elementor_Dynamic_Tag_Jet_Engine_Do_Macros_Image extends \Elementor\Core\DynamicTags\Data_Tag {

	public function get_name() {
		return 'jet-engine-do-macros-tag-image';
	}

	public function get_title() {
		return 'Do Macros - Data';
	}

	public function get_group() {
		return Jet_Engine_Dynamic_Tags_Module::JET_GROUP;
	}

	public function get_categories() {
		return [ 
			\Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::URL_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::POST_META_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::NUMBER_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::COLOR_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY,
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
		$this->add_control(
			'strip_tags',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => 'Strip tags',
			]
		);
		$this->add_control(
			'is_image',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => 'Is image',
			]
		);
	}

	public function get_value( array $options = array() ) {
		$macros_string = $this->get_settings( 'macros_string' );
		$strip_tags    = $this->get_settings( 'strip_tags' );
		$is_image      = $this->get_settings( 'is_image' );

		$result = jet_engine()->listings->macros->do_macros( $macros_string );
		$result = do_shortcode( $result );

		if ( isset( $strip_tags ) && 'yes' == $strip_tags ) {
			$result = wp_strip_all_tags( $result );
		}

		if ( $is_image ) {
			$result = \Jet_Engine_Tools::get_attachment_image_data_array( $result );
		}

		return $result;
	}

}