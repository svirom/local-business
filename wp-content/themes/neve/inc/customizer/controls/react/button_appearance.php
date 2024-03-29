<?php
/**
 * Button_Appearance Control. Handles data passing from args to JS.
 *
 * @package Neve\Customizer\Controls\React
 */

namespace Neve\Customizer\Controls\React;

/**
 * Class Button_Appearance
 *
 * @package Neve\Customizer\Controls\React
 */
class Button_Appearance extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'neve_button_appearance';
	/**
	 * Additional arguments passed to JS.
	 *
	 * @var array
	 */
	public $no_hover = false;

	/**
	 * Send to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['no_hover'] = $this->no_hover;
	}
}
