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

            if(isset($_POST['submit'])) {
                $search_input = $_POST['search_input'];

                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search_input%' ";
                //WHERE SALARY LIKE '%200%'
                //Finds any values that have 200 in any position.
                $search_input_query = mysqli_query($conn, $query);

                if(!$search_input_query) { die("error.". mysqli_error($conn)); }

                $count = mysqli_num_rows($search_input_query);
                if($count==0){ echo "<h2>No results.</h2>"; }
                else{
                    while($row = mysqli_fetch_assoc($search_input_query))
                    {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_image = $row['post_image'];
                    }

                }

                ?>
                    
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $post_title; ?> </a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?> at 10:00 PM</p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
            
        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>