<?php

if(isset($_POST['submit_user'])){
    $role = $_POST['role'];
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $username = $_POST['username'];
    $email = $_POST['emailid'];
    $pwd = $_POST['pwd'];

    $pwd = password_hash($pwd, PASSWORD_BCRYPT, array('cost'=>12));

    // $post_img = $_FILES['image']['name'];
    // $post_img_temp = $_FILES['image']['tmp_name']; //tmp_name is inbuilt

    //move_uploaded_file($post_img_temp, "../images/$post_img");

    $query = "INSERT INTO users(username, password, firstname, lastname, email, role) VALUES ('{$username}','{$pwd}','{$fn}','{$ln}','{$email}','{$role}')";

    $insert_users_query = mysqli_query($conn, $query);

    check($insert_users_query);

    echo "User Created: "."<a href='users.php'>View Users</a> <br>";

}

?>

<form action="" method="post" enctype="multipart/form-data">

   <div class="form-group">
       <label for="role">
           Select Role
       </label>
    <select class="form-control" name="role" id = "role">
        <option value="Admin">Admin</option>
        <option value="Subscriber">Subscriber</option>
    </select>
   </div>

   <div class="form-group">
        <label for="fn">
            First Name
        </label>
        <input type="text" class="form-control" name="fn">
    </div>

    <div class="form-group">
        <label for="ln">
            Last Name
        </label>
        <input type="text" class="form-control" name="ln">
    </div>

    <div class="form-group">
        <label for="username">
            Username
        </label>
        <input type="text" class="form-control" name="username">
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
        <input type="text" class="form-control" name="emailid">
    </div>

    <div class="form-group">
        <label for="pwd">
            Password
        </label>
        <input type="password" class="form-control" name="pwd">
    </div>

    <div class="form-group">
        <input class ="btn btn-primary" type="submit" name="submit_user" value="Add User"> 
    </div>

</form>