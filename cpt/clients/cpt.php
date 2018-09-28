<?php

/* ---- Create Custom Post Types ---- */
function client_create_type() {
	$args = array(
	      	'label' => 'Clients',
	      	'labels' => array(
	      		'add_new_item' => 'Add New Client',
	      		'edit_item' => 'Edit Client',
	      		'search_items' => 'Search Clients',
	      		'not_found' => 'No Clients Found',
	      		'singular_name' => 'Client'
	      	),
	       	'public' => false,
	       	'show_ui' => true,
	       	'capability_type' => 'post',
	       	'show_in_rest' => false,
	       	'hierarchical' => false,
	       	'rewrite' => array('slug' => 'clients'),
			'menu_icon'  => 'dashicons-universal-access',
	        'query_var' => true,
	        'supports' => array(
	            'title',
	            'thumbnail')
	    );
	register_post_type( 'client' , $args );
}

/*------ Metabox Functions --------*/

function client_init() {
	global $current_user;

	add_meta_box("client-meta", "Client Info", "client_meta", "client", "normal", "high");
	add_meta_box("password-meta", "Password", "client_pass_meta", "client", "normal", "high");
}

function client_meta() {
	global $post;
    $custom = get_post_custom($post->ID);

    include_once('views/client-view.php');
}

function client_pass_meta() {
	global $post;
    $custom = get_post_custom($post->ID);

    include_once(plugin_dir_path( __FILE__ ) . '../common/views/password-view.php');
}

function client_save($post_id, $post) {
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || $post->post_status == 'auto-draft' ) return $post_id;
    if ( $post->post_type != 'client' ) return $post_id;

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $password_match = $password == '' || $password == $confirm_password;

    if ( ( isset( $_POST['publish'] ) || isset( $_POST['save'] ) ) && $_POST['post_status'] == 'publish' ) {
        if ( !$password_match ) {
            global $wpdb;
            $wpdb->update( $wpdb->posts, array( 'post_status' => 'pending' ), array( 'ID' => $post_id ) );

            add_filter( 'redirect_post_location', create_function( '$location','return add_query_arg("message", "5", $location);' ) );
            return $post_id;
        }
    }

	if(array_key_exists('password', $_POST) && $_POST['password'] != '')
		update_post_meta($post->ID, "password", password_hash($_POST["password"], PASSWORD_DEFAULT));	

	update_post_meta($post->ID, "email", $_POST["email"]);
	update_post_meta($post->ID, "phone", $_POST["phone"]);
	update_post_meta($post->ID, "from", $_POST["from"]);
	update_post_meta($post->ID, "to", $_POST["to"]);
	update_post_meta($post->ID, "type", $_POST["type"]);
	update_post_meta($post->ID, "auto_transport", $_POST["auto_transport"]);
}

add_action('init', 'client_create_type');
add_action("admin_init", "client_init");

add_action('save_post', 'client_save', 20, 2);


?>