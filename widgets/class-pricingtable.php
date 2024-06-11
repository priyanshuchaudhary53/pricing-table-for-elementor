<?php
/**
 * PricingTable class.
 * 
 * @category    Class
 * @package     SimplePricingTableElementor
 * @subpackage  WordPress
 * @author      Priyanshu <contact@priyanshuc.dev>
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
        return __('Pricing Table', 'simple-pricing-table-for-elementor');
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

        /**  Badge Section Start **/
        $this->start_controls_section(
            'badge_section',
            [
                'label' => __('Badge', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => __('Show Badge', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Badge Text', 'simple-pricing-table-for-elementor'),
                'input_type' => 'text',
                'default' => __('Most popular', 'simple-pricing-table-for-elementor'),
                'condition' => [
                    'show_badge' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        /**  Badge Section End **/

        /**  Icon Section Start **/
        $this->start_controls_section(
            'icon_section',
            [
                'label' => __('Icon', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'pricing_table_style' => 'style1'
                ]
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => __('Show Icon', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'main_icon',
            [
                'label' => __('Main Icon', 'simple-pricing-table-for-elementor'),
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
                'label' => __('Content', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'package',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Package', 'simple-pricing-table-for-elementor'),
                'input_type' => 'text',
                'default' => __('Basic', 'simple-pricing-table-for-elementor'),
                'placeholder' => __('Package name', 'simple-pricing-table-for-elementor'),
            ]
        );

        $this->add_control(
            'package_description',
            [
                'type' => Controls_Manager::WYSIWYG,
                'label' => __('Description', 'simple-pricing-table-for-elementor'),
                'default' => __('A single license. Perfect for freelance designers or developers.', 'simple-pricing-table-for-elementor'),
                'placeholder' => __('Type package description here', 'simple-pricing-table-for-elementor'),
            ]
        );

        $this->add_control(
            'package_price',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Price', 'simple-pricing-table-for-elementor'),
                'input' => 'text',
                'default' => __('$24', 'simple-pricing-table-for-elementor'),
                'placeholder' => __('Package price', 'simple-pricing-table-for-elementor'),
            ]
        );

        $this->add_control(
            'package_duration',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Duration', 'simple-pricing-table-for-elementor'),
                'options' => [
                    'monthly' => __('Monthly', 'simple-pricing-table-for-elementor'),
                    'yearly' => __('Yearly', 'simple-pricing-table-for-elementor'),
                    'lifetime' => __('Lifetime', 'simple-pricing-table-for-elementor'),
                    'custom' => __('Custom', 'simple-pricing-table-for-elementor'),
                ],
                'default' => 'monthly',
            ]
        );

        $this->add_control(
            'package_duration_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Custom Duration', 'simple-pricing-table-for-elementor'),
                'input' => 'text',
                'label_block' => true,
                'placeholder' => __('Package custom duration', 'simple-pricing-table-for-elementor'),
                'condition' => [
                    'package_duration' => 'custom'
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => __('Title', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Title', 'simple-pricing-table-for-elementor'),
                'placeholder' => __('Title', 'simple-pricing-table-for-elementor'),
            ]
        );

        $repeater->add_control(
            'item_description',
            [
                'label' => __('Description', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::WYSIWYG,
                'rows' => 5,
                'default' => __('Description', 'simple-pricing-table-for-elementor'),
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => __('Icon', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'package_pros',
            [
                'label' => __('Pros', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => __('Unilimited viewers', 'simple-pricing-table-for-elementor'),
                        'item_description' => __('Easily customizable global styles', 'simple-pricing-table-for-elementor'),
                        'item_icon' => [
                            'value' => 'fas fa-eye',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'item_title' => __('Upto 2 editors', 'simple-pricing-table-for-elementor'),
                        'item_description' => __('Easily customizable global styles', 'simple-pricing-table-for-elementor'),
                        'item_icon' => [
                            'value' => 'fas fa-user-friends',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'item_title' => __('Upto 3 projects', 'simple-pricing-table-for-elementor'),
                        'item_description' => __('Easily customizable global styles', 'simple-pricing-table-for-elementor'),
                        'item_icon' => [
                            'value' => 'fas fa-code-branch',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->add_control(
            'package_cons',
            [
                'label' => __('Cons', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'item_title' => __('Automated voicemails', 'simple-pricing-table-for-elementor'),
                        'item_description' => __('Easily customizable global styles', 'simple-pricing-table-for-elementor'),
                        'item_icon' => [
                            'value' => 'fas fa-voicemail',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'item_title' => __('Marketing automation', 'simple-pricing-table-for-elementor'),
                        'item_description' => __('Easily customizable global styles', 'simple-pricing-table-for-elementor'),
                        'item_icon' => [
                            'value' => 'fas fa-funnel-dollar',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
                'condition' => [
                    'pricing_table_style' => 'style3'
                ],
            ]
        );

        $this->end_controls_section();
        /**  Content Section End **/

        /**  Button Section Start **/
        $this->start_controls_section(
            'section_button',
            [
                'label' => __('Button', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Text', 'simple-pricing-table-for-elementor'),
                'input_type' => 'text',
                'default' => __('Get started', 'simple-pricing-table-for-elementor'),
                'placeholder' => __('Click here', 'simple-pricing-table-for-elementor'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'dynamic' => [
                    'active' => true,
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
                'label' => __('Style', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'container_full_width',
            [
                'label' => __('Full width', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __('Width', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'container_full_width!' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pricing_table_align',
            [
                'label' => __('Alignment', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'simple-pricing-table-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'simple-pricing-table-for-elementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'simple-pricing-table-for-elementor'),
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
                'label' => __('Full Height', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'pricing_table_style',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Style', 'simple-pricing-table-for-elementor'),
                'options' => [
                    'style1' => __('Style 1', 'simple-pricing-table-for-elementor'),
                    'style2' => __('Style 2', 'simple-pricing-table-for-elementor'),
                    'style3' => __('Style 3', 'simple-pricing-table-for-elementor'),
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
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget',
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __('Padding', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-3 .inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .badge' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();
        /**  Style Section End **/

        /**  Badge Section Start **/
        $this->start_controls_section(
            'badge_style_section',
            [
                'label' => __('Badge', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_badge' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'badge_text_color',
            [
                'label' => __('Text Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .badge' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => __('Background Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .badge' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-3 .badge-wrapper' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'badge_text_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'badge_text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .badge'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .badge',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => __('Border Radius', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .badge',
            ]
        );

        $this->add_control(
            'badge_padding',
            [
                'label' => esc_html__('Padding', 'simple-pricing-table-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        /**  Badge Section End **/

        /**  Main Icon Section Start **/
        $this->start_controls_section(
            'main_icon_section',
            [
                'label' => __('Main Icon', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon' => 'yes',
                    'pricing_table_style' => 'style1'
                ]
            ]
        );

        $this->add_responsive_control(
            'main_icon_size',
            [
                'label' => __('Size', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span svg' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'main_icon_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'main_icon_bg_color',
            [
                'label' => __('Background Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget.style-1 .main-icon span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'main_icon_bg_width',
            [
                'label' => __('Width', 'simple-pricing-table-for-elementor'),
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
                'label' => __('Height', 'simple-pricing-table-for-elementor'),
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
                'label' => __('Border Radius', 'simple-pricing-table-for-elementor'),
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
                'label' => __('Bottom Margin', 'simple-pricing-table-for-elementor'),
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
                'label' => __('Package', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'package_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .package' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'package_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .package',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'package_text_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .package',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'package_text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .package'
            ]
        );

        $this->add_responsive_control(
            'package_spacing',
            [
                'label' => __('Bottom Margin', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .package' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        /**  Package Section End **/

        /**  Description Section Start **/
        $this->start_controls_section(
            'description_section',
            [
                'label' => __('Description', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget > .description' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .pricing-table-elementor-widget .inner-wrapper > .description' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget > .description',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .inner-wrapper > .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'description_text_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget > .description',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .inner-wrapper > .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'description_text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget > .description',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .inner-wrapper > .description',
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __('Bottom Margin', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget > .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-table-elementor-widget .inner-wrapper > .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        /**  Description Section End **/

        /**  Pricing Section Start **/
        $this->start_controls_section(
            'pricing_section',
            [
                'label' => __('Pricing', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pricing_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .pricing .price' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pricing_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .pricing .price',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'pricing_text_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .pricing .price',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'pricing_text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .pricing .price'
            ]
        );

        $this->add_responsive_control(
            'pricing_spacing',
            [
                'label' => __('Bottom Margin', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .pricing' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_duration_options',
            [
                'label' => __('Duration', 'simple-pricing-table-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'duration_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .pricing .duration' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'duration_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .pricing .duration',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'duration_text_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .pricing .duration',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'duration_text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .pricing .duration'
            ]
        );

        $this->end_controls_section();
        /**  Pricing Section End **/

        /**  Features Section Start **/
        $this->start_controls_section(
            'features_section',
            [
                'label' => __('Features', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'features_border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .features',
            ]
        );

        $this->add_control(
            'features_padding',
            [
                'label' => esc_html__('Padding', 'simple-pricing-table-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .features' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
        /**  Features Section End **/

        /**  Pros Section Start **/
        $this->start_controls_section(
            'pros_section',
            [
                'label' => __('Pros', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pros_gaping',
            [
                'label' => __('Space Between', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .included' => 'gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'pros_icon_spacing',
            [
                'label' => __('Icon Spacing', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pros_icon_options',
            [
                'label' => __('Icon', 'simple-pricing-table-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'pros_icon_size',
            [
                'label' => __('Size', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item .icon span' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item .icon span svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pros_icon_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item .icon span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pros_icon_bg_color',
            [
                'label' => __('Background Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item .icon span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'pros_icon_bg_width',
            [
                'label' => __('Width', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item .icon span' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pros_icon_bg_height',
            [
                'label' => __('Height', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item .icon span' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pros_icon_border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .included .item .icon span',
            ]
        );

        $this->add_responsive_control(
            'pros_icon_border_radius',
            [
                'label' => __('Border Radius', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item .icon span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pros_icon_box_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .included .item .icon span',
            ]
        );

        $this->add_control(
            'pros_title_options',
            [
                'label' => __('Title', 'simple-pricing-table-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pros_title_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item .text .heading' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pros_title_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .included .item .text .heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'pros_title_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .included .item .text .heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'pros_title_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .included .item .text .heading'
            ]
        );

        $this->add_control(
            'pros_description_options',
            [
                'label' => __('Description', 'simple-pricing-table-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pros_description_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .included .item .text .description' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pros_description_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .included .item .text .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'pros_description_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .included .item .text .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'pros_description_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .included .item .text .description'
            ]
        );

        $this->end_controls_section();
        /**  Pros Section End **/

        /**  Cons Section Start **/
        $this->start_controls_section(
            'cons_section',
            [
                'label' => __('Cons', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pricing_table_style' => 'style3'
                ],
            ]
        );

        $this->add_responsive_control(
            'cons_gaping',
            [
                'label' => __('Space Between', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cons_icon_spacing',
            [
                'label' => __('Icon Spacing', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cons_icon_options',
            [
                'label' => __('Icon', 'simple-pricing-table-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'cons_icon_size',
            [
                'label' => __('Size', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .icon span' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .icon span svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cons_icon_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .icon span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cons_icon_bg_color',
            [
                'label' => __('Background Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .icon span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'cons_icon_bg_width',
            [
                'label' => __('Width', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .icon span' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cons_icon_bg_height',
            [
                'label' => __('Height', 'simple-pricing-table-for-elementor'),
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
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .icon span' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cons_icon_border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .icon span',
            ]
        );

        $this->add_responsive_control(
            'cons_icon_border_radius',
            [
                'label' => __('Border Radius', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .icon span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cons_icon_box_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .icon span',
            ]
        );

        $this->add_control(
            'cons_title_options',
            [
                'label' => __('Title', 'simple-pricing-table-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'cons_title_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .text .heading' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cons_title_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .text .heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'cons_title_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .text .heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'cons_title_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .text .heading'
            ]
        );

        $this->add_control(
            'cons_description_options',
            [
                'label' => __('Description', 'simple-pricing-table-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'cons_description_color',
            [
                'label' => __('Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .text .description' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cons_description_typography',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .text .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'cons_description_stroke',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .text .description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'cons_description_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .excluded .item .text .description'
            ]
        );

        $this->end_controls_section();
        /**  Pros Section End **/

        /**  Button Section Start **/
        $this->start_controls_section(
            'button_section',
            [
                'label' => __('Button', 'simple-pricing-table-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_full_width',
            [
                'label' => __('Full width', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'button_align',
            [
                'label' => __('Alignment', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'simple-pricing-table-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'simple-pricing-table-for-elementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'simple-pricing-table-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper' => 'justify-content: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-text',
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'simple-pricing-table-for-elementor')
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link',
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
                'label' => __('Hover', 'simple-pricing-table-for-elementor')
            ]
        );

        $this->add_control(
            'buttonn_hover_color',
            [
                'label' => __('Text Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link:hover .button-text, {{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link:focus .button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background_hover',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link:hover, {{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link:focus',
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
                'label' => __('Border Color', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link:hover, {{WRAPPER}} .pricing-table-elementor-widget .button- .button-link:focus' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __('Hover Animation', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link',
            ]
        );

        $this->add_responsive_control(
            'button_text_padding',
            [
                'label' => __('Padding', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __('Top Margin', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin_bottom',
            [
                'label' => __('Bottom Margin', 'simple-pricing-table-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-elementor-widget .button-wrapper .button-link' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
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

        if ($settings['container_full_height'] == 'yes') {
            $mainClasses .= ' full-height';
        }

        ?>

        <div class="<?php echo esc_attr($mainClasses); ?>">

            <?php

            $innnerClasses = 'pricing-table-elementor-widget';

            $style = $settings['pricing_table_style'];

            switch ($style) {
                case 'style1':
                    $innnerClasses .= ' style-1';
                    break;
                case 'style2':
                    $innnerClasses .= ' style-2';
                    break;
                case 'style3':
                    $innnerClasses .= ' style-3';
                    break;
                default:
                    break;
            }

            ?>

            <div class="<?php echo esc_attr($innnerClasses); ?>">

                <?php if ($style === 'style1'): ?>

                    <?php if ($settings['show_badge'] === 'yes' && $settings['badge_text'] !== ''): ?>
                        <div class="badge">
                            <?php echo esc_html($settings['badge_text']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($settings['show_icon'] === 'yes'): ?>
                        <div class="main-icon">
                            <span>
                                <?php Icons_Manager::render_icon($settings['main_icon'], ['aria-hidden' => 'true']); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <div class='package'>
                        <?php echo esc_html($settings['package']); ?>
                    </div>

                    <?php if ($settings['package_description']): ?>
                        <div class='description'>
                            <?php echo wp_kses_post($settings['package_description']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="pricing">
                        <span class="price">
                            <?php echo esc_html($settings['package_price']); ?>
                        </span>
                        <?php if ($settings['package_duration'] !== 'lifetime'): ?>
                            <span class="duration">
                                <?php
                                if ($settings['package_duration'] === 'monthly') {
                                    echo esc_html('/month');
                                } elseif ($settings['package_duration'] === 'yearly') {
                                    echo esc_html('/year');
                                } elseif ($settings['package_duration'] === 'custom') {
                                    echo esc_html($settings['package_duration_text']);
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
                                        <?php if ($item['item_icon']['value']) : ?>
                                            <div class="icon">
                                                <span>
                                                    <?php Icons_Manager::render_icon($item['item_icon'], ['aria-hidden' => 'true']); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="text">
                                            <div class="heading">
                                                <?php echo esc_html($item['item_title']); ?>
                                            </div>
                                            <div class="description">
                                                <?php echo wp_kses_post($item['item_description']); ?>
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
                        <div class="<?php echo esc_attr($buttonClasses); ?>">

                            <?php
                            $btnLinkClass = 'button-link';
                            if ($settings['button_hover_animation']) {
                                $btnLinkClass .= ' elementor-animation-' . $settings['button_hover_animation'];
                            }

                            $this->add_render_attribute('button_class', 'class', $btnLinkClass);
                            ?>

                            <a <?php echo wp_kses_data($this->get_render_attribute_string('button_link'));
                            echo wp_kses_data($this->get_render_attribute_string('button_class')); ?>>
                                <span class="button-text">
                                    <?php echo esc_html($settings['button_text']); ?>
                                </span>
                            </a>
                        </div>

                    <?php endif; ?>

                <?php endif; ?>

                <?php if ($style === 'style2'): ?>

                    <?php if ($settings['show_badge'] === 'yes' && $settings['badge_text'] !== ''): ?>
                        <div class="badge-wrapper">
                            <div class="badge">
                                <?php echo esc_html($settings['badge_text']); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class='package'>
                        <?php echo esc_html($settings['package']); ?>
                    </div>

                    <div class="pricing">
                        <span class="price">
                            <?php echo esc_html($settings['package_price']); ?>
                        </span>
                        <?php if ($settings['package_duration'] !== 'lifetime'): ?>
                            <span class="duration">
                                <?php
                                if ($settings['package_duration'] === 'monthly') {
                                    echo esc_html('/month');
                                } elseif ($settings['package_duration'] === 'yearly') {
                                    echo esc_html('/year');
                                } elseif ($settings['package_duration'] === 'custom') {
                                    echo esc_html($settings['package_duration_text']);
                                }
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php if ($settings['package_description']): ?>
                        <div class='description'>
                            <?php echo wp_kses_post($settings['package_description']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="features">
                        <?php if ($settings['package_pros']): ?>
                            <div class="included">
                                <?php foreach ($settings['package_pros'] as $item): ?>
                                    <div class="item">
                                        <?php if ($item['item_icon']['value']) : ?> 
                                            <div class="icon">
                                                <span>
                                                    <?php Icons_Manager::render_icon($item['item_icon'], ['aria-hidden' => 'true']); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="text">
                                            <div class="heading">
                                                <?php echo esc_html($item['item_title']); ?>
                                            </div>
                                            <div class="description">
                                                <?php echo wp_kses_post($item['item_description']); ?>
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
                        <div class="<?php echo esc_attr($buttonClasses); ?>">

                            <?php
                            $btnLinkClass = 'button-link';
                            if ($settings['button_hover_animation']) {
                                $btnLinkClass .= ' elementor-animation-' . $settings['button_hover_animation'];
                            }

                            $this->add_render_attribute('button_class', 'class', $btnLinkClass);
                            ?>

                            <a <?php echo wp_kses_data($this->get_render_attribute_string('button_link'));
                            echo wp_kses_data($this->get_render_attribute_string('button_class')); ?>>
                                <span class="button-text">
                                    <?php echo esc_html($settings['button_text']); ?>
                                </span>
                            </a>
                        </div>

                    <?php endif; ?>

                <?php endif; ?>

                <?php if ($style === 'style3'): ?>

                    <?php if ($settings['show_badge']): ?>
                        <div class="badge-wrapper">
                            <?php if($settings['badge_text'] !== ''): ?>
                                <div class="badge">
                                    <?php echo esc_html($settings['badge_text']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="inner-wrapper">
                        
                        <div class="package">
                            <?php echo esc_html($settings['package']); ?>
                        </div>

                        <?php if ($settings['package_description']): ?>
                            <div class="description">
                                <?php echo wp_kses_post($settings['package_description']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="pricing">
                            <span class="price">
                                <?php echo esc_html($settings['package_price']); ?>
                            </span>
                            <?php if ($settings['package_duration'] !== 'lifetime'): ?>
                                <span class="duration">
                                    <?php
                                    if ($settings['package_duration'] === 'monthly') {
                                        echo esc_html('/month');
                                    } elseif ($settings['package_duration'] === 'yearly') {
                                        echo esc_html('/year');
                                    } elseif ($settings['package_duration'] === 'custom') {
                                        echo esc_html($settings['package_duration_text']);
                                    }
                                    ?>
                                </span>
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
                            <div class="<?php echo esc_attr($buttonClasses); ?>">

                                <?php
                                $btnLinkClass = 'button-link';
                                if ($settings['button_hover_animation']) {
                                    $btnLinkClass .= ' elementor-animation-' . $settings['button_hover_animation'];
                                }

                                $this->add_render_attribute('button_class', 'class', $btnLinkClass);
                                ?>

                                <a <?php echo wp_kses_data($this->get_render_attribute_string('button_link'));
                                echo wp_kses_data($this->get_render_attribute_string('button_class')); ?>>
                                    <span class="button-text">
                                        <?php echo esc_html($settings['button_text']); ?>
                                    </span>
                                </a>
                            </div>

                        <?php endif; ?>

                        <div class="features">
                            
                            <?php if ($settings['package_pros']): ?>
                                <div class="included">
                                    <?php foreach ($settings['package_pros'] as $item): ?>
                                        <div class="item">
                                            <?php if ($item['item_icon']['value']) : ?>
                                                <div class="icon">
                                                    <span>
                                                        <?php Icons_Manager::render_icon($item['item_icon'], ['aria-hidden' => 'true']); ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="text">
                                                <div class="heading">
                                                    <?php echo esc_html($item['item_title']); ?>
                                                </div>
                                                <div class="description">
                                                    <?php echo wp_kses_post($item['item_description']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($settings['package_cons']): ?>
                                <div class="excluded">
                                    <?php foreach ($settings['package_cons'] as $item): ?>
                                        <div class="item">
                                            <?php if ($item['item_icon']['value']) : ?>
                                                <div class="icon">
                                                    <span>
                                                        <?php Icons_Manager::render_icon($item['item_icon'], ['aria-hidden' => 'true']); ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="text">
                                                <div class="heading">
                                                    <?php echo esc_html($item['item_title']); ?>
                                                </div>
                                                <div class="description">
                                                    <?php echo wp_kses_post($item['item_description']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>

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

            <# if (settings.container_full_height==='yes' ) { main_classes +=' full-height' ; } #>

                <div class="{{main_classes}}">

                    <# var inner_classes="pricing-table-elementor-widget" , iconsHTML={}; #>

                        <# if(settings.pricing_table_style==='style1' ) { 
                            inner_classes +=' style-1' ; 
                        } else if (settings.pricing_table_style==='style2' ) {
                            inner_classes +=' style-2' ;
                        } else if (settings.pricing_table_style==='style3') {
                            inner_classes +=' style-3' ;
                        }#>

                        <div class="{{inner_classes}}">

                            <# if(settings.pricing_table_style==='style1' ) { #>

                                <# if (settings.show_badge==='yes' && settings.badge_text !=='' ) { #>
                                    <div class="badge">
                                        {{{settings.badge_text}}}
                                    </div>
                                <# } #>

                                <# if(settings.show_icon==='yes' ) { #>
                                    <# var mainIcon=elementor.helpers.renderIcon( view, settings.main_icon, { 'aria-hidden' : true }, 'i' , 'object' ); #>
                                    <div class="main-icon"><span>{{{mainIcon.value}}}</span></div>
                                <# } #>

                                <div class='package'>{{{settings.package}}}</div>

                                <# if (settings.package_description) { #>
                                    <div class='description'>{{{settings.package_description}}}</div>
                                <# } #>

                                <div class="pricing">
                                    <span class="price">{{{settings.package_price}}}</span>
                                    <# if (settings.package_duration !=='lifetime') { 
                                        var duration_text;
                                        if (settings.package_duration==='monthly' ) { 
                                            duration_text='/month' 
                                        } else if (settings.package_duration==='yearly') { 
                                            duration_text='/year' 
                                        } else if (settings.package_duration==='custom') {
                                            duration_text=settings.package_duration_text
                                        }
                                    #>
                                    <span class="duration">{{{duration_text}}}</span>
                                    <# } #>
                                </div>

                                <div class="features">

                                    <# if (settings.package_pros) { #>
                                        <div class="included">
                                            <# _.each(settings.package_pros, function(item, index) { #>
                                                <div class="item">
                                                    <# if ( item.icon || item.item_icon.value ) { #>
                                                        <# iconsHTML[ index ]=elementor.helpers.renderIcon( view, item.item_icon, { 'aria-hidden' : true }, 'i', 'object' ); #>
                                                        <div class="icon">
                                                            <span>{{{iconsHTML[ index ].value}}}</span>
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

                                </div>

                                <# if(settings.button_text !=='' ) { #>
                                    <# var button_classes='button-wrapper' ; #>
                                    <# if(settings.button_full_width !=='yes' ) {
                                        button_classes +=' flex' ; 
                                    } #>
                                    <div class="{{button_classes}}">

                                        <# var btn_link_class='button-link' ;
                                        if(settings.button_hover_animation !=='') { 
                                            btn_link_class +=' elementor-animation-' + settings.button_hover_animation; 
                                        }
                                        view.addRenderAttribute( 'button_class', { 'class' : btn_link_class } ); #>
                                        <a href="{{settings.button_link.url}}" {{{ view.getRenderAttributeString( 'button_class') }}}>
                                            <span class="button-text">
                                                {{{settings.button_text}}}
                                            </span>
                                        </a>
                                    </div>
                                <# } #>
                                
                            <# } #>

                            <# if(settings.pricing_table_style==='style2') { #>

                                <# if (settings.show_badge==='yes' && settings.badge_text !=='' ) { #>
                                    <div class="badge-wrapper">
                                        <div class="badge">
                                            {{{settings.badge_text}}}
                                        </div>
                                    </div>
                                <# } #>

                                <div class='package'>
                                    {{{settings.package}}}
                                </div>

                                <div class="pricing">
                                    <span class="price">{{{settings.package_price}}}</span>
                                    <# if (settings.package_duration !=='lifetime') { 
                                        if (settings.package_duration==='monthly') { 
                                            var duration_text='/month'
                                        } else if (settings.package_duration==='yearly') { 
                                            duration_text='/year' 
                                        } else if (settings.package_duration==='custom') {
                                            duration_text=settings.package_duration_text
                                        }
                                        #>
                                        <span class="duration">{{{duration_text}}}</span>
                                    <# } #>
                                </div>

                                <# if (settings.package_description) { #>
                                    <div class='description'>
                                        {{{settings.package_description}}}
                                    </div>
                                <# } #>

                                <div class="features">

                                    <# if (settings.package_pros) { #>
                                        <div class="included">
                                            <# _.each(settings.package_pros, function(item, index) { #>
                                                <div class="item">
                                                    <# if (item.icon || item.item_icon.value) { 
                                                        iconsHTML[index]=elementor.helpers.renderIcon(view, item.item_icon, { 'aria-hidden':true }, 'i', 'object');#>
                                                        <div
                                                            class="icon">
                                                            <span>{{{iconsHTML[
                                                                index
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

                                </div>

                                <# if(settings.button_text !== '' ) {
                                    var button_classes='button-wrapper';
                                    if(settings.button_full_width !== 'yes' ) {
                                        button_classes +=' flex' ;
                                    } #>
                                    <div class="{{button_classes}}">

                                        <# var btn_link_class='button-link';
                                        if(settings.button_hover_animation !== '') {
                                            btn_link_class +=' elementor-animation-' + settings.button_hover_animation;
                                        }
                                        view.addRenderAttribute( 'button_class', { 'class' : btn_link_class } ); #>
                                        <a href="{{settings.button_link.url}}" {{{ view.getRenderAttributeString( 'button_class' ) }}}>
                                            <span class="button-text">
                                                {{{settings.button_text}}}
                                            </span>
                                        </a>
                                    </div>
                                <# } #>

                            <# } #>

                            <# if(settings.pricing_table_style==='style3') { #>
                            
                                <# if(settings.show_badge==='yes') { #>
                                    <div class="badge-wrapper">
                                        <# if(settings.badge_text !=='') { #>
                                            <div class="badge">
                                                {{{settings.badge_text}}}
                                            </div>
                                        <# } #>
                                    </div>
                                <# } #>

                                <div class="inner-wrapper">
                                    
                                    <div class="package">
                                        {{{settings.package}}}
                                    </div>

                                    <# if (settings.package_description) { #>
                                        <div class='description'>
                                            {{{settings.package_description}}}
                                        </div>
                                    <# } #>

                                    <div class="pricing">
                                        <span class="price">{{{settings.package_price}}}</span>
                                        <# if (settings.package_duration !== 'lifetime') { 
                                            if (settings.package_duration==='monthly' ) { 
                                                var duration_text='/month' 
                                            } else if (settings.package_duration==='yearly') { 
                                                duration_text='/year' 
                                            } else if (settings.package_duration==='custom') {
                                                duration_text=settings.package_duration_text
                                            }
                                        #>
                                        <span class="duration">{{{duration_text}}}</span>
                                        <# } #>
                                    </div>

                                    <# if(settings.button_text !=='' ) { #>
                                        <# var button_classes='button-wrapper' ; #>
                                        <# if(settings.button_full_width !=='yes' ) {
                                            button_classes +=' flex' ; 
                                        } #>
                                        <div class="{{button_classes}}">

                                            <# var btn_link_class='button-link' ;
                                            if(settings.button_hover_animation !=='') { 
                                                btn_link_class +=' elementor-animation-' + settings.button_hover_animation; 
                                            }
                                            view.addRenderAttribute( 'button_class', { 'class' : btn_link_class } ); #>
                                            <a href="{{settings.button_link.url}}" {{{ view.getRenderAttributeString( 'button_class') }}}>
                                                <span class="button-text">
                                                    {{{settings.button_text}}}
                                                </span>
                                            </a>
                                        </div>
                                    <# } #>

                                    <div class="features">

                                        <# if (settings.package_pros) { #>
                                            <div class="included">
                                                <# _.each(settings.package_pros, function(item, index) { #>
                                                    <div class="item">
                                                        <# if (item.icon || item.item_icon.value) { 
                                                            iconsHTML[index]=elementor.helpers.renderIcon(view, item.item_icon, { 'aria-hidden':true }, 'i', 'object');#>
                                                            <div
                                                                class="icon">
                                                                <span>{{{iconsHTML[
                                                                    index
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

                                        <# if (settings.package_cons) { #>
                                            <div class="excluded">
                                                <# _.each(settings.package_cons, function(item, index) { #>
                                                    <div class="item">
                                                        <# if (item.icon || item.item_icon.value) { 
                                                            iconsHTML[index]=elementor.helpers.renderIcon(view, item.item_icon, { 'aria-hidden':true }, 'i', 'object');#>
                                                            <div
                                                                class="icon">
                                                                <span>{{{iconsHTML[
                                                                    index
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

                                    </div>

                                </div>
                            
                            <# } #>

                        </div>

                </div>
            <?php
            
    }
}