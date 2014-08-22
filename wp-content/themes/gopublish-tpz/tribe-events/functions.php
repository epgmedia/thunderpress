<?php
/**
 * Calendar functions
 */

include('class_category_images.php');
include('admin-views/featured-event.class.php');
include('admin-views/category-settings.php');

/**
 * Custom Region Taxonomy
 */
if ( ! function_exists( 'epg_event_regions' ) ) {

	// Register Custom Taxonomy
	function epg_event_regions() {

		$labels = array(
			'name'                       => 'Regions',
			'singular_name'              => 'Region',
			'menu_name'                  => 'Regions',
			'all_items'                  => 'All Regions',
			'parent_item'                => 'Parent Regions',
			'parent_item_colon'          => 'Parent Region:',
			'new_item_name'              => 'New Region',
			'add_new_item'               => 'Add Region',
			'edit_item'                  => 'Edit Region',
			'update_item'                => 'Update Region',
			'separate_items_with_commas' => 'Separate Regions with commas',
			'search_items'               => 'Search Regions',
			'add_or_remove_items'        => 'Add or remove Regions',
			'choose_from_most_used'      => 'Choose from the most used Regions',
			'not_found'                  => 'Not Found',
		);
		$rewrite = array(
			'slug'                       => '/calendar/region',
			'with_front'                 => false,
			'hierarchical'               => true,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'event_regions', array( 'tribe_events' ), $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'epg_event_regions', 0 );

}

/**
 * Filter the archive_template with our custom function
 */

add_filter( 'taxonomy_template', 'region_archive', 0 );
function region_archive( $single ) {
	//global $wp_query, $post;

	/* Checks for single template by post type */
	if ( is_tax('event_regions') ) {
		if ( file_exists( get_template_directory() . '/tribe-events/default-template.php' ) )
			return get_template_directory() . '/tribe-events/default-template.php';
	}

	return $single;
}

/**
 * Add important query args to region pages.
 */
add_action( 'pre_get_posts', 'region_query_args' );
function region_query_args( &$wp_query ) {

	if ( is_tax( 'event_regions' ) ) {
		$wp_query->query['post_type'] = TribeEvents::POSTTYPE;
		$wp_query->query_vars['eventDisplay'] = 'upcoming';
		$wp_query->query_vars["posts_per_page"] = '10';
		$wp_query->query_vars["start_date"] = date('Y-m-d H:i:s', strtotime("now"));
	}
}

/**
 * Enqueue scripts on regions pages
 */
add_filter( 'tribe_query_is_event_query', 'epg_region_event' );
function epg_region_event( $tribe_is_event_query ) {
	if ( is_tax( 'event_regions' ) ) return TRUE;

	return $tribe_is_event_query;
}

/**
 *
 * Targets:
 * <?php do_action('before_content_area'); ?>
 *
 * Placed after header.php.
 */

function before_calendar_content() {
	do_action('before_content_area');
}

add_action('before_content_area', 'calendar_hero');

/**
 * Header of the Calendar homepage
 */
function calendar_hero() {
	if ( ( tribe_is_past() || tribe_is_upcoming() ) && !is_tax() ) { ?>
		<h1 class="calendar-title">Calendar</h1>
		<div class="events-hero">
			<?php calendar_hero_categories(); ?>
		</div>
	<?php }
}

/**
 * Prints out the 4 categories as header items.
 */
function calendar_hero_categories() {

	$options = get_option( TribeEvents::OPTIONNAME );
	$categories = array(
		'featured_category_1' => $options['featured_category_1'],
		'featured_category_2' => $options['featured_category_2'],
		'featured_category_3' => $options['featured_category_3'],
		'featured_category_4' => $options['featured_category_4'],
	);

	$terms = array();

	foreach ( $categories as $cat_key => $cat_val ) {
		$terms[] = get_term( $cat_val, 'tribe_events_cat' );
	}

	foreach ( $terms as $category ) { ?>

		<div class="category-hero">
			<?php category_hero_post( $category ); ?>
		</div>

	<?php }
}

/**
 * Displays a single "hero" category
 *
 * @param $category_post object
 */
function category_hero_post( $category_post ) {

	if ( is_string( get_term_link( $category_post ) ) ) {
		$category_link = get_term_link( $category_post );
	}

	global $post;
	$next_event = tribe_get_events(
		array(
			'eventDisplay'  => 'upcoming',
			'posts_per_page'=> 1,
			'tax_query'     => array(
				array(
					'taxonomy' => 'tribe_events_cat',
					'field'    => 'slug',
					'terms'    => $category_post->slug
				)
			)
		)
	);

	?>
	<h2>
		<a href="<?php echo $category_link; ?>"><?php echo $category_post->name; ?></a>
	</h2>
	<?php

	foreach($next_event as $post) {
		setup_postdata($post);
		category_hero_image( $category_link, $category_post->term_id );
	} //endforeach

	wp_reset_query();
}

/**
 * Finds the image to display in the category hero section
 *
 * @param $category_link string
 * @param $term_id int
 */
function category_hero_image( $category_link, $term_id) {

	global $post;

	if ( has_post_thumbnail() ) {

		$image_atts = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>

		<div class="event-thumb event-hero">
			<a href="<?php echo $category_link; ?>"><img src="<?php echo $image_atts[0]; ?>" width="<?php echo $image_atts[1]; ?>" height="<?php echo $image_atts[2]; ?>" class="category-hero-image" /></a>
		</div>

	<?php } elseif ( ! has_post_thumbnail() && ( function_exists('z_taxonomy_image_url') && z_taxonomy_image_url($term_id) !== NULL ) ) { ?>
		<div class="event-thumb">
			<a href="<?php echo $category_link; ?>/"><img src="<?php echo z_taxonomy_image_url( $term_id, array( 211, 240 ) ); ?>" /></a>
		</div>
	<?php }
}


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
 * Displays the event presenter information
 *
 * @param null   $presenter
 * @param string $html
 */
function epg_event_presenter( $presenter = null, $html = 'p' ) {

	$presenter = ($presenter === null ) ? epg_get_event_presenter() : $presenter;

	if ( $presenter !== null ):

		$presenter_string = '<' . $html . '>';
		$presenter_string .= '<em>';
		$presenter_string .= 'Presented By: ';

		$presenter_url = epg_event_presenter_url();


		if ( $presenter_url !== NULL ) {
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

	if ( $benefactor !== null ):

		$benefactor_string = '<' . $html . '>';
		$benefactor_string .= '<em>';
		$benefactor_string .= 'Benefiting: ';

		$benefactor_url = epg_event_benefactor_url();


		if ( $benefactor !== NULL ) {
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

	?>
	<span class="adr header-address">

	<?php

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

	?>
	</span>
	<?php
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
 * Remove calendar links from details and place above featured image.
 */
add_action( 'after_setup_theme', 'epg_add_to_cal_link' );
function epg_add_to_cal_link() {
	if ( remove_action( 'tribe_events_single_event_after_the_content', array( 'TribeiCal', 'single_event_links' ) ) == TRUE ) {
		add_action( 'epg_single_event_after_header', array( 'TribeiCal', 'single_event_links' ) );
	}
}


/**
 * Remove Other INformation
 *
 */
add_action( 'wp_loaded', 'epg_event_no_additional_info', 400 );

function epg_event_no_additional_info() {
	$hook_name = 'tribe_events_single_event_meta_primary_section_end';
	global $wp_filter;
	$wp_filter[$hook_name] = null;
}
