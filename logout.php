<?php
session_start();

if(isset($_SESSION['admin_id']))
{
    unset($_SESSION['user_id']); //destroy session for user id only
    header("Location: admin/login_user.php"); //redirect to admin login as user
}
else{
    unset($_SESSION['user_id']); //destroy session for user id
    header("Location: login.php"); //redirect to login page 
}

exit;

?>