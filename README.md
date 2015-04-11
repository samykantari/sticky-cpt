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
