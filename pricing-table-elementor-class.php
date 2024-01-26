<?php
/**
 * Pricing_Table_Elementor class.
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

if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * Main Pricing Table Elementor Class
 *
 * The init class that runs the Elementor Awesomesauce plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 */
final class Pricing_Table_Elementor
{
    /**
     * Plugin Version
     * 
     * @since 0.1.0
     * @var string The plugin version.
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     * 
     * @since 0.1.0
     * @var string Mininum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

    /**
     * Minimum PHP Version
     * 
     * @since 0.1.0
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.4.1';

    /**
     * Constructor
     * 
     * @since   0.1.0
     * @access  public
     */
    public function __construct()
    {
        // Register elementor category.
        add_action('elementor/elements/categories_registered', [$this, 'register_category']);

        // Register widget styles.
        add_action('wp_enqueue_scripts', [$this, 'register_widget_styles']);

        // Load the translation.
        add_action('init', [$this, 'i18n']);

        // Initialize the plugin.
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Register Elementor Category
     * 
     * @since   0.1.0
     * @access  public
     */
    public function register_category($elements_manager)
    {
        $elements_manager->add_category(
            'pricing_table',
            [
                'title' => __('Pricing Table', 'simple-pricing-table-for-elementor'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Register Widget Styles
     * 
     * @since   0.1.0
     * @access  public
     */
    public function register_widget_styles()
    {
        wp_register_style('pricing-table-style', plugins_url('assets/css/pricing-table.css', __FILE__));
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     * Fired by `init` action hook.
     *
     * @since  0.1.0
     * @access public
     */
    public function i18n()
    {
        load_plugin_textdomain('simple-pricing-table-for-elementor');
    }

    /**
     * Initialize the plugin
     *
     * Validates that Elementor is already loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed include the plugin class.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 0.1.0
     * @access public
     */
    public function init()
    {
        // Check if Elementor installed and activated.
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version.
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version.
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Once we get here, We have passed all validation checks so we can safely include our widgets.
        require_once 'class-widgets.php';
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 0.1.0
     * @access public
     */
    public function admin_notice_missing_main_plugin()
    {
        deactivate_plugins(plugin_basename(PRICING_TABLE_FOR_ELEMENTOR));

        printf(
            sprintf(
                '<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> to be installed and activated.</p></div>',
                'Pricing Table for Elementor',
                'Elementor'
            ),
        );
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 0.1.0
     * @access public
     */
    public function admin_notice_minimum_elementor_version()
    {
        deactivate_plugins(plugin_basename(PRICING_TABLE_FOR_ELEMENTOR));

        printf(
            sprintf(
                '<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> version %3$s or greater.</p></div>',
                'Pricing Table for Elementor',
                'Elementor',
                esc_html(self::MINIMUM_ELEMENTOR_VERSION)
            ),
        );
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 0.1.0
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {
        deactivate_plugins(plugin_basename(PRICING_TABLE_FOR_ELEMENTOR));

        printf(
            sprintf(
                '<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> version %3$s or greater.</p></div>',
                'Pricing Table for Elementor',
                'PHP',
                esc_html(self::MINIMUM_PHP_VERSION)
            ),
        );
    }
}

// Instantiate Pricing_Table_Elementor.
new Pricing_Table_Elementor();