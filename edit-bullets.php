<?php 
require('CONFIG.php'); 
require_once('includes/functions.php');
//doctype and visible header
require('includes/header.php');

//if submitted, pre-fill the fields so the form "sticks" after editing, else use some default items
if(isset($_POST['item'])){
	$items = $_POST['item'];
}else{
	$items = array('Ingredient 1', 'Ingredient 2',	);
}
?>
<main class="container">
	<h1>Add Your Ingredients</h1>

	<form method="post"  action="edit-bullets.php">
		<fieldset id="field">
			<?php 
			foreach( $items AS $key => $item ){ 
				$number = $key + 1;
				?>
				<div>
					<label for="field_<?php echo $number ?>"><?php echo $number; ?>. </label>
					<input type="text" id="field_<?php echo $number ?>" name="item[]" class="multi-field" value="<?php echo $item ?>">
				</div>
			<?php } ?>
			
			
		</fieldset>	

		<button type="button" class="button-outline float-right" onclick="addFormField('field')">+</button>
		<br>
		<input type="submit" value="Submit">
	</form>

	<?php 
	//examples of how to handle array output
	if( ! empty($_POST) ){ ?>
		<hr>
		<h1>Example output</h1>
		
		<h2>Raw Data - <code>print_r($_POST['item']);</code></h2>
		<div class="output">
			<pre><?php print_r($_POST['item']); ?></pre>
		</div>

		<h2>sanitized as strings (strip tags) - <code>foreach</code> with <code>filter_var()</code></h2>
		<?php 
		//sanitize each key in the array
		$clean = array();
		foreach( $_POST['item'] AS $item ){
			$clean[] = filter_var($item, FILTER_SANITIZE_STRING);
		} 
		?>
		<pre><?php print_r($clean); ?></pre>

		<h2>Displayed as a bullet list - <code>foreach</code></h2>
		<blockquote>
			<ul>
				<?php foreach($clean as $item ){
					echo "<li>$item</li>";
				} ?>
			</ul>
		</blockquote>

		<h2>best way to store as one record in Database - <code>serialize()</code></h2>
		<blockquote>
			<?php 
			$serialized = serialize($clean);
			echo $serialized;
			?>
		</blockquote>
		<h2>Convert serialized back to php array with <code>unserialize()</code></h2>
		<pre><?php 
		$array = unserialize($serialized);
		print_r($array);
		?>
	</pre>
<?php } ?>

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


		node.innerHTML = '<div><label for="field_' + fieldCounter + '">' + fieldCounter + '. </label><input type="text" id="field_' + fieldCounter + '" name="item[]" placeholder="Ingredient ' + fieldCounter + '" class="multi-field"></div>';
		parent.appendChild(node);
	}
</script>
<?php include('includes/footer.php'); ?>