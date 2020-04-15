<?php

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

add_action('init', 'create_post_type_places');

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_places()
{
	register_taxonomy_for_object_type('category', 'places'); // Register Taxonomies for Category
	// register_taxonomy_for_object_type('post_tag', 'places');
	register_post_type('places', // Register Custom Post Type
		array(
		'labels' => array(
			'name' => __('Заклади', 'understrap'), // Rename these to suit
			'singular_name' => __('Заклад', 'understrap'),
			'menu_name' => __('Заклади', 'understrap'),
			'all_items' => __('Усі заклади', 'understrap'),
			'add_new' => __('Додати новий', 'understrap'),
			'add_new_item' => __('Додати новий заклад', 'understrap'),
			'edit' => __('Редагувати', 'understrap'),
			'edit_item' => __('Редагувати заклад', 'understrap'),
			'new_item' => __('Новий заклад', 'understrap'),
			'view' => __('Дивитись заклад', 'understrap'),
			'view_item' => __('Дивитись заклад', 'understrap'),
			'search_items' => __('Шукати заклад', 'understrap'),
			'not_found' => __('Заклад не знайдено', 'understrap'),
			'not_found_in_trash' => __('Немає закладу у кошику', 'understrap')
		),
		'menu_icon' => 'dashicons-admin-multisite',
		'public' => true,
		'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
		'has_archive' => true,
		'supports' => array(
			'title',
      'thumbnail',
			'editor'
		), // Go to Dashboard Location post for supports
		'can_export' => true, // Allows export in Tools > Export
		'taxonomies' => array(
			'post_tag',
			'category'
		) // Add Category and Post Tags support
	));
}