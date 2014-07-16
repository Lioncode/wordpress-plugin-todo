<div class="wrap">

	<h2>Todo Application</h2>
<input type="search" id="todo_add_text"> <button id="add_btn" class="button-primary action">Add</button>

<hr>
	<table class="widefat">
		<thead>
			<tr >
				<th class="check-column"><input type="checkbox"></th>
				<th class="column-title"><a href="#">Title</a></th>
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
<?php
//Set Your Nonce
$ajax_nonce = wp_create_nonce( "my-special-string" );
?>

<script type="text/javascript">
jQuery(document).ready(function($){


	 
	function tasks(action){

	var data = {
	'action': action,
	'security': '<?php echo $ajax_nonce; ?>',
	};

	$.post(ajaxurl, data, function(response) {
	//alert('Got this from the server: ' + response);
	$('tbody').append(response);
	$('tbody tr:odd').addClass('alternate');
	});
	}

	function tasks_delete(id){
	var data = {
	'action': 'delete_task',
	'security': '<?php echo $ajax_nonce; ?>',
	'id': id
	};
		$.post(ajaxurl, data, function(response) {
			$('tbody').text('');
			$('tbody').append(response);
			$('tbody tr:odd').addClass('alternate');
		});
	}

	function add_task(){


	var title = $('#todo_add_text').val();
    //title = $(title)[0].textContent;

	var data = {
	'action': 'add_task',
	'security': '<?php echo $ajax_nonce; ?>',
	'title': title
	};
		$.post(ajaxurl, data, function(response){$('tbody').text('');
			$('tbody').append(response);
			$('tbody tr:odd').addClass('alternate');
				}
			);
	}
	tasks('load_todos');
	function edit(event){
		 event.parent().parent().find('label').hide();
		  event.parent().parent().find('input').show();
		  console.log(event);
	}
	
 $('.wrap').on('click','button',function(e){
 	// $action = $(this).attr('id');
 	
 	var action = $(this).text();
 	var id = $(this).attr('id');
 	//console.log($(this).parent().parent().find('label').text());
 
 	switch(action) {
    case 'Edit':
    	edit($(this));
        break;
    case 'Delete':
       tasks_delete(id);
        break;
    case 'Add':
    	add_task();
    	break;
    // default:
    //     default code block
	}

	
 });



});
</script>
