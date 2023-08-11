<?php
if(isset($_GET['edit_user']))
{
    $edit_user_id = $_GET['edit_user'];

    $query="SELECT * FROM users WHERE user_id = $edit_user_id";
    $select_a_user_query = mysqli_query($conn,$query);
    check($select_a_user_query);

    while($row = mysqli_fetch_assoc($select_a_user_query)) 
    {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $first = $row['firstname'];
        $last = $row['lastname'];
        $email = $row['email'];
        $role = $row['role'];
        $pwd = $row['password'];
    }

    if(isset($_POST['update']))
    {
        $role = $_POST['role'];
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

        // $query = "SELECT randSalt FROM users";
        // $select_randSalt = mysqli_query($conn,$query);

        // $row = mysqli_fetch_array($select_randSalt);
        // $salt = $row['randSalt'];

        // $hashed_pwd = crypt($pwd, $salt);


        if(!empty($pwd))
        {
            $query_pwd = "SELECT password FROM users WHERE user_id = $edit_user_id";
            $get_pwd_query = mysqli_query($conn, $query_pwd);
            check($get_pwd_query);
            $row =  mysqli_fetch_array($get_pwd_query);
            $p = $row['password'];

            if($p != $pwd)
            {
                $hashed_pwd = password_hash($p, PASSWORD_BCRYPT, array('cost'=>12));
            }

            $query = "UPDATE users SET ";
            $query .= "role = '{$role}', ";
            $query .= "firstname = '{$fn}', ";
            $query .= "lastname = '{$ln}', ";
            $query .= "username = '{$username}', ";
            $query .= "email = '{$email}', ";
            $query .= "password = '{$hashed_pwd}' ";
            $query .= "WHERE user_id={$user_id}";

            $update_users_query = mysqli_query($conn, $query);
            if(!$update_users_query){ die("failed".mysqli_error($conn)); }

            echo "User Updated: "."<a href='users.php'>View Users</a> <br>";
        }

    }
}
else
{
    header("Location: index.php");
}

?>
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
       <label for="role">
           Select Role
       </label>
    <select class="form-select" name="role" id = "role">
        <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
        <?php 
        if ($role=='Admin'){
            echo "<option value='Subscriber'>Subscriber</option>" ;
        }
        else{
            echo "<option value='Admin'>Admin</option>";
        }

        ?>
    
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
        <input class ="btn btn-primary" type="submit" name="update" value="Update User"> 
    </div>

</form>