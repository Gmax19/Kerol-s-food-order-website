<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; // display the session message if set
                unset($_SESSION['add']);// remove session message 
            }
        ?>
        
        <form action="" method="POST">
         
            <table class="tbl-30"> 
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter a username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter a password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>


<?php 

//Process value from form and save it in database

//Check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    // Button is clicked 
    // echo "button clicked";

    //1. Get data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption with MD5
    
    //2. SQL Query to save data into database
    $sql = "INSERT INTO tbl_admin SET
            full_name= '$full_name',
            username = '$username' ,
            password = '$password'
    ";

    //3. Executing Query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4.check whether the data(query) is executed into database or not and display appropriate message
    if($res=TRUE)
    {
        //data inserted 
        // echo "Data inserted";
        //create a session variable to display message 
        $_SESSION['add'] = "Admin added succesfully";
        //redirect to manage admin page 
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else 
    {
        //failed to insert data 
        // echo "failed to insert data";
        //create a session variable to display message 
        $_SESSION['add'] = "Failed to add admin";
        //redirect to add admin page 
        header("location:".SITEURL.'admin/add-admin.php');
    }
} 

?>