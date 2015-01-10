<?php
/**
 * Calendar functions
 */

include('admin-views/functions-featured-event.php');
include('admin-views/category-settings.php');

// Various Functions
include('inc/functions-list-view.php');
include('inc/functions-region.php');
include('inc/functions-single-event.php');


/**
 * Shrinks an excerpt
 *
 * @param int $length
 *
 * @return string
 */
function event_excerpt( $length = 100 ) {
	$excerpt = get_the_excerpt();
	if ( strlen( $excerpt ) > 0 ) {
		$excerpt = substr( get_the_excerpt(), 0, $length );
	}

	return $excerpt;
}

/**
 * Check URL before returning
 *
 * Checks for HTTP:// at the beginning of a URL to make sure it's printed correctly to hyperlinks.
 *
 * @param $url
 *
 * @return string
 */
function epg_check_url( $url ) {
	if ( substr($url, 0, 7) === 'http://' ) {

		return $url;
	} else {

		return 'http://' . $url;
	}
}

/**
 * Related Events View
 */
add_action( 'tribe_events_single_event_after_the_meta', 'related_venues_view' );
function related_venues_view() { ?>
	<!-- More Related Venues -->
	<?php tribe_get_template_part( 'pro/related-events' ); ?>
	<!-- END -->
	<?php
}

function epg_venue_related_events() {

}