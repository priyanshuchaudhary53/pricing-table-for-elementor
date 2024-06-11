<?php
/**
 * Pricing Table for Elementor WordPress Plugin
 * 
 * @package SimplePricingTableElementor
 * 
 * Plugin Name: Simple Pricing Table for Elementor
 * Description: The Pricing Table for Elementor lets you create stunning, customizable pricing tables to highlight your offerings and boost conversions.
 * Plugin URI: 
 * Version:     0.1.4
 * Author:      Priyanshu
 * Author URI:  https://priyanshuc.dev
 * Text Domain: simple-pricing-table-elementor
 * License:     GPL-3.0-only
 * License URI: https://opensource.org/licenses/GPL-3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

define('PRICING_TABLE_FOR_ELEMENTOR', __FILE__);

/**
 * Include Pricing_Table_Elementor class.
 * 
 */
require plugin_dir_path(PRICING_TABLE_FOR_ELEMENTOR) . 'pricing-table-elementor-class.php';