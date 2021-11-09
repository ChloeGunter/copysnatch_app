<?php 
require('CONFIG.php');
require_once('includes/functions.php');
require('includes/header.php');
//kill the page if not logged in
if( ! $logged_in_user ){
	exit( 'This page is for logged in users only.' );
}
 ?>
	<main class="content" id="box-container">
		<?php require( 'includes/new-post-parse.php' ); ?>
		<h2>Add A Post</h2>
		<?php show_feedback( $feedback, $feedback_class, $errors ); ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

		    <label>Upload Your Image</label>
            <input type="file" name="uploadedfile" accept="image/*" required>

			<input type="submit" name="Next: Add Post Details &rarr;" class="button button-outline">
			<input type="hidden" name="did_upload" value="1">
        </form>

	
	</main>
<?php 
include('includes/footer.php');
 ?>