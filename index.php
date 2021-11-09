<?php 
require('CONFIG.php');
require_once('includes/functions.php');
require('includes/header.php');
 ?>
    <main class="content" id="home">

	<h2 class="section-heading">Popular Recipes</h2>
	<div class="popular-container">
    <?php //1. Write it. get all published posts, newest first
		$result = $DB->prepare('SELECT posts.post_id, posts.image, 
                                       users.user_id, users.profile_pic, users.username, ratings.rating
								FROM posts, users, ratings
								WHERE posts.is_published = 1
								AND users.user_id = posts.user_id
								ORDER BY rating DESC
								LIMIT 4');
		//2. Run it.
		$result->execute();
		//3. Check it. did we find any posts?
		if( $result->rowCount() >= 1 ){ 
			//loop it - once per row
			while( $row = $result->fetch() ){
	 ?>

	
		<div class="popular-post">
				<a class="popular-post" href="single.php?post_id=<?php echo $row['post_id']; ?>">
			<!-- 			<img src="<?php //echo $row['image']; ?>" /> -->
				<?php show_post_image( $row['image'], 'small' ); ?>
				</a>
				<span class="author popular">
				<a href="profile.php?user_id=<?php echo $row['user_id']; ?>">
				<?php show_profile_pic( $row['profile_pic'], 'small' ); ?>
				</a>
				</span>
		</div>
	
	<?php 
		} //end while loop.
			}else{ ?>

		<div class="feedback">
			<h2>Sorry</h2>
			<p>No posts found. Try a search instead.</p>
		</div>

	<?php } //end of if posts found.?>     

	</div>
	<!-- end of popular posts -->

	<h2 class="section-heading">Explore</h2>
	<div class="explore-container">
    <?php //1. Write it. get all published posts, newest first
		$result = $DB->prepare('SELECT posts.*, users.username, users.user_id, users.profile_pic, categories.name AS category, levels.name AS level
								FROM posts, users, categories, levels
								WHERE posts.is_published = 1
								AND users.user_id = posts.user_id
								AND categories.category_id = posts.category_id
								AND levels.level_id = posts.level_id
								ORDER BY posts.date DESC');
		//2. Run it.
		$result->execute();
		//3. Check it. did we find any posts?
		if( $result->rowCount() >= 1 ){ 
			//loop it - once per row
			while( $row = $result->fetch() ){
		 ?>

		<div class="one-post">
			<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
<!-- 			<img src="<?php //echo $row['image']; ?>" /> -->
			<?php show_post_image( $row['image'] ); ?>
			<img class="gradient"></img>
			</a>
			

			<div class="special-author-container">

				<span class="author">
					<a href="profile.php?user_id=<?php echo $row['user_id']; ?>">
					<?php show_profile_pic( $row['profile_pic'], 'small' ); ?>
					<?php echo $row['username']; ?>
					</a>
				</span>

				<?php 
				//show this button if the logged in user is the author
				if( $logged_in_user AND $logged_in_user['user_id'] == $row['user_id'] ){ ?>
				<br>
				<a href="edit-post.php?post_id=<?php echo $row['post_id']; ?>" class="button button-outline">Edit</a>
				<?php } ?>
			</div>

			<h3><?php echo $row['title']; ?></h3>
			<p class="post-description"><?php echo $row['body']; ?></p>

			<div class="nutrition">
                <div><i class="fas fa-clock"></i><p><?php echo $row['time']; ?></p><p class="description">minutes</p></div>
                <div><i class="fas fa-user-friends"></i><p><?php echo $row['servings']; ?></p><p class="description">servings</p></div>
                <div><i class="fas fa-fire"></i><p><?php echo $row['calories']; ?></p><p class="description">calories</p></div>
                <div><i class="fas fa-layer-group"></i><p class="level"><?php echo $row['level']; ?></p></div>
            </div>

			<span class="post-info">

				<p class="date"><?php echo time_ago( $row['date']); ?></p>

				<div class="rating-container">
						<?php rating_interface($row['post_id'], $logged_in_user['user_id']); ?>	
				</div>
				
			</span>
		</div>

		<?php 
		} //end while loop.
			}else{ ?>

		<div class="feedback">
			<h2>Sorry</h2>
			<p>No posts found. Try a search instead.</p>
		</div>

		<?php } //end of if posts found.?>        
		</div>
    </main>

<?php 
require('includes/footer.php');
 ?>
