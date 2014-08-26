<?php
/**
 * Calendar functions
 */

include('class_category_images.php');
include('admin-views/featured-event.class.php');
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

	$excerpt = ( the_excerpt() > 0 ? substr( the_excerpt(), 0, $length ) : '' );

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