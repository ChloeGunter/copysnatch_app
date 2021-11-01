<?php 



//parse the form
if( isset( $_POST['did_edit'] ) ){
	//sanitize everything
	$title = filter_var( $_POST['title'], FILTER_SANITIZE_STRING );
	$body = filter_var( $_POST['body'], FILTER_SANITIZE_STRING );
	$time = filter_var( $_POST['time'], FILTER_SANITIZE_NUMBER_INT );
	$servings = filter_var( $_POST['servings'], FILTER_SANITIZE_NUMBER_INT );
	$calories = filter_var( $_POST['calories'], FILTER_SANITIZE_NUMBER_INT );
	$category_id = filter_var( $_POST['category_id'], FILTER_SANITIZE_NUMBER_INT );
	$level_id = filter_var( $_POST['level_id'], FILTER_SANITIZE_NUMBER_INT );
	$ingredients = array();
	foreach( $_POST['item'] AS $item ){
		$ingredient = filter_var($item, FILTER_SANITIZE_STRING);
		if( strlen($ingredient) > 0 ){
			$ingredients[] = $ingredient;
		}
	} 
	$steps = array();
	foreach( $_POST['step'] AS $step ){
		$step = filter_var($step, FILTER_SANITIZE_STRING);
		if( strlen($step) > 0 ){
			$steps[] = $step;
		}
	} 

	// serealized
	$s_ingredients = serialize($ingredients);
	$s_steps = serialize($steps);

	//sanitize booleans
	if( !isset( $_POST['allow_comments'] ) OR $_POST['allow_comments'] != 1 ){
		$allow_comments = 0;
	}else{
		$allow_comments = 1;
	}

	if( !isset( $_POST['is_published'] ) OR $_POST['is_published'] != 1 ){
		$is_published = 0;
	}else{
		$is_published = 1;
	}
	//validate everything
	$valid = true;

	//title too long or blank
	if( $title == '' OR strlen($title) > 50 ){
		$valid = false;
		$errors[] = 'Please provide a title that is shorter than 50 charcters.';
	}
	//body too long
	if( strlen($body) > 2000 ){
		$valid = false;
		$errors[] = 'Post body must be shorter than 2,000 characters long.';
	}
	//time too short
	if( $time < 1 ){
		$valid = false;
		$errors[] = 'Recipe time must be a valid entry.';
	}
	//time too short
	if( $servings < 1 ){
		$valid = false;
		$errors[] = 'Total servings must be a valid entry.';
	}
	//time too short
	if( $calories < 0 ){
		$valid = false;
		$errors[] = 'Total calories per serving must be a valid entry.';
	}
	//invalid category
	if( $category_id < 1 ){
		$valid = false;
		$errors[] = 'Please choose a category for this post.';
	}
	//invalid level
	if( $level_id < 1 ){
		$valid = false;
		$errors[] = 'Please choose a difficulty level for this post.';
	}
	//if valid, update the post in the DB
	if( $valid ){
		$result = $DB->prepare('UPDATE posts
							   SET
							   title = :title,
							   body = :body,
							   time = :time,
							   servings = :servings,
							   calories = :calories,
							   category_id = :cat,
							   level_id = :level,
							   ingredients = :ingredients,
							   steps = :steps,
							   allow_comments = :allow_comments,
							   is_published = :is_published

							   WHERE post_id = :post_id
							   AND user_id = :user_id
							   LIMIT 1 ');
		$data = array(
					'title' => $title,
					'body' => $body,
					'time' => $time,
					'servings' => $servings,
					'calories' => $calories,
					'cat' => $category_id,
					'level' => $level_id,
					'ingredients' => $s_ingredients,
					'steps' => $s_steps,
					'allow_comments' => $allow_comments,
					'is_published' => $is_published,
					'post_id' => $post_id,
					'user_id' => $logged_in_user['user_id'],
		);
		$result->execute( $data );
		//tricky query! lets debug it!
		//debug_statement($result);
		if( $result->rowCount() >= 1 ){
			//success
			$feedback = 'Changes successfully saved!';
			$feedback_class = 'success';
		}else{
			//no changes made
			$feedback = 'No changes were made to your post.';
			$feedback_class = 'info';
		}
	}else{
		//error
		$feedback = 'Please fix the following:';
		$feedback_class = 'error';
	}
	//show feedback

	

}//end form parse


//pre-fill the form and make sure it belongs to the logged in user


$result = $DB->prepare('SELECT * FROM posts
						WHERE post_id = :post_id
						AND user_id = :user_id
						LIMIT 1');
$data = array(
			'post_id' => $post_id,
			'user_id' => $logged_in_user['user_id'],
);
$result->execute($data);
//if one row found, create simle variables to display in the form
if( $result->rowCount() >= 1 ){
	$row = $result->fetch();
	//make variables $title, $body, etc
	extract($row);
	//!! serialized in the DB
	$ingredients = unserialize($row['ingredients']);
	$steps = unserialize($row['steps']); 

}
//fix the datatype of our arrays if they are blank in the db
if( ! is_array($ingredients) ){
	$ingredients = array('');

}
if( ! is_array($steps) ){
	$steps = array('');
}

//no close php