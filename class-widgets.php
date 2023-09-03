<?php
/**
 * Widgets class.
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

namespace SimplePricingTableElementor;

use Elementor\Plugin;

// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * Class Plugin
 * 
 * Main Plugin Class
 * 
 * @since 0.1.0
 */
class Widgets
{
    /**
     * Instance
     * 
     * @since   0.1.0
     * @access  private
     * @static
     * 
     * @var Plugin The single instance of the class.
     */
    private static $instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 0.1.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 0.1.0
     * @access private
     */
    private function include_widgets_files()
    {
        require_once 'widgets/class-pricingtable.php';
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 0.1.0
     * @access public
     */
    public function register_widgets()
    {
        // Include widgets files.
        $this->include_widgets_files();

        // Register the plugin widget files.
        Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PricingTable());
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 0.1.0
     * @access public
     */
    public function __construct()
    {
        // Register the widgets.
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
    }
}

// Instantiate the Widgets class.
Widgets::instance();