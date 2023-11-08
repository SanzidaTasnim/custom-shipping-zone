<?php 
/*
 * Plugin Name:       Custom Shipping Zone
 * Plugin URI:        https://me.sanzida.com
 * Description:       This pluign used for custom shipping zone.
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7
 * Author:            sanzida
 * Author URI:        https://me.sanzida.com
 * Text Domain:       trial-plugin
 * Domain Path:       /languages
*/

namespace CBS;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

//load autoloader
require_once "vendor/autoload.php";

/**
 * Plugin Main class
 */

final class CBS {
    
    static $instance = false;

    function __construct() {

        //load all hooks
        $this->hooks();
    }

    /**
     * All hooks
     */
    public function hooks() {

        //load all assets
        add_action( 'wp_enqueue_scripts', [$this, 'load_front_assets'] );
        add_action( 'wp admin_enqueue_scripts', [$this, 'load_admin_enqueue_script'] );
        add_action( 'wp_ajax_cbs_shipping_zone_verify', [$this , 'cbs_shipping_zone_verify' ] );
        new Src\Shortcode(); 
    }

    /**
     * Load Front Assets
     */
    function load_front_assets() {

        if( ! is_admin() ) {

            //load all css
            wp_enqueue_style( 'cbs-front-css',  plugins_url( '/assets/front/css/front.css', __FILE__ ), '', time(), 'all' );

            //load all js
            wp_enqueue_script( 'cbs-front-js', plugins_url( 'assets/front/js/front.js', __FILE__ ), array('jquery'), time(), true );


            wp_enqueue_script( 'cbs-sweetalert-js', 'https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js', array('jquery'), time(), true );
            wp_enqueue_style( 'cbs-sweetalert-css', 'https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css','', time(), 'all' );


            //localize script
            wp_localize_script('cbs-front-js','AJAX_OBJECT', array('ajax_url' => admin_url('admin-ajax.php'))) ;
        } 

    }
    function cbs_shipping_zone_verify() {
        $allowedZipCodes = [ "11211", "11221", "11222", "11206" ];
        $zipcode         = $_POST['zipCode'] ;
        wp_send_json_success([
            'zipcode'    => $zipcode,
            'allowedZip' => $allowedZipCodes,
        ]);

    }

    /**
     * Singleton Instance
     */
    static function get_cbs() {
        
        if( ! self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

/**
 * Cick off the plugin
 */
CBS::get_cbs();



