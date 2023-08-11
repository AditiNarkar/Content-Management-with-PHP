<?php include "includes/admin_header.php";?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
            <h1 class="page-header"> Hello! <?php echo $_SESSION['role']; ?> <small><?php echo $_SESSION['username']; ?></small> </h1>

            <?php
            if(isset($_GET['source']))
                $source = $_GET['source'];
            else 
                $source = '';

            switch($source){
                case 'approve'; include "includes/add_posts.php"; break;
                case 'unapprove'; include "includes/edit_posts.php"; break;
                default: include "includes/view_comments.php";
            }
            ?>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
  
<?php include "includes/admin_footer.php"; ?>