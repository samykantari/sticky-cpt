<?php

/**
 * Plugin Name:       Sticky CPT
 * Plugin URI:        http://www.samy-kantari.fr/
 * Description:       Add the possibility of "sticky" CPT
 * Version:           1.0.0
 * Author:            Kantari Samy
 * Author URI:        http://www.samy-kantari.fr/
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );


/**
 * DEFINES
 */
define( 'STICKY_CPT'          , '1.0.0' );
define( 'STICKY_CPT_FILE'     , __FILE__ );
define( 'STICKY_CPT_PATH'     , realpath( plugin_dir_path( STICKY_CPT_FILE ) ) . '/' );
define( 'STICKY_CPT_INCLUDES' , realpath( STICKY_CPT_PATH . 'includes/' ) . '/' );


if ( ! class_exists( 'Sticky_cpt' ) ) :

    class Sticky_cpt {
        protected $plugin_name;
        protected $version;

        protected static $instance = null;

        public function __construct() {

            $this->plugin_name = 'sticky-cpt';
            $this->version     = STICKY_CPT;

            $this->load_dependencies();
        }


        public function load_dependencies() {

            include_once STICKY_CPT_INCLUDES . 'class-sticky-cpt-loader.php';
            include_once STICKY_CPT_INCLUDES . 'class-sticky-cpt-posts.php';

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
