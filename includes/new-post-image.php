<h2>Add A Post</h2>
        <form method="post" action="single.php?post_id=<?php echo $post_id; ?>">
		    <label>Upload Your Image</label>
            <input type="submit" value="Next">
            <input type="hidden" name="did_add_image" value="1">
        </form>