<?php
require('CONFIG.php');
// require_once('includes/functions.php');
// require('includes/logout-parse.php');
require('includes/login-parse.php');
// header without navigation
require('includes/header-no-nav.php'); 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <main class="content">
        <div class="container login-form">
            <h1>Log In</h1>
            <form method="post" action="login.php">
                <label>Username</label>
                <input type="text" name="username">

                <label>Password</label>
				<input type="password" name="password">

                <input type="submit" value="Log In">

				<input type="hidden" name="did_login" value="true">
            </form>
            <p>Don't have an account? <span><a href="signup.php">Sign Up</a></span></p>
        </div>
    </main>
</body>
</html>
