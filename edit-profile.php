<?php 
require('CONFIG.php');
require_once('includes/functions.php');
require('includes/header.php');
//kill the page if not logged in
if( ! $logged_in_user ){
	exit( 'This page is for logged in users only.' );
}
//which profile are we editing?
$user_id = filter_var( $_GET['user_id'], FILTER_SANITIZE_NUMBER_INT );
 ?>
    <main class="content" id="edit-profile">
        <?php require( 'includes/edit-profile-parse.php' ); ?>
        <div>
            <h2>Edit Your Profile</h2>

            <?php show_feedback( $feedback, $feedback_class, $errors ); ?>

            <a href="edit-profile-pic.php" class="button button-outline">Change Profile Picture</a>

            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

                <label>Bio</label>
                <textarea name="bio"><?php echo_if_exists( $bio ); ?></textarea>


                <input type="submit" name="Save Changes" class="login-form">
                <input type="hidden" name="did_edit_profile" value="1">

            </form>
        </div>
    </main>
<?php 
require('includes/footer.php');
 ?>
