<?php 
    //include constants.php for url
    include('../config/constants.php');
    //1. Destroy the session 
    session_destroy(); 
    //unsets $_SESSION['user']

    //2.redirect to login page
    header('Location:'.SITEURL.'admin/login.php');

?>