			<div>
				<label for="field_1">List Item 1</label>
				<input type="text" id="field_1" name="item[]" class="multi-field">
			</div>
			<div>
				<label for="field_2">List Item 2</label>
				<input type="text" id="field_2" name="item[]" class="multi-field">
			</div>
			
		</fieldset>	

		<button type="button" class="button-outline float-right" onclick="addFormField('field')">+</button>
		<br>

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