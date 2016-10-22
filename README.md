# Sticky CPT - Plugin WordPress

## Description

* Add the possibility of "sticky" CPT.

The plugin allows to highlight the CPT in the same way as would the WordPress core functionality for posts.

You can highlight new content created for your CPT.

It is also possible to highlight the content quickly thanks to bulk actions.

## Start example

	$args = array(
	    'post_type'      => ['project'],
	    'post_status'    => 'publish',
	    'posts_per_page' => -1,
	    'post__in'       => get_option( 'sticky_posts' )
	);
	$stickyProject = new WP_Query( $args );


## Hook

    add_filter( 'sticky_cpt_add_cpt' , 'add_cpt' );

    function add_cpt( $post_types ){
        $post_types['newcpt'] = 'newcpt';

        return $post_types;

    }
