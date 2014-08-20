<?php

if ( class_exists( 'TribeField' ) ) {

	class featured_event_field extends TribeField {

		public function __construct() {
			$id = 'tribe_featured_event';
			$field = array(
				'type' => 'checkbox_bool',
				'name' => $id,
				'label' => 'Featured Event',
				'tooltip' => '',
				'can_be_empty' => true,
			);

			parent::__construct($id, $field);

		}

	}

}