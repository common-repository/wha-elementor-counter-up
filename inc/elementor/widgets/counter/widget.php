<?php
namespace WHA_Elementor\Widgets\Counter;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

include( __DIR__ . '/common.php' );



/**
 * Elementor widget for WHA.
 */
class WHA_Counter extends Widget_Base {

	/**
	 * Presets
	 * @access protected
	 * @var array $presets Array objects presets.
	 */
	protected $presets;

	public $preset_elements_select;

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		if( ! defined( 'WHA_ELEMENTOR_WIDGET_COUNTER_DIR' ) ){
			define( 'WHA_ELEMENTOR_WIDGET_COUNTER_DIR', rtrim( __DIR__, ' /\\' ) );
		}

		if ( ! defined( 'WHA_ELEMENTOR_WIDGET_COUNTER_URL' ) ) {
			define( 'WHA_ELEMENTOR_WIDGET_COUNTER_URL', rtrim( plugin_dir_url( __FILE__ ), ' /\\' ) );
		}


		wp_register_style( 'wha-counter-css', WHA_ELEMENTOR_WIDGET_COUNTER_URL . '/assets/css/wha-counter.css', array(), null );
		wp_register_style( 'wha-odometer-css', WHA_ELEMENTOR_WIDGET_COUNTER_URL . '/assets/css/wha-odometer.css', array(), null );
        wp_register_script( 'wha-odometr-js', WHA_ELEMENTOR_WIDGET_COUNTER_URL . '/assets/js/wha-odometer.js', array('jquery'), false, true);
        wp_register_script( 'wha-counter-js', WHA_ELEMENTOR_WIDGET_COUNTER_URL . '/assets/js/wha-counters.js', array( 'jquery' ), null, true );


	}


	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return 'wha-counter';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */

	public function get_title() {
		return __( 'Counter Up', 'wha-elements' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */

	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'wha_widgets' ];
	}

	public function get_style_depends() {
		return [ 'wha-counter-css', 'wha-odometer-css' ];
	}

	public function get_script_depends() {
		return [ 'wha-odometr-js', 'wha-counter-js' ];
	}

	public function is_reload_preview_required() {
		return true;
	}


	/**
	 * Retrieve the value setting
	 * @access public
	 *
	 * @param string $control_id Control id
	 * @param string $control_sub Control value name (size, unit)
	 *
	 * @return string
	 */
	public function get_val( $control_id, $control_sub = null ) {
		if ( empty( $control_sub ) ) {
			return $this->get_settings()[ $control_id ];
		} else {
			return $this->get_settings()[ $control_id ][ $control_sub ];
		}
	}

	/**
	 * Retrieve presets
	 *
	 * @param object $control
	 *
	 * @access protected
	 */
	protected function get_custom_presets( $control=null ) {
		include 'bases/preset_base.php';
		foreach ( glob( __DIR__ . '/presets/*.php' ) as $filename ) {
			$new_preset = null;
			if(empty( $filename ) || !is_readable( $filename)) continue;
			include $filename;
			if( !empty( $new_preset) ){
				$this->presets[] = $new_preset;
			}
		}
	}


	/**
	 * Create presets options for Select
	 *
	 * @access protected
	 * @return array
	 */
	protected function get_presets_options() {
		if ( empty( $this->presets ) ) return array();
		$out = array();
		foreach ( (array) $this->presets as $preset ) {
			$out[ $preset->preset_id ] = $preset->preset_title;
		}
		return $out;
	}

	/**
	 * Get default presets options for Select
	 *
	 * @param int $index
	 *
	 * @access protected
	 * @return string
	 */
	protected function set_default_presets_options($index=0) {
		if ( empty( $this->presets ) ) {
			return null;
		}
		return $this->presets[ $index ]->preset_id;
	}

	/**
	 * Register the widget controls.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		$this->get_custom_presets();

		if( !empty($this->presets) ){
			foreach ( (array) $this->presets as $preset ) {
                if($preset->preset_id === 'counter-preset1') {
                    $preset->controls( $this );
                }
			}
		}
	}

	protected function get_setting_preset( $val ) {
		if( empty( $val) ) {
			return '';
		}
		return $val;
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	public function render() {

		$settings = $this->get_settings_for_display();

		$preset = 'counter-preset1';

        $preset_path = __DIR__ . '/templates/preset_html1.php';

        ?>

        <div class="wha-container-element <?php echo $preset; ?>">

            <div class="lds-ripple"><div></div><div></div></div>

            <div class="wha-counter-container">
                <?php

                    if( !empty( $preset_path) && file_exists( $preset_path) ){
                        include( $preset_path );
                    }
                ?>
            </div>

        </div>

		<?php

        if ( is_admin() && Plugin::$instance->editor->is_edit_mode() ): ?>
            <script type="text/javascript">
                jQuery('.elementor-element-<?php echo $this->get_id(); ?> .wha-counter').each(function() {
                    init_odometer(this);
                });
            </script>
        <?php endif;
	}


    /**
     * Retrieve image widget link URL.
     *
     * @since 1.0.0
     * @access private
     *
     * @param array $settings
     *
     * @return array|string|false An array/string containing the link URL, or false if no link.
     */
    private function get_link_url( $settings ) {

        $preset = 'counter-preset1';

        if ( empty( $settings[$preset.'_link' ]['url'] ) ) {
            return false;
        }

        return [
            'url'         => $settings[$preset.'_link' ]['url'],
            'nofollow'    => $settings[$preset.'_link']['nofollow'],
            'is_external' => $settings[$preset.'_link']['is_external'],
        ];
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new WHA_Counter() );
