<?php 

include_once "./admin/functions.php"; 
//session_start();

?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">


        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/CMS_TEMPLATE">CMS HOME</a>
        </div>



        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

            <?php

            // $query="SELECT * FROM categories";
            // $select_all_categories_query = mysqli_query($conn,$query);

            // while($row = mysqli_fetch_assoc($select_all_categories_query))
            // {
            //     $cat_id = $row['cat_id'];
            //     $cat_title = $row['title'];

            //     $cat_class='';
            //     $reg_class = '';
            //     $contact_class = '';

            //     $page_name = basename($_SERVER['PHP_SELF']);
            //     $reg = 'registration.php';
            //     $contact = 'contact.php';

            //     if(isset($_GET['category']) && $_GET['category'] == $cat_id)
            //     {
            //         $cat_class='active';
            //     }
            //     else if($page_name == $reg)
            //     {
            //         $reg_class = 'active';
            //     }
            //     else if($page_name == $contact)
            //     {
            //         $contact_class = 'active';
            //     }

            //     echo "<li class='$cat_class'><a href='/CMS_TEMPLATE/category/$cat_id''>{$cat_title}</a></li>";
            //}

            ?>

                <?php if(isLoggedin()): ?>

                    

                        <li>
                        <a href="/CMS_TEMPLATE/admin">Admin</a>
                        </li>
                    
                   
                    
                    <li>
                    <a href="/CMS_TEMPLATE/includes/logout.php">Log Out</a>
                    </li>
                
                <?php else:?>

                    <li class="<?php echo $contact_class; ?>">
                    <a href="/CMS_TEMPLATE/login">Log In</a>
                    </li>

                <?php endif;?>
                


                <li class="<?php echo $reg_class; ?>">
                    <a href="/CMS_TEMPLATE/registration">Registration</a>
                </li >

                <li class="<?php echo $contact_class; ?>">
                    <a href="/CMS_TEMPLATE/contact">Contact Us</a>
                </li>


                <?php
                if(isset($_SESSION['role'])){
                    if(isset($_GET['p_id'])){
                        $edit_post_id=$_GET['p_id'];
                        echo "<li><a href='/CMS_TEMPLATE/admin/posts.php?source=edit_post&p_id={$edit_post_id}'>Edit Post</a></li>";
                    }
                }

                ?>
    
            </ul> 
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>