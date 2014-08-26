<?php
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

/**
 * Header of the Calendar homepage
 */
add_action('before_content_area', 'calendar_hero');
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
