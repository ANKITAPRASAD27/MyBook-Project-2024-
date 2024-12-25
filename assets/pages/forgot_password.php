<div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">

        <?php
        if(isset($_SESSION['forgot_code']) && !isset( $_SESSION['auth_temp'] ))
        {
            $action ="verifyCode";

        }


        elseif(isset($_SESSION['forgot_code']) && isset( $_SESSION['auth_temp'] ))
        {
            $action ="changepassword";

        }


       else
        {
            $action ="forgotpassword";
        }
        ?>


            <form method="post" action="assets/php/action.php?<?=$action?>">
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Forgot Your Password ?</h1>


            <?php
                if($action=='forgotpassword')
                {

                        ?>

                <div class="form-floating">
                    <input type="email" class="form-control rounded-0" placeholder="username/email" name="email-forgot_password">
                    <label for="floatingInput">enter your email</label>
                </div>
               
        <?= showError('email') ?>

                <br>
                <button class="btn btn-primary" type="submit">Send Verification Code</button>

                        <?php



                }
            ?>








<?php
                if($action=='verifyCode')
                {

                        ?>

               
                <p>Enter 6 Digit Code Sended to You 
                    <br>
                 <h6 class="text-success">Email:<?=$_SESSION['forgot_password']?>
                 </h6>
                </p>
                <div class="form-floating mt-1">

                    <input type="text" name="otpcode" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">######</label>
                </div>
        <?= showError('email_verify') ?>

                <br>
                <button class="btn btn-primary" type="submit">Verify Code</button> 

                        <?php



                }
?>





<?php
                if($action=='changepassword')
                {

                        ?>

               
                <p>Enter your new password - 
                    <br>
                 <h6 class="text-success">Email:<?=$_SESSION['forgot_password']?>
                 </h6>
                </p>
                <div class="form-floating mt-1">
                    <input type="text" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="new Password" >
                    <label for="floatingPassword">new password</label>
                </div>  
        <?= showError('password') ?>

                <br>
                 
    <button class="btn btn-primary" type="submit">Change Password</button>

                        <?php



                }
?>

                

            






                <br>

                <a href="?login" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i> Go Back
                    To
                    Login
                </a>

            </form>
        </div>
    </div>

