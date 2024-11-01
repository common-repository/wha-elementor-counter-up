<?php
if ( ! defined( 'ABSPATH' ) ) exit;


class WHA_Counter_Preset1 extends WHA_Counter_Preset_Base {

	public function __construct() {
		parent::__construct();

		$this->preset_id = 'counter-preset1';

		$this->preset_title = __( 'Style 1', 'wha-elements' );

		$this->preset_path = 'preset_html1.php';

		$this->preset_arg = [
			'preset_old_class' => 'wha-counter-style-1',
		];

	}

}

$new_preset = new WHA_Counter_Preset1();
