<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        

        <?php 
        //check whether id is set or not
        if(isset($_GET['id']))
        {
            //get order details
            $id = $_GET['id'];

            //get all details from order details
            //SQL query to get the order details
            $sql = "SELECT * FROM tbl_order WHERE id =$id";
            //execute query 
            $res =mysqli_query($conn, $sql);

            //count the rows returned
            $count = mysqli_num_rows($res);

            //check whether value is available or not
            if($count == 1)
            {
                //details available
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                
            }
            else
            {
                //details not available
                //redirect to manage order page
                header('Location:'.SITEURL.'admin/manage-order.php');
            }
        }
        else
        {
            //redirect to manage order page
            header('Location:'.SITEURL.'admin/manage-order.php');
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><b>$<?php echo $price; ?></b></td>
                </tr>
                
                <tr>
                    <td>Quantity</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>">
                </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status =="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status =="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status =="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status =="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan = "2" >
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value-="update order" class="btn-primary">
                    </td>
                </tr>
            </table>
            
        </form>

        <?php 
            //check whether update button is clicked or not
            if(isset($_POST['submit']))
            {
                // echo "clicked";
                //get all the values from form 
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];

                //update the values 
                $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status'
                    WHERE id = $id
                ";

                //execute the query
                $res2 = mysqli_query($conn , $sql2);

                //check whether the result updated or not
                //redirect to manage order with message
                if($res2 == true)
                {
                    //updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully</div>";
                    header("Location:".SITEURL."admin/manage-order.php");
                }
                else
                {
                    //failed to update
                    $_SESSION['update'] = "<div class='error'>Failed to update order</div>";
                    header("Location:".SITEURL."admin/manage-order.php");
                }
            }
        ?>

    </div>
</div>
<?php include('partials/footer.php'); ?>
