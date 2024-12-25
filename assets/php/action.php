<?php
// print_r($_POST);
require_once 'function.php';
require_once 'send_code.php';

//for manageing signup
if(isset($_GET['signup']))
{
    $response=validateSignup($_POST);
    // print_r($response);
    if($response['status'])
    {
    //    echo isEmailRegistered('ankitaprasad2799@gmail.com');

            if(createUser($_POST))
            {
                    header('location:../../?login');
            }
            else
            {
                echo "<srcipt>alert('something is wrong')</script>";
            }
    }
    else
    {
            $_SESSION['error']=$response;
            $_SESSION['formdata']=$_POST;
            header("location:../../?signup");
    }
}


//for maneging login
if(isset($_GET['login']))
{

        // print_r(checkUser($_POST));

    $response=validateLogin($_POST);
//     echo "<pre>";
//     print_r($response);
    if($response['status'])
    {
                $_SESSION['Auth']=true;
                $_SESSION['userdata']= $response['signup_users'];
                if($response['signup_users']['account_status']==0){
                 $_SESSION['code']= $code = rand(111111,999999);
                 sendCode($response['signup_users']['email'],'verify your email',$code);
                }
                header("location:../../");

    }
    else
    {
            $_SESSION['error']=$response;
            $_SESSION['formdata']=$_POST;
            header("location:../../?login");
    }
}

if(isset($_GET['resend_code']))
{
        $_SESSION['code']= $code = rand(111111,999999);
        sendCode( $_SESSION['userdata']['email'],'verify your email',$code);
        header("location:../../?resended");
}

if(isset($_GET['verify_email']))
{
        $user_code = $_POST['otpcode'];
        $code = $_SESSION['code'];
        if($code==$user_code)
        {

              if(verifyEmail($_SESSION['userdata']['email']))
              {
                        header("location:../../");
              }
              else
              {
                        echo "something is wrong";
              }
                
        }
        else
        {
                $response['msg']='incorrect verification code !';

                if(!$_POST['otpcode'])
                {
                        $response['msg']='enter 6 digit code !';
                }
               
                $response['field']='email_verify';
                $_SESSION['error']=$response;
                header("location:../../");
        }

}

//for logout the signup_users
if(isset($_GET['logout']))
{
        session_destroy();
        header("location:../../");

}


//forgot verfication code
if(isset($_GET['forgotpassword']))
{
      if(!$_POST['email-forgot_password'])
       {
                $response['msg'] = "enter your registered email id";
                // $response['status'] = false;
                $response['field'] = 'email';
                $_SESSION['error'] = $response;
                header("location:../../?forgotpassword");

       }
       elseif(!isEmailRegistered($_POST['email-forgot_password'])) 
       {
                     //email registered validation
                     $response['msg'] = "email id is not registered";
                     // $response['status'] = false;
                     $response['field'] = 'email';
                     $_SESSION['error'] = $response;
                     header("location:../../?forgotpassword");

        }
       else
       {

                //email store in forgot_password
                $_SESSION['forgot_password']=$_POST['email-forgot_password'];
                echo"yes good!";
                $_SESSION['forgot_code']= $code = rand(111111,999999);
                sendCode($_POST['email-forgot_password'],'forgot your password ? ',$code);
                header("location:../../?forgotpassword&resended");

       }




}


// after veried code
if(isset($_GET['verifyCode']))
{
        $user_code = $_POST['otpcode'];
        $code = $_SESSION['forgot_code'];
        if($code==$user_code)
        {
                $_SESSION['auth_temp'] = true;
               
                header("location:../../");
             
        }
        else
        {
                $response['msg']='incorrect verification code !';

                if(!$_POST['otpcode'])
                {
                        $response['msg']='enter 6 digit code !';
                }
               
                $response['field']='email_verify';
                $_SESSION['error']=$response;
                header("location:../../?forgotpassword");
        }

}


if(isset($_GET['changepassword']))
{
        if(!$_POST['password'])
        {
                 $response['msg'] = "enter your new password ";
                 // $response['status'] = false;
                 $response['field'] = 'password';
                 $_SESSION['error'] = $response;
                 header("location:../../?forgotpassword");
 
        }

        else{
        resetPassword($_SESSION['forgot_password'],$_POST['password']);
        header("location:../../?reseted");
        }
}


?>