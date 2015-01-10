<?php
/**
 * Related functionality for Featured Events
 */

/**
 * Function to add meta box for featured posts.
 */
add_action( 'add_meta_boxes', 'addFeaturedBox' );
function addFeaturedBox() {
	add_meta_box(
		'tribe_events_featured_event',
		'Featured Event',
		'eventFeaturedBox',
		'tribe_events',
		'side',
		'default'
	);
}

/**
 * Displays the featured Event metabox
 */
function eventFeaturedBox() {
	global $post;
	wp_nonce_field( 'featured_event_meta_box', 'featured_event_meta_box_nonce' );
	$checked = ( get_post_meta( $post->ID, 'featured_event', true ) == 1 ? ' checked' : '');
	?>
	<label class="selectit">
		<input type="checkbox" value="1" <?php echo $checked; ?> name="featured_event"> Make Featured
	</label>
<?php
}

/**
 * Featured event meta box validator
 */
add_action( 'save_post_tribe_events', 'featured_event_save_meta_box_data' );
function featured_event_save_meta_box_data( $post_id ) {
	// Check if our nonce is set.
	if ( ! isset( $_POST['featured_event_meta_box_nonce'] ) ) {

		return;
	}
	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['featured_event_meta_box_nonce'], 'featured_event_meta_box' ) ) {

		return;
	}
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

		return;
	}
	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'tribe_events' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {

			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {

			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Make sure that it is set.
	if ( ! isset( $_POST['featured_event'] ) ) {

		return;
	}

	// Sanitize user input.
	$my_data = ( $_POST['featured_event'] ? 1 : 0 );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'featured_event', $my_data );
}

function featured_events_ids( ) {
	$featured_query = get_featured_events();
	$featured_events = $featured_query->posts;
	$featured_posts = array();

	foreach ( $featured_events as $post ) {
		$featured_posts[] = $post->ID;
	}

	return $featured_posts;
}

function get_featured_events( ) {
	global $wp_query;

	$args = array(
		"post_type" => 'tribe_events',
		"eventDisplay" => 'upcoming',
		'meta_query' => array(
			array(
				'key' => 'featured_event',
				'value' => 1
			)
		),
		"tax_query" => $wp_query->tax_query->queries,
		"posts_per_page" => '10',
		"start_date" => date('Y-m-d H:i:s', strtotime("now")),
		'orderby' => 'event_date',
		'order' => 'ASC'
	);

	$featured_events = new WP_query($args);

	if ( $featured_events->have_posts() ) {

		return $featured_events;
	} else {

		return null;
	}
}

function featured_events_list() {

	$featured_events = get_featured_events();


	if ( $_REQUEST['tribe_paged'] < 2 &&
	     $featured_events !== null &&
	     $featured_events->have_posts()
	) {
		while( $featured_events->have_posts() ):
			$featured_events->the_post();
			$featured_posts[] = get_the_ID();

			do_action( 'tribe_events_inside_before_loop' ); ?>

			<!-- FEATURED -->
			<?php single_event_featured_banner(); ?>

			<!-- Featured Event  -->
			<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?> featured-event">
				<?php tribe_get_template_part( 'list/featured-single', 'event' ) ?>
			</div><!-- .hentry .vevent -->


			<?php do_action( 'tribe_events_inside_after_loop' );
		endwhile;
	}
}

//add_action( 'pre_get_posts','remove_featured_from_main' );
function remove_featured_from_main( WP_Query $query ) {

	if( $query->is_main_query() ) {
		//Do something to main query
		$event_ids = featured_events_ids();
		if ( count( $event_ids ) >= 1 ) {
			$posts_per_page = $query->query_var['posts_post_page'];

			$query->query_var['post__not_in']    = $event_ids;
			$query->query_var['posts_post_page'] = $posts_per_page - count($event_ids);
		}
	}

	return $query;
}

/**
 * Add featured banner to the top of posts
 */
add_action( 'epg_events_single_event_before_content', 'single_event_featured_banner' );
function single_event_featured_banner() {
	global $post;
	if ( get_post_meta( $post->ID, 'featured_event', true ) ){
		featured_event_banner();
	}
}

/**
 * Div and text to appear for featured events
 */
function featured_event_banner() {
	echo '<div class="featured-event-label"><span>Featured Event</span></div>';
}