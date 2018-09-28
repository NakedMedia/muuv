<?php

/* ---- Movers Routes ---- */
function muuv_get_movers( WP_REST_Request $request  ) {
	$user = getUserFromToken($request->get_header('muuv-token'));

	if(!$user) {
		$response = new WP_REST_Response( array('error' => 'Please login') );
		$response->set_status(403);
		return $response;
	}

	if($user->type != 'admin') {
		$response = new WP_REST_Response( array('error' => 'You must be an admin to access this data') );
		$response->set_status(403);
		return $response;
	}

	$args = array(
		'posts_per_page'   => -1,
		'post_type'        => 'mover',
		'post_status'      => 'publish',
	);

	$movers = [];

	foreach (get_posts($args) as $post) {
		$mover = getEmployeeById($post->ID);
		array_push($movers, $mover);
	}

	return new WP_REST_Response( $movers );
}

function muuv_create_mover( WP_REST_Request $request ) {
	$user = getUserFromToken($request->get_header('muuv-token'));

	if(!$user) {
		$response = new WP_REST_Response( array('error' => 'Please login') );
		$response->set_status(403);
		return $response;
	}

	if($user->type != 'admin') {
		$response = new WP_REST_Response( array('error' => 'You must be an admin to access this data') );
		$response->set_status(403);
		return $response;
	}

	$postarr = array(
		'post_title' => $request['name'],
		'post_status' => 'publish',
		'post_type' => 'mover'
	);

	$post = get_post(wp_insert_post($postarr));
	update_post_meta($post->ID, 'phone', $request['phone']);
	update_post_meta($post->ID, 'email', $request['email']);
	update_post_meta($post->ID, 'type', $request['type']);
	update_post_meta($post->ID, "password", password_hash($request["password"], PASSWORD_DEFAULT));
	update_post_meta($post->ID, 'token', "NONE");

	if($request['media_id'])
		set_post_thumbnail($post->ID, $request['media_id']);

	$mover = getEmployeeById($post->ID);

	return new WP_REST_Response( $mover );
}

function muuv_update_mover( WP_REST_Request $request ) {
	$user = getUserFromToken($request->get_header('muuv-token'));

	if(!$user) {
		$response = new WP_REST_Response( array('error' => 'Please login') );
		$response->set_status(403);
		return $response;
	}

	if($user->ID != $request['id'] && $user->type != 'admin') {
		$response = new WP_REST_Response( array('error' => 'You must be an admin to access this data') );
		$response->set_status(403);
		return $response;
	}

	$post = get_post($request->get_param('id'));

	if(!$post) {
		$response = new WP_REST_Response( array('error' => 'No mover with that ID found') );
		$response->set_status(404);
		return $response;
	}

	wp_update_post(array('ID' => $post->ID, 'post_title' => $request['name']));

	update_post_meta($post->ID, 'phone', $request['phone']);
	update_post_meta($post->ID, 'email', $request['email']);
	update_post_meta($post->ID, 'type', $request['type']);

	if($request["password"]) {
		if($user->type == 'admin' || password_verify($request['currentPassword'], get_post_meta($user->ID, 'password', true))) {
			update_post_meta($post->ID, "password", password_hash($request["password"], PASSWORD_DEFAULT));
		}
		else {
			return new WP_REST_Response( array('error' => 'Incorrect password') );
		}

		
	}

	if($request['media_id'])
		set_post_thumbnail($post->ID, $request['media_id']);

	$mover = getEmployeeById($post->ID);

	return new WP_REST_Response( $mover );
}

function muuv_delete_mover( WP_REST_Request $request ) {
	$user = getUserFromToken($request->get_header('muuv-token'));

	if(!$user) {
		$response = new WP_REST_Response( array('error' => 'Please login') );
		$response->set_status(403);
		return $response;
	}

	if($user->type != 'admin') {
		$response = new WP_REST_Response( array('error' => 'You must be an admin to access this data') );
		$response->set_status(403);
		return $response;
	}

	$post = get_post($request->get_param('id'));

	if(!$post) {
		$response = new WP_REST_Response( array('error' => 'No mover with that ID found') );
		$response->set_status(404);
		return $response;
	}

	$mover = getEmployeeById($post->ID);

	wp_trash_post($post->ID);

	return new WP_REST_Response( $mover );
}


add_action( 'rest_api_init', function () {

	register_rest_route( 'muuv', '/movers', array(
		array(
			'methods' => 'GET',
			'callback' => 'muuv_get_movers',
		),
		array(
			'methods' => 'POST',
			'callback' => 'muuv_create_mover',
		),
	));

	register_rest_route( 'muuv', '/movers/(?P<id>\d+)', array(
		array(
			'methods' => 'PATCH',
			'callback' => 'muuv_update_mover',
		),
		array(
			'methods' => 'DELETE',
			'callback' => 'muuv_delete_mover',
		),
	));

} );

?>