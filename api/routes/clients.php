<?php 

/* ---- Clients Routes ---- */
function muuv_get_clients( WP_REST_Request $request  ) {
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
		'post_type'        => 'client',
		'post_status'      => 'publish',
	);

	$clients = [];

	foreach (get_posts($args) as $post) {
		$client = getClientById($post->ID);
		array_push($clients, $client);
	}

	return new WP_REST_Response( $clients );
}

function muuv_create_client( WP_REST_Request $request ) {
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
		'import_id' => $request['id'],
		'post_title' => $request['name'],
		'post_status' => 'publish',
		'post_type' => 'client'
	);

	$post = get_post(wp_insert_post($postarr));
	update_post_meta($post->ID, 'address', $request['address']);
	update_post_meta($post->ID, 'contact_name', $request['contact_name']);
	update_post_meta($post->ID, 'contact_email', $request['contact_email']);
	update_post_meta($post->ID, 'contact_phone', $request['contact_phone']);
	update_post_meta($post->ID, "password", password_hash($request["password"], PASSWORD_DEFAULT));
	update_post_meta($post->ID, 'token', "NONE");

	if($request['media_id'])
		set_post_thumbnail($post->ID, $request['media_id']);

	$client = getClientById($post->ID);

	return new WP_REST_Response( $client );
}

function muuv_update_client( WP_REST_Request $request ) {
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
		$response = new WP_REST_Response( array('error' => 'No client with that ID found') );
		$response->set_status(404);
		return $response;
	}

	wp_update_post(array('ID' => $post->ID, 'post_title' => $request['name']));

	update_post_meta($post->ID, 'address', $request['address']);
	update_post_meta($post->ID, 'contact_name', $request['contact_name']);
	update_post_meta($post->ID, 'contact_email', $request['contact_email']);
	update_post_meta($post->ID, 'contact_phone', $request['contact_phone']);

	if($request["password"])
		update_post_meta($post->ID, "password", password_hash($request["password"], PASSWORD_DEFAULT));

	if($request['media_id'])
		set_post_thumbnail($post->ID, $request['media_id']);

	$client = getClientById($post->ID);

	return new WP_REST_Response( $client );
}

function muuv_delete_client( WP_REST_Request $request ) {
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
		$response = new WP_REST_Response( array('error' => 'No client with that ID found') );
		$response->set_status(404);
		return $response;
	}

	$client = getClientById($post->ID);

	wp_trash_post($post->ID);

	return new WP_REST_Response( $client );
}


add_action( 'rest_api_init', function () {

	register_rest_route( 'muuv', '/clients', array(
		array(
			'methods' => 'GET',
			'callback' => 'muuv_get_clients',
		),
		array(
			'methods' => 'POST',
			'callback' => 'muuv_create_client',
		),
	));

	register_rest_route( 'muuv', '/clients/(?P<id>\d+)', array(
		array(
			'methods' => 'PATCH',
			'callback' => 'muuv_update_client',
		),
		array(
			'methods' => 'DELETE',
			'callback' => 'muuv_delete_client',
		),
	));
} );

?>