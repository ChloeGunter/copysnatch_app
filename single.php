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
    <main class="content" id="single">
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

			
            <div class="post-image"><?php show_post_image( $row['image'] ); ?></div>
			<div class="post-details">
				<div class="special-author-container">

					<span class="author">
						<a href="profile.php?user_id=<?php echo $row['user_id']; ?>">
						<?php show_profile_pic( $row['profile_pic'], 'small' ); ?>
						<?php echo $row['username']; ?>
						</a>
					</span>

					<div class="rating-container">
						<?php rating_interface($row['post_id'], $logged_in_user['user_id']); ?>	
					</div>

					</div>


					<h2><?php echo $row['title']; ?></h2>

					<p class="description"><?php echo $row['body']; ?></p>

					<p class="category">Category: <?php echo $row['category']; ?></p>
			</div>

            
			
				<div class="nutrition">
					<div><i class="fas fa-clock"></i><p><?php echo $row['time']; ?></p><p class="description">minutes</p></div>
					<div><i class="fas fa-user-friends"></i><p><?php echo $row['servings']; ?></p><p class="description">servings</p></div>
					<div><i class="fas fa-fire"></i><p><?php echo $row['calories']; ?></p><p class="description">calories</p></div>
					<div><i class="fas fa-layer-group"></i><p class="level"><?php echo $row['level']; ?></p></div>
				</div>


				<div class="ingredients-container">
					<h4>Ingredients</h4>
					<ul><?php 
							$array = unserialize($row['ingredients']);
							foreach($array as $item ){
								echo "<li>$item</li>";
							}
						?></ul>
				</div>


				<div class="instructions-container">
					<h4>Instructions</h4>
						<ol><?php 
							$array = unserialize($row['steps']);
							foreach($array as $step ){
								echo "<li>$step</li>";
							}
						?></ol>
				</div>

			
            <div class="post-footer">
                <p class="comment-count"><i class="fas fa-comment"></i> <?php count_comments( $row['post_id'] ); ?></p>

				<?php 
					//show this button if the logged in user is the author
					if( $logged_in_user AND $logged_in_user['user_id'] == $row['user_id'] ){ ?>
					<br>
					<a href="edit-post.php?post_id=<?php echo $row['post_id']; ?>" class="button button-outline">Edit</a>
				<?php } ?>
			</div>

        </div>

		<?php 
		//show this button if the logged in user is the author
		if( $logged_in_user AND $logged_in_user['user_id'] == $row['user_id'] ){ ?>
		<div class="box-container">
		<?php include('includes/comments.php'); ?>
		<?php include('includes/comment-form.php') ?>
		</div>
		<?php }else{
    			echo '<h3>Please <a href="login.php">Log in</a> to view and leave comments!</h3>';
			  } ?>

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
<?php if($logged_in_user){ ?>
<script type="text/javascript">
        $(":radio").click(function() { 
            //get the value of the rating they clicked
            var rating = this.value;      
            var postId = $(this).data("id");  
	        var userId = <?php echo $logged_in_user['user_id']; ?>;   	
            var $outputContainer =  $(this).parents('.rating-container');	
            console.log($outputContainer);     
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
	                $outputContainer.html(response);
                }
            });
        });
         //do stuff during and after ajax is loading (like visual feedback)
        $(document).on({
	            ajaxStart: function() { $outputContainer.addClass("loading");    },	
            ajaxStop: function() { $outputContainer.removeClass("loading"); } 
        });
    </script>
<?php } //end if logged in ?>	