<?php
/**
 * PricingTable class.
 * 
 * @category    Class
 * @package     SimplePricingTableElementor
 * @subpackage  WordPress
 * @author      Priyanshu <priyanshuchaudhary53@gmail.com>
 * @copyright   2023 Priyanshu
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @since       0.1.0
 * php version  7.4.1
 */

namespace SimplePricingTableElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * Elementor Pricing Table Widget.
 * 
 * Elementor widget that generates pricing table.
 * 
 * @since 0.1.0
 */
class PricingTable extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve Pricing Table widget name.
     *
     * @since 0.1.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'pricing_table';
    }

    /**
     * Get widget title.
     *
     * Retrieve Pricing Table widget title.
     *
     * @since 0.1.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Pricing Table', 'simple-pricing-table-elementor');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Pricing Table widget icon.
     *
     * @since 0.1.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-price-table';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Pricing Table widget belongs to.
     *
     * @since 0.1.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['pricing_table'];
    }

    /**
     * Get widget style dependencies.
     * 
     * Retrieve the list of style dependencies for the Pricing Table widget.
     * 
     * @since 0.1.0
     * @access public
     * @return array Widget styles.
     */
    public function get_style_depends()
    {
        return ['pricing-table-style'];
    }

    /**
     * Register Pricing Table widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 0.1.0
     * @access protected
     */
    protected function register_controls()
    {

        /**
         * Content Tab Controls
         * 
         */

        /**  Icon Section Start **/
        $this->start_controls_section(
            'icon_section',
            [
                'label' => __('Icon', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => __('Show Icon', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'main_icon',
            [
                'label' => __('Main Icon', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-bolt',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
        /**  Icon Section End **/


        /**  Content Section Start **/
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'package',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Package', 'simple-pricing-table-elementor'),
                'input_type' => 'text',
                'default' => __('Basic', 'simple-pricing-table-elementor'),
                'placeholder' => __('Package name', 'simple-pricing-table-elementor'),
            ]
        );

        $this->add_control(
            'package_description',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => __('Description', 'simple-pricing-table-elementor'),
                'rows' => 5,
                'default' => __('A single license. Perfect for freelance designers or developers.', 'simple-pricing-table-elementor'),
                'placeholder' => __('Type package description here', 'simple-pricing-table-elementor'),
            ]
        );

        $this->add_control(
            'package_price',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Price', 'simple-pricing-table-elementor'),
                'input' => 'text',
                'default' => __('$24', 'simple-pricing-table-elementor'),
                'placeholder' => __('Package price', 'simple-pricing-table-elementor'),
            ]
        );

        $this->add_control(
            'package_duration',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Duration', 'simple-pricing-table-elementor'),
                'options' => [
                    'monthly' => __('Monthly', 'simple-pricing-table-elementor'),
                    'yearly' => __('Yearly', 'simple-pricing-table-elementor'),
                    'lifetime' => __('Lifetime', 'simple-pricing-table-elementor'),
                ],
                'default' => 'monthly',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => __('Title', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Title', 'simple-pricing-table-elementor'),
                'placeholder' => __('Title', 'simple-pricing-table-elementor'),
            ]
        );

        $repeater->add_control(
            'item_description',
            [
                'label' => __('Description', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __('Description', 'simple-pricing-table-elementor'),
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => __('Icon', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'package_pros',
            [
                'label' => __('Pros', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => __('Unilimited viewers', 'simple-pricing-table-elementor'),
                        'item_description' => __('Easily customizable global styles', 'simple-pricing-table-elementor'),
                        'item_icon' => [
                            'value' => 'fas fa-eye',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'item_title' => __('Upto 2 editors', 'simple-pricing-table-elementor'),
                        'item_description' => __('Easily customizable global styles', 'simple-pricing-table-elementor'),
                        'item_icon' => [
                            'value' => 'fas fa-user-friends',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'item_title' => __('Upto 3 projects', 'simple-pricing-table-elementor'),
                        'item_description' => __('Easily customizable global styles', 'simple-pricing-table-elementor'),
                        'item_icon' => [
                            'value' => 'fas fa-code-branch',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();
        /**  Content Section End **/

        /**  Button Section Start **/
        $this->start_controls_section(
            'section_button',
            [
                'label' => __('Button', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Text', 'simple-pricing-table-elementor'),
                'input_type' => 'text',
                'default' => __('Get started', 'simple-pricing-table-elementor'),
                'placeholder' => __('Click here', 'simple-pricing-table-elementor'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'elementor'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
        /**  Button Section End **/


        /**
         * Style Tab Controls
         * 
         */

        /**  Style Section Start **/
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'container_full_width',
            [
                'label' => __('Full width', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __('Width', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1900,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 370,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'container_full_width!' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pricing_table_align',
            [
                'label' => __('Alignment', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .pte-pricing-table-container' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'container_full_width!' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'container_full_height',
            [
                'label' => __('Full Height', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'pricing_table_style',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Style', 'simple-pricing-table-elementor'),
                'options' => [
                    'style1' => __('Style 1', 'simple-pricing-table-elementor'),
                    'style2' => __('Style 2', 'simple-pricing-table-elementor'),
                    'style3' => __('Style 3', 'simple-pricing-table-elementor'),
                ],
                'default' => 'style1',
                'separator' => 'before',
            ],
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient', 'video'],
                'fields_options' => [
                    'background' => [
                        'frontend_available' => true,
                    ],
                    'image' => [
                        'background_lazyload' => [
                            'active' => true,
                            'keys' => ['background_image', 'url'],
                        ],
                    ],
                ],
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1',
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __('Padding', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();
        /**  Style Section End **/

        /**  Main Icon Section Start **/
        $this->start_controls_section(
            'main_icon_section',
            [
                'label' => __('Main Icon', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'main_icon_size',
            [
                'label' => __('Size', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                        'step' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'main_icon_color',
            [
                'label' => __('Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'main_icon_bg_color',
            [
                'label' => __('Background Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'main_icon_bg_width',
            [
                'label' => __('Width', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                        'step' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'main_icon_bg_height',
            [
                'label' => __('Height', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                        'step' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'main_icon_border_radius',
            [
                'label' => __('Border Radius', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'main_icon_box_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span',
            ]
        );

        $this->add_responsive_control(
            'main_icon_spacing',
            [
                'label' => __('Spacing', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        /**  Main Icon Section End **/

        /**  Package Section Start **/
        $this->start_controls_section(
            'package_section',
            [
                'label' => __('Package', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'package_color',
            [
                'label' => __('Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .package' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'package_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .package',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'package_text_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .package',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'package_text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .package'
            ]
        );

        $this->add_responsive_control(
            'package_spacing',
            [
                'label' => __('Spacing', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .package' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        /**  Package Section End **/

        /**  Description Section Start **/
        $this->start_controls_section(
            'description_section',
            [
                'label' => __('Description', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 > .description' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 > .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'description_text_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 > .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'description_text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 > .description'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __('Spacing', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 > .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        /**  Description Section End **/

        /**  Pricing Section Start **/
        $this->start_controls_section(
            'pricing_section',
            [
                'label' => __('Pricing', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pricing_color',
            [
                'label' => __('Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .pricing .price' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pricing_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .pricing .price',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'pricing_text_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .pricing .price',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'pricing_text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .pricing .price'
            ]
        );

        $this->add_responsive_control(
            'pricing_spacing',
            [
                'label' => __('Spacing', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .pricing' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_duration_options',
            [
                'label' => __('Duration', 'simple-pricing-table-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'duration_color',
            [
                'label' => __('Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .pricing .duration' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'duration_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .pricing .duration',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'duration_text_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .pricing .duration',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'duration_text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .pricing .duration'
            ]
        );

        $this->end_controls_section();
        /**  Pricing Section End **/

        /**  Features Section Start **/
        $this->start_controls_section(
            'features_section',
            [
                'label' => __('Features', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'features_border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .features',
            ]
        );

        $this->add_control(
            'features_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .features' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
        /**  Features Section End **/

        /**  Pros Section Start **/
        $this->start_controls_section(
            'pros_section',
            [
                'label' => __('Pros', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pros_gaping',
            [
                'label' => __('Space Between', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pros_icon_spacing',
            [
                'label' => __('Icon Spacing', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pros_icon_options',
            [
                'label' => __('Icon', 'simple-pricing-table-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'pros_icon_size',
            [
                'label' => __('Size', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                        'step' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .icon span' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pros_icon_color',
            [
                'label' => __('Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .icon span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pros_icon_bg_color',
            [
                'label' => __('Background Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .icon span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'pros_icon_bg_width',
            [
                'label' => __('Width', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                        'step' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .icon span' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pros_icon_bg_height',
            [
                'label' => __('Height', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                        'step' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .icon span' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pros_icon_border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .icon span',
            ]
        );

        $this->add_responsive_control(
            'pros_icon_border_radius',
            [
                'label' => __('Border Radius', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .icon span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pros_icon_box_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .icon span',
            ]
        );

        $this->add_control(
            'pros_title_options',
            [
                'label' => __('Title', 'simple-pricing-table-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pros_title_color',
            [
                'label' => __('Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .text .heading' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pros_title_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .text .heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'pros_title_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .text .heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'pros_title_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .text .heading'
            ]
        );

        $this->add_control(
            'pros_description_options',
            [
                'label' => __('Description', 'simple-pricing-table-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pros_description_color',
            [
                'label' => __('Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .text .description' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pros_description_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .text .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'pros_description_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .text .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'pros_description_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .included .item .text .description'
            ]
        );

        $this->end_controls_section();
        /**  Pros Section End **/

        /**  Button Section Start **/
        $this->start_controls_section(
            'button_section',
            [
                'label' => __('Button', 'simple-pricing-table-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_full_width',
            [
                'label' => __('Full width', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'button_align',
            [
                'label' => __('Alignment', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'button_full_width!' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-text',
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'simple-pricing-table-elementor')
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'simple-pricing-table-elementor')
            ]
        );

        $this->add_control(
            'buttonn_hover_color',
            [
                'label' => __('Text Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link:hover .button-text, {{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link:focus .button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background_hover',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link:hover, {{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link:focus',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link:hover, {{WRAPPER}} .pricing-table-elementor-widget.style-1 .button- .button-link:focus' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __('Hover Animation', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link',
            ]
        );

        $this->add_responsive_control(
            'button_text_padding',
            [
                'label' => __('Padding', 'simple-pricing-table-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .button-wrapper .button-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
        /**  Button Section End **/
    }

    /**
     * Render Pricing Table widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 0.1.0
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display(); ?>

        <?php

        $mainClasses = 'pte-pricing-table-container';

        if ($settings['container_full_height'] !== 'yes') {
            $mainClasses .= ' auto-height';
        }

        ?>

        <div class="<?php echo $mainClasses; ?>">

            <?php

            $innnerClasses = 'pricing-table-elementor-widget';

            $style = $settings['pricing_table_style'];

            if ($style === 'style1') {
                $innnerClasses .= ' style-1';
            }

            ?>

            <div class="<?php echo $innnerClasses; ?>">

                <?php if ($style === 'style1'): ?>

                    <?php if ($settings['show_icon'] === 'yes'): ?>
                        <div class="main-icon">
                            <span>
                                <?php Icons_Manager::render_icon($settings['main_icon'], ['aria-hidden' => 'true']); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <div class='package'>
                        <?php echo $settings['package']; ?>
                    </div>

                    <?php if ($settings['package_description']): ?>
                        <div class='description'>
                            <?php echo $settings['package_description'] ?>
                        </div>
                    <?php endif; ?>

                    <div class="pricing">
                        <span class="price">
                            <?php echo $settings['package_price']; ?>
                        </span>
                        <?php if ($settings['package_duration'] !== 'lifetime'): ?>
                            <span class="duration">
                                <?php
                                if ($settings['package_duration'] === 'monthly') {
                                    echo '/month';
                                } elseif ($settings['package_duration'] === 'yearly') {
                                    echo '/year';
                                }
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="features">
                        <?php if ($settings['package_pros']): ?>
                            <div class="included">
                                <?php foreach ($settings['package_pros'] as $item): ?>
                                    <div class="item">
                                        <div class="icon">
                                            <span>
                                                <?php Icons_Manager::render_icon($item['item_icon'], ['aria-hidden' => 'true']); ?>
                                            </span>
                                        </div>
                                        <div class="text">
                                            <div class="heading">
                                                <?php echo $item['item_title'] ?>
                                            </div>
                                            <div class="description">
                                                <?php echo $item['item_description'] ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($settings['button_text'] !== ''): ?>

                        <?php if (!empty($settings['button_link']['url'])) {
                            $this->add_link_attributes('button_link', $settings['button_link']);
                        }

                        $buttonClasses = 'button-wrapper';

                        if ($settings['button_full_width'] !== 'yes') {
                            $buttonClasses .= ' flex';
                        }

                        ?>
                        <div class="<?php echo $buttonClasses; ?>">

                            <?php
                            $btnLinkClass = 'button-link';
                            if ($settings['button_hover_animation']) {
                                $btnLinkClass .= ' elementor-animation-' . $settings['button_hover_animation'];
                            }

                            $this->add_render_attribute('button_class', 'class', $btnLinkClass);
                            ?>

                            <a <?php echo $this->get_render_attribute_string('button_link');
                            echo $this->get_render_attribute_string('button_class'); ?>>
                                <span class="button-text">
                                    <?php echo $settings['button_text']; ?>
                                </span>
                            </a>
                        </div>

                    <?php endif; ?>

                <?php endif; ?>


            </div>

        </div>

        <?php

    }

    /**
     * Render list widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 0.1.0
     * @access protected
     */
    protected function content_template()
    {

        ?>

        <# var main_classes='pte-pricing-table-container' ; #>

            <# if (settings.container_full_height!=='yes' ) { main_classes +=' auto-height' ; } #>

                <div class="{{main_classes}}">

                    <# var inner_classes="pricing-table-elementor-widget" , iconsHTML={}; #>

                        <# if(settings.pricing_table_style==='style1' ) { inner_classes +=' style-1' ; } #>

                            <div class="{{inner_classes}}">

                                <# if(settings.pricing_table_style==='style1' ) { #>

                                    <# if(settings.show_icon==='yes' ) { #>
                                        <# var mainIcon=elementor.helpers.renderIcon( view, settings.main_icon, { 'aria-hidden'
                                            : true }, 'i' , 'object' ); #>
                                            <div class="main-icon"><span>{{{mainIcon.value}}}</span></div>
                                            <# } #>

                                                <div class='package'>{{{settings.package}}}</div>

                                                <# if (settings.package_description) { #>
                                                    <div class='description'>{{{settings.package_description}}}</div>
                                                    <# } #>

                                                        <div class="pricing">
                                                            <span class="price">{{{settings.package_price}}}</span>
                                                            <# if (settings.package_duration !=='lifetime' ) { if
                                                                (settings.package_duration==='monthly' ) { var
                                                                duration_text='/month' }else { duration_text='/year' } #>
                                                                <span class="duration">{{{duration_text}}}</span>
                                                                <# } #>
                                                        </div>

                                                        <div class="features">

                                                            <# if (settings.package_pros) { #>
                                                                <div class="included">
                                                                    <# _.each(settings.package_pros, function(item, index) { #>
                                                                        <div class="item">
                                                                            <# if ( item.icon || item.item_icon.value ) { #>
                                                                                <# iconsHTML[ index
                                                                                    ]=elementor.helpers.renderIcon( view,
                                                                                    item.item_icon, { 'aria-hidden' : true
                                                                                    }, 'i' , 'object' ); #>
                                                                                    <div class="icon"><span>{{{iconsHTML[ index
                                                                                            ].value}}}</span>
                                                                                    </div>
                                                                                    <# } #>
                                                                                        <div class="text">
                                                                                            <div class="heading">
                                                                                                {{{item.item_title}}}
                                                                                            </div>
                                                                                            <div class="description">
                                                                                                {{{item.item_description}}}
                                                                                            </div>
                                                                                        </div>
                                                                        </div>
                                                                        <# } ); #>
                                                                </div>
                                                                <# } #>

                                                                    <# } #>

                                                        </div>

                                                        <# if(settings.button_text !=='' ) { #>
                                                            <# var button_classes='button-wrapper' ; #>
                                                                <# if(settings.button_full_width !=='yes' ) { button_classes
                                                                    +=' flex' ; } #>
                                                                    <div class="{{button_classes}}">

                                                                        <# var btn_link_class='button-link' ; #>
                                                                            <# if(settings.button_hover_animation !=='' ) {
                                                                                btn_link_class +=' elementor-animation-' +
                                                                                settings.button_hover_animation; }
                                                                                view.addRenderAttribute( 'button_class' ,
                                                                                { 'class' : btn_link_class } ); #>
                                                                                <a href="{{settings.button_link.url}}" {{{
                                                                                    view.getRenderAttributeString( 'button_class'
                                                                                    ) }}}>
                                                                                    <span class="button-text">
                                                                                        {{{settings.button_text}}}
                                                                                    </span>
                                                                                </a>
                                                                    </div>
                                                                    <# } #>
                            </div>

                </div>
                <?php

    }
}