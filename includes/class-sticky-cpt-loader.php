<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'Sticky_cpt_Loader' ) ) :

    class Sticky_cpt_Loader{

        protected static $instance = null;

        public function __construct(){

            add_action( 'init', array($this, 'init'));

            add_action( 'admin_footer-post.php', array( $this ,'add_sticky' ) );
            add_action( 'admin_footer-post-new.php', array( $this ,'add_sticky' ) );

            add_action('admin_footer-edit.php', array($this, 'add_sticky_quick_edit'));

        }

        public function init(){

            $post_types = $this->get_all_cpt();

            // Ajout automatique des préfix
            array_walk($post_types, array($this, 'add_prefix'));

            foreach( $post_types as $hook )
                add_filter( "views_$hook" ,  array($this, 'edit_counter'));

        }

        private function add_prefix( &$n ) {
            $n = 'edit-'.$n;
        }



        public function edit_counter ($views) {
            // echo "<pre>".print_r($views, 1)."</pre>";
            // die();
            $views = Sticky_cpt_posts::edit_counter( $views );

            return $views;
        }

        private function get_all_cpt(){
            // Récupération de tout les nouveaux CPT
            $args = array(
               'public'   => true,
               '_builtin' => false
            );
            $post_types = get_post_types( $args );

            return $post_types;
        }


        public function add_sticky_quick_edit(){

            global $typenow, $pagenow;

            $post_types = $this->get_all_cpt();

            if ( $pagenow != 'edit.php' || !in_array($typenow, $post_types) || !current_user_can( 'edit_others_posts' ) ) return false;

            $label = __( "Make this post sticky" );

            $labelBulkEdit = __( "Sticky" );
            $NotSticky = __( "Not Sticky" );
            $NoChange = __( "&mdash; No Change &mdash;" );

$script = <<<HTML
<script>
    jQuery(function($) {
        var sticky = "<label class='alignleft'><input type='checkbox' value='sticky' name='sticky'><span class='checkbox-title'>$label</span></label>";
        $('.quick-edit-row .inline-edit-status').parent().append(sticky);

        var bulkEdit = "<label class='alignright'><span class='title'>$labelBulkEdit</span><select name='sticky'> <option value='-1'>$NoChange</option> <option value='sticky'>$labelBulkEdit</option> <option value='unsticky'>$NotSticky</option>  </select> </label>";

        $('#bulk-edit .inline-edit-status').parent().append(bulkEdit);
    });
</script>
HTML;
            echo $script;
        }

        public function add_sticky(){
            global $post, $typenow;

            $post_types = $this->get_all_cpt();

            if ( !in_array($typenow, $post_types) || !current_user_can( 'edit_others_posts' ) ) return false;

            $label = __( "Stick this post to the front page" );
            $checked = checked( is_sticky( $post->ID ) );

$script = <<<HTML
<script>
    jQuery(function($) {
        var sticky = "<br/><span id='sticky-span'><input id='sticky' name='sticky' type='checkbox' value='sticky' $checked /> <label for='sticky' class='selectit'>$label</label><br /></span>";
        $('[for=visibility-radio-public]').append(sticky);
    });
</script>
HTML;
            echo $script;
        }


        public static function get_instance() {

            if ( null == self::$instance ) {
                self::$instance = new self;
            }

            return self::$instance;
        }

    }

    Sticky_cpt_Loader::get_instance();

endif;

