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
        $path = "../images/category/".$image_name;
        //remove the image
        $remove = unlink($path);

        //if failed to remove image then add error message and stop the process
        if($remove == false)
        {
            //set the session message 
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
    
            //redirect to manage category page
            header("Location:".SITEURL.'admin/manage-category.php');

            //stop  the process
            die();
        }
    }

    //delete data from database
    //SQL Query to delete data from database
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //execute the Query
    $res = mysqli_query($conn, $sql);

    //check whether the data is delete from database or not
    if($res == true)
    {
        //Set success message and redirect
        $_SESSION['delete'] = "<div class='success'>category deleted successfully</div>";
        //redirect to manage category page
        header("Location:".SITEURL.'admin/manage-category.php');
    }
    else
    {
        //Set Fail message and redirect
        $_SESSION['delete'] = "<div class='error'>failed to delete category</div>";
        //redirect to manage category page
        header("Location:".SITEURL.'admin/manage-category.php');
    }
    //redirect to manage category page with message
}
else
{
    //redirect to manage category page
    header('Location:'.SITEURL.'admin/manage-category');
}

?>