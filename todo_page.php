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
				<th> <a href="#">Options</a> </td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
<hr>

</div>


<script type="text/javascript">
jQuery(document).ready(function($){


	var data = [
	{"title": "my todo task","description": "My description task"},
	{"title": "my 2nd task","description": "My 2nd task"}
	];



	for (var i = 0; i < data.length; i++) {

		$('tbody').append(
				'<tr> ' + 
				'<td><input type="checkbox"></td>' +
				'<td>' + data[i].title + '</div> </td>' +
				'<td>' + data[i].description+  '</div> </td>' +
				'<td>In progress</td>' +
				'<td>' +
				'<button id="edit" class="button">Edit</button>' +
				'<button id="delete" class="button">Delete</button> </td>' +
				'</tr>'
			);
	
	};
 $('button').click(function(){
 	$action = $(this).attr('id');
 	


	var data = {
		'action': 'my_action',
		'id': 12
	};

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	$.post(ajaxurl, data, function(response) {
		alert('Got this from the server: ' + response);
	});


 });

});
</script>