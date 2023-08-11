<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

// send email


if(isset($_POST['submit']))
{
    $to = "adunarkar2004@gmail.com";
    $subj = $_POST['subj'];
    $body = $_POST['body'];
    $header = "From: ".$_POST['email'];

    mail($to, $subj, $body, $header); //needs SMTP server locally
}

?>

<!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
    
 
<!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Id">
                        </div>

                        <div class="form-group">
                            <label for="subj" class="sr-only">Subject</label>
                            <input type="text" name="subj" id="subj" class="form-control" placeholder="Enter Subject">
                        </div>

                         <div class="form-group">
                            <label for="body" class="sr-only">Body</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


<hr>
<?php include "includes/footer.php";?>