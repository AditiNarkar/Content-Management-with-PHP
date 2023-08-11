<?php
session_start();
include "includes/db.php";
include "includes/header.php";
include "admin/functions.php";

//<!-- Navigation -->
include "includes/navigation.php";
?>



<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <?php

        if(isset($_GET['category']))
        {
            $post_cat_id = $_GET['category'];

            if($_SESSION['role'] == 'Admin')
            {
                $statement1 = mysqli_prepare($conn, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_cat_id = ?");
            }
            else
            {
                $statement2 = mysqli_prepare($conn, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_cat_id = ? AND post_status = ?");

                $pub = 'published';
            }

            if(isset($statement1))
            {
                mysqli_stmt_bind_param($statement1, "i", $post_cat_id);
                
                mysqli_stmt_execute($statement1);

                mysqli_stmt_bind_result($statement1, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);

                $stmt = $statement1;
        
            }

            elseif(isset($statement2))
            {
                mysqli_stmt_bind_param($statement2, "is", $post_cat_id, $pub);
                
                mysqli_stmt_execute($statement2);

                mysqli_stmt_bind_result($statement2, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);

                $stmt = $statement2;

            }

            if(mysqli_stmt_fetch($stmt) == 0)
            {
                echo "<h2 class='text-center'>No Posts Available.</h2>";
            }

           

            while(mysqli_stmt_fetch($stmt)):
                

            ?>
                

            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $post_title; ?> </a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_user; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <?php $post_img = image_placeholder($post_image);
    
                echo "<img width=700 src='../images/{$post_img}' alt='N.A.'>";
           
            ?>
            <hr>
            <p><?php echo $post_content; ?>...</p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

        <?php   
            //if bracket
        endwhile;
        mysqli_stmt_close($stmt);
        }
        
        else
        {
            header("Location: index.php");
        } 
    
        ?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>
    
</div>
<!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>