<?php
// session_start();

require_once 'assets/php/function.php';


//function call showpage
// showPage('pagename',[]);
// showPage('header', ['page_title' => 'MyBook-SignUP']);
// showPage('signup');
// showPage('footer');

if(isset($_SESSION['Auth']))
{
    $user = getUser($_SESSION['userdata']['id']);
}
if(isset($_SESSION['Auth']) && $user ['account_status']==1)
{
        // echo"user is logged in";
        // $userdata = $_SESSION['userdata'];
        // echo "<pre>";
        // print_r($userdata);

        //show page
        showPage('header', ['page_title' => 'MyBook-Home']);
        showPage('navbar');
        showPage('wallhome');

}
elseif(isset($_SESSION['Auth']) && $user ['account_status']==0)
{
        // echo"user is logged in";
        // $userdata = $_SESSION['userdata'];
        // echo "<pre>";
        // print_r($userdata);

        //show page
        showPage('header', ['page_title' => 'MyBook-Verify Your Email']);
        showPage('verify_email');

}
elseif(isset($_SESSION['Auth']) && $user ['account_status']==2)
{
        // echo"user is logged in";
        // $userdata = $_SESSION['userdata'];
        // echo "<pre>";
        // print_r($userdata);

        //show page
        showPage('header', ['page_title' => 'MyBook-Blocked']);
        showPage('blocked');

}
elseif (isset($_GET['signup']))
{
    showPage('header', ['page_title' => 'MyBook-SignUP']);
    showPage('signup');
    // showPage('footer');
   
}
elseif(isset($_GET['login']))
{
    showPage('header', ['page_title' => 'MyBook-Login']);
    showPage('login');
}
elseif(isset($_GET['forgotpassword']))
{
    showPage('header', ['page_title' => 'MyBook-forgot_password']);
    showPage('forgot_password');
}


else
{
    showPage('header', ['page_title' => 'MyBook-Login']);
    showPage('login');
}



showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);