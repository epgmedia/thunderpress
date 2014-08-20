<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */
?>

<div class="tribe-events-meta-group tribe-events-meta-group-details" id="tribe-event-details">
	<h3 class="tribe-events-single-section-title"> <?php _e('Details', 'tribe-events-calendar' ) ?> </h3>
	<table>

		<tr>

			<?php
			do_action( 'tribe_events_single_meta_details_section_start' );

			$time_format = get_option( 'time_format', TribeDateUtils::TIMEFORMAT );
			$time_range_separator = tribe_get_option('timeRangeSeparator', ' - ');

			$start_datetime = tribe_get_start_date();
			$start_date = tribe_get_start_date( null, false );
			$start_time = tribe_get_start_date( null, false, $time_format );
			$start_ts = tribe_get_start_date( null, false, TribeDateUtils::DBDATEFORMAT );

			$end_datetime = tribe_get_end_date();
			$end_date = tribe_get_end_date( null, false );
			$end_time = tribe_get_end_date( null, false,  $time_format );
			$end_ts = tribe_get_end_date( null, false, TribeDateUtils::DBDATEFORMAT );

			// All day (multiday) events
			if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
			?>

			<td class="tribe-event-detail-label"> <?php _e( 'Start:', 'tribe-events-calendar' ) ?> </td>
			<td> <abbr class="tribe-events-abbr updated published dtstart" title="<?php esc_attr_e( $start_ts ) ?>"> <?php esc_html_e( $start_date ) ?> </abbr> </td>
		</tr>
		<tr>
			<td class="tribe-event-detail-label"> <?php _e( 'End:', 'tribe-events-calendar' ) ?> </td>
			<td> <abbr class="tribe-events-abbr dtend" title="<?php esc_attr_e( $end_ts ) ?>"> <?php esc_html_e( $end_date ) ?> </abbr> </td>
		</tr>
			<?php
			// All day (single day) events
			elseif ( tribe_event_is_all_day() ):
				?>
			<tr>
				<td class="tribe-event-detail-label"> <?php _e( 'Date:', 'tribe-events-calendar' ) ?> </td>
				<td> <abbr class="tribe-events-abbr updated published dtstart" title="<?php esc_attr_e( $start_ts ) ?>"> <?php esc_html_e( $start_date ) ?> </abbr> </td>
			</tr>
			<?php
			// Multiday events
			elseif ( tribe_event_is_multiday() ) :
			?>
		<tr>
			<td class="tribe-event-detail-label"> <?php _e( 'Start:', 'tribe-events-calendar' ) ?> </td>
			<td> <abbr class="tribe-events-abbr updated published dtstart" title="<?php esc_attr_e( $start_ts ) ?>"> <?php esc_html_e( $start_datetime ) ?> </abbr> </td>
		</tr>
		<tr>
			<td class="tribe-event-detail-label"> <?php _e( 'End:', 'tribe-events-calendar' ) ?> </td>
			<td> <abbr class="tribe-events-abbr dtend" title="<?php esc_attr_e( $end_ts ) ?>"> <?php esc_html_e( $end_datetime ) ?> </abbr> </td>
		</tr>
		<?php
		// Single day events
		else :
			?>
			<tr>
				<td class="tribe-event-detail-label"> <?php _e( 'Date:', 'tribe-events-calendar' ) ?> </td>
				<td> <abbr class="tribe-events-abbr updated published dtstart" title="<?php esc_attr_e( $start_ts ) ?>"> <?php esc_html_e( $start_date ) ?> </abbr> </td>
			</tr>
			<tr>
				<td class="tribe-event-detail-label"> <?php _e( 'Time:', 'tribe-events-calendar' ) ?> </td>
				<td> <abbr class="tribe-events-abbr updated published dtstart" title="<?php esc_attr_e( $end_ts ) ?>">
						<?php if ( $start_time == $end_time ) esc_html_e( $start_time ); else esc_html_e( $start_time . $time_range_separator . $end_time ); ?>
					</abbr> </td>
			</tr>
		<?php endif ?>

		<?php
		$cost = tribe_get_formatted_cost();
		if ( ! empty( $cost ) ):
			?>
			<tr>
				<td class="tribe-event-detail-label"> <?php _e( 'Cost:', 'tribe-events-calendar' ) ?> </td>
				<td class="tribe-events-event-cost"> <?php esc_html_e( tribe_get_formatted_cost() ) ?> </td>
			</tr>
		<?php endif ?>

		<tr>
			<?php
			echo tribe_get_event_categories( get_the_id(),array(
					'before' => '',
					'sep' => ', ',
					'after' => '',
					'label' => null, // An appropriate plural/singular label will be provided
					'label_before' => '<td class="tribe-event-detail-label">',
					'label_after' => '</td>',
					'wrap_before' => '<td class="tribe-events-event-categories">',
					'wrap_after' => '</td>'
				) );
			?>
		</tr>
		<tr>
			<td colspan="2">
				<dl>
					<?php echo tribe_meta_event_tags( __( 'Event Tags:', 'tribe-events-calendar' ), ', ', false ) ?>
				</dl>
			</td>
		</tr>
		<?php
		$website = tribe_get_event_website_link();
		if ( ! empty( $website ) ):
			?>
			<tr>
				<td class="tribe-event-detail-label"> <?php _e( 'Website:', 'tribe-events-calendar' ) ?> </td>
				<td class="tribe-events-event-url"> <?php echo $website ?> </td>
			</tr>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>

	</table>

	<!-- 'tribe_events_single_meta_details_section_end' -->
</div>