<?php

if ( class_exists( 'TribeField' ) ) {

	class featured_event_field extends TribeField {

		public function __construct() {
			$id = 'tribe_featured_event';
			$field = array(
				'type' => 'checkbox_bool',
				'name' => $id,
				'label' => 'Featured Event class',
				'tooltip' => '',
				'can_be_empty' => true,
			);

			parent::__construct($id, $field);

		}

	}

}


add_action( 'add_meta_boxes', 'addFeaturedBox' );
function addFeaturedBox() {
	add_meta_box( 'tribe_events_featured_event', 'Featured Event', 'eventFeaturedBox', 'tribe_events', 'side', 'default' );
}

function eventFeaturedBox() {
	global $post;
	wp_nonce_field( 'featured_event_meta_box', 'featured_event_meta_box_nonce' );
	$value = get_post_meta( $post->ID, 'featured_event', true );
	$checked = ($value === 'on' ? ' checked' : '');

	echo $checked;
	?>
	<label class="selectit"><input type="checkbox" <?php echo $checked; ?> name="featured_event"> Make Featured</label>
<?php
}

add_action( 'save_post_tribe_events', 'featured_event_save_meta_box_data' );
function featured_event_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */
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
	$my_data = $_POST['featured_event'];

	echo $my_data;

	// Update the meta field in the database.
	update_post_meta( $post_id, 'featured_event', $my_data );
}