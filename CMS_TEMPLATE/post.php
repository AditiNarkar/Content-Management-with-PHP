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

        if(isset($_GET['p_id']))
        {
            // echo $_SESSION['role'];
            $display_post_id = $_GET['p_id'];

            $view_query = "UPDATE posts SET views = views + 1 WHERE post_id = {$display_post_id}";

            $send_query = mysqli_query($conn, $view_query);

            if(isset($_SESSION['role']) && $_SESSION['role']=='Admin')
            {
                $query = "SELECT * FROM posts WHERE post_id = $display_post_id";
            }
            else
            {
                $query = "SELECT * FROM posts WHERE post_id = $display_post_id AND post_status='published'";
            }
        
        $select_all_posts_query = mysqli_query($conn,$query);
        
        if(!$select_all_posts_query) die("failed.". mysqli_error($conn));

        if(mysqli_num_rows($select_all_posts_query)==0)
        {
            echo "<h2 class='text-center'>No Posts Available.</h2>";
        }

        else
        {

        
        while($row = mysqli_fetch_assoc($select_all_posts_query))
        {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
            $post_image = $row['post_image'];

        ?>
            

        <!-- First Blog Post -->
        <h2>
            <?php echo $post_title; ?> 
        </h2>
        <p class="lead">
            by <a href="index.php"><?php echo $post_user; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
        <hr>
        <img class="img-responsive" src="/CMS_TEMPLATE/images/<?php echo image_placeholder($post_image); ?>" alt="post_image">
        <hr>
        <p><?php echo $post_content; ?></p>

        <hr>

        <?php } 
        
        ?>
        
        <!-- Blog Comments -->

        <?php

        if(isset($_POST['comment'])){
            $cmt_post_id = $_GET['p_id'];
            $cmt_writer = $_POST['cmt_writer'];
            $cmt_email = $_POST['cmt_email'];
            $cmt_cont = $_POST['cmt_cont'];

            if(!empty($cmt_writer) && !empty($cmt_email) && !empty($cmt_cont)  ){

                $query = "INSERT INTO comments(cmt_post_id, cmt_writer, cmt_email, cmt_content, cmt_status, cmt_date) VALUES ({$cmt_post_id}, '{$cmt_writer}', '{$cmt_email}', '{$cmt_cont}', 'unapproved', now())";
                $add_cmt_query = mysqli_query($conn,$query);
                if(!$add_cmt_query) die("failed.". mysqli_error($conn));

                $query = "UPDATE posts SET post_cmt_count = post_cmt_count+1 WHERE post_id = $cmt_post_id";

                $update_cmt_count = mysqli_query($conn, $query);  
            }

            else{
                echo "<script>alert('Enter all fields')</script>";
            }
        }
        
        ?>

        <!-- Comments Form -->
        <div class="well">
            <form role="form" action="" method="post">

                <h4>Leave a Comment:</h4>
                <div class="form-group">
                    <textarea class="form-control" rows="3" name="cmt_cont"></textarea>
                </div>

                <div class="form-group">
                    <label for="cmt_writer"> Name</label>
                    <input type="text" class="form-control" name='cmt_writer'>
                </div>
                <div class="form-group">
                    <label for="cmt_email">Email Id</label>
                    <input type="email" class="form-control" name='cmt_email'>
                </div>
                <!-- <div class="form-group">
                <input type="text" class="form-control" name='cmt_writer'>
                </div>
                <div class="form-group">
                <input type="text" class="form-control" name='cmt_writer'>
                </div>
                <div class="form-group">
                <input type="text" class="form-control" name='cmt_writer'>
                </div> -->
                
                <button type="submit" class="btn btn-primary" name="comment">Comment</button>
            </form>
        </div>

        <hr>

        <!-- Posted Comments -->

        <?php
        $query="SELECT * FROM comments WHERE cmt_post_id = {$display_post_id} AND cmt_status='approved' ORDER BY cmt_id DESC";
        $app_cmts_query = mysqli_query($conn, $query);
        if(!$app_cmts_query) die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($app_cmts_query)){
            $cmt_date = $row['cmt_date'];
            $cmt_cont = $row['cmt_content'];
            $cmt_writer = $row['cmt_writer'];
        ?>

        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $cmt_writer; ?>
                    <small><?php echo $cmt_date; ?></small>
                </h4>
                <?php echo $cmt_cont; ?>
            </div>
        </div>

        <?php
        }
        }
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