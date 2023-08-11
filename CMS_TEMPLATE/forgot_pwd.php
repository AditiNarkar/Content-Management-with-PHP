<?php  use PHPMailer\PHPMailer\PHPMailer; ?>

<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include_once "./admin/functions.php"; ?>

<?php

require './vendor/autoload.php';
require './classes/Config.php';

if(!isset($_GET['forgot']))
{
    redirect('index');
}

if(isMethod('post'))
{
    if(isset($_POST['email']))
    {
        $email = $_POST['email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if(existing_email($email))
        {
            if($statement1 = mysqli_prepare($conn, "UPDATE users SET token = '{$token}' WHERE email = ?"))
            {
                mysqli_stmt_bind_param($statement1, "s", $email);
                mysqli_stmt_execute($statement1);
                mysqli_stmt_close($statement1);

            
                $mail = new PHPMailer(true);

                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = Config::SMTP_HOST;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = Config::SMTP_USER;                     //SMTP username
                $mail->Password   = Config::SMTP_PASSWORD;                               //SMTP password
                $mail->Port       = Config::SMTP_PORT;
                $mail -> CharSet = 'UTF-8';
                
                $mail->isHTML(true); 
                
                $mail->setFrom('rosiana@jule.com', 'Rosiana');
                $mail->addAddress($email);     //Add a recipient

                $mail->Subject = 'Here is the subject';
                $mail->Body    = '<p>Hello user, 
                
                <a href="http://localhost:8080/CMS_TEMPLATE/reset.php?email='.$email.'&token='.$token.'">Click here </a> 
            
                to reset your password.</p>';
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                if($mail -> send())
                    $sent = true;
                
                else
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            
            }
            else
            {
                //echo mysqli_stmt_error($statement1);
                echo mysqli_error($conn);
            }
        }
    }
}

?>

<!-- Page Content -->
<div class="container">

<div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                        <?php if(!isset($sent)): ?>
                            
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">


                        <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                            </div>

                            <input type="hidden" class="hide" name="token" id="token" value="">

                            <?php else: ?>

                            <div class="form-group">
                                <h3> Reset link has been sent. Check your mail. </h3>
                            </div>

                            <?php endif; ?>
                        </form>

                        </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

