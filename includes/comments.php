<?php 
//get all the approved comments about this post, oldest first
//get all the approved comments about this post, oldest first
$result = $DB->prepare('SELECT comments.body, comments.date, 
                        users.username, users.profile_pic
                        FROM comments, users
                        WHERE users.user_id = comments.user_id
                        AND comments.is_approved = 1
                        AND comments.post_id = ?
                        ORDER BY comments.date ASC
                        LIMIT 50'
);
$result->execute( array( $post_id ) );
$total = $result->rowCount();
if( $total >= 1 ){
?>

<div class="comments">
    <h2>
        <?php 
        // total comments on the current post
        echo $total == 1 ? 'One Comment' : "$total Comments";
         ?>
    </h2>

    <?php 
    //while loop
    while( $row = $result->fetch() ){
    ?>
    <div class="one-comment">
        <div class="user author">
        <?php show_profile_pic( $row['profile_pic'], 'small' ); ?>

			<?php 
            //username
            echo $row['username']; 
            ?>
        </div>

        <p>
            <?php 
            //comment body
            echo $row['body']; 
            ?>
        </p>
        <span class="date">
            <?php 
            //time ago function
            echo time_ago( $row['date'] ); 
            ?>
        </span>
    </div>
    <?php 
    } //end of while loop
    ?>
</div>
<?php 
} //end of if comments that were found
?>