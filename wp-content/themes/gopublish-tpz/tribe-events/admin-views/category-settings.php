<?php

add_action('tribe_settings_do_tabs', 'tribe_general_setting_tabs');
function tribe_general_setting_tabs() {
	$taxonomies = array(
		'tribe_events_cat',
	);

	$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'hide_empty'        => false,
		'fields'            => 'all',
		'hierarchical'      => true,
		'get'               => '',
		'name__like'        => '',
		'description__like' => '',
		'pad_counts'        => false,
		'offset'            => '',
		'search'            => '',
		'cache_domain'      => 'core'
	);

	$terms = get_terms( $taxonomies, $args );
	$term_ids = array();
	foreach ( $terms as $term ) {
		$term_ids[$term->term_id] = $term->name;
	}

	$generalTab = array(
		'priority' => 20,
		'fields' => array(
			'settings-heading' => array(
				'type' => 'heading',
				'label' => __('Featured Categories Settings', 'tribe-events-calendar'),
			),
			'featured_category_1' => array(
				'type' => 'dropdown',
				'label' => __('Featured Category 1', 'tribe-events-calendar'),
				'tooltip' => __('This will be the first category to appear in the header', 'tribe-events-calendar'),
				'validation_type' => 'options',
				'size' => 'medium',
				'default' => null,
				'options' => $term_ids,
			),
			'featured_category_2' => array(
				'type' => 'dropdown',
				'label' => __('Featured Category 2', 'tribe-events-calendar'),
				'tooltip' => __('This will be the first category to appear in the header', 'tribe-events-calendar'),
				'validation_type' => 'options',
				'size' => 'medium',
				'default' => null,
				'options' => $term_ids,
			),
			'featured_category_3' => array(
				'type' => 'dropdown',
				'label' => __('Featured Category 3', 'tribe-events-calendar'),
				'tooltip' => __('This will be the first category to appear in the header', 'tribe-events-calendar'),
				'validation_type' => 'options',
				'size' => 'medium',
				'default' => null,
				'options' => $term_ids,
			),
			'featured_category_4' => array(
				'type' => 'dropdown',
				'label' => __('Featured Category 4', 'tribe-events-calendar'),
				'tooltip' => __('This will be the first category to appear in the header', 'tribe-events-calendar'),
				'validation_type' => 'options',
				'size' => 'medium',
				'default' => null,
				'options' => $term_ids,
			),
		),
	);
	new TribeSettingsTab( 'featured_categories', __('Featured Categories', 'tribe-events-calendar'), $generalTab);
}
