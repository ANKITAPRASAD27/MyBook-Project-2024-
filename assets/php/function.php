<?php
// session_start();
require_once 'config.php';
//MAKE CANNATION using object oriented
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die("database is not connected");
//function for showing pages
function showPage($page_name, $data = "")
{
    include("assets/pages/$page_name.php");

    // include('assets/pages/header.php');
    // include('assets/pages/signup.php');
    // include('assets/pages/footer.php');
}
//function show error
function showError($field)
{
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        if (isset($error['field']) && $field == $error['field']) {
            ?>
            <div class="alert alert-danger" style="height:5px; font-size:10px;">
               <?=$error['msg']?>
            </div>

            <?php
        }
    }
}
//function for show prevformdata
function showFormData($field)
{
    if (isset($_SESSION['formdata'])) 
    {
        $formData = $_SESSION['formdata'];
        return $formData[$field];
    }
}
//for checking duplicate email
function  isEmailRegistered($email)
{
        global $db;
        $query="SELECT COUNT(*) as row FROM signup_users where email='$email'";
        $run=mysqli_query($db,$query);
        $return_data=mysqli_fetch_assoc($run);
        return $return_data['row'];
}
//for checking duplicate username
function  isUserRegistered($username)
{
        global $db;
        $query="SELECT COUNT(*) as row FROM signup_users where username='$username'";
        $run=mysqli_query($db,$query);
        $return_data=mysqli_fetch_assoc($run);
        return $return_data['row'];
}
//validation for sign up form
function validateSignup($form_data)
{
    //blank array
    $response = array();
    $response['status']=true;

    if (!$form_data['password']) {
        $response['msg'] = "password is not given";
        $response['status'] = false;
        $response['field'] = 'password';
    }


    if (!$form_data['confirm_password']) {
        $response['msg'] = "confirm password is not given";
        $response['status'] = false;
        $response['field'] = 'confirm_password';
    }


    if (!$form_data['username']) {
        $response['msg'] = "user name is not given";
        $response['status'] = false;
        $response['field'] = 'username';
    }


    if (!$form_data['email']) {
        $response['msg'] = "email is not given";
        $response['status'] = false;
        $response['field'] = 'email';
    }

    //email registered validation
    if (isEmailRegistered($form_data['email'])) {
        $response['msg'] = "email id is already registered";
        $response['status'] = false;
        $response['field'] = 'email';
    }

     //user registered validation
     if (isUserRegistered($form_data['username'])) {
        $response['msg'] = "user name is already registered";
        $response['status'] = false;
        $response['field'] = 'username';
    }



    return $response;
}


//for creating new user
function createUser($data)
{
    global $db;
    $username=mysqli_real_escape_string($db,$data['username']);
    $gender=$data['gender'];
    $email=mysqli_real_escape_string($db,$data['email']);
    $password=mysqli_real_escape_string($db,$data['password']);
    $password=md5($password);
    $confirm_password=mysqli_real_escape_string($db,$data['confirm_password']);
    $query="INSERT INTO signup_users(username,gender,email,password,confirm_password)";$query.="VALUES('$username',$gender,'$email','$password','$confirm_password')";

    return mysqli_query($db,$query);
}

//validation for sign in form
function validateLogin($form_data)
{
    //blank array
    $response = array();
    $response['status']=true;
    $blank=false;

    if (!$form_data['password']) {
        $response['msg'] = "password is not given";
        $response['status'] = false;
        $response['field'] = 'password';
        $blank=true;
    }

    if (!$form_data['username_email']) {
        $response['msg'] = "username/email is not given";
        $response['status'] = false;
        $response['field'] = 'username_email';
        $blank=true;
    }
    
    if (!$blank && !checkUser($form_data)['status']) {
        $response['msg'] = "something is incorrect we cant't find you";
        $response['status'] = false;
        $response['field'] = 'checkuser';
    }
    else{
        $response['signup_users']=checkUser($form_data)['signup_users'];
    }
    return $response;
}
//checking the username/email or password for login
function checkUser($login_data)
{
        global $db; 
        $username_email=$login_data['username_email'];
        $password=md5($login_data['password']);
        $query="SELECT * FROM signup_users WHERE(email='$username_email' || username='$username_email') && password='$password'";
        $run= mysqli_query($db,$query);
        $data['signup_users']=mysqli_fetch_assoc($run)??array();

        if(count($data['signup_users'])>0)
        {
            $data['status']=true;

        }
        else
        {
            $data['status']=false;

        }


        return $data;
}




//for getting the data by user id
function getUser($user_id)
{       
        global $db; 
        $query="SELECT * FROM signup_users WHERE id='$user_id'";
        $run= mysqli_query($db,$query);
        return mysqli_fetch_assoc($run);
}

//function for verify email
function verifyEmail($email)
{
    global $db;
    $query="UPDATE signup_users SET account_status = 1 WHERE email='$email'";
    return mysqli_query($db,$query);


}



//function for verify password
function resetPassword($email,$password)
{
    global $db;
   // $password=mysqli_real_escape_string($db,$password['password']);
    $password=md5($password);
    $query="UPDATE signup_users SET password = '$password' WHERE email='$email' ";
    return mysqli_query($db,$query);


}



?>