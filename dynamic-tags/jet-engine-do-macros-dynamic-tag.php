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
			'sanitize_output',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => 'Sanitize output',
			]
		);
		$this->add_control(
			'strip_tags',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => 'Strip tags',
			]
		);
	}

	public function render() {
		$macros_string   = $this->get_settings( 'macros_string' );
		$sanitize_output = $this->get_settings( 'sanitize_output' );
		$strip_tags      = $this->get_settings( 'sanitize_output' );

		$result = jet_engine()->listings->macros->do_macros( $macros_string );
		$result = do_shortcode( $result );

		if ( isset( $sanitize_output ) && 'yes' == $sanitize_output ) {
			$result = wp_kses_post( $result );
		}

		if ( isset( $strip_tags ) && 'yes' == $strip_tags ) {
			$result = wp_strip_all_tags( $result );
		}

		echo $result;
	}

}
