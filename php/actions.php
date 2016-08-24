<?php

class GardenHui_Controller {

	function thumbnails() {
    add_image_size('thumbnail', 60, 60, true);
		add_image_size('hero', 1440, 810, true);
	}

	function register_post_types() {

    register_post_type( 'hui', array(
      'labels'            => array(
        'name'                => __( 'Huis', 'en' ),
        'singular_name'       => __( 'Hui', 'en' ),
        'all_items'           => __( 'All Huis', 'en' ),
        'new_item'            => __( 'New hui', 'en' ),
        'add_new'             => __( 'Add New', 'en' ),
        'add_new_item'        => __( 'Add New hui', 'en' ),
        'edit_item'           => __( 'Edit hui', 'en' ),
        'view_item'           => __( 'View hui', 'en' ),
        'search_items'        => __( 'Search huis', 'en' ),
        'not_found'           => __( 'No huis found', 'en' ),
        'not_found_in_trash'  => __( 'No huis found in trash', 'en' ),
        'parent_item_colon'   => __( 'Parent hui', 'en' ),
        'menu_name'           => __( 'Huis', 'en' ),
      ),
      'public'            => true,
      'hierarchical'      => false,
      'show_ui'           => true,
      'show_in_nav_menus' => true,
      'supports'          => array( 'title', 'editor' ),
      'has_archive'       => true,
      'rewrite'           => true,
      'query_var'         => true,
      'menu_icon'         => 'dashicons-admin-post',
    ) );

  	register_post_type( 'connection', array(
  		'labels'            => array(
  			'name'                => __( 'Connections', 'en' ),
  			'singular_name'       => __( 'Connection', 'en' ),
  			'all_items'           => __( 'All Connections', 'en' ),
  			'new_item'            => __( 'New connection', 'en' ),
  			'add_new'             => __( 'Add New', 'en' ),
  			'add_new_item'        => __( 'Add New connection', 'en' ),
  			'edit_item'           => __( 'Edit connection', 'en' ),
  			'view_item'           => __( 'View connection', 'en' ),
  			'search_items'        => __( 'Search connections', 'en' ),
  			'not_found'           => __( 'No connections found', 'en' ),
  			'not_found_in_trash'  => __( 'No connections found in trash', 'en' ),
  			'parent_item_colon'   => __( 'Parent connection', 'en' ),
  			'menu_name'           => __( 'Connections', 'en' ),
  		),
  		'public'            => true,
  		'hierarchical'      => false,
  		'show_ui'           => true,
  		'show_in_nav_menus' => true,
  		'supports'          => array( 'title', 'editor' ),
  		'has_archive'       => true,
  		'rewrite'           => true,
  		'query_var'         => true,
  		'menu_icon'         => 'dashicons-admin-post',
  	));
  }

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

}


?>
