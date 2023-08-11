<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>User Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last name</th>
            <th>Email Id</th>
            <!-- <th>Image</th> -->
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

    <?php

    $query="SELECT * FROM users";
    $select_all_users_query = mysqli_query($conn,$query);
    check($select_all_users_query);
    while($row = mysqli_fetch_assoc($select_all_users_query))
    {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $first = $row['firstname'];
        $last = $row['lastname'];
        $email = $row['email'];
        $role = $row['role'];
        
        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$first}</td>";
        echo "<td>{$last}</td>";
        echo "<td>{$email}</td>";
        echo "<td>{$role}</td>";
    
        echo "<td><a href='users.php?to_admin={$user_id}'>Make Admin</a></td>";
        echo "<td><a href='users.php?to_sub={$user_id}'>Make Subscriber</a></td>";
        echo "<td><a href='users.php?source=edit&edit_user={$user_id}'>Edit</a></td>";
        
        echo "<td><a onClick=\"javascript: return confirm('Confirm Deletion ?');\" href='users.php?delete={$user_id}'>Delete</a></td>";
        echo "</tr>";
    }

    ?>

    </tbody>
</table>

<?php

if(isset($_GET['to_admin'])){
    $admin_user_id = $_GET['to_admin'];
    $query = "UPDATE users SET role='Admin' WHERE user_id=$admin_user_id";
    $admin_query = mysqli_query($conn, $query);
    if(!$admin_query) die(mysqli_error($conn));
    header("Location: users.php");
}


if(isset($_GET['to_sub'])){
    $sub_user_id = $_GET['to_sub'];
    $query = "UPDATE users SET role='Subscriber' WHERE user_id=$sub_user_id";
    $sub_query = mysqli_query($conn, $query);
    if(!$sub_query) die(mysqli_error($conn));
    header("Location: users.php");
}

//delete cmt query
if(isset($_GET['delete']))
{
    if(isset($_SESSION['role']))
    {       
        if($_SESSION['role']=='Admin')
        {
            $del_user_id = mysqli_real_escape_string($conn, $_GET['delete']);
            
            $query = "DELETE FROM users WHERE user_id={$del_user_id}";
            $del_user_query = mysqli_query($conn, $query);
            header("Location: users.php");
        }
    }
}

?>