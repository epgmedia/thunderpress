<?php
/**
 * Calendar functions
 */

include('class_category_images.php');

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

function calendar_hero() {
	if ( ( tribe_is_past() || tribe_is_upcoming() ) && !is_tax() ) { ?>
		<div class="events-hero">
			<h1>Calendar</h1>
			<?php calendar_hero_categories(); ?>
		</div>
	<?php }
}

function calendar_hero_categories() {

	$categories = get_terms('tribe_events_cat', array('hide_empty' => false));

	foreach ( $categories as $category ) { ?>

		<div class="category-hero">
			<?php category_hero_post( $category ); ?>
		</div>

	<?php }
}

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

function event_excerpt( $length = 100 ) {

	$excerpt = ( the_excerpt() > 0 ? substr( the_excerpt(), 0, $length ) : '' );

	return $excerpt;
}

if(function_exists("register_field_group")) {
	register_field_group(
		array (
			'id' => 'acf_events',
			'title' => 'Featured Event',
			'fields' => array (
				array (
					'key' => 'field_53e2bc2d35320',
					'label' => '',
					'name' => 'featured_event',
					'type' => 'true_false',
					'instructions' => 'Featured events appear prominently around the site.',
					'message' => '',
					'default_value' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'tribe_events',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'normal',
				'layout' => 'no_box',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		)
	);
}