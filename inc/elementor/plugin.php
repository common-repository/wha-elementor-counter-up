<?php

namespace WHA_Elementor;
/**
 * Class Plugin
 * Main Plugin class
 */
class Plugin {

    /**
     * Instance
     *
     * @access private
     * @static
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * widget_global_scripts
     * Load global scripts & css files required plugin core.
     *
     * @access public
     */
    public function widget_global_scripts() {}

    /**
     * Register custom category for widgets
     * @access public
     */
    public function widget_categories( $el_manager ) {
        $el_manager->add_category(
            'wha_widgets',
            [
                'title' => __( 'WHA Widgets', 'wha-elements' ),
                'icon'  => 'eicon-star',
            ]
        );
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @access public
     */
    public function register_widgets() {
        foreach ( glob( WHA_ELEMENTOR_DIR . '/widgets/*/widget.php' ) as $filename ) {
            if ( empty( $filename ) || ! is_readable( $filename ) ) {
                continue;
            }
            require $filename;
        }
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @access public
     */
    public function __construct() {

        // Register global widget scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_global_scripts' ] );

        // Register categories
        add_action( 'elementor/elements/categories_registered', [ $this, 'widget_categories'] );

        // Register widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
    }
}

Plugin::instance();