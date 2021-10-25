<?php 
require('CONFIG.php');
// require_once('includes/functions.php');
// CONFIG How many posts per page?

//sanitize what they searched for
//What did they search for?

require('includes/header.php');
 ?>
<main class="content">
    <section class="title">
        <h2>Search Results for <?php echo $phrase; ?></h2>
        <h3><?php echo $total; ?> posts found</h3>
        <!-- TODO: May not keep -->
        <h3>Showing page <?php echo $current_page; ?> of <?php echo $max_pages; ?></h3>
    </section>

    <?php 
        // if the total number of posts found is >= 1 then...
    ?>

    <section class="grid">
        <?php    
            //while(){// while loop to fetch
        ?>
        <div class="item">
            <a href="single.php?post_id=<?php echo $row['post_id']; ?>">
                <img src="<?php echo $row['image']; ?>" width="150" height="150" />
                <h2><?php echo $row['title']; ?></h2>
                <p><?php echo $row['body']; ?></p>

            <div class="nutrition">
                <span><i></i><?php echo $row['time']; ?>minutes</span>
                <span><i></i><?php echo $row['servings']; ?>servings</span>
                <span><i></i><?php echo $row['calories']; ?>calories</span>
                <span><i></i><?php echo $row['levels.name']; ?></span>
            </div>
            </a>
        </div>
        <?php //} // end while loop ?>
    </section> <!-- end grid -->

    <section class="pagination">
        <?php 
        //cariables for the neighboring pages
        ?>
    </section>
    <?php //} //end of if total ?>

    <?php //}else{
        // TODO: Popular Searches or most recent posts
        //echo 'Invalid Search';
    //}
     ?>

</main>
<?php 
require('includes/footer.php');
 ?>