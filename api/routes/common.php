<?php

/* ---- General Routes ---- */
function muuv_api_login( WP_REST_Request $request  ) {
	if(!$request['id'] || !$request['password'])
		return array('error' => 'Please provide a user ID and password');

	$args = array(
		'posts_per_page'   => -1,
		'post_type'        => ['mover', 'client'],
		'post_status'      => 'publish',
	);

	foreach (get_posts($args) as $user) {
		if(
			$user->ID == $request['id'] && 
			password_verify($request['password'], get_post_meta($user->ID, 'password', true))
		) {
			$token = JWT::encode(array('id' => $user->ID), generateRandomString(5));

			update_post_meta($user->ID, 'token', $token);
			return new WP_REST_Response( array('token' => $token) );
		}
	}

	return array('error' => 'Invalid login');
}

function muuv_api_logout( WP_REST_Request $request  ) {
	$user = getUserFromToken($request->get_header('muuv-token'));

	if(!$user) {
		$response = new WP_REST_Response( array('error' => 'Please login') );
		$response->set_status(403);
		return $response;
	}

	update_post_meta($user->ID, 'token', "NONE");

	return new WP_REST_Response( array('message' => 'Successfully logged out') );
}

function muuv_api_media( WP_REST_Request $request ) {
	$user = getUserFromToken($request->get_header('muuv-token'));

	if(!$user) {
		$response = new WP_REST_Response( array('error' => 'Please login') );
		$response->set_status(403);
		return $response;
	}

	$file = $request->get_file_params();

	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

	if (empty($file)) {
		$response = new WP_REST_Response( array('error' => 'No file provided') );
		$response->set_status(403);
		return $response;
	}

    $attachment_id = media_handle_upload( 'file', 0 );
	    
    return new WP_REST_Response( array('media_id' => $attachment_id, 'media_url' => wp_get_attachment_image_src($attachment_id, 'large')[0]) );	
}


/* ---- User Routes ---- */
function muuv_get_me( WP_REST_Request $request ) {
	$user = getUserFromToken($request->get_header('muuv-token'));

	if(!$user) {
		$response = new WP_REST_Response( array('error' => 'Please login') );
		$response->set_status(403);
		return $response;
	}

	if($user->post_type == 'mover') {
		$user = getEmployeeById($user->ID);
	}

	if($user->post_type == 'client') {
		$user = getClientById($user->ID);
	}


	return new WP_REST_Response( $user );
}

add_action( 'rest_api_init', function () {
	remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );

	add_filter( 'rest_pre_serve_request', function( $value ) {
		header( 'Access-Control-Allow-Origin: *' );
		header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, muuv-token' );
		header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH, DELETE' );
		header( 'Access-Control-Allow-Credentials: true' );

		return $value;
	});
	

	register_rest_route( 'muuv', '/login', array(
		'methods' => 'POST',
		'callback' => 'muuv_api_login',
	));

	register_rest_route( 'muuv', '/logout', array(
		'methods' => 'GET',
		'callback' => 'muuv_api_logout',
	));

	register_rest_route( 'muuv', '/media', array(
		'methods' => 'POST',
		'callback' => 'muuv_api_media',
	));

	register_rest_route( 'muuv', '/me', array(
		'methods' => 'GET',
		'callback' => 'muuv_get_me',
	));
} );

?>