<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Sticky CPT
 * Plugin URI:        http://www.samy-kantari.fr/
 * Description:       Ajoute la possibilité de mettre en sticky les customs post type
 * Version:           1.0.0
 * Author:            Kantari Samy
 * Author URI:        http://www.samy-kantari.fr/
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Sticky_cpt' ) ) :

    class Sticky_cpt {
        protected $plugin_name;
        protected $version;


        protected static $instance = null;

        public function __construct() {

            $this->plugin_name = 'sticky-cpt';
            $this->version = '1.0.0';

            register_activation_hook(__FILE__, array( $this, 'sticky_cpt_activation') );
            register_deactivation_hook(__FILE__, array( $this, 'sticky_cpt_deactivation') );


            $this->load_dependencies();

        }

        /**
         * [load_dependencies]
         */
        public function load_dependencies() {

            include_once 'includes/class-sticky-cpt-loader.php';
            include_once 'includes/class-sticky-cpt-posts.php';

        }


        public function sticky_cpt_activation() {

        }

        public function sticky_cpt_deactivation() {

        }





        public static function get_instance() {

            if ( null == self::$instance ) {
                self::$instance = new self;
            }

            return self::$instance;
        }
    }

    Sticky_cpt::get_instance();

endif;
