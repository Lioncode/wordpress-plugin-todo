<?php
/**
 * Plugin Name: Todos for Admin
 * Plugin URI: http://ryanantenor.be/wordpress/plugins
 * Description: A todo application for admins
 * Version: 1.0.0
 * Author: Ryan Antenor
 * Author URI: http://ryanantenor.be
 * License: A "Slug" license name e.g. GPL2
 */

 //Add the admin menu 
add_action('admin_menu', 'todos_page_actions');
function todos_page_actions() {
	add_menu_page( 'Todo Lists', 'Todo Lists', 'manage_options', __FILE__, 'todos_admin'); 
}

//Display the todo page
function todos_admin(){
	include("todo_page.php");
}

function todos_activate() {

    // Activation code here...
    global $wpdb;
	$table_name = $wpdb->prefix . "todos";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name' ") != $table_name){
		$sql = "CREATE TABLE wp_test (
					tid INT(11) NOT NULL AUTO_INCREMENT,
					title TINYTEXT  NOT NULL,
					description TINYTEXT NOT NULL,
					status TINYTEXT NOT NULL,
					UNIQUE KEY id(tid)
					)";
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				dbDelta($sql);

	}
}
register_activation_hook( __FILE__, 'todos_activate');