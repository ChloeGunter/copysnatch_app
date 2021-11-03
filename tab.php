<?php 
require('CONFIG.php');
require_once('includes/functions.php');
require('includes/header.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Simple PHP + MySQL + JQuery Ajax tabs demo</title>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

 <link rel="stylesheet" type="text/css" href="../ajax-demos-style.css">
</head>

<body>
    <h3>Pick a category</h3>

    <?php 
    $result = $DB->prepare('SELECT posts.image, posts.post_id
                            , posts.category_id, users.user_id
                            , categories.name
                            FROM posts, users, categories
                            WHERE posts.is_published = 1
                            AND users.user_id = posts.user_id
                            AND categories.category_id = posts.category_id
                            ORDER BY posts.date DESC');
    //2. Run it.
    $result->execute();
    //3. Check it. did we find any posts?
    if( $result->rowCount() >= 1 ){ 
    ?>


    <ul class="tabs">
        <?php 
        //loop it - once per row
        while( $row = $result->fetch() ){ 
        ?>

        <li class="tab" data-user="<?php echo $row['user_id'] ?>"><?php echo $row['username'] ?></li>

        <?php } ?>
    </ul>

    <div id="display-area" class="tab-panel">Choose a category to view the posts</div>
<?php 
require('includes/footer.php');
 ?>
    <script type="text/javascript">
        $(".tab").click(function() { 

            //get the value of the category they clicked
            var user_id = $(this).data("user"); 

            //reset active tab class
            $('ul > li').removeClass('active'); 
            //apply active tab class
            $(this).addClass('active'); 

            //create an ajax request to display.php
            $.ajax({   
                type: "GET",
                url: "display.php",  
                data: { 'user_id': user_id },   //send the user id in the request    
                dataType: "html",   //expect html to be returned
                success: function(response){
                    $("#display-area")  .html(response)
                    .addClass('active');
                    //alert(response);
                }
            });
        });
        //do stuff during and after ajax is loading (like visual feedback)
        $(document).on({
            ajaxStart: function() { $("#display-area").addClass("loading");    },
            ajaxStop: function() { $("#display-area").removeClass("loading"); }    
        });
</script>