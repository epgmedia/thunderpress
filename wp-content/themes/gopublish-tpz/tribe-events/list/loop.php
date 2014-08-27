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
global $post;
$more = false;
?>
<div class="tribe-events-loop vcalendar">

	<!-- Featured Events Loop -->
	<?php featured_events_list (); ?>

	<!-- Normal Events Loop -->
	<?php while ( have_posts() ) : the_post(); ?>

		<?php //if( array_search( get_the_ID(), $featured_posts ) === FALSE ) { ?>

			<?php do_action( 'tribe_events_inside_before_loop' ); ?>

			<!-- Month / Year Headers -->
			<?php tribe_events_list_the_date_headers(); ?>

			<?php single_event_featured_banner(); ?>

			<!-- Event  -->
			<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
				<?php tribe_get_template_part( 'list/single', 'event' ) ?>
			</div><!-- .hentry .vevent -->


			<?php do_action( 'tribe_events_inside_after_loop' ); ?>

		<?php //} ?>

	<?php endwhile; ?>

</div><!-- .tribe-events-loop -->
