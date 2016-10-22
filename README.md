# Sticky CPT - Plugin WordPress

## Description

* Le plugin donne la possibilité de mettre les customs post type en sticky

## Fonctionnement

Une fois l'article en sticky, on procède normalement :)

	$args = array(
	    'post_type'      => ['project'],
	    'post_status'    => 'publish',
	    'posts_per_page' => -1,
	    'post__in'       => get_option( 'sticky_posts' )
	);
	$stickyProject = new WP_Query( $args );


## Hook

Ce hook permet  de gérer les CPT si besoin

    add_filter( 'sticky_cpt_add_cpt' , 'add_cpt' );

    function add_cpt( $post_types ) {

        $post_types['newcpt'] = 'newcpt';

        return $post_types;

    }
