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
			'name' => __('Заклади', 'neve-child'), // Rename these to suit
			'singular_name' => __('Заклад', 'neve-child'),
			'menu_name' => __('Заклади', 'neve-child'),
			'all_items' => __('Усі заклади', 'neve-child'),
			'add_new' => __('Додати новий', 'neve-child'),
			'add_new_item' => __('Додати новий заклад', 'neve-child'),
			'edit' => __('Редагувати', 'neve-child'),
			'edit_item' => __('Редагувати заклад', 'neve-child'),
			'new_item' => __('Новий заклад', 'neve-child'),
			'view' => __('Дивитись заклад', 'neve-child'),
			'view_item' => __('Дивитись заклад', 'neve-child'),
			'search_items' => __('Шукати заклад', 'neve-child'),
			'not_found' => __('Заклад не знайдено', 'neve-child'),
			'not_found_in_trash' => __('Немає закладу у кошику', 'neve-child')
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