<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

get_header(); ?>

	<?php before_calendar_content(); ?>

	<div id="tribe-events-pg-template">

		<?php tribe_events_before_html(); ?>

		<?php if ( is_tax( 'event_regions' ) ) $view = 'list';  ?>

		<?php tribe_get_view( $view ); ?>

		<?php tribe_events_after_html(); ?>

	</div> <!-- #tribe-events-pg-template -->

	<?php include( TEMPLATEPATH . "/sidebar.php" );

get_footer(); ?>

