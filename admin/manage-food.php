<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Foods</h1>
    <br><br>
            <!--  button to create an admin account -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add A Food</a>
        <br><br><br>
        
        <?php 
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['unauthorized']))
        {
            echo $_SESSION['unauthorized'];
            unset($_SESSION['unauthorized']);
        }
        
        if(isset($_SESSION['no-food-found']))
        {
            echo $_SESSION['no-food-found'];
            unset($_SESSION['no-food-found']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['remove-failed']))
        {
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }
        ?>
                <table class="tbl-full">
                   <tr>
                       <th>S.N</th>
                       <th>Title</th>
                       <th>Price</th>
                       <th>Image</th>
                       <th>Featured</th>
                       <th>Active</th>
                       <th>Actions</th>
                   </tr>

            <?php 
                //Query to get all categories from database
                $sql = "SELECT * FROM tbl_food";

                //execute query to get all categories
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //create serial number variable and assign value as 1
                $sn=1;

                //check whether we hae in database or not
                if($count>0)
                {
                    //We have data in database
                    //get and display data
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                    <tr>
                       <td><?php echo $sn++; ?></td>
                       <td><?php echo $title?></td>
                       <td>$<?php echo $price?></td>


                       <td>
                           <?php 
                           //check whether image name is available or not 
                           if($image_name != "")
                           {
                               //display the image
                               ?>
                               <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name?>" width="100px">
                               <?php
                           }
                           else
                           {
                               //display the message
                               echo "<div class='error'>Image not added</div>";
                           }
                           ?>
                        </td>
                       <td><?php echo $featured?></td>
                       <td><?php echo $active?></td>
                       <td>
                           <a href="<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                           <a href="<?php echo SITEURL?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                       </td>
                   </tr>

                        <?php
                    }
                }
                else 
                {
                    //we do not have data in database
                    //we'l display the message inside table
                    ?>

                    <tr>
                    <td colspan="6" ><div class="error">No Food added</div></td>
                    </tr>

                    <?php
                }
            ?>


               </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
