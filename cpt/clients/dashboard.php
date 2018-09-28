<?php

/* ---- Modify Title Texts ---- */
function client_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( $screen->post_type == 'client') {
          $title = 'Enter client name';
     }
  
     return $title;
}

/* ---- Define Admin Page Columns ---- */
function muuv_edit_client_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'id' => __('ID'),
		'title' => __( 'Client' ),
		'email' => __('Email'),
		'phone' => __('Phone'),
		'type' => __('Move Type'),
	);

	return $columns;
}

/* ---- Get Column Data ---- */
function muuv_manage_client_columns( $column, $post_id ) {
	global $post;

	$custom = get_post_custom($post_id);

	switch( $column ) {

		case 'id' :
			echo $post_id;
			break;

		case 'email':
			echo $custom['email'][0] ?: '--';
			break;

		case 'phone':
			echo $custom['phone'][0] ?: '--';
			break;

		case 'type':
			echo $custom['type'][0] ?: '--';
			break;

		default :
			break;
	}
}

/* ---- Select Sortable Columns ---- */
function muuv_sortable_client_column( $columns ) {
    $columns['id'] = 'id';
 
    return $columns;
}

/* ---- Modify Status Messages ---- */
function muuv_client_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );

	$messages['client'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => 'Client updated.',
		2  => 'Custom field updated.',
		3  => 'Custom field deleted.',
		4  => 'Client updated.',
		5  => 'Error: passwords do not match',
		6  => 'Client created.',
		7  => 'Client saved.',
		8  => 'Client submitted.',
		10 => 'Client draft updated.'
	);

	return $messages;
}

add_filter( 'enter_title_here', 'client_change_title_text' );
add_filter( 'manage_edit-client_columns', 'muuv_edit_client_columns' );
add_action( 'manage_client_posts_custom_column', 'muuv_manage_client_columns', 10, 2 );
add_filter( 'manage_edit-client_sortable_columns', 'muuv_sortable_client_column' );
add_filter( 'post_updated_messages', 'muuv_client_updated_messages' );

?>