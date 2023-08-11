<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/functions.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<?php

if(isset($_GET['lang']) && !empty($_GET['lang']))
{
    $_SESSION['lang'] = $_GET['lang'];
    if(isset($_SESSION['lang']) && isset($_SESSION['lang']) != $_GET['lang'])
    {
        echo "<script type='text/javascript'> location.reload(); </script>";
    }
}

if(isset($_SESSION['lang']))
    include "includes/languages/".$_SESSION['lang'].".php";

else
    include "includes/languages/en.php";



if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = trim($_POST['username']); //removes white spaces
    $email = trim($_POST['email']);
    $pwd = trim($_POST['password']);

    $error = [
        'username' => '',
        'email' => '',
        'pwd' => ''
    ];

    if(strlen($username) < 3)
        $error['username'] = "Very small username.";
    
    if($username == '')
        $error['username'] = "Username cannot be empty.";

    if(existing_username($username))
        $error['username'] = "User already exists. <a href='index.php'>LogIn instead.</a>";

    if($email == '')
        $error['email'] = "Email cannot be empty.";

    if(existing_email($email))
        $error['email'] = "Email already exists. <a href='index.php'>LogIn instead.</a>";

    if($pwd == '')
        $error['pwd'] = "Password cannot be empty.";

    
    foreach($error as $key => $val)
    {
        if(empty($val))
        {
            unset($error[$key]);
        }
    }

    if(empty($error))
    {
        register($username, $email, $pwd);

        echo "<script>setTimeout(\"location.href='/CMS_TEMPLATE/admin';\",1500);</script>";
        echo "<script type='text/javascript'>toastr.success('User registered successfully. Redirecting to login page...')</script>";

        //login($username, $pwd);
    }
}



?>

<!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
    
 
<!-- Page Content -->
<div class="container">

<form method="get" action="" class="navbar-form navbar-right" id="lang_form">
    <div class="form-group">
        <label for="lang_form">Select Language</label>
        <select name="lang"  class="form-select" onChange="changeLang()">
            
        <option value="en" 
        <?php 
        if(isset($_SESSION['lang']) && $_SESSION['lang']=='en'){echo "selected"; }
        ?>
        >
        English
        </option>
                
        <option value="lang2" 
        <?php 
        if(isset($_SESSION['lang']) && $_SESSION['lang']=='lang2') {echo "selected";  }
        ?>
        >
        Spanish
        
        </option>

        
        </select>
    </div>
</form>
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _REGISTER; ?></h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>" 
                            autocomplete="on"
                            value="<?php echo isset($username) ? $username : ''; ?>"
                            >
                            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>

                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>"
                            autocomplete="on"
                            value="<?php echo isset($email) ? $email : ''; ?>"
                            >
                            <p><?php echo isset($error['pwd']) ? $error['pwd'] : '' ?></p>
                        </div>

                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>"
                            >
                            <p><?php echo isset($error['pwd']) ? $error['pwd'] : '' ?></p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="<?php echo _REGISTER; ?>">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


<hr>

<script>
    function changeLang()
    {
        document.getElementById('lang_form').submit();
    }
</script>


<?php include "includes/footer.php";?>