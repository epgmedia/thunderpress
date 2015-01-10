<?php


/**
 * Event Presenter
 *
 * @param null|object|int $event
 * @return string The event's presenter
 */
function epg_get_event_presenter( $event = null ) {
	$post_id = ( is_object($event) && isset($event->tribe_is_event) && $event->tribe_is_event ) ? $event->ID : $event;
	$post_id = ( !empty($post_id) || empty($GLOBALS['post']) ) ? $post_id : get_the_ID();
	$presenter = tribe_get_event_meta( $post_id, '_ecp_custom_4', true );

	return $presenter;
}

/**
 * Returns the URL of an event presenter
 *
 * @param null|object $event
 *
 * @return mixed
 */
function epg_event_presenter_url($event = null) {
	$post_id = ( is_object($event) && isset($event->tribe_is_event) && $event->tribe_is_event ) ? $event->ID : $event;
	$post_id = ( !empty($post_id) || empty($GLOBALS['post']) ) ? $post_id : get_the_ID();
	$presenter = tribe_get_event_meta( $post_id, '_ecp_custom_8', true );

	return $presenter;

}

/**
 * Displays the event presenter information
 *
 * @param null   $presenter
 * @param string $html
 */
function epg_event_presenter( $presenter = null, $html = 'p' ) {
	$presenter = ($presenter === null ) ? epg_get_event_presenter() : $presenter;
	if ( $presenter ):
		$presenter_string = '<' . $html . '>';
		$presenter_string .= '<em>';
		$presenter_string .= 'Presented By: ';
		$presenter_url = epg_event_presenter_url();

		if ( $presenter_url ) {
			$presenter_string .= '<a href="' . epg_check_url( $presenter_url ) . '" ><strong>';
			$presenter_string .= $presenter;
			$presenter_string .= '</strong></a>';
		} else {
			$presenter_string .= $presenter;
		}

		$presenter_string .= '</em>';
		$presenter_string .= '</' . $html . '>';

		echo $presenter_string;

	endif;
}


/**
 * Event benefactor
 *
 * @param null|object|int $event
 * @return string The event's presenter
 */
function epg_get_event_benefactor( $event = null ) {
	$post_id = ( is_object($event) && isset($event->tribe_is_event) && $event->tribe_is_event ) ? $event->ID : $event;
	$post_id = ( !empty($post_id) || empty($GLOBALS['post']) ) ? $post_id : get_the_ID();
	$benefactor = tribe_get_event_meta( $post_id, '_ecp_custom_3', true );

	return $benefactor;
}

/**
 * Returns event benefactor URL
 *
 * @param null|object $event
 *
 * @return mixed
 */
function epg_event_benefactor_url( $event = null ) {
	$post_id = ( is_object($event) && isset($event->tribe_is_event) && $event->tribe_is_event ) ? $event->ID : $event;
	$post_id = ( !empty($post_id) || empty($GLOBALS['post']) ) ? $post_id : get_the_ID();
	$benefactor = tribe_get_event_meta( $post_id, '_ecp_custom_7', true );

	return $benefactor;

}

/**
 * Returns the event benefactor value
 *
 * @param null   $benefactor
 * @param string $html
 */
function epg_event_benefactor( $benefactor = null, $html = 'p' ) {

	$benefactor = ($benefactor === null ) ? epg_get_event_benefactor() : $benefactor;
	if ( $benefactor ):
		$benefactor_string = '<' . $html . '>';
		$benefactor_string .= '<em>';
		$benefactor_string .= 'Benefiting: ';
		$benefactor_url = epg_event_benefactor_url();
		if ( $benefactor_url ) {
			$benefactor_string .= '<a href="' . epg_check_url( $benefactor_url ) . '" ><strong>';
			$benefactor_string .= $benefactor;
			$benefactor_string .= '</strong></a>';
		} else {
			$benefactor_string .= $benefactor;
		}
		$benefactor_string .= '</em>';
		$benefactor_string .= '</' . $html . '>';

		echo $benefactor_string;

	endif;
}

/**
 * Displays the event's address at the top.
 */
function epg_event_header_address() {

	$postId = get_the_ID();
	$address_out = array();
	?><span class="adr header-address"> <?php
	// Get our street address
	if( tribe_get_address( $postId ) ) {
		$address_out []= '<span class="street-address">'. tribe_get_address( $postId ) .'</span>';
		if( ! tribe_is_venue() )
			$address_out []= '<span class="delimiter">,</span> ';
	}
	// Get our full region
	$our_province = tribe_get_event_meta( $postId, '_VenueStateProvince', true );
	$our_states = TribeEventsViewHelpers::loadStates();
	$our_full_region = isset( $our_states[$our_province] ) ? $our_states[$our_province] : $our_province;

	// Get our city
	if( tribe_get_city( $postId ) ) {
		if( tribe_get_address( $postId ) )
			$address_out []= '<span class="delimiter">,</span> ';
		$address_out []= ' <span class="locality">'. tribe_get_city( $postId ) .'</span>';
		$address_out []= '<span class="delimiter">,</span> ';
	}

	// Get our region
	if( tribe_get_region( $postId ) ) {
		if(count($address_out))
			$address_out []= ' <abbr class="region tribe-events-abbr" title="'. $our_full_region .'">'. tribe_get_region( $postId ) .'</abbr>';
	}

	// Get our postal code
	if( tribe_get_zip( $postId ) ) {
		$address_out []= ' <span class="postal-code">'. tribe_get_zip( $postId ) .'</span>';
	}

	// Get our country
	if( tribe_get_country( $postId ) ) {
		if(count($address_out))
			$address_out []= ' <span class="country-name">'. tribe_get_country( $postId ) .'</span>';
	}

	$address_link =  implode( '', $address_out );

	echo '<a href="http://maps.google.com/?q=' . strip_tags( $address_link ) . '" target="_blank">' . $address_link . '</a>';

	?></span><?php
}

/**
 * Remove calendar links from details and place above featured image.
 */
add_action( 'after_setup_theme', 'epg_add_to_cal_link' );
function epg_add_to_cal_link() {
	if ( remove_action( 'tribe_events_single_event_after_the_content', array( 'TribeiCal', 'single_event_links' ) ) == TRUE ) {
		add_action( 'epg_single_event_after_header', array( 'TribeiCal', 'single_event_links' ) );
	}
}


/**
 * Remove Other Information
 *
 */
add_action( 'wp_loaded', 'epg_event_no_additional_info', 400 );

function epg_event_no_additional_info() {
	global $wp_filter;
	$wp_filter['tribe_events_single_event_meta_primary_section_end'] = null;
}
