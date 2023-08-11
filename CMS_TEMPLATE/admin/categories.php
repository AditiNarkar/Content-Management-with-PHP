<?php include "includes/admin_header.php";?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Hello! Admin
                    <small>Author</small>
                </h1>

                <div class="col-sm-6">
                    <?php insert_cat(); ?>
                    
                    <form action="" method="post">
                        <div class="form-group">
                            <input class="form-control" type="text" name ="cat_title" placeholder="Enter Category Title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name ="submit" value="Add category">
                        </div>
                    </form>

                    <?php
                    if(isset($_GET['edit'])){
                        $cat_id = $_GET['edit'];
                        include "includes/update_cat.php";
                    }

                    ?>

                </div>
        
                <div class="col-sm-6">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                    <?php
                    printAllCategories();
                    delete_cat();
                    ?>
                            
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
  
<?php include "includes/admin_footer.php"; ?>