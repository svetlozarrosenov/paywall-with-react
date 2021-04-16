<?php

/**
 * Plugin Name: Paywall
 * Description: Subscription managment plugin.
 * Version: 1.0.0
 * Author: ssimeonov
 *
 * @package Paywall
 **/

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

define( 'PAYWALL_VERSION', '1.0.0' );

define( 'PAYWALL_MANAGER_URL', plugin_dir_url( __FILE__ ) );
define( 'PAYWALL_PATH', plugin_dir_path( __FILE__ ) );

use Paywall_Package\Admin_Page;

class Paywall {
    public function __construct() {
        require 'vendor/autoload.php';

        new Admin_Page();
        
        add_action(
            'after_setup_theme',
            function() {
                \Carbon_Fields\Carbon_Fields::boot();
            },
            11
        );

        add_filter('the_content', function( $content ) {
            return '<div id="react-app"></div><!-- #react-app -->' . $content;
        } );

        add_action( 'wp_enqueue_scripts', function() {
            wp_enqueue_script(
                'crb-paywall-react',
                PAYWALL_MANAGER_URL . 'build/index.js',
                ['wp-element'], // deps
                time(), // version -- this is handled by the bundle manifest
                true // in footer
            );
        } );
    }

    public function activate() {}

    public function deactivate() {}
}

$Paywall = new Paywall();

register_activation_hook( __FILE__, [ $Paywall, 'activate' ] );

register_deactivation_hook( __FILE__, [ $Paywall, 'deactivate' ] );