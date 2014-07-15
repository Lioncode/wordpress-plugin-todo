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

		global $wpdb;
		$sql = "CREATE TABLE $table_name (
		 			tid INT(11) NOT NULL AUTO_INCREMENT,
		 			title TINYTEXT  NOT NULL,
					description TINYTEXT NOT NULL,
		 			status TINYTEXT NOT NULL,
		 			UNIQUE KEY id(tid)
				);";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);


	}
}
register_activation_hook( __FILE__, 'todos_activate');


//Ajax loads
function myFunction(){
//do something
die();
}
add_action('wp_ajax_myFunction', 'myFunction');
add_action('wp_ajax_nopriv_myFunction', 'myFunction');




//Ajax action response
 add_action( 'wp_ajax_load_todos', 'my_action_callback' );
function my_action_callback() {
	global $wpdb; // this is how you get access to the database
	check_ajax_referer( 'my-special-string', 'security' );
	$table_name = $wpdb->prefix . "todos";
	$data = $wpdb->get_results( "SELECT * FROM wp_todos");

	render($data);

	die(); // this is required to return a proper result
}

function render(){
	global $wpdb;
	$data = $wpdb->get_results( "SELECT * FROM wp_todos");

	if($data){
		$db = "";
		foreach ($data as $key)  {
			$db .= '<tr> 
					<td><input type="checkbox" ></td>
					<td><label>'.$key->title.'</label><div><input class="edit" type="text" value=" ' . $key->title . '"> </div> </td> 
					<td>'.$key->description.'</div> </td>
					<td>'.$key->status.'</td>
					<td>
					<button id="'. $key->tid .'" class="button">Edit</button>
					<button id="'. $key->tid .'" class="button">Delete</button> </td>
					</tr>';
		}
		echo $db;
	}else{
		echo '';
	}


}


add_action( 'wp_ajax_delete_task', 'delete_task' );
function delete_task(){
	global $wpdb;
	$table_name = $wpdb->prefix . "todos";
	$wpdb->delete($table_name,array('tid'=>$_POST['id']));

	$data = $wpdb->get_results( "SELECT * FROM wp_todos");
	render($data);
	
	die();
}

add_action( 'wp_ajax_add_task', 'add_task' );
function add_task(){
	global $wpdb;
	$table_name = $wpdb->prefix . "todos";
	echo $_POST['title'];
	$wpdb->insert($table_name,array('title'=>$_POST['title']));
	render();
	die();
}

// Register style sheet.
//add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );
add_action( 'admin_enqueue_scripts', 'register_plugin_styles' );
/**
 * Register stylsheet.
 */
function register_plugin_styles() {
	wp_register_style( 'my-plugin', plugins_url( 'css/styles.css', __FILE__ ) );
	wp_enqueue_style( 'my-plugin' );
}

