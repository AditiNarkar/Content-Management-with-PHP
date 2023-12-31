<?php
include "includes/db.php";
include "includes/header.php";

//<!-- Navigation -->
include "includes/navigation.php";
?>



<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <?php

        if(isset($_GET['p_id'])){
            $display_post_id = $_GET['p_id'];
            $display_post_author = $_GET['author'];
        }

        $query = "SELECT * FROM posts WHERE post_user = '{$display_post_author}'";
        $select_all_posts_query = mysqli_query($conn,$query);
        if(!$select_all_posts_query) die("failed.". mysqli_error($conn));

        while($row = mysqli_fetch_assoc($select_all_posts_query))
        {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
            $post_image = $row['post_image'];

        ?>
            
        <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- First Blog Post -->
        <h2>
            <a href="post.php?p_id=<?php echo $post_id; ?>"> <?php echo $post_title; ?> </a>
        </h2>
        <p class="lead">
            All posts by <?php echo $post_user; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
        <hr>
        <p><?php echo $post_content; ?></p>

        <hr>

        <?php } ?>
        

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>
    
</div>
<!-- /.row -->

<hr>

<?php include "includes/footer.php"; ?>