<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Sticky_cpt_posts' ) ) :

    class Sticky_cpt_posts{


        public static function edit_counter( $views ){
            global $current_screen, $user_ID, $wpdb, $pagenow;

            $post_type = $current_screen->post_type;

            $sticky = $wpdb->get_col("SELECT `ID` FROM $wpdb->posts WHERE (post_status = 'publish' OR post_status = 'draft' OR post_status = 'pending') AND ( post_type = '$post_type' ) ");

            $all_sticky = get_option( 'sticky_posts' );

            $result = array_intersect($all_sticky, $sticky);

            if( count( $result ) == 0 ) return $views;

            $label = __( "Sticky" );
            $count = count( $result );

            $current = ( isset($_GET['show_sticky']) && $_GET['show_sticky'] ) ? 'class="current" ' : '';

            $link = "<a ".$current."href='edit.php?post_type=".$post_type."&show_sticky=1'>".$label." <span class='count'>(".$count.")</span></a>";

            $views = Sticky_cpt_posts::insertArrayIndex( $views, $link , 'all' );

            return $views;
        }

        public static function insertArrayIndex($array, $new_element, $index) {

            $index = ( isset($array['publish']) ) ? 2 : 1;

            $start = array_slice($array, 0, $index);

            $end = array_slice($array, $index);

            $start['sticky'] = $new_element;

            return array_merge($start, $end);
        }

    }

endif;
