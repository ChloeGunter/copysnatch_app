<?php 
require('CONFIG.php');
require_once('includes/functions.php');
require('includes/header.php');
//kill the page if not logged in
if( ! $logged_in_user ){
	exit( 'This page is for logged in users only.' );
}
//which post are we editing?
$post_id = filter_var( $_GET['post_id'], FILTER_SANITIZE_NUMBER_INT );

 ?>
    <main class="content" id="edit-post">
        <?php require( 'includes/edit-post-parse.php' ); ?>

        <h2>Edit Your Post</h2>

        <?php show_feedback( $feedback, $feedback_class, $errors ); ?>

        <img src="uploads/<?php echo $image; ?>_medium.jpg">

        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

            <label>Title</label>
            <input type="text" name="title" value="<?php echo $title; ?>">

            <label>Caption</label>
            <textarea name="body"><?php echo $body; ?></textarea>

            <?php 
            //get all the categories in the alphabetical order
            $result = $DB->prepare('SELECT * FROM categories
                                    ORDER BY name ASC');
            $result->execute();
            if( $result->rowCount() >= 1 ){
            ?>
            <label>Category</label>
            <select name="category_id">
                <?php while( $row = $result->fetch() ){ ?>
                <option value="<?php echo $row['category_id']; ?>" 
                    <?php selected( $category_id, $row['category_id'] ); ?>>
                    <?php echo $row['name']; ?>
                </option>
                <?php } ?>
            </select>
            <?php } ?>

            <h1>Recipe Details</h1>
            <label>Time to make the recipe:</label>
            <span><input type="number" name="time" value="<?php echo $time; ?>">minutes</span>

            <label>Number of servings:</label>
            <span><input type="number" name="servings" value="<?php echo $servings; ?>">servings</span>

            <label>Calories per serving:</label>
            <span><input type="number" name="calories" value="<?php echo $calories; ?>">calories</span>

            <?php 
            $result = $DB->prepare('SELECT * FROM levels');
            $result->execute();
            if( $result->rowCount() >= 1 ){
            ?>
            <label>Difficulty Level:</label>
            <select name="level_id">
                <?php while( $row = $result->fetch() ){ ?>
                <option value="<?php echo $row['level_id']; ?>" 
                    <?php selected( $level_id, $row['level_id'] ); ?>>
                    <?php echo $row['name']; ?>
                </option>
                <?php } ?>
            </select>
            <?php } ?>


            <h1>Add Your Ingredients</h1>
        <!-- <form method="post"  action="edit-bullets.php"> -->
            <fieldset id="field">
                <?php 
                foreach( $ingredients AS $key => $item ){ 
                    $number = $key + 1;
                    ?>
                    <div>
                        <label for="field_<?php echo $number ?>"><?php echo $number; ?>. </label>
                        <input type="text" id="field_<?php echo $number ?>" name="item[]" class="multi-field" value="<?php echo $item ?>">
                    </div>
                <?php } ?>
                
                
            </fieldset>	

            <button type="button" class="button-outline" onclick="addFormField('field')">+</button>
            <br>


            <h1>Add The Instructions</h1>
        <!-- <form method="post"  action="edit-bullets.php"> -->
            <fieldset id="sfield">
                <?php 
                foreach( $steps AS $key => $step ){ 
                    $number = $key + 1;
                    ?>
                    <div>
                        <label for="sfield_<?php echo $number ?>"><?php echo $number; ?>. </label>
                        <input type="text" id="sfield_<?php echo $number ?>" name="step[]" class="multi-sfield" value="<?php echo $step ?>">
                    </div>
                <?php } ?>
                
                
            </fieldset>	

            <button type="button" class="button-outline" onclick="addFormStep('sfield')">+</button>
            <br>

            <label>
                <input type="checkbox" name="allow_comments" value="1" 
                <?php checked( $allow_comments, 1 ); ?>>
                Allow Comments on this post
            </label>

            <label>
                <input type="checkbox" name="is_published" value="1" 
                <?php checked( $is_published, 1 ); ?>>
                Make this post public
            </label>

            <input type="submit" name="Save Post" class="button button-outline">
            <input type="hidden" name="did_edit" value="1">

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


		node.innerHTML = '<div><label for="field_' + fieldCounter + '">' + fieldCounter + '. </label><input type="text" id="field_' + fieldCounter + '" name="item[]" placeholder="Ingredient ' + fieldCounter + '" class="multi-field"></div>';
		parent.appendChild(node);
	}

	function addFormStep(id) {
		switch(id) {
			case "sfield":
			addfieldStep(id);
			break;
		}
	}

	//count how many fields there are so we can add on to them with the correct numbering
	var sfieldCounter = document.getElementsByClassName("multi-sfield").length
	console.log(sfieldCounter);

	function addfieldStep(id) {
		var parent = document.getElementById(id);
		var node = document.createElement('div');
		sfieldCounter++;


		node.innerHTML = '<div><label for="sfield_' + sfieldCounter + '">' + sfieldCounter + '. </label><input type="text" id="sfield_' + sfieldCounter + '" name="step[]" placeholder="Step ' + sfieldCounter + '" class="multi-sfield"></div>';
		parent.appendChild(node);
	}
</script>
<?php 
require('includes/footer.php');
 ?>
