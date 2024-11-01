<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) exit;


class WHA_Counter_Preset_Base {

	protected $control;

	public $preset_id = 'counter-preset';

	public $preset_title = '';

	public $preset_path = 'preset_html.php';

	protected $preset_elements = [];

	public $preset_arg = [];

	public $preset_styles = [];

	public function __construct() {

		$this->preset_title = __( 'Design', 'wha-elements' );

		$this->preset_styles = [];

	}


	/**
	 * HTML preset puth
	 * @access protected
	 */
	protected function html_puth( $control ) {

		$control->add_control(
			$this->preset_id . '_preset_html',
			[
				'default' => $this->preset_path,
				'type' => Controls_Manager::HIDDEN,
				'show_label' => false,
			]
		);

	}

	/**
	 * HTML preset puth
	 * @access protected
	 */
	protected function presets_args( $control ) {

		$control->add_control(
			$this->preset_id . '_preset_args',
			[
				'default' => !empty( $this->preset_arg) ? json_encode( (array)$this->preset_arg ) : '',
				'type' => Controls_Manager::HIDDEN,
				'show_label' => false,
			]
		);

	}



	/**
	 * Content Settings
	 * @access protected
	 */
	protected function content_settings( $control ) {


		$control->start_controls_section(
			$this->preset_id . '_content_settings',
			[
				'label' => __( 'Content', 'wha-elements' ),

			]
		);

        $control->add_control(
            'numbers_format',
            [
                'label' => __( 'Numbers Format', 'wha-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => __( '(ddd).ddd', 'wha-elements' ),
                'options' => [
                    '(ddd).ddd'  => __( '9999',  'wha-elements' ),
                    '( ddd).ddd' => __( '9 999', 'wha-elements' ),
                    '(,ddd).ddd' => __( '9,999', 'wha-elements' ),
                    '(.ddd).ddd' => __( '9.999', 'wha-elements' ),
                    '(.dd).ddd'  => __( '9.99', 'wha-elements' ),
                    '(,dd).ddd'  => __( '9,99', 'wha-elements' ),
                    '( dd).ddd'  => __( '9 99', 'wha-elements' ),
                ],
            ]
        );

        $control->add_control(
            $this->preset_id . '_starting_number',
            [
                'label' => __( 'Starting Number', 'wha-elements' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'step' => 1,
                'default' => 0,
            ]
        );

        $control->add_control(
            $this->preset_id . '_ending_number',
            [
                'label' => __( 'Ending Number', 'wha-elements' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'step' => 1,
                'default' => 1000,
            ]
        );

        $control->add_control(
            $this->preset_id . '_number_suffix',
            [
                'label' => __( 'Number Suffix', 'wha-elements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Number Suffix', 'wha-elements' ),
            ]
        );

        $control->add_control(
            $this->preset_id . '_spacing_suffix',
            [
                'label' => 'Spacing',
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'wha-elements' ),
                'label_off' => __( 'No', 'wha-elements' ),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $control->add_control(
            $this->preset_id .'_description',
            [
                'label' => __( 'Description', 'wha-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 3,
                'placeholder' => __( 'Counters', 'wha-elements' ),
            ]
        );

        $control->add_control(
            $this->preset_id . '_vertical_position_description',
            [
                'label' => 'Position Description',
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Top', 'thegem' ),
                'label_off' => __( 'Bottom', 'thegem' ),
                'frontend_available' => true,
            ]
        );

        $control->add_control(
            $this->preset_id .'_link',
            [
                'label' => __( 'Link', 'wha-elements' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'wha-elements' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $control->add_control(
            $this->preset_id .'_icon',
            [
                'label' => __( 'Icon', 'wha-elements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-street-view',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $control->add_control(
            $this->preset_id . '_show_connector',
            [
                'label' => 'Connector',
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Show', 'thegem' ),
                'label_off' => __( 'Hide', 'thegem' ),
                'frontend_available' => true,
            ]
        );

		self::html_puth( $control );

		$control->end_controls_section();

        $control->start_controls_section(
            $this->preset_id . '_additional_options_settings',
            [
                'label' => __( 'Additional Options', 'wha-elements' ),
            ]
        );

        $control->add_control(
            $this->preset_id . '_animation_enabled',
            [
                'label' => 'Animation enabled',
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'wha-elements' ),
                'label_off' => __( 'Off', 'wha-elements' ),
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $control->end_controls_section();

	}


	/**
	 * Container Styles
	 * @access protected
	 */
	protected function container_styles( $control ) {


		$control->start_controls_section(
			$this->preset_id . '_container',
			[
				'label' => __( 'Container Style', 'wha-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$control->start_controls_tabs( $this->preset_id . '_container_tabs' );

		$control->start_controls_tab( $this->preset_id . '_container_tab_normal', [ 'label' => __( 'Normal', 'wha-elements' ), ] );

        $control->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $this->preset_id .'_background',
                'label' => __( 'Background Color', 'wha-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box'
            ]
        );

        $control->add_responsive_control(
            $this->preset_id . '_container_radius',
            [
                'label' => __( 'Radius', 'wha-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'separator' => 'after',
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $control->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $this->preset_id . '_container_border',
                'label' => __( 'Border', 'wha-elements' ),
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box',

            ]
        );

        $control->add_control(
            $this->preset_id . '_container_align',
            [
                'label' => __( 'Content Align', 'wha-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'separator' => 'before',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'wha-elements' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'wha-elements' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'wha-elements' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'selectors_dictionary' => [
                    'left' => 'text-align: left; align-items: center; justify-content: flex-start;',
                    'center' => 'text-align: center; align-items: center; justify-content: center;',
                    'right' => 'text-align: right; align-items: center; justify-content: flex-end;',

                ],
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box, 
                     {{WRAPPER}} .' . $this->preset_id . ' .wha-icon, 
                     {{WRAPPER}} .' . $this->preset_id . ' .wha-counter-number, 
                     {{WRAPPER}} .' . $this->preset_id . ' .wha-counter-text' => '{{VALUE}}',
                ],
            ]
        );

        $control->add_responsive_control(
            $this->preset_id . '_container_padding',
            [
                'label' => __( 'Padding', 'wha-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $control->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $this->preset_id . '_container_shadow',
                'label' => __( 'Shadow', 'wha-elements' ),
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box',
            ]
        );

		$control->end_controls_tab();

		$control->start_controls_tab( $this->preset_id . '_container_tab_hover', [ 'label' => __( 'Hover', 'wha-elements' ), ] );

        $control->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $this->preset_id .'_background_hv',
                'label' => __( 'Background Color', 'wha-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:before'
            ]
        );

        $control->add_control(
            $this->preset_id . '_container_brdcolor_hv',
            [
                'label' => __( 'Border Container Color', 'wha-elements' ),
                'type' => Controls_Manager::COLOR,
                'label_block' => false,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );

        $control->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => $this->preset_id . '_container_shadow_hv',
            'label' => __( 'Shadow', 'wha-elements' ),
            'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover',
        ]
    );

        $control->end_controls_tab();

        $control->end_controls_tabs();

		$control->end_controls_section();

	}


    /**
     * Number Styles
     * @access protected
     */
    protected function number_styles( $control ) {

        $control->start_controls_section(
            $this->preset_id . '_number',
            [
                'label' => __( 'Number Style', 'wha-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]

        );

        $control->start_controls_tabs( $this->preset_id . '_number_tabs' );

        $control->start_controls_tab( $this->preset_id . '_number_tab_normal', [ 'label' => __( 'Normal', 'wha-elements' ), ] );

        $control->add_control(
            $this->preset_id . '_number_color',
            [
                'label' => __( 'Color', 'wha-elements' ),
                'type' => Controls_Manager::COLOR,
                'label_block' => false,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $control->add_group_control( Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'wha-elements' ),
                'name' => $this->preset_id . '_title_typ',
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-number',
            ]
        );

        $control->end_controls_tab();

        $control->start_controls_tab( $this->preset_id . '_number_tab_hover', [ 'label' => __( 'Hover', 'wha-elements' ), ] );

        $control->add_control(
            $this->preset_id . '_number_color_hv',
            [
                'label' => __( 'Color', 'wha-elements' ),
                'type' => Controls_Manager::COLOR,
                'label_block' => false,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover .wha-counter-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $control->add_group_control( Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'wha-elements' ),
                'name' => $this->preset_id . '_number_typ_hv',
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover .wha-counter-number',
            ]
        );

        $control->end_controls_tab();

        $control->end_controls_tabs();

        $control->add_control(
            $this->preset_id . '_number_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'wha-elements' ),
                'condition' => [
                    $this->preset_id .'_vertical_position_description' => [''],
                ],
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-number' => 'margin-bottom:{{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $control->end_controls_section();

    }


    /**
     * Description Styles
     * @access protected
     */
    protected function description_styles( $control ) {

        $control->start_controls_section(
            $this->preset_id . '_description_style',
            [
                'label' => __( 'Description Style', 'wha-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]

        );

        $control->start_controls_tabs( $this->preset_id . '_description_tabs' );

        $control->start_controls_tab( $this->preset_id . '_description_tab_normal', [ 'label' => __( 'Normal', 'wha-elements' ), ] );

        $control->add_control(
            $this->preset_id . '_description_color',
            [
                'label' => __( 'Color', 'wha-elements' ),
                'type' => Controls_Manager::COLOR,
                'label_block' => false,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-text' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $control->add_group_control( Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'wha-elements' ),
                'name' => $this->preset_id . '_description_typ',
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-text',
            ]
        );

        $control->end_controls_tab();

        $control->start_controls_tab( $this->preset_id . '_description_style_tab_hover', [ 'label' => __( 'Hover', 'wha-elements' ), ] );

        $control->add_control(
            $this->preset_id . '_description_color_hv',
            [
                'label' => __( 'Color', 'wha-elements' ),
                'type' => Controls_Manager::COLOR,
                'label_block' => false,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover .wha-counter-text' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $control->add_group_control( Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography', 'wha-elements' ),
                'name' => $this->preset_id . '_description_typ_hv',
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover .wha-counter-text',
            ]
        );

        $control->end_controls_tab();

        $control->end_controls_tabs();

        $control->add_control(
            $this->preset_id . '_description_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'wha-elements' ),
                'condition' => [
                    $this->preset_id .'_vertical_position_description' => ['yes'],
                ],
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-text' => 'margin-bottom:{{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $control->end_controls_section();

    }


	/**
	 * Icon Styles
     * @access protected
	 */
	protected function icon_styles( $control ) {

		$control->start_controls_section(
			$this->preset_id . '_icon_style',
			[
				'label' => __( 'Icon Style', 'wha-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $control->add_responsive_control(
            $this->preset_id . '_icon_font_size',
            [
                'label' => __( 'Size', 'wha-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 48,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: 1; display: flex; justify-content: center; align-items: center;',
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $control->add_responsive_control(
                $this->preset_id . '_icon_padding_style1',
                [
                    'label' => __( 'Padding', 'wha-elements' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'rem', 'em' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'rem' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'em' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner' => 'padding: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $control->add_control(
            $this->preset_id . '_icon_bottom_spacing',
            [
                'label' => __( 'Bottom Spacing', 'wha-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon' => 'margin-bottom:{{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $control->add_control(
            $this->preset_id . '_icon_radius',
            [
                'label' => __( 'Radius', 'wha-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'label_block' => true,
                'default' => !empty($this->preset_styles['image_radius']) ? $this->preset_styles['image_radius'] : null,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $control->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $this->preset_id . '_icon_border',
                'label' => __( 'Border', 'wha-elements' ),
                'fields_options' => [
                    'border' => [
                        'default' => '',
                    ],
                    'color' => [
                        'default' => '#dcdcdc',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => true,
                        ],
                    ],
                ],
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner',
            ]
        );

        $control->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $this->preset_id . '_icon_shadow',
                'label' => __( 'Shadow', 'wha-elements' ),
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner',
            ]
        );

        $control->start_controls_tabs( $this->preset_id . '_icon_tabs' );

        $control->start_controls_tab( $this->preset_id . '_icon_tab_normal', [ 'label' => __( 'Normal', 'wha-elements' ), ] );

        $control->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $this->preset_id .'_icon_background',
                'label' => __( 'Background Color', 'wha-elements' ),
                'types' => [ 'classic', ],
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box .wha-icon-inner'
            ]
        );

        $control->add_control(
            $this->preset_id . '_icon_bgcolor',
            [
                'label' => __( 'Icon Color', 'wha-elements' ),
                'type' => Controls_Manager::COLOR,
                'label_block' => false,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner svg' => 'fill:{{VALUE}};',
                ],
            ]
        );

        $control->add_control(
            $this->preset_id . '_rotate_icon_style',
            [
                'label' => __( 'Rotate Icon, %', 'wha-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 360,
                    ]
                ],
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner i' => 'transform: rotate({{SIZE}}deg);',
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-icon-inner svg' => 'transform: rotate({{SIZE}}deg);',

                ],
            ]
        );

        $control->end_controls_tab();

        $control->start_controls_tab( $this->preset_id . '_icon_tab_hover', [ 'label' => __( 'Hover', 'wha-elements' ), ] );

        $control->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $this->preset_id .'_icon_background_hv',
                'label' => __( 'Background Color', 'wha-elements' ),
                'types' => [ 'classic', ],
                'selector' => '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover .wha-icon-inner'
            ]
        );

        $control->add_control(
            $this->preset_id . '_icon_bgcolor_hv',
            [
                'label' => __( 'Icon Color', 'wha-elements' ),
                'type' => Controls_Manager::COLOR,
                'label_block' => false,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover .wha-icon-inner i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover .wha-icon-inner svg' => 'fill:{{VALUE}};',
                ],
            ]
        );

        $control->add_control(
            $this->preset_id . '_rotate_icon_style_hv',
            [
                'label' => __( 'Rotate Icon, %', 'wha-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 360,
                    ]
                ],
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover .wha-icon-inner i' => 'transform: rotate({{SIZE}}deg)',
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-box:hover .wha-icon-inner svg' => 'transform: rotate({{SIZE}}deg)',

                ],
            ]
        );

        $control->end_controls_tab();

        $control->end_controls_tabs();

		$control->end_controls_section();
	}



    /**
     * Connector Styles
     * @access protected
     */
    protected function connector_styles( $control ) {

            $control->start_controls_section(
                $this->preset_id . '_connector_style',
                [
                    'label' => __( 'Connector Style', 'wha-elements' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        $this->preset_id . '_show_connector' => 'yes',
                    ],
                ]
            );

            $control->add_control(
            $this->preset_id . '_сonnector_person_bgcolor',
            [
                'label' => __( 'Color', 'wha-elements' ),
                'type' => Controls_Manager::COLOR,
                'label_block' => false,
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-container .divider-counter span' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );

            $control->add_control(
            $this->preset_id . '_сonnector_width',
            [
                'label' => __( 'Weight', 'wha-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 30,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-container .divider-counter span' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

            $control->add_control(
            $this->preset_id . '_сonnector_height',
            [
                'label' => __( 'Size', 'wha-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 50,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .' . $this->preset_id . ' .wha-counter-container .divider-counter span' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

            $control->end_controls_section();

    }



	/**
	 * Controls call
	 * @access public
	 */
	public function controls( $control ) {

		$this->control = $control;

		$this->content_settings( $control );

		$this->container_styles( $control );

        $this->number_styles( $control );

        $this->description_styles( $control );

		$this->icon_styles( $control );

        $this->connector_styles( $control );

	}



}

new WHA_Counter_Preset_Base();
