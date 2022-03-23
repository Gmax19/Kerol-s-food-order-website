<?php 
//include constants file
include('../config/constants.php');

//echo "delete page";
//check whether the id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //get the value and delete the image
    //echo "get the value and delete the image";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image file is available
    if($image_name != "")
    {
        //image is available. so remove it
        $path = "../images/food/".$image_name;
        //remove the image
        $remove = unlink($path);

        //if failed to remove image then add error message and stop the process
        if($remove == false)
        {
            //set the session message 
            $_SESSION['upload'] = "<div class='error'>Failed to remove food image</div>";
    
            //redirect to manage food page
            header("Location:".SITEURL.'admin/manage-food.php');

            //stop  the process
            die();
        }
    }

    //delete data from database
    //SQL Query to delete data from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //execute the Query
    $res = mysqli_query($conn, $sql);

    //check whether the data is delete from database or not
    if($res == true)
    {
        //Set success message and redirect
        $_SESSION['delete'] = "<div class='success'>food deleted successfully</div>";
        //redirect to manage food page
        header("Location:".SITEURL.'admin/manage-food.php');
    }
    else
    {
        //Set Fail message and redirect
        $_SESSION['delete'] = "<div class='error'>failed to delete food</div>";
        //redirect to manage food page
        header("Location:".SITEURL.'admin/manage-food.php');
    }
    //redirect to manage food page with message
}
else
{
    //redirect to manage food page
    $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access</div>";
    header('Location:'.SITEURL.'admin/manage-food');
}

?>