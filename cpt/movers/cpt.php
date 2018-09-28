<?php

/* ---- Create Custom Post Types ---- */
function mover_create_type() {
	$args = array(
	      	'label' => 'Movers',
	      	'labels' => array(
	      		'add_new_item' => 'Add New Mover',
	      		'edit_item' => 'Edit Mover',
	      		'search_items' => 'Search Movers',
	      		'not_found' => 'No Movers Found',
	      		'singular_name' => 'Mover'
	      	),
	       	'public' => false,
	       	'show_ui' => true,
	       	'capability_type' => 'post',
	       	'show_in_rest' => false,
	       	'hierarchical' => false,
	       	'rewrite' => array('slug' => 'movers'),
			'menu_icon'  => 'dashicons-admin-multisite',
	        'query_var' => true,
	        'supports' => array(
	            'title',
	            'thumbnail')
	    );
	register_post_type( 'mover' , $args );
}

/*------ Metabox Functions --------*/
function mover_init() {
	global $current_user;

	add_meta_box("mover-meta", "Moving Company Info", "mover_meta", "mover", "normal", "high");
	add_meta_box("password-meta", "Password", "mover_pass_meta", "mover", "normal", "high");
}

function mover_meta() {
	global $post;
    $custom = get_post_custom($post->ID);

    include_once('views/mover.php');
}

function mover_pass_meta() {
	global $post;
    $custom = get_post_custom($post->ID);

    include_once(plugin_dir_path( __FILE__ ) . '../common/views/password-view.php');
}

function mover_save($post_id, $post) {
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || $post->post_status == 'auto-draft' ) return $post_id;
    if ( $post->post_type != 'mover' ) return $post_id;

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
	update_post_meta($post->ID, "location", $_POST["location"]);

	update_post_meta($post->ID, "Local", $_POST["Local"]);
	update_post_meta($post->ID, "LongDistance", $_POST["LongDistance"]);
	update_post_meta($post->ID, "AutoTransport", $_POST["AutoTransport"]);
	update_post_meta($post->ID, "International", $_POST["International"]);
}

add_action('init', 'mover_create_type');
add_action("admin_init", "mover_init");

add_action('save_post', 'mover_save', 20, 2);

?>