
<?php 

//authorization - access control
//check whether the user is logged in or not
if(!isset($_SESSION['user']))//if user session is not set
{
    //User is not logged in 
    //Redirect to login page with message 
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access the admin panel</div>";
    //redirect ot login page
    header('Location:'.SITEURL.'admin/login.php');
}
?>