<?php include('partials-front/menu.php'); ?>

  <?php

    // check whether the food is set or not
    if(isset($_GET['food_id']))
    {
        //Get the Food Id and details of the selected Food
        $food_id = $_GET['food_id'];

        //Get the detils of selected details
        $sql="SELECT * FROM tbl_food WHERE  id=$food_id";

        //Execute the query
        $res=mysqli_query($conn,$sql);

        //count the rows
        $count=mysqli_num_rows($res);

          //check whether the data is avaliable or not
          if($count==1)
          {
              //We have data
              //Get the datafrom database

              $row=mysqli_fetch_assoc($res);
              $id= $row['id'];
              $title = $row['title'];
              $description=$row['description'];
              $price = $row['price'];
              $image_name = $row['image_name'];
        }else
        {
            //Food not avaliable
            echo "<div class='error'>Food Not Avaliable.</div>";
        }
    
    

      
    }else
    {
        //Redirect to homepage
        header('location:'.SITEURL);
    }
  
  
  
  ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php

                    //check whetehr the image is avaliable or not
                    if($image_name=="")
                    {
                        //Image is not avaliable
                        echo "<div class='error'>Image is not avaliable</div>";

                    }else
                    {
                        //Image is avaiable
                        ?>
                        <img src="<?php echo SITEURL ;?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">

                       <?php

                    }
                    
                    
                    ?>
                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name ="food" value="<?php echo $title; ?>">

                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name ="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. aBC" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vaBC.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 

            //check whether the submit button is clicked or not
              
                if(isset($_POST['submit']))
                  {
          
              // echo "clicked";

             //1.Get the details from the form
             $food=$_POST['food'];
             $price =$_POST['price'];
             $qty =$_POST['qty'];
             $total=$price*$qty; 

             $order_date=date("Y-m-d h:i:sa"); //order date\

             $status="Ordered"; //Ordered , On delivdery,Delivered,cancel
             $customer_name=$_POST['full-name'];
             $customer_contact=$_POST['contact'];
             $customer_email=$_POST['email'];
             $customer_address=$_POST['address'];

             //save the order in database
             $sql2="INSERT INTO tbl_order SET
             food='$food',
             price='$price',
             qty='$qty',
             total='$total',
             order_date='$order_date',
             status='$status',
             customer_name='$customer_name',
             customer_contact=' $customer_contact',
             customer_email='$customer_email',
             customer_address='$customer_address'
             ";
              // echo $sql2; die();
             //execute the query
             $res2=mysqli_query($conn,$sql2);

        //4. check whether the query is executed or not and data added or not
        if($res2==true){

          //query executed and order saved
           $_SESSION['order']="<div class='success text-center'>Food Ordered  Sucessfully.</div>";
          //Redirect to manage category page
          header('location:'.SITEURL);

        }else{

          //Failed to save order
          $_SESSION['order']="<div class='error text-center'>Failed to Order Food.</div>";
          //Redirect to manage category page
          header('location:'.SITEURL);

        }

       }
            
                  
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>

</body>
</html>