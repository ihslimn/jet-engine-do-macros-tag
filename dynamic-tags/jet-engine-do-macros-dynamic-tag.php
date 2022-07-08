<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

Class Elementor_Dynamic_Tag_Jet_Engine_Do_Macros extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'jet-engine-do-macros-tag';
	}

	public function get_title() {
		return 'Do Macros';
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
			\Elementor\Modules\DynamicTags\Module::COLOR_CATEGORY
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
			'sanitize_output',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => 'Sanitize output',
			]
		);
	}

	public function render() {
		$macros_string   = $this->get_settings( 'macros_string' );
		$sanitize_output = $this->get_settings( 'sanitize_output' );

		$result = jet_engine()->listings->macros->do_macros( $macros_string );

		if ( isset( $sanitize_output ) && 'yes' == $sanitize_output ) {
			$result = wp_kses_post( $result );
		}

		echo $result;
	}

}