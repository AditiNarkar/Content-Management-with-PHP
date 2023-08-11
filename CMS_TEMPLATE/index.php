<?php

session_start();
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

        $per_page = 5;

        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        else 
        {
            $page="";
        }

        if($page == "" || $page == 1)
        {
            $page_1 = 0;
        }
        else
        {
            $page_1 = ($page * $per_page) - $per_page;
        }




        if(isset($_SESSION['role']) && $_SESSION['role']=='Admin')
        {
            $query_count = "SELECT * FROM posts";
            $query = "SELECT * FROM posts LIMIT $page_1, $per_page ";
        }
        else
        {
            $query_count = "SELECT * FROM posts WHERE post_status='published'";
            $query = "SELECT * FROM posts WHERE post_status='published' LIMIT $page_1, $per_page ";
        }



        $count_post = mysqli_query($conn, $query_count);

        $count = mysqli_num_rows($count_post);

        if($count < 1 )
        {
            echo "<h2 class='text-center'>$count Posts Available.</h2>";
        }

        else
        {
            echo "<h4 class=''>Showing $count posts...</h2>";
            echo"<h1 class='page-header'>Posts</h1>";

            $count = ceil($count/$per_page);
        
            $select_all_posts_query = mysqli_query($conn,$query);

            while($row = mysqli_fetch_assoc($select_all_posts_query))
            {
                $post_title = $row['post_title'];
                $post_id = $row['post_id'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_content = substr($row['post_content'], 0, 90);
                $post_image = $row['post_image'];
                $post_status = $row['post_status'];
                
                ?>
                

                <!-- First Blog Post -->

                <h2>
                    <a href="post/<?php echo $post_id; ?>"> <?php echo $post_title; ?> </a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?p_id=<?php echo $post_id; ?>&author=<?php echo $post_user; ?>"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img width=900 class="img-responsive" src="images/<?php echo image_placeholder($post_image); ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content;?>...</p>
        
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
    <?php   }

    
        } ?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>
    
</div>
<!-- /.row -->

<hr>

<ul class="pager">
    <?php

    for($i=1; $i<=$count; $i++){
        if($i == $page)
        {
            echo "<li><a class='active_link' href='index.php?page=$i'>{$i}</a></li>";
        }
        else
        {
            echo "<li><a href='index.php?page=$i'>{$i}</a></li>";
        }
    }

    ?>
</ul>

<?php include "includes/footer.php"; ?>