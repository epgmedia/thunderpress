<?php
/**
 * Related Events Template
 * The template for displaying related events on the single event page.
 *
 * @package TribeEventsCalendarPro
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

//Maximum Number of related posts to display
$num_posts = 3;

$posts = tribe_get_related_posts( $num_posts );
?>

<?php
if ( is_array( $posts ) && !empty( $posts ) ) {
	echo '<h3 class="tribe-events-related-events-title">'.  __( 'Related Events', 'tribe-events-calendar-pro' ) .'</h3>';
	echo '<ul class="tribe-related-events tribe-clearfix hfeed vcalendar">';
	foreach ( $posts as $post ) {
		echo '<li>';

		$thumb = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail( $post->ID, 'large' ) : '<img src="'. trailingslashit( TribeEventsPro::instance()->pluginUrl ) . 'resources/images/tribe-related-events-placeholder.png" alt="'. get_the_title( $post->ID ) .'" />';;
		echo '<div class="tribe-related-events-thumbnail">';
		echo '<a href="'. tribe_get_event_link( $post ) .'" class="url" rel="bookmark">'. $thumb .'</a>';
		echo '</div>';
		echo '<div class="tribe-related-event-info">';
		echo '<h3 class="tribe-related-events-title summary"><a href="'. tribe_get_event_link( $post ) .'" class="url" rel="bookmark">'. get_the_title( $post->ID ) .'</a></h3>';

		if ( $post->post_type == TribeEvents::POSTTYPE ) {
			echo tribe_events_event_schedule_details( $post );
		}
		echo '</div>';
		echo '</li>';
	}
	echo '</ul>';
}
?>