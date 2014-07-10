
<?php

if (isset($_POST["add"]) && !empty($_POST["add"])) {
   
	//Add row data
	global $wpdb;


}else{  
    echo "N0, mail is not set";
}
?>

<div class="wrap">

	<h2>Todo Application</h2>

<form action="" method="POST">
<input type="search" name="add"> <button class="button action">Add</button>
</form>

<hr>

	<table class="widefat">
		<thead>
			<tr >
				<th><a href="#">Task</a></th>
				<th><a href="#">Title</a></th>
				<th><a href="#">Description</th>
				<th><a href="#">Status</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input type="checkbox"></td>
				<td>My Todo Application</td>
				<td>Todo Description</td>
				<td>In progress</td>
			</tr>
		
			<tr>
				<td><input type="checkbox"></td>
				<td>My Todo Application</td>
				<td>Todo Description</td>
				<td>In progress</td>
			</tr>

			<tr>
				<td><input type="checkbox"></td>
				<td>My Todo Application</td>
				<td>Todo Description</td>
				<td>In progress</td>
			</tr>

		</tbody>
	</table>
<hr>
</div>