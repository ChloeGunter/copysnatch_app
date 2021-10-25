<?php 
//get all the approved comments about this post, oldest first
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
    ?>
    <div class="one-comment">
        <div class="user">
            <?php 
            //profile pic
            //username
            ?>
        </div>

        <p>
            <?php 
            //comment body
            ?>
        </p>
        <span class="date">
            <?php 
            //time_ago function
            ?>
        </span>
    </div>
    <?php 
    //end of while loop
    ?>
</div>
<?php 
//end of if comments that were found
?>