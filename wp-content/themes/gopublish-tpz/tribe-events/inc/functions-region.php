<?php
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

add_filter( 'taxonomy_template', 'include_region_archive', 0 );
function include_region_archive( $single ) {
	/* Checks for single template by post type */
	if ( is_tax('event_regions') ) {
		if ( file_exists( get_template_directory() . '/tribe-events/default-template.php' ) )
			return get_template_directory() . '/tribe-events/default-template.php';
	}

	return $single;
}

/**
 * Enqueue scripts on regions pages
 */
add_filter( 'tribe_query_is_event_query', 'epg_region_is_event_query' );
function epg_region_is_event_query( $tribe_is_event_query ) {
	if ( is_tax( 'event_regions' ) ) return TRUE;

	return $tribe_is_event_query;
}