<div class="comment-form">
    <h2>Leave A Comment</h2>

    <form method="post" action="single.php?post_id=<?php echo $post_id; ?>">
        <textarea name="body"></textarea>
        <input type="submit" value="Comment" class="button button-outline">
        <input type="hidden" name="did_comment" value="1">

    </form>

</div>
