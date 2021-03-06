<?php
// Loading the wordpress plugin files to access the core functions
$path = preg_replace('/wp-content.+$/','', __DIR__);
require_once($path.'wp-load.php');

$result = array();

if((!empty($_POST['user_name']) && $_POST['user_name']!='') && (!empty($_POST['user_email']) && $_POST['user_email']!='')){

	$user_login = sanitize_text_field($_POST['user_name']);
	$user_email = sanitize_text_field($_POST['user_email']);
	$user_role = sanitize_text_field($_POST['user_role']);

	// To check if the username exists or not
	$check_by_username = new WP_User_Query( 
		array(
			'search' => $user_login, 
			'search_columns' => 
			array(
				'user_login', 
				'fields' => 'user_login'
			)
		)
	);	

	// To check if the user email exists or not
	$check_by_email = new WP_User_Query( 
		array(
			'search' => $user_email, 
			'search_columns' => 
			array(
				'user_email', 
				'fields' => 'user_email'
			)
		)
	);

	// To check whether the submitted form has either same username or same email exists or not.
	if(!empty($check_by_username->get_results()) || (!empty($check_by_email->get_results()))){
		$result['success'] = false;
		$result['user_name'] = false;
		$result['user_email'] = false;
	}else{

		$data['user_login'] = $user_login;
		$data['user_email'] = $user_email;
		$data['user_role'] = $user_role;

		// Wordpress Core function to generate random password
		$data['password'] = wp_generate_password( 12, false ); 

		// Wordpress Core function to create user 
		$user_id = wp_create_user(
			$data['user_login'],
			$data['password'],
			$data['user_email'],
		);

		$set_user_role = new WP_User($user_id);

		$set_user_role->set_role($user_role);

		// To check error for user creation part, using Wordpress Core function
		if ( ! is_wp_error( $user_id ) ) {
			$result['success_message'] = 'User created with Username: ' . $data['user_login'].' and Password: '.$data['password'].' Please save this first';
			$result['user_name'] = $data['user_login']; 
			$result['user_email'] = $data['user_email']; 
			$result['user_role'] = $data['user_role']; 
			$result['success'] = true;
		}
	}
}
else{
	$result['success'] = false;
}
// Result response to JSON for Ajax Call
echo wp_send_json($result);