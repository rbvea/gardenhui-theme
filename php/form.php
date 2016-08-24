<?php

function user_form_init() {
	register_post_type( 'user-form', array(
		'labels'            => array(
			'name'                => __( 'User forms', 'en' ),
			'singular_name'       => __( 'User form', 'en' ),
			'all_items'           => __( 'All User forms', 'en' ),
			'new_item'            => __( 'New user form', 'en' ),
			'add_new'             => __( 'Add New', 'en' ),
			'add_new_item'        => __( 'Add New user form', 'en' ),
			'edit_item'           => __( 'Edit user form', 'en' ),
			'view_item'           => __( 'View user form', 'en' ),
			'search_items'        => __( 'Search user forms', 'en' ),
			'not_found'           => __( 'No user forms found', 'en' ),
			'not_found_in_trash'  => __( 'No user forms found in trash', 'en' ),
			'parent_item_colon'   => __( 'Parent user form', 'en' ),
			'menu_name'           => __( 'User forms', 'en' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-edit',
	) );

}
add_action( 'init', 'user_form_init' );

function user_form_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['user-form'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('User form updated. <a target="_blank" href="%s">View user form</a>', 'en'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'en'),
		3 => __('Custom field deleted.', 'en'),
		4 => __('User form updated.', 'en'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('User form restored to revision from %s', 'en'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('User form published. <a href="%s">View user form</a>', 'en'), esc_url( $permalink ) ),
		7 => __('User form saved.', 'en'),
		8 => sprintf( __('User form submitted. <a target="_blank" href="%s">Preview user form</a>', 'en'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('User form scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview user form</a>', 'en'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('User form draft updated. <a target="_blank" href="%s">Preview user form</a>', 'en'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'user_form_updated_messages' );
