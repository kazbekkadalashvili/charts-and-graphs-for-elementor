<?php
namespace ElementorChartsGraphs\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Charts Graphs
 *
 * Elementor widget for Charts Graphs.
 *
 * @since 1.0.0
 */
class Charts_Graphs extends Widget_Base {

	/**
	 * Retrieve the list of scripts the widget.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts.
	 */
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
 
		wp_enqueue_script( 'elementor-chart-js', plugin_dir_url( __FILE__ ) . 'assets/js/chart.js' );
	}

	protected function generateRandomString($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charts-graphs';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Charts & Graphs', 'elementor_charts_graphs' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-pie-chart';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}

	/**
	 * Retrieve the list of scripts the widget.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'elementor_charts_graphs' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementor_charts_graphs' ),
			]
		);

		$this->add_control(
			'chart_type',
			[
				'label' => __( 'Type', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'line',
				'options' => [
					'line'  => __( 'Line', 'elementor-chart' ),
					'bar' => __( 'Bar', 'elementor-chart' ),
					'horizontalBar' => __( 'Horizontal Bar', 'elementor-chart' ),
					'pie' => __( 'Pie', 'elementor-chart' ),
					'doughnut' => __( 'Doughnut', 'elementor-chart' ),
					'polarArea' => __( 'Polar Area', 'elementor-chart' ),
				],
			]
		);

		$this->add_control(
			'chart_label_line',
			[
				'label' => __( 'Lable', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'elementor-chart' ),
				'condition' => [
					'chart_type' => 'line',
				]
			]
		);

		$this->add_control(
			'chart_label_bar',
			[
				'label' => __( 'Lable', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'elementor-chart' ),
				'condition' => [
					'chart_type' => 'bar',
				]
			]
		);

		$this->add_control(
			'chart_label_horizontalBar',
			[
				'label' => __( 'Lable', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'elementor-chart' ),
				'condition' => [
					'chart_type' => 'horizontalBar',
				]
			]
		);

		$this->add_control(
			'chart_label_pie',
			[
				'label' => __( 'Lable', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'elementor-chart' ),
				'condition' => [
					'chart_type' => 'pie',
				]
			]
		);

		$this->add_control(
			'chart_label_doughnut',
			[
				'label' => __( 'Lable', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'elementor-chart' ),
				'condition' => [
					'chart_type' => 'doughnut',
				]
			]
		);

		$this->add_control(
			'chart_label_polarArea',
			[
				'label' => __( 'Lable', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'elementor-chart' ),
				'condition' => [
					'chart_type' => 'polarArea',
				]
			]
		);
		
		
		$this->add_control(
			'background_color_line',
			[
				'label' => __( 'Background Color', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
                'condition' => [
					'chart_type' => 'line',
                ],
			]
		);

        $this->add_control(
			'border_color_line',
			[
				'label' => __( 'Border Color', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
					'chart_type' => 'line',
                ],
			]
		);

		$this->add_control(
			'pointRadius',
			[
				'label' => __( 'Point Radius', 'elementor-chart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'condition' => [
					'chart_type' => 'line',
                ],
			]
		);

		$this->add_control(
			'pointHoverRadius',
			[
				'label' => __( 'Point Hover Radius', 'elementor-chart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'condition' => [
					'chart_type' => 'line',
                ],
			]
		);

		$repeater_line = new \Elementor\repeater();
		
		$repeater_line->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'elementor-chart' ),
				'placeholder' => __( 'Type your title here', 'elementor-chart' ),
			]
		);

		$repeater_line->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_line->add_control(
			'point_background',
			[
				'label' => __( 'Point Background', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_line->add_control(
			'point_border',
			[
				'label' => __( 'Point Border Color', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'list_line',
			[
				'label' => __( 'Chart Sections', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'line',
                ],
				'fields' => $repeater_line->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'elementor-chart' ),
						'section_value' => 5,
						'point_background' => '#FF0000',
						'point_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'elementor-chart' ),
						'section_value' => 2,
						'point_background' => '#FFC100',
						'point_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'elementor-chart' ),
						'section_value' => 10,
						'point_background' => '#09FF5E',
						'point_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'elementor-chart' ),
						'section_value' => 15,
						'point_background' => '#8130F5',
						'point_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_bar = new \Elementor\repeater();
		
		$repeater_bar->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'elementor-chart' ),
				'placeholder' => __( 'Type your title here', 'elementor-chart' ),
			]
		);

		$repeater_bar->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_bar->add_control(
			'bar_background',
			[
				'label' => __( 'Bar Background', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_bar->add_control(
			'bar_border',
			[
				'label' => __( 'Bar Border Color', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_bar',
			[
				'label' => __( 'Chart Sections', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'bar',
                ],
				'fields' => $repeater_bar->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'elementor-chart' ),
						'section_value' => 5,
						'bar_background' => '#FF0000',
						'bar_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'elementor-chart' ),
						'section_value' => 2,
						'bar_background' => '#FFC100',
						'bar_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'elementor-chart' ),
						'section_value' => 10,
						'bar_background' => '#09FF5E',
						'bar_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'elementor-chart' ),
						'section_value' => 15,
						'bar_background' => '#8130F5',
						'bar_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_horizontalBar = new \Elementor\repeater();
		
		$repeater_horizontalBar->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'elementor-chart' ),
				'placeholder' => __( 'Type your title here', 'elementor-chart' ),
			]
		);

		$repeater_horizontalBar->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_horizontalBar->add_control(
			'bar_background',
			[
				'label' => __( 'Bar Background', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_horizontalBar->add_control(
			'bar_border',
			[
				'label' => __( 'Bar Border Color', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_horizontalBar',
			[
				'label' => __( 'Chart Sections', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'horizontalBar',
                ],
				'fields' => $repeater_horizontalBar->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'elementor-chart' ),
						'section_value' => 5,
						'bar_background' => '#FF0000',
						'bar_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'elementor-chart' ),
						'section_value' => 2,
						'bar_background' => '#FFC100',
						'bar_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'elementor-chart' ),
						'section_value' => 10,
						'bar_background' => '#09FF5E',
						'bar_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'elementor-chart' ),
						'section_value' => 15,
						'bar_background' => '#8130F5',
						'bar_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_pie = new \Elementor\repeater();
		
		$repeater_pie->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'elementor-chart' ),
				'placeholder' => __( 'Type your title here', 'elementor-chart' ),
			]
		);

		$repeater_pie->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_pie->add_control(
			'pie_background',
			[
				'label' => __( 'Pie Background', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_pie->add_control(
			'pie_border',
			[
				'label' => __( 'Pie Border Color', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_pie',
			[
				'label' => __( 'Chart Sections', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'pie',
                ],
				'fields' => $repeater_pie->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'elementor-chart' ),
						'section_value' => 5,
						'pie_background' => '#FF0000',
						'pie_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'elementor-chart' ),
						'section_value' => 2,
						'pie_background' => '#FFC100',
						'pie_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'elementor-chart' ),
						'section_value' => 10,
						'pie_background' => '#09FF5E',
						'pie_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'elementor-chart' ),
						'section_value' => 15,
						'pie_background' => '#8130F5',
						'pie_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_doughnut = new \Elementor\repeater();
		
		$repeater_doughnut->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'elementor-chart' ),
				'placeholder' => __( 'Type your title here', 'elementor-chart' ),
			]
		);

		$repeater_doughnut->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_doughnut->add_control(
			'doughnut_background',
			[
				'label' => __( 'Pie Background', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_doughnut->add_control(
			'doughnut_border',
			[
				'label' => __( 'Pie Border Color', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_doughnut',
			[
				'label' => __( 'Chart Sections', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'doughnut',
                ],
				'fields' => $repeater_doughnut->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'elementor-chart' ),
						'section_value' => 5,
						'doughnut_background' => '#FF0000',
						'doughnut_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'elementor-chart' ),
						'section_value' => 2,
						'doughnut_background' => '#FFC100',
						'doughnut_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'elementor-chart' ),
						'section_value' => 10,
						'doughnut_background' => '#09FF5E',
						'doughnut_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'elementor-chart' ),
						'section_value' => 15,
						'doughnut_background' => '#8130F5',
						'doughnut_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_polarArea = new \Elementor\repeater();
		
		$repeater_polarArea->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'elementor-chart' ),
				'placeholder' => __( 'Type your title here', 'elementor-chart' ),
			]
		);

		$repeater_polarArea->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);


		$repeater_polarArea->add_control(
			'polarArea_background',
			[
				'label' => __( 'Background', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_polarArea->add_control(
			'polarArea_border',
			[
				'label' => __( 'Border Color', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_polarArea',
			[
				'label' => __( 'Chart Sections', 'elementor-chart' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'polarArea',
                ],
				'fields' => $repeater_polarArea->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'elementor-chart' ),
						'section_value' => 5,
						'polarArea_background' => '#FF0000',
						'polarArea_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'elementor-chart' ),
						'section_value' => 2,
						'polarArea_background' => '#FFC100',
						'polarArea_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'elementor-chart' ),
						'section_value' => 10,
						'polarArea_background' => '#09FF5E',
						'polarArea_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'elementor-chart' ),
						'section_value' => 15,
						'polarArea_background' => '#8130F5',
						'polarArea_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);
		

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$id_gen = $this->generateRandomString();
		$chart_type = $settings['chart_type'];
		
		if ($chart_type == 'line') {
			$pointRadius = $settings['pointRadius']['size'];
			$pointHoverRadius = $settings['pointHoverRadius']['size'];
			$chart_label_line = $settings['chart_label_line'];
			$background_line = $settings['background_color_line'];
			$border_color_line = $settings['border_color_line'];
			foreach ($settings['list_line'] as $key => $value) {
				$pointer_color[] = $value['point_background'];
				$border_pointer[] = $value['point_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'bar') {
			$chart_label_bar = $settings['chart_label_bar'];
			foreach ($settings['list_bar'] as $key => $value) {
				$bar_background[] = $value['bar_background'];
				$bar_border[] = $value['bar_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'horizontalBar') {
			$chart_label_bar = $settings['chart_label_horizontalBar'];
			foreach ($settings['list_horizontalBar'] as $key => $value) {
				$bar_background[] = $value['bar_background'];
				$bar_border[] = $value['bar_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'pie') {
			$chart_label_pie = $settings['chart_label_pie'];
			foreach ($settings['list_pie'] as $key => $value) {
				$pie_background[] = $value['pie_background'];
				$pie_border[] = $value['pie_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'doughnut') {
			$chart_label_doughnut = $settings['chart_label_doughnut'];
			foreach ($settings['list_doughnut'] as $key => $value) {
				$doughnut_background[] = $value['doughnut_background'];
				$doughnut_border[] = $value['doughnut_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'polarArea') {
			$chart_label_polarArea = $settings['chart_label_polarArea'];
			foreach ($settings['list_polarArea'] as $key => $value) {
				$polarArea_background[] = $value['polarArea_background'];
				$polarArea_border[] = $value['polarArea_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		
		
		?>
		<canvas id='myChart-<?php echo $id_gen ?>'></canvas>
		<?php
		switch ($chart_type) {
			case 'line':
				?>
				<script>
				var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
				var chart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: <?php echo json_encode($title) ?>,
						datasets: [{
							label: '<?php echo $chart_label_line ?>',
							data: <?php echo json_encode($date) ?>,
							backgroundColor: '<?php echo $background_line ?>',
							borderColor: '<?php echo $border_color_line ?>',
							pointBackgroundColor: <?php echo json_encode($pointer_color) ?>,
							pointBorderColor: <?php echo json_encode($border_pointer) ?>,
							pointRadius: <?php echo $pointRadius ?>,
							pointHoverRadius: <?php echo $pointHoverRadius ?>,
						}]
					},

					options: {}
				});
				</script>				
				<?php
				break;
			case 'bar':
				?>
				<script>
				var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
				var chart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: <?php echo json_encode($title) ?>,
						datasets: [{
							label: '<?php echo $chart_label_bar ?>',
							data: <?php echo json_encode($date) ?>,
							backgroundColor: <?php echo json_encode($bar_background) ?>,
							borderColor: <?php echo json_encode($bar_border) ?>,
							/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
							hoverBackgroundColor: ,
							hoverBorderColor: ,
							hoverBorderWidth: ,*/
						}, 
						]
					},

					options: {}
				});
				</script>				
				<?php
				break;
			case 'horizontalBar':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'horizontalBar',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_bar ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($bar_background) ?>,
								borderColor: <?php echo json_encode($bar_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {}
					});
					</script>				
					<?php
				break;
			case 'pie':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'pie',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_pie ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($pie_background) ?>,
								borderColor: <?php echo json_encode($pie_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {}
					});
					</script>				
					<?php
				break;
			case 'doughnut':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'doughnut',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_doughnut ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($doughnut_background) ?>,
								borderColor: <?php echo json_encode($doughnut_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {}
					});
					</script>				
					<?php
				break;
			case 'doughnut':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'doughnut',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_doughnut ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($doughnut_background) ?>,
								borderColor: <?php echo json_encode($doughnut_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {}
					});
					</script>				
					<?php
				break;
			case 'polarArea':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'polarArea',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_polarArea ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($polarArea_background) ?>,
								borderColor: <?php echo json_encode($polarArea_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {}
					});
					</script>				
					<?php
				break;
		}
	}
}