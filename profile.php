<?php 
require('CONFIG.php');
require_once('includes/functions.php');
require('includes/header.php');

//which user are we showing? URL will be profile.php?user_id=X
if( isset( $_GET['user_id'] ) ){
	$user_id = filter_var( $_GET['user_id'], FILTER_SANITIZE_NUMBER_INT );
	//make sure it isn't blank
	if( $user_id == '' ){
		$user_id = 0;
	}
}else{
	$user_id = 0;
}
 ?>
    <main class="content" id="profile">
    <?php //1. Write it. get this users info as well as any published posts they've written
		$result = $DB->prepare('SELECT users.username, users.bio, 
								users.profile_pic
								FROM users
								WHERE users.user_id = ?');
		//2. Run it.
		$result->execute( array($user_id) );
		//3. Check it.
		if( $result->rowCount() >= 1 ){ 
			//loop it - once per row
			while( $row = $result->fetch() ){
					//big bio
	?>

    <div class="profile">
			<div class="author author-profile">
			<?php show_profile_pic( $row['profile_pic'], 'small' ); ?>
                <div class="edit">
                <?php 
                    //if this profile belongs to the logged in user, show a 'edit profile' button, otherwise show the follow button
                    if( $logged_in_user AND $user_id == $logged_in_user['user_id'] ){
                    ?>
                        <div class="item"><a class="button button-outline" href="edit-profile.php?user_id=<?php echo $logged_in_user['user_id']; ?>">Edit Profile</a></div>
                <?php }?>
                </div>
				<h2><?php echo $row['username']; ?></h2>
				<p><?php echo $row['bio']; ?></p>
			</div>
            <?php }
        }?>
    </div>


    <section class="portfolio-options" id="tab-list">

      <nav class="tab-list flex">
        <a href="#recipes" class="tab active">Recipes</a>
        <a href="#categories" class="tab">Categories</a>
      </nav>

    <section id="recipes" class="content visible">
    <?php //1. Write it. get this users info as well as any published posts they've written
		$result = $DB->prepare('SELECT posts.*, users.user_id
								FROM posts, users
								WHERE posts.is_published = 1
								AND users.user_id = posts.user_id
                                AND users.user_id = ?
								ORDER BY posts.date DESC');
		//2. Run it.
		$result->execute( array($user_id) );
		//3. Check it. did we find any posts?
		if( $result->rowCount() >= 1 ){ 
            ?>
            <div class="profile-grid">
            <?php
			//loop it - once per row
			while( $row = $result->fetch() ){
		?>

			<?php // if the user has a post, show it, otherwise this is a blank profile
			if( $row['image'] != '' ){ ?>
            <div class="little-post">
                <a href="single.php?post_id=<?php echo $row['post_id']; ?>">
    <!-- 			<img src="<?php //echo $row['image']; ?>" /> -->
                <?php show_post_image( $row['image'], 'small' ); ?>
                </a>
            </div>
		<?php }else{
				echo '<div>This user hasn\'t made any posts yet.</div>';
		} ?>


		<?php 
			} //end while loop.
        ?>
        </div>
        <?php
		}else{ ?>

		<div class="feedback">
			<h2>Sorry</h2>
			<p>No posts found. Try a search instead.</p>
		</div>

		<?php } //end of if posts found.?>
        </section>


        <section id="categories" class="content">
        <?php 
            //get all the categories in the alphabetical order
            $result = $DB->prepare('SELECT * FROM categories
                                    ORDER BY name ASC');
            $result->execute();
            if( $result->rowCount() >= 1 ){
            ?>
            <select class="category-dropdown" name="category_id">
                <div class="profile-grid">
                <?php while( $row = $result->fetch() ){ ?>
                <option value="<?php echo $row['category_id']; ?>" 
                    <?php selected( $category_id, $row['category_id'] ); ?>>
                    <?php echo $row['name']; ?>
                </option>
                <?php } ?>
                </div>
            </select>
        <?php } ?>
        	<div class="category-posts">
        		
        	</div>
        </section>
        
        </section>
      
      

    </main>
<?php 
require('includes/footer.php');
 ?>
<script type="text/javascript">
$('.tab-list').on('click', '.tab', function(e){
    e.preventDefault();
    $('.tab').removeClass('active');
    $('.content').removeClass('visible');
    $(this).addClass('active');
    console.log($(this).attr('href'));
    $($(this).attr('href')).addClass('visible'); 
})

$('.category-dropdown').change(function(){
	var category_id = $(this).val();
	var user_id = <?php echo $user_id; ?>;
	console.log(category_id);
	//create an ajax request to display.php
            $.ajax({   
                type: "GET",
                url: "ajax-handlers/get-post-by-category.php",  
                data: { 'category_id': category_id,
                		'user_id': user_id },   //send the user id in the request    
                dataType: "html",   //expect html to be returned
                success: function(response){
                    $(".category-posts")  .html(response)
                    .addClass('active');
                    //alert(response);
                }
            });
})


</script>
