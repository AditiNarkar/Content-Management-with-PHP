<?php include "includes/admin_header.php";

if(!isAdmin(($_SESSION['username'])))
{
    header("Location: index.php");
}

?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
            <h1 class="page-header"> Hello! Admin <small>Author</small> </h1>

            <?php
            if(isset($_GET['source'])){
                $source = $_GET['source'];
            }
            else { $source = '';}
            switch($source){
                case 'add_users'; include "includes/add_users.php"; break;
                case 'edit'; include "includes/edit_users.php"; break;
                default: include "includes/view_users.php";
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