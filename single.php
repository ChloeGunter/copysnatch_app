<?php 
require('CONFIG.php');
require_once('includes/functions.php');
require('includes/header.php');

//Which posts are we trying to view?
//url will be like single.php?post_id=X
if( isset( $_GET['post_id'] ) ){
	$post_id = filter_var( $_GET['post_id'], FILTER_SANITIZE_NUMBER_INT );
	//make sure it isn't blank
	if( $post_id == '' ){
		$post_id = 0;
	}
}else{
	$post_id = 0;
}
require('includes/comment-parse.php');
 ?>
    <main class="content">
    <?php //1. Write it. get all published posts, newest first
		$result = $DB->prepare('SELECT posts.*, users.username, users.profile_pic, categories.name AS category, levels.name AS level
								FROM posts, users, categories, levels
								WHERE posts.is_published = 1
								AND users.user_id = posts.user_id
								AND categories.category_id = posts.category_id
                                AND levels.level_id = posts.level_id
								AND posts.post_id = ?
								ORDER BY posts.date DESC
								LIMIT 1');
		//2. Run it.
		$result->execute( array( $post_id ) );
		//3. Check it. did we find any posts?
		if( $result->rowCount() >= 1 ){ 
			//loop it - once per row
			while( $row = $result->fetch() ){
		 ?>
        <div class="one-post">

			<span class="author">
				<?php show_profile_pic( $row['profile_pic'], 40 ); ?>
				<?php echo $row['username']; ?>
			</span>

            <?php show_post_image( $row['image'] ); ?>

			<h2><?php echo $row['title']; ?></h2>

			<form action="#" method="post">
				<span class="star-rating">
				<!-- 	data-id is the primary key for the post (post_id = 1)	 -->
				<input type="radio" name="rating" value="1" data-id="<?php echo $post_id; ?>"><i></i>
				<input type="radio" name="rating" value="2" data-id="<?php echo $post_id; ?>"><i></i>
				<input type="radio" name="rating" value="3" data-id="<?php echo $post_id; ?>"><i></i>
				<input type="radio" name="rating" value="4" data-id="<?php echo $post_id; ?>"><i></i>
				<input type="radio" name="rating" value="5" data-id="<?php echo $post_id; ?>"><i></i>
				</span>

			</form>

			<p><?php echo $row['body']; ?></p>

            <h3 class="category"><?php echo $row['category']; ?></h3>
            
            <div class="nutrition">
                <span><i></i><?php echo $row['time']; ?>minutes</span>
                <span><i></i><?php echo $row['servings']; ?>servings</span>
                <span><i></i><?php echo $row['calories']; ?>calories</span>
                <span><i></i><?php echo $row['level']; ?></span>
            </div>

            <div class="box-container">
                <ul><?php 
						$array = unserialize($row['ingredients']);
						foreach($array as $item ){
							echo "<li>$item</li>";
						}
					?></ul>
            </div>

            <div class="box-container">
			<ol><?php 
						$array = unserialize($row['steps']);
						foreach($array as $step ){
							echo "<li>$step</li>";
						}
					?></ol>
            </div>

            <div class="box-container">
                <span class="comment-count"><?php count_comments( $row['post_id'] ); ?></span>
            </div>

        </div>

		<?php require('includes/comments.php'); ?>
		<?php require('includes/comment-form.php') ?>

		<?php 
		} //end while loop.
			}else{ ?>

		<div class="feedback">
			<h2>Sorry</h2>
			<p>No posts found. Try a search instead.</p>
		</div>

		<?php } //end of if posts found.?>
        
    </main>

<?php 
require('includes/footer.php');
 ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
        $(":radio").click(function() { 
            //get the value of the rating they clicked
            var rating = this.value;      
            var postId = $(this).data("id");  
            var userId = <?php echo $user_id; ?>      
            //create an ajax request to display.php
            $.ajax({   
                type: "GET",
                url: "ajax-handlers/rate-parse.php",  
                data: { 
                    'rating': rating, 
                    'postId': postId,
                    'userId': userId
                    },   
               
              success: function(response){
                $("#display-area").html(response);
                }
            });
        });
         //do stuff during and after ajax is loading (like visual feedback)
        $(document).on({
            ajaxStart: function() { $("#display-area").addClass("loading");    },
            ajaxStop: function() { $("#display-area").removeClass("loading"); } 
        });
    </script>