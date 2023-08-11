<?php include "includes/admin_header.php";?>

<?php

if(isset($_SESSION['username'])){
    $user=$_SESSION['username'];

    $query="SELECT * FROM users WHERE username='{$user}'";
    $select_user_query = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($select_user_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $pwd = $row['password'];
        $first = $row['firstname'];
        $last = $row['lastname'];
        $email = $row['email'];
    }
}
if(isset($_POST['update']))
{
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $username = $_POST['username'];
    $email = $_POST['emailid'];
    $pwd = $_POST['pwd'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    // if(empty($post_image)){
    //     $query="SELECT * FROM posts WHERE post_id = $edit_post_id";
    //     $select_img = mysqli_query($conn, $query);
    //     while($r = mysqli_fetch_assoc($select_img)){
    //         $post_image = $r['post_image'];
    //     }
    // }

    $query = "UPDATE users SET ";
    $query .= "firstname = '{$fn}', ";
    $query .= "lastname = '{$ln}', ";
    $query .= "username = '{$username}', ";
    $query .= "email = '{$email}', ";
    $query .= "password = '{$pwd}' ";
    $query .= "WHERE username='{$user}'";

    $update_users_query = mysqli_query($conn, $query);
    if(!$update_users_query){ die("failed".mysqli_error($conn)); }

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

            <form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    
    </select>
   </div>

   <div class="form-group">
        <label for="fn">
            First Name
        </label>
        <input value="<?php echo $first; ?>" type="text" class="form-control" name="fn">
    </div>

    <div class="form-group">
        <label for="ln">
            Last Name
        </label>
        <input value="<?php echo $last; ?>" type="text" class="form-control" name="ln">
    </div>

    <div class="form-group">
        <label for="username">
            Username
        </label>
        <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
    </div>

    <!-- <div class="form-group">
        <label for="image">
           Image
        </label>
        <input type="file" name="image" accept="image/*">
    </div> -->


    <div class="form-group">
        <label for="emailid">
           Email Id
        </label>
        <input value="<?php echo $email; ?>" type="text" class="form-control" name="emailid">
    </div>

    <div class="form-group">
        <label for="pwd">
            Password
        </label>
        <input autocomplete="off" type="password" class="form-control" name="pwd">
    </div>

    <div class="form-group">
        <input class ="btn btn-primary" type="submit" name="update" value="Update Profile"> 
    </div>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
  
<?php include "includes/admin_footer.php"; ?>