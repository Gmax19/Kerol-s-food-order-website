<?php 

 // include constant.php file here
        include('../config/constants.php');

 // 1. get the ID of admin to be deleted
        $id = $_GET['id'];

 // 2. Create SQL Query to delete admin 
        $sql = "DELETE FROM tbl_admin WHERE id=$id";

// Execute the query 
        $res = mysqli_query($conn, $sql);

// check whether the query is executed successfully or not
        if($res==TRUE)
        {
            //Query executed successfully and admin is deleted
            // echo "Admin Deleted";
            //create session variable to display message
            $_SESSION['delete'] = "<div class='success'>Admin Deleted successfully</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Query failed to delete admin
            // echo "Failed to delete admin";
            //create session variable to display message
            $_SESSION['delete'] = "<div class='error'>Admin failed to be deleted , Try again later</div>";
             //redirect to manage admin page
             header('location:'.SITEURL.'admin/manage-admin.php');
        }

 // 3. Redirect to manage admin page with message (success/error)


?>