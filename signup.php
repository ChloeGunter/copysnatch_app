<?php 
require('CONFIG.php'); 
require_once('includes/functions.php');
require('includes/signup-parse.php');
//doctype and invisible header
require('includes/header-no-nav.php');
?>
<main class="container">
    <h1>Sign Up</h1>
    <?php show_feedback( $feedback, $feedback_class, $errors ); ?>

    <form method="post" action="signup.php">

        <label>Email</label>
        <input type="email" name="email" value="<?php echo_if_exists( $email ); ?>">

        <label>Username</label>
        <input type="text" name="username" value="<?php echo_if_exists( $username ); ?>">

        <label>Password:</label>
		<input type="password" name="password" value="<?php echo_if_exists( $password ); ?>">

        <label>
			<input type="checkbox" name="policy" value="1" <?php checked( $policy, 1 ); ?>>
			I agree to the <a href="#" target="_blank">terms of use and privacy policy</a>
		</label>

		<input type="submit" value="Sign Up">
		<input type="hidden" name="did_signup" value="1">
    </form>
</main>

<?php include('includes/footer.php'); ?>