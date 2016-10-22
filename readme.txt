=== Sticky CPT ===
Contributors: leprincenoir
Tags: sticky, cpt, highlighting, push, forward
Requires at least: 3.5
Tested up to: 4.6.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add the possibility of "sticky" CPT.

== Description ==

The plugin allows to highlight the CPT in the same way as would the WordPress core functionality for posts.
You can highlight new content created for your CPT.
It is also possible to highlight the content quickly thanks to bulk actions.


Start example

$args = array(
    'post_type'      => ['project'],
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post__in'       => get_option( 'sticky_posts' )
);
$stickyProject = new WP_Query( $args );


Hook available

add_filter( 'sticky_cpt_add_cpt' , 'add_cpt' );

function add_cpt( $post_types ) {
    $post_types['newcpt'] = 'newcpt';

    return $post_types;
}



== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/sticky-cpt` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==

(soon)

== Screenshots ==

(soon)

== Changelog ==

= 1.0.0 =
* 22 oct 2016
* Initial release \o/