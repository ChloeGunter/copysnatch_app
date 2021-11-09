<?php 



//parse the form
if( isset( $_POST['did_edit_profile'] ) ){
	//sanitize everything
	$bio = filter_var( $_POST['bio'], FILTER_SANITIZE_STRING );
	
    //validate
	$valid = true;

	//bio too long
	if( strlen($bio) > 300 ){
		$valid = false;
		$errors[] = 'Please provide a title that is shorter than 300 charcters.';
	}

	//if valid, update the post in the DB
	if( $valid ){
		$result = $DB->prepare('UPDATE users
							   SET
							   bio = :bio
							   WHERE user_id = :user_id
							   LIMIT 1 ');
		$data = array(
                    'bio' => $bio,
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
			$feedback = 'No changes were made to your profile.';
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


$result = $DB->prepare('SELECT * FROM users
						WHERE user_id = :user_id
						LIMIT 1');
$data = array(
			'user_id' => $logged_in_user['user_id'],
);
$result->execute($data);
//if one row found, create simle variables to display in the form
if( $result->rowCount() >= 1 ){
	$row = $result->fetch();
	//make variables $title, $body, etc
	extract($row);
}


//no close php