<?php

/* ---- Modify Title Texts ---- */
function mover_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( $screen->post_type == 'mover') {
          $title = 'Enter moving company name';
     }
  
     return $title;
}

/* ---- Define Admin Page Columns ---- */
function muuv_edit_mover_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'id' => __('ID'),
		'title' => __( 'Mover' ),
		'email' => __('Email'),
		'phone' => __('Phone'),
		'location' => __('Location'),
	);

	return $columns;
}

/* ---- Get Column Data ---- */
function muuv_manage_mover_columns( $column, $post_id ) {
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

		case 'location':
			echo $custom['location'][0] ?: '--';
			break;

		default :
			break;
	}
}

/* ---- Select Sortable Columns ---- */
function muuv_sortable_mover_column( $columns ) {
    $columns['id'] = 'id';
 
    return $columns;
}

/* ---- Modify Status Messages ---- */
function muuv_mover_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );

	$messages['mover'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => 'Mover updated.',
		2  => 'Custom field updated.',
		3  => 'Custom field deleted.',
		4  => 'Mover updated.',
		5  => 'Error: passwords do not match',
		6  => 'Mover created.',
		7  => 'Mover saved.',
		8  => 'Mover submitted.',
		10 => 'Mover draft updated.'
	);

	return $messages;
}

add_filter( 'enter_title_here', 'mover_change_title_text' );
add_filter( 'manage_edit-mover_columns', 'muuv_edit_mover_columns' );
add_action( 'manage_mover_posts_custom_column', 'muuv_manage_mover_columns', 10, 2 );
add_filter( 'manage_edit-mover_sortable_columns', 'muuv_sortable_mover_column' );
add_filter( 'post_updated_messages', 'muuv_mover_updated_messages' );

?>