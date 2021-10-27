<?php
//$logged_in_user = check_login();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copysnatch Recipe App</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="site">
        <header class="header">
            <a href="index.php" class="logo"><img src="images/header-logo.png" class="logo" /></a>

            <ul class="menu">
            <?php # if( ! $logged_in_user ){ ?>
				<li><a href="signup.php">Sign Up</a></li>
				<li><a href="login.php">Log In</a></li>

			<?php # }else{ ?>

				<li><a href="#">Add New Post</a></li>
				<li><a href="#"><?php # echo $logged_in_user['profile_pic']; ?></a></li>
                <!-- TODO: log out on profile page -->
			<?php # } ?>
			</ul>

            <nav class="main-navigation">
                <form class="search-form" method="get" action="search.php">
                <input type="search" name="phrase">
				<input type="submit" name="search">
				<input type="hidden" name="page" value="1">
                </form>
            </nav>
        </header>