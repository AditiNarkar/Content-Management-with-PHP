<?php

//DATABASE HELPERS

function redirect($loc)
{
    header("Location: ".$loc);
    exit;
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    check($result);
    return $result;
}

function fetch_rec($result)
{
    return mysqli_fetch_array($result);
}



//GENERAL HELPERS








//AUTHENTICATION HELPERS

function isAdmin($username = '')
{
    if(isLoggedin())
    {
        $id = $_SESSION['user_id'];
        $result = query("SELECT role FROM users WHERE user_id = $id");
        $row = fetch_rec($result);

        if($row['role'] == 'Admin') return true;
        else return false;
    }
}





function isMethod($method = null)
{
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method))
        return true;

    return false;
}

function isLoggedin()
{
    if(isset($_SESSION['role']))
        return true;
    
    return false;
}


if (!function_exists('checkLoginAndRedirect')) :
function checkLoginAndRedirect($redirectLoc = null)
{
    if(isLoggedin())
        redirect($redirectLoc);
        //header("Location: ".$redirectLoc);
}
endif;

//FOR SQL INJECTIONS
function escape($string)
{
    global $conn;
    return mysqli_real_escape_string($conn, trim($string));
}

function online_users_count()
{
    if(isset($_GET['onlineusers']))
    {
        global $conn;

        if(!$conn)
        {
            session_start();
            include ("../includes/db.php");
        
            $session = session_id();
            $time = time();
            $time_out_in_secs = 5;
            $time_out = $time - $time_out_in_secs;

            $query = "SELECT * FROM online_users WHERE session = '$session'";
            $online_query = mysqli_query($conn, $query);
            $count = mysqli_num_rows($online_query);

            if($count == NULL)
            {
                mysqli_query($conn, "INSERT INTO online_users(session, time) VALUES('$session', '$time')");
            }
            else
            {
                mysqli_query($conn, "UPDATE online_users SET time = $time WHERE session ='$session'");
            }

            $onlineUsersQuery = mysqli_query($conn, "SELECT * FROM online_users WHERE time > '$time_out'");
            echo $onlineUserCount = mysqli_num_rows($onlineUsersQuery);
        }
    }
}
online_users_count();

function check($q)
{
    global $conn;
    if(!$q){ die("failed.".mysqli_error($conn));}
}

function insert_cat()
{
    global $conn;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        
        if($cat_title==""||empty($cat_title)){
            echo "Enter Category Title.";
        }

        else{
            $query1 = mysqli_prepare($conn, "INSERT INTO categories(title) VALUES (?)");
            
            mysqli_stmt_bind_param($query1, 's', $cat_title);

            mysqli_stmt_execute($query1);

            if(!$query1){ die("error.".mysqli_error($conn));}
        }
    }
}

function printAllCategories()
{
    global $conn;
    $query="SELECT * FROM categories";
    $select_all_categories_query = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($select_all_categories_query))
    {
        $cat_id = $row['cat_id'];
        $cat_title = $row['title'];
        echo "<tr><td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td></tr>";
    }
}

function delete_cat()
{
    global $conn;
    if(isset($_GET['delete'])){
        $delete_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id={$delete_cat_id} ";
        $delete_cat_query = mysqli_query($conn,$query);
        header("Location:categories.php"); //refreshes page
    }
}

function count_rec($table_name)
{
    global $conn;
    $query = "SELECT * FROM ". $table_name;
    $select_query = mysqli_query($conn, $query);
    $count = mysqli_num_rows($select_query);
    return $count;
}

function check_condition($table_name, $col, $cond)
{
    global $conn;
    $query = "SELECT * FROM $table_name WHERE $col='$cond'";
    $select_query = mysqli_query($conn, $query);
    return mysqli_num_rows($select_query);
}

function check_double_condition($table_name, $col, $cond, $col2, $user)
{
    global $conn;
    
    $query = "SELECT * FROM $table_name WHERE $col='$cond' AND $col2 ='$user'";
    $select_query = mysqli_query($conn, $query);
    return mysqli_num_rows($select_query);
}

function user_posts($table_name, $col, $cond)
{
    global $conn;
    
    $query = "SELECT * FROM $table_name WHERE $col=$cond";
    $select_query = mysqli_query($conn, $query);
    return mysqli_num_rows($select_query);
}


function existing_username($username)
{
    global $conn;
    $query = "SELECT username FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function existing_email($email)
{
    global $conn;
    $query = "SELECT email FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function register($username, $email, $pwd)
{
    global $conn;
    
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $pwd = mysqli_real_escape_string($conn, $pwd);

    // $query = "SELECT randSalt FROM users";
    // $select_randSalt = mysqli_query($conn,$query);

    //ENCRYPTING PASSWORDS
    $pwd = password_hash($pwd, PASSWORD_BCRYPT, array('cost'=>12));
    
    // $row = mysqli_fetch_array($select_randSalt);
    // $salt = $row['randSalt'];
    // $pwd = crypt($pwd, $salt);

    // $hashFormat="$2y$10$";
    // $salt = "iusesomecrazystrings22";
    // $hashF_and_salt = $hashFormat.$salt;

    // $pwd = crypt($pwd, $hashF_and_salt);

    $query = "INSERT INTO users(username, email, password, role) VALUES('{$username}', '{$email}', '{$pwd}', 'Subscriber')";

    $register = mysqli_query($conn, $query);
    check($register);
        
}

function login($username, $pwd)
{
    global $conn;

    $username = trim($username);
    $pwd = trim($pwd);

    $username = mysqli_real_escape_string($conn, $username);
    $pwd = mysqli_real_escape_string($conn, $pwd);

    $query = "SELECT * FROM users WHERE username='{$username}'";
    $select_user_query = mysqli_query($conn, $query);
    if(!$select_user_query) die(mysqli_error($conn));

    while($row = mysqli_fetch_array($select_user_query)){
        $db_user_id = $row['user_id'];
        $db_first = $row['firstname'];
        $db_last = $row['lastname'];
        $db_user = $row['username'];
        $db_role= $row['role'];
        $db_pwd = $row['password'];
   
        //$p = crypt($p, $pwd);

        if(password_verify($pwd,$db_pwd))
        {
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_user;
            $_SESSION['firstname'] = $db_first;
            $_SESSION['lastname'] = $db_last;
            $_SESSION['role'] = $db_role;
            
            //redirect("/CMS_TEMPLATE/admin");
            echo "<script>setTimeout(\"location.href='/CMS_TEMPLATE/admin';\",1500);</script>";
            echo "<script type='text/javascript'>toastr.success('Logged in successfully.')</script>";
            
            
        }
        else
        {
            return false; 
        }
    }

    return true;
}

function image_placeholder($img = '')
{
    if(!$img)
        return 'NA.jpg';
    
    else return $img;
}

function current_user()
{
    if(isset($_SESSION['username']))
        return $_SESSION['username'];

    return false;
}

?>