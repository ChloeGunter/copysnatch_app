<?php
$logged_in_user = check_login();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copysnatch Recipe App</title>
    <script src="https://kit.fontawesome.com/f12efb326b.js" crossorigin="anonymous"></script>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css" integrity="sha512-xiunq9hpKsIcz42zt0o2vCo34xV0j6Ny8hgEylN3XBglZDtTZ2nwnqF/Z/TTCc18sGdvCjbFInNd++6q3J0N6g==" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
        <header class="header">
            <a href="index.php" class="logo"><img src="images/header-logo.png" class="logo" /></a>
            <nav class="main-navigation">
                <ul class="menu">
                <?php if( ! $logged_in_user ){ ?>
                    <li><a href="signup.php">Sign Up</a></li>
                    <span class="no-login"> | </span>
                    <li><a href="login.php">Log In</a></li>
                <?php }else{ ?>
                    <li><a href="new-post.php" class="add-post-button"><i class="fas fa-plus"></i></a></li>
                    <li class="profile_pic"><a href="profile.php?user_id=<?php echo $logged_in_user['user_id']; ?>">
                    <?php show_profile_pic( $logged_in_user['profile_pic'], 'small' ); ?></a></li>   
                </a></li>
                <li><a href="login.php?action=logout">Log Out</a></li>
                <?php } ?>
                </ul>
            </nav>

            <form class="search-form" method="get" action="search.php">
                <span>
                    <input type="search" name="phrase">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    <input type="hidden" name="page" value="1">
                </span>
            </form>
        </header>


        