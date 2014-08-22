<?php
/**
 * List View Loop
 * This file sets up the structure for the list loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/loop.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php
global $more;
$more = false;
?>
<div class="tribe-events-loop vcalendar">

	<!-- Featured Events Loop -->
	<?php
	$args = array(
		"post_type" => 'tribe_events',
		"eventDisplay" => 'upcoming',
		'meta_query' => array(
			array(
				'key' => 'featured_event',
				'value' => 'on'
			)
		),
		"posts_per_page" => '10',
		"start_date" => date('Y-m-d H:i:s', strtotime("now")),
		'orderby' => 'event_date',
		'order' => 'ASC'
	);

	$featured_events = new WP_query($args);
	$featured_posts = array();

	if (  $_REQUEST['tribe_paged'] < 2 ) {

		if ( $featured_events->have_posts() ) { ?>

			<?php while($featured_events->have_posts()): $featured_events->the_post(); ?>

				<?php $featured_posts[] = get_the_ID(); ?>

				<?php do_action( 'tribe_events_inside_before_loop' ); ?>

				<!-- FEATURED -->
				<div class="featured-event-label">
					<span>Featured Event</span>
				</div>

				<!-- Featured Event  -->
				<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?> featured-event">
					<?php tribe_get_template_part( 'list/featured-single', 'event' ) ?>
				</div><!-- .hentry .vevent -->


				<?php do_action( 'tribe_events_inside_after_loop' ); ?>
			<?php endwhile; ?>

		<?php } ?>

	<?php } ?>

	<!-- Normal Events Loop -->
	<?php while ( have_posts() ) : the_post(); ?>

		<?php if( array_search( get_the_ID(), $featured_posts ) === FALSE ) { ?>

			<?php do_action( 'tribe_events_inside_before_loop' ); ?>

			<!-- Month / Year Headers -->
			<?php tribe_events_list_the_date_headers(); ?>

			<!-- Event  -->
			<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
				<?php tribe_get_template_part( 'list/single', 'event' ) ?>
			</div><!-- .hentry .vevent -->


			<?php do_action( 'tribe_events_inside_after_loop' ); ?>

		<?php } ?>

	<?php endwhile; ?>

</div><!-- .tribe-events-loop -->
