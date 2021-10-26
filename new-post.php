<?php 
require('CONFIG.php');
require_once('includes/functions.php');
require('includes/header.php');
//kill the page if not logged in
if( ! $logged_in_user ){
	exit( 'This page is for logged in users only.' );
}
 ?>
	<main class="content">
	<?php  ?>
	<h2>Add A Post</h2>
        <form method="post" action="single.php?post_id=<?php echo $post_id; ?>">
		    <label>Upload Your Image</label>
            <input type="submit" value="Next">
            <input type="hidden" name="did_add_image" value="1">
        </form>

	
	</main>
<script type="text/javascript">
	function addFormField(id) {
		switch(id) {
			case "field":
			addfieldField(id);
			break;
		}
	}

	//count how many fields there are so we can add on to them with the correct numbering
	var fieldCounter = document.getElementsByClassName("multi-field").length
	console.log(fieldCounter);

	function addfieldField(id) {
		var parent = document.getElementById(id);
		var node = document.createElement('div');
		fieldCounter++;


		node.innerHTML = '<div><label for="field_' + fieldCounter + '">List Item ' + fieldCounter + '</label><input type="text" id="field_' + fieldCounter + '" name="item[]" placeholder="Item ' + fieldCounter + '" class="multi-field"></div>';
		parent.appendChild(node);
	}
</script>
<?php include('includes/footer.php'); ?>