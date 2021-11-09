<?php 
require('CONFIG.php');
require_once('includes/functions.php');

//CONFIG. How many posts per page?
$per_page = 4;

//sanitize what they searched for
//What did they search for?
$phrase = filter_var( $_GET['phrase'], FILTER_SANITIZE_STRING );

require('includes/header.php');
 ?>
<main class="content" id="search">
<?php 
	if( $phrase != '' ){
		//get all the published posts about this phrase.
		$result = $DB->prepare('SELECT * FROM posts
								WHERE is_published = 1
								AND (
									title LIKE :phrase
									OR body LIKE :phrase
								)');
		$result->execute( array( 'phrase' => "%$phrase%" ) );

		//how many total results found?
		$total = $result->rowCount();

		//how many pages will it take to hold them? (round up because there's no 'half' page)
		$max_pages = ceil($total/$per_page);

		//what page are we on? URL will be like search.php?phrase=bla&page=2
		$current_page = filter_var( $_GET['page'], FILTER_SANITIZE_NUMBER_INT );

		//make sure the current page is valid
		if( $current_page < 1 OR $current_page > $max_pages ){
			$current_page = 1;
		}

		//create the offset for the SQL LIMIT
		$offset = ( $current_page - 1 ) * $per_page;

		//write the query again, this time with the LIMIT
		$result = $DB->prepare('SELECT posts.*, users.username, users.user_id, users.profile_pic
                                FROM posts, users
								WHERE is_published = 1
                                AND users.user_id = posts.user_id
								AND (
									title LIKE :phrase
									OR body LIKE :phrase
								)
								LIMIT :offset, :per_page');

		//must use strict data types with bindParam because LIMIT requires integers
		$wildcard_phrase = "%$phrase%";
		$result->bindParam( 'phrase', $wildcard_phrase, PDO::PARAM_STR );
		$result->bindParam( 'offset', $offset, PDO::PARAM_INT );
		$result->bindParam( 'per_page', $per_page, PDO::PARAM_INT );
		// debug_statement($result);
		$result->execute();

 ?>
    <section class="search-title">
        <h2>Search Results for <?php echo $phrase; ?></h2>
        <h3><?php echo $total; ?> posts found</h3>
        <!-- TODO: May not keep -->
    </section>
    <section class="explore-container">
    <?php 
        // if the total number of posts found is >= 1 then...
        if( $total >= 1 ){
    ?>


        <?php    
            //while(){// while loop to fetch
            while( $row = $result->fetch() ){
        ?>
        <div class="one-post">
            <a href="single.php?post_id=<?php echo $row['post_id']; ?>">
                <?php show_post_image( $row['image'], 'small' ); ?>
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
            </div>
        </div>
        <?php } // end while loop ?>
    </section> <!-- end grid -->

    <section class="pagination">
    <h3>Showing page <?php echo $current_page; ?> of <?php echo $max_pages; ?></h3>
        <?php 
        //cariables for the neighboring pages
        $prev = $current_page - 1;
        $next = $current_page + 1;

        if( $current_page != 1 ){
         ?>
        <a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $prev; ?>" class="button button-outline prev">&larr; Previous
        </a>
        <?php } 

        if( $current_page != $max_pages ){ ?>
        <a href="search.php?phrase=<?php echo $phrase; ?>&amp;page=<?php echo $next; ?>" class="button button-outline">Next &rarr;
        </a>
        <?php } ?>
    </section>
    <?php } //end if total 
    ?>
    <?php }else{
        // TODO: Popular Searches or most recent posts
        echo 'Invalid Search';
    }
    ?>

</main>
<?php 
require('includes/footer.php');
 ?>