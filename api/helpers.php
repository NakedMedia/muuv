<?php


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getUserFromToken( $token ) {
	$users = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => ['mover', 'client'],
			'post_status' => 'publish',
		)
	);

	foreach ($users as $user) {
		if($token == get_post_meta($user->ID, 'token', true))
			return $user;
	}

	return null;
}

function getEmployeeById( $mover_id ) {
	return array(
		'id' => $mover_id,
		'name' => get_post($mover_id)->post_title,
		'phone' => get_post_meta($mover_id, 'phone', true),
		'email' => get_post_meta($mover_id, 'email', true),
		'img' => wp_get_attachment_image_src(get_post_thumbnail_id( $mover_id ))[0],
		'type' => get_post_meta($mover_id, 'type', true),
	);
}

function getClientById( $client_id ) {
	return array(
		'id' => $client_id,
		'name' => get_post($client_id)->post_title,
		'contact_name' => get_post_meta($client_id, 'contact_name', true),
		'contact_phone' => get_post_meta($client_id, 'contact_phone', true),
		'contact_email' => get_post_meta($client_id, 'contact_email', true),
		'address' => get_post_meta($client_id, 'address', true),
		'img' => wp_get_attachment_image_src(get_post_thumbnail_id( $client_id ))[0],
		'type' => 'client'
	);
}

function getReportById( $report_id ) {
	$mover_id = (int) get_post_meta($report_id, 'mover_id', true);
	$client_id = (int) get_post_meta($report_id, 'client_id', true);

	$media_ids = array();
	$media_urls = array();

	if(get_post_meta($report_id, 'media_ids', true) != null) {
		$media_ids = array_map('intval', explode(";", get_post_meta($report_id, 'media_ids', true)));
	
		foreach($media_ids as $media_id) 
			array_push($media_urls, wp_get_attachment_image_src($media_id, 'large')[0]);
	}

	$post = get_post($report_id);

	return array(
		'id' => $report_id,
		'description' => $post->post_content,
		'date' => $post->post_date,
		'media_ids' => $media_ids,
		'media_urls' => $media_urls,
		'mover' => getEmployeeById($mover_id),
		'client' => getClientById($client_id),
	);
}

?>