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
		<?php require( 'includes/edit-profile-pic-parse.php' ); ?>
		<h2>Edit Your Profile</h2>

		<?php show_feedback( $feedback, $feedback_class, $errors ); ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

		    <label>Upload Your Image</label>
            <input type="file" name="uploadedfile" accept="image/*" required>

            <input type="submit" name="Save Changes">
            <input type="hidden" name="did_edit_profile_pic" value="1">
        </form>

	</main>
<?php 
require('includes/footer.php');
 ?>
