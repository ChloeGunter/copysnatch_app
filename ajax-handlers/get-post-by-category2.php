<?php

require('../CONFIG.php');
require_once('../includes/functions.php');

//data coming from jquery .ajax() call
$category_id 	= filter_var($_REQUEST['category_id'], FILTER_SANITIZE_NUMBER_INT);
$user_id 	= filter_var($_REQUEST['user_id'], FILTER_SANITIZE_NUMBER_INT);

$result = $DB->prepare('SELECT posts.*
								FROM posts
								WHERE posts.is_published = 1
								AND category_id = ?
                                AND user_id = ?
								ORDER BY posts.date DESC');

//2. Run it.
$result->execute( array($category_id, $user_id) );
//3. Check it. did we find any posts?
		if( $result->rowCount() >= 1 ){ 
			//loop it - once per row
			?>
			<div class="profile-grid">
			<?php
			while( $row = $result->fetch() ){
		?>
			<div class="little-post item">
                <a href="single.php?post_id=<?php echo $row['post_id']; ?>">
    <!-- 			<img src="<?php //echo $row['image']; ?>" /> -->
                <?php show_post_image( $row['image'], 'small' ); ?>
                </a>
            </div>

            <?php } ?>
			</div>
            <?php }else{
            	echo 'There are no posts.';
            } ?>