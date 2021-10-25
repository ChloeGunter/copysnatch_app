<?php 
require('CONFIG.php');
// require_once('includes/functions.php');
require('includes/header.php');
 ?>
    <main class="content">
        <div class="one-post">
            <img src="<?php echo $row['image']; ?>" />

            <span class="author">
				<?php show_profile_pic( $row['profile_pic'], 40 ); ?>
				<?php echo $row['username']; ?>
			</span>

            <h2><?php echo $row['title']; ?></h2>
            <p><?php echo $row['body']; ?></p>

            <div class="nutrition">
                <span><i></i><?php echo $row['time']; ?>minutes</span>
                <span><i></i><?php echo $row['servings']; ?>servings</span>
                <span><i></i><?php echo $row['calories']; ?>calories</span>
                <span><i></i><?php echo $row['levels.name']; ?></span>
            </div>

            <div class="box-container">
                <p><?php echo $row['ingredients']; ?></p>
            </div>

            <div class="box-container">
                <p><?php echo $row['instructions']; ?></p>
            </div>

        </div>

        <?php require('includes/comments.php'); ?>
		<?php require('includes/comment-form.php') ?>
        
    </main>

<?php 
require('includes/footer.php');
 ?>
